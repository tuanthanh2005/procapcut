<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TelegramProduct;

class AdjustProfitMarginCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:set-margin {--margin=30 : Tỷ lệ % lợi nhuận thêm} {--min-profit=5000 : Lợi nhuận tối thiểu mỗi đơn (₫)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Điều chỉnh lại toàn bộ giá bán theo tỷ lệ lợi nhuận mong muốn (Mặc định 30%)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $margin = (float) $this->option('margin');
        $minProfit = (int) $this->option('min-profit');

        $this->info("Bắt đầu cập nhật lại giá bán với Lợi nhuận: {$margin}% (Tối thiểu +{$minProfit}₫)...");

        $products = TelegramProduct::all();
        $updated = 0;

        foreach ($products as $p) {
            // Giá gốc nhập sỉ
            $cost = (int) $p->canboso_cost_price;

            if ($cost > 0) {
                // Tính lợi nhuận 30% từ giá sỉ
                $profit = max($minProfit, (int) round(($cost * $margin) / 100));
                $newPrice = ceil(($cost + $profit) / 1000) * 1000;
            } else {
                // Nếu sản phẩm không có cost_price sỉ, tăng trực tiếp 30% trên giá bán hiện tại
                $newPrice = ceil(($p->price * (1 + $margin / 100)) / 1000) * 1000;
            }

            $originalPrice = ceil(($newPrice * 1.35) / 1000) * 1000;

            $p->update([
                'price' => $newPrice,
                'original_price' => $originalPrice,
            ]);
            $updated++;
        }

        $this->info("Đã cập nhật giá mới cho {$updated} sản phẩm Telegram.");

        // Tự động gọi đồng bộ lại toàn bộ sản phẩm lên Website aicuatoi.com
        $this->call('web:sync-products');

        $this->info("Hoàn tất! Cả Bot Telegram và Website đã được cập nhật giá mới với 30% lợi nhuận.");
        return 0;
    }
}
