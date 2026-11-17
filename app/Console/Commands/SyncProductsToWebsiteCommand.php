<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\TelegramCategory;
use App\Models\TelegramProduct;
use Illuminate\Support\Str;

class SyncProductsToWebsiteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'web:sync-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Đồng bộ toàn bộ danh mục và các gói sản phẩm đang có từ kho sang bảng sản phẩm Web (aicuatoi.com)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Bắt đầu đồng bộ danh mục & gói cước lên Website chính (aicuatoi.com)...");

        // Lấy tất cả danh mục Telegram đang có sản phẩm
        $categories = TelegramCategory::with(['products' => function($q) {
            $q->where('is_active', true);
        }])->get();

        $totalWebSynced = 0;

        foreach ($categories as $cat) {
            $catProducts = $cat->products;
            if ($catProducts->isEmpty()) {
                continue;
            }

            // Tạo danh sách Options (Gói cước) tương ứng với từng gói TelegramProduct trong danh mục
            $options = [];
            $minPrice = PHP_INT_MAX;
            $minSlashed = PHP_INT_MAX;
            $hasInStock = false;

            foreach ($catProducts as $p) {
                $stock = (int) $p->stock_count;
                $isAvailable = $stock > 0;
                if ($isAvailable) {
                    $hasInStock = true;
                }

                $optPrice = (int) $p->price;
                $optSlashed = (int) ($p->original_price ?: round($optPrice * 1.35));

                if ($optPrice < $minPrice) {
                    $minPrice = $optPrice;
                    $minSlashed = $optSlashed;
                }

                $options[] = [
                    'id' => 'canboso-' . ($p->canboso_product_id ?: $p->id),
                    'name' => $p->name,
                    'price' => $optPrice,
                    'slashed' => $optSlashed,
                    'description' => $p->description ?: 'Bảo hành đầy đủ trong suốt thời gian sử dụng.',
                    'require_email' => false,
                    'stock' => $stock,
                    'in_stock' => $isAvailable,
                ];
            }

            if ($minPrice === PHP_INT_MAX) {
                $minPrice = 50000;
                $minSlashed = 80000;
            }

            // Slug của sản phẩm Web theo danh mục
            $slug = Str::slug($cat->name);
            if (empty($slug)) {
                $slug = 'danh-muc-' . $cat->id;
            }

            // Ánh xạ category code cho bộ lọc web
            $catCode = 'other';
            $lowerCat = mb_strtolower($cat->name, 'UTF-8');
            if (str_contains($lowerCat, 'capcut')) $catCode = 'capcut';
            elseif (str_contains($lowerCat, 'gpt') || str_contains($lowerCat, 'openai')) $catCode = 'gpt';
            elseif (str_contains($lowerCat, 'gemini')) $catCode = 'gemini';
            elseif (str_contains($lowerCat, 'canva')) $catCode = 'canva';
            elseif (str_contains($lowerCat, 'token') || str_contains($lowerCat, 'api')) $catCode = 'api-token';

            // Tạo các tính năng nổi bật mặc định
            $features = [
                "Kích hoạt tự động, nhận tài khoản/key ngay sau thanh toán",
                "Bảo hành 1 đổi 1 suốt thời gian sử dụng",
                "Hỗ trợ kỹ thuật 24/7 qua Zalo & Telegram",
                "Chính sách hoàn tiền uy tín nếu phát sinh lỗi không xử lý được",
            ];

            // Cập nhật hoặc thêm mới vào bảng Product của Web
            $product = Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $cat->name,
                    'category' => $catCode,
                    'category_label' => $cat->name,
                    'icon' => $cat->telegram_display_icon ?: '📦',
                    'rating' => 5.0,
                    'review_count' => rand(25, 95),
                    'sold' => rand(150, 850) . '+',
                    'tag' => 'BÁN CHẠY',
                    'default_price' => $minPrice,
                    'default_slashed' => $minSlashed,
                    'description' => "Cung cấp tài khoản và gói dịch vụ bản quyền {$cat->name} giá rẻ, bảo hành uy tín chính hãng, nhận thông tin tự động 24/7.",
                    'seo_title' => "Mua {$cat->name} Giá Rẻ Chính Hãng - Ai Của Tôi",
                    'seo_desc' => "Mua gói bản quyền {$cat->name} giá rẻ, kích hoạt nhanh chóng, bảo hành 1 đổi 1 uy tín tại aicuatoi.com.",
                    'seo_keywords' => "{$cat->name}, mua {$cat->name}, tài khoản {$cat->name} giá rẻ",
                    'features' => $features,
                    'options' => $options,
                ]
            );

            $this->line("✔ [Web Product] {$product->name} (Slug: {$slug}) -> Có " . count($options) . " gói cước");
            $totalWebSynced++;
        }

        $this->info("Hoàn tất! Đã đồng bộ {$totalWebSynced} dòng sản phẩm (kèm toàn bộ gói cước và tồn kho) lên Website aicuatoi.com.");
        return 0;
    }
}
