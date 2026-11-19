<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tests\TestCase;

#[RunTestsInSeparateProcesses]
#[PreserveGlobalState(false)]
class SharedHeaderTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_pages_share_navigation_assets_and_account_menu(): void
    {
        Product::create([
            'name' => 'Own product', 'slug' => 'own-product', 'icon' => 'box',
            'category' => 'other', 'category_label' => 'Other',
            'default_price' => 10000, 'default_slashed' => 10000,
            'features' => ['Owned stock'],
            'options' => [['id' => 'own-plan', 'name' => 'Own plan', 'price' => 10000, 'slashed' => 10000, 'stock' => 5, 'description' => 'Own stock', 'require_email' => false]],
        ]);
        Post::create(['title' => 'Own article', 'slug' => 'own-article', 'content' => 'Article content', 'is_published' => true]);

        foreach (['/', '/products', '/products?category=api-token', '/product/own-product', '/posts', '/post/own-article', '/login', '/register', '/forgot-password', '/reset-password/test-token'] as $url) {
            $response = $this->get($url)->assertOk();
            $this->assertSharedHeader($response->getContent(), $url, false);
        }

        $user = User::factory()->create();
        $this->actingAs($user);
        $order = Order::create([
            'user_id' => $user->id, 'customer_name' => $user->name,
            'customer_email' => $user->email, 'customer_phone' => '0900000000',
            'product_name' => 'Own product', 'product_icon' => 'box', 'price' => 10000,
            'payment_method' => 'bank', 'status' => 'pending', 'items' => [],
        ]);
        foreach (['/', '/products', '/posts', '/wallet', '/orders', '/profile', '/checkout', '/checkout/thankyou/'.$order->id, '/checkout/success/'.$order->id] as $url) {
            $response = $this->get($url)->assertOk();
            $this->assertSharedHeader($response->getContent(), $url, true);
        }
    }

    private function assertSharedHeader(string $html, string $url, bool $authenticated): void
    {
        $this->assertSame(1, substr_count($html, 'data-site-header>'), $url);
        $this->assertSame(1, substr_count($html, 'id="site-navigation"'), $url);
        $this->assertSame(1, substr_count($html, 'css/site-header.css'), $url);
        $this->assertSame(1, substr_count($html, 'js/site-header.js'), $url);
        $this->assertSame(1, substr_count($html, 'id="cart-count"'), $url);
        preg_match('/<nav class="site-links".*?<\/nav>/s', $html, $matches);
        preg_match_all('/href="([^"]+)"/', $matches[0], $links);
        $this->assertSame(['/', '/products', '/products?category=api-token', '/posts', 'https://zalo.me/0569012134'], $links[1], $url);
        $this->assertSame($authenticated ? 1 : 0, substr_count($html, 'class="user-pill-btn user-menu-btn"'), $url);
        $this->assertStringNotContainsString('const userMenuBtn', $html, $url);

    }
}
