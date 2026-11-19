<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\TelegramCategory;
use App\Models\TelegramProduct;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tests\TestCase;

#[RunTestsInSeparateProcesses]
#[PreserveGlobalState(false)]
class ManualCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_empty_catalog_and_manual_web_product(): void
    {
        $this->get('/')->assertOk();
        $this->get('/products')->assertOk();

        $product = Product::create([
            'name' => 'Owned product', 'slug' => 'owned-product',
            'category' => 'other', 'category_label' => 'Owned', 'icon' => 'box',
            'default_price' => 10000, 'default_slashed' => 10000,
            'sold' => '0', 'options' => [['id' => 'owned-1', 'name' => 'Own plan', 'price' => 10000, 'stock' => 5]],
        ]);
        $this->get('/')->assertOk()->assertSee('Owned product');
        $product->delete();
        $this->get('/')->assertOk()->assertDontSee('Owned product');
    }

    public function test_telegram_admin_has_manual_catalog_without_supplier_requests(): void
    {
        Http::fake();
        $admin = User::factory()->create(['role' => 'admin']);
        $this->withSession(['admin_verified' => true, 'admin_verified_at' => time()]);
        $this->actingAs($admin)->get('/admin/telegram?tab=products')
            ->assertOk()->assertDontSee('Canboso')->assertSee('addProductModal');
        $this->get('/admin/telegram?tab=canboso')->assertRedirect('/admin/telegram?tab=products');
        Http::assertNotSent(fn ($request) => str_contains($request->url(), 'canboso'));
    }

    public function test_telegram_product_accepts_owned_stock_and_rejects_supplier_delivery(): void
    {
        Http::fake();
        $this->actingAs(User::factory()->create(['role' => 'admin']));
        $this->withSession(['admin_verified' => true, 'admin_verified_at' => time()]);
        $category = TelegramCategory::create(['name' => 'Own category', 'slug' => 'own-category']);
        $data = ['category_id' => $category->id, 'name' => 'Own account', 'price' => 10000, 'delivery_type' => 'key_stock'];
        $this->post('/admin/telegram/products', $data)->assertSessionHasNoErrors();
        $this->assertSame(1, TelegramProduct::count());
        $this->post('/admin/telegram/products', array_replace($data, ['delivery_type' => 'canboso_api']))
            ->assertSessionHasErrors('delivery_type');
        $this->assertSame(1, TelegramProduct::count());
    }
}
