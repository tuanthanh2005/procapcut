<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TelegramCategory;
use App\Models\TelegramProduct;

class CleanDuplicateCategoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:clean-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dọn dẹp danh mục trùng lặp, gom sản phẩm về danh mục chuẩn và gán icon đẹp';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Bắt đầu dọn dẹp các danh mục trùng lặp...");

        // 1. Lấy tất cả danh mục
        $categories = TelegramCategory::all();

        // Gom nhóm theo tên
        $grouped = $categories->groupBy(function($item) {
            return mb_strtolower(trim($item->name), 'UTF-8');
        });

        foreach ($grouped as $normName => $cats) {
            if ($cats->count() > 1) {
                // Chọn danh mục giữ lại: danh mục nào có nhiều sản phẩm nhất
                $master = $cats->sortByDesc(function($c) {
                    return $c->products()->count();
                })->first();

                $this->line("📌 Danh mục chính: [ID: {$master->id}] {$master->name}");

                foreach ($cats as $subCat) {
                    if ($subCat->id === $master->id) {
                        continue;
                    }

                    $prodCount = $subCat->products()->count();
                    if ($prodCount > 0) {
                        // Chuyển toàn bộ sản phẩm của danh mục trùng sang danh mục chính
                        TelegramProduct::where('category_id', $subCat->id)->update([
                            'category_id' => $master->id
                        ]);
                        $this->line("   -> Đã chuyển {$prodCount} sản phẩm từ ID: {$subCat->id} sang ID: {$master->id}");
                    }

                    // Xóa danh mục rác bị trùng
                    $subCat->delete();
                    $this->warn("   -> Đã xóa danh mục trùng: ID: {$subCat->id} ({$subCat->name})");
                }
            }
        }

        // 2. Xóa các danh mục rỗng không có bất kỳ sản phẩm nào và không cần thiết (như các ID 47-56)
        $emptyCategories = TelegramCategory::doesntHave('products')->get();
        foreach ($emptyCategories as $ec) {
            $this->warn("Xóa danh mục rỗng không sử dụng: [ID: {$ec->id}] {$ec->name}");
            $ec->delete();
        }

        // 3. Khôi phục lại icon & telegram_icon chuẩn cho các danh mục còn lại
        $activeCategories = TelegramCategory::all();
        foreach ($activeCategories as $cat) {
            $cat->update([
                'is_active' => true,
            ]);
        }

        $this->info("Dọn dẹp hoàn tất! Hiện còn " . TelegramCategory::count() . " danh mục chuẩn.");
        return 0;
    }
}
