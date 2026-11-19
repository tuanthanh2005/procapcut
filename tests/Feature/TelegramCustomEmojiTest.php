<?php

namespace Tests\Feature;

use App\Models\TelegramCategory;
use App\Models\TelegramUser;
use App\Models\User;
use App\Services\TelegramBotService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tests\TestCase;

#[RunTestsInSeparateProcesses]
#[PreserveGlobalState(false)]
class TelegramCustomEmojiTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_buttons_send_custom_icons_without_svg_or_duplicate_emoji(): void
    {
        Http::fake(['*' => Http::response(['ok' => true])]);
        $category = TelegramCategory::create([
            'name' => 'ChatGPT', 'slug' => 'chatgpt', 'icon' => '<svg></svg>',
            'telegram_icon' => 'X', 'telegram_custom_emoji_id' => '5368324170671202286', 'is_active' => true,
        ]);
        (new TelegramBotService('test-token'))->showCategories(123);
        Http::assertSent(function ($request) use ($category) {
            $button = json_decode($request['reply_markup'], true)['inline_keyboard'][0][0];
            return $button === ['text' => 'ChatGPT', 'callback_data' => 'cat_'.$category->id, 'icon_custom_emoji_id' => '5368324170671202286'];
        });
        $category->telegram_custom_emoji_id = null;
        $this->assertSame('X ChatGPT', $category->toTelegramButton()['text']);
        $this->assertArrayNotHasKey('icon_custom_emoji_id', $category->toTelegramButton());
    }

    public function test_rejected_custom_icon_retries_once_with_functional_text_buttons(): void
    {
        Http::fake(['*' => Http::sequence()
            ->push(['ok' => false, 'error_code' => 400, 'description' => 'Bad Request: CUSTOM_EMOJI_ID_INVALID'], 400)
            ->push(['ok' => true])]);
        TelegramCategory::create(['name' => 'Own', 'slug' => 'own', 'telegram_custom_emoji_id' => '5368324170671202286', 'is_active' => true]);
        (new TelegramBotService('test-token'))->showCategories(123, 456);
        Http::assertSentCount(2);
        $payload = Http::recorded()->last()[0];
        $this->assertStringEndsWith('/editMessageText', $payload->url());
        $button = json_decode($payload['reply_markup'], true)['inline_keyboard'][0][0];
        $this->assertSame('Own', $button['text']);
        $this->assertArrayNotHasKey('icon_custom_emoji_id', $button);
        $this->assertStringStartsWith('cat_', $button['callback_data']);
    }

    public function test_admin_can_save_edit_and_clear_ids_and_reject_invalid_ids(): void
    {
        Http::fake(['*' => Http::response(['ok' => true])]);
        $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->withSession(['admin_verified' => true, 'admin_verified_at' => time()]);
        $data = ['name' => 'Own icons', 'telegram_custom_emoji_id' => '5368324170671202286', 'is_active' => 1];
        $this->post('/admin/telegram/categories', $data)->assertSessionHasNoErrors();
        $category = TelegramCategory::firstOrFail();
        $this->assertSame($data['telegram_custom_emoji_id'], $category->telegram_custom_emoji_id);
        $this->get('/admin/telegram?tab=categories')->assertOk()->assertSee('edit_cat_custom_emoji_id')->assertSee('add_cat_custom_emoji_id');
        $this->put('/admin/telegram/categories/'.$category->id, array_replace($data, ['telegram_custom_emoji_id' => 'bad-id']))
            ->assertSessionHasErrors('telegram_custom_emoji_id');
        $this->put('/admin/telegram/categories/'.$category->id, array_replace($data, ['telegram_custom_emoji_id' => '']))
            ->assertSessionHasNoErrors();
        $this->assertNull($category->fresh()->telegram_custom_emoji_id);
    }

    public function test_emojiid_command_reads_custom_emoji_from_a_replied_message(): void
    {
        Http::fake(['*' => Http::response(['ok' => true])]);
        TelegramUser::create(['telegram_id' => 123, 'first_name' => 'Owner']);
        (new TelegramBotService('test-token'))->handleMessage([
            'chat' => ['id' => 123], 'from' => ['id' => 123, 'first_name' => 'Owner'],
            'text' => '/emojiid',
            'reply_to_message' => ['entities' => [
                ['type' => 'custom_emoji', 'custom_emoji_id' => '5368324170671202286', 'offset' => 0, 'length' => 2],
            ]],
        ]);
        Http::assertSentCount(1);
        Http::assertSent(fn ($request) => str_contains($request['text'], '<code>5368324170671202286</code>'));
    }

    public function test_web_icon_round_trip_repairs_old_encoding_and_preserves_custom_telegram_icon(): void
    {
        Http::fake(['*' => Http::response(['ok' => true])]);
        $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->withSession(['admin_verified' => true, 'admin_verified_at' => time()]);
        $category = TelegramCategory::create([
            'name' => 'ChatGPT', 'slug' => 'chatgpt',
            'telegram_custom_emoji_id' => '5368324170671202286',
        ]);
        $svg = '<svg viewBox="0 0 24 24"><path fill="#10a37f" d="M0 0h24v24z"/></svg>';
        // Simulate a record saved by the old form, bypassing normalization.
        \Illuminate\Support\Facades\DB::table('telegram_categories')->where('id', $category->id)
            ->update(['icon' => htmlspecialchars($svg, ENT_QUOTES)]);
        for ($round = 0; $round < 2; $round++) {
            $html = $this->get('/admin/telegram?tab=categories')->assertOk()->getContent();
            $this->assertStringContainsString('<path fill="#10a37f"', $html);
            $this->assertStringNotContainsString('&amp;lt;svg', $html);
            preg_match('/data-cat-icon="([^"]+)"/', $html, $matches);
            $formValue = html_entity_decode($matches[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $this->put('/admin/telegram/categories/'.$category->id, [
                'name' => 'ChatGPT', 'icon' => $formValue,
                'telegram_custom_emoji_id' => '5368324170671202286',
            ])->assertSessionHasNoErrors();
            $this->assertSame($svg, $category->fresh()->getRawOriginal('icon'));
            $this->assertSame('5368324170671202286', $category->fresh()->telegram_custom_emoji_id);
        }
    }
}
