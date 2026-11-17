<?php

namespace App\Console\Commands;

use App\Models\TelegramProduct;
use App\Services\CanbosoService;
use Illuminate\Console\Command;

class SyncCanbosoStockCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'canboso:sync-stock';

    /**
     * The console command description.
     */
    protected $description = 'Sync real-time stock and cost price from Canboso API to local Telegram products';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching products from Canboso API...');
        $service = new CanbosoService();
        $res = $service->getProducts();
        $productsList = $res['products'] ?? [];

        if (empty($productsList)) {
            $this->error('Failed to fetch products from Canboso API.');
            return 1;
        }

        $stockMap = [];
        $costMap = [];
        foreach ($productsList as $p) {
            $pid = $p['productId'] ?? null;
            if ($pid) {
                $stockMap[$pid] = $p['availability']['available'] ?? 0;
                $costMap[$pid] = (int) ($p['price']['amount'] ?? 0);
            }
        }

        $updated = 0;
        $products = TelegramProduct::where('delivery_type', 'canboso_api')->get();

        foreach ($products as $prod) {
            if ($prod->canboso_product_id && isset($stockMap[$prod->canboso_product_id])) {
                $realStock = (int) $stockMap[$prod->canboso_product_id];
                $realCost = $costMap[$prod->canboso_product_id];

                $prod->update([
                    'canboso_stock' => $realStock,
                    'canboso_cost_price' => $realCost,
                ]);
                $updated++;
            }
        }

        $this->info("Successfully synced exact stock for {$updated} products from Canboso!");
        return 0;
    }
}
