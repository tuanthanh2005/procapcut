<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TelegramCategory;
use App\Models\TelegramProduct;

class CheckTelegramDbCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:check-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kiểm tra chi tiết danh mục và sản phẩm trong database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("=== DANH MỤC & SẢN PHẨM TRONG HỆ THỐNG ===");
        
        $categories = TelegramCategory::all();
        $this->line("Tổng số danh mục: " . $categories->count());

        foreach ($categories as $cat) {
            $totalProducts = $cat->products()->count();
            $activeProducts = $cat->products()->where('is_active', true)->count();
            $inStockProducts = $cat->products()->where('is_active', true)->get()->filter(fn ($product) => $product->stock_count > 0)->count();

            $this->line("📁 [ID: {$cat->id}] {$cat->name} (is_active: " . ($cat->is_active ? 'BẬT' : 'TẮT') . ") -> Tổng: {$totalProducts} SP | Hoạt động: {$activeProducts} SP | Còn hàng: {$inStockProducts} SP");
        }

        $vpnProducts = TelegramProduct::where('name', 'LIKE', '%VPN%')->get();
        $this->info("\n=== SẢN PHẨM VPN TRONG HỆ THỐNG (" . $vpnProducts->count() . " sản phẩm) ===");
        foreach ($vpnProducts as $vp) {
            $this->line("- [ID: {$vp->id} | Cat ID: {$vp->category_id}] {$vp->name} | Giá: " . number_format($vp->price) . "đ | Stock: {$vp->stock_count} | is_active: {$vp->is_active}");
        }

        return 0;
    }
}
