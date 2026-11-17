<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TelegramCategory;
use App\Models\TelegramProduct;
use App\Services\CanbosoService;
use Illuminate\Support\Str;

class SyncAllCanbosoProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'canboso:import-all {--margin=30 : Tỷ lệ lợi nhuận thêm (%)} {--min-profit=10000 : Lợi nhuận tối thiểu (VND)} {--all-stock : Nhập cả sản phẩm hết hàng}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Đồng bộ và nhập đầy đủ toàn bộ sản phẩm và danh mục chuẩn từ API Canboso';

    /**
     * Category mapping config
     */
    public static function getCategoryMapping(string $emoji, string $name): array
    {
        $emoji = strtolower(trim($emoji));
        $lowerName = mb_strtolower(trim($name), 'UTF-8');

        // 1. Phân loại theo tên sản phẩm trước (chính xác tuyệt đối)
        if (str_contains($lowerName, 'vpn') || str_contains($lowerName, 'proxy') || in_array($emoji, ['hotspot_shield', 'norton_vpn', 'purevpn', 'hma_vpn', 'express', 'surfshark', 'nordvpn', 'proton', 'adguard_vpn'])) {
            return [
                'name' => 'VPN & Proxy Riêng',
                'telegram_icon' => '🛡️',
                'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'
            ];
        }

        if (str_contains($lowerName, 'capcut') || $emoji === 'capcut') {
            return [
                'name' => 'CapCut Pro',
                'telegram_icon' => '✂️',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" viewBox="0 0 24 24" id="capcut"><path d="M24.189 6.442V2.671l-4.535 2.383V4.91c.002-1.505-1.078-2.411-2.638-2.411H2.64C.993 2.5 0 3.407 0 4.91V8.72L6.354 12 0 15.316v3.8C0 20.595 1 21.5 2.64 21.5h14.373c1.56 0 2.639-.907 2.639-2.382v-.197l4.536 2.409v-3.828L13.64 12 24.19 6.443zM9.982 13.873l7.797 4.083H2.157l7.825-4.083zm7.741-7.828l-7.742 4.057-7.825-4.057h15.567z" fill="currentColor"></path></svg>'
            ];
        }

        if (str_contains($lowerName, 'gemini') || str_contains($lowerName, 'google') || in_array($emoji, ['google', 'google_one'])) {
            return [
                'name' => 'Google Gemini',
                'telegram_icon' => '✨',
                'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path fill="#1A73E8" d="M12 24c0-6.627-5.373-12-12-12 6.627 0 12-5.373 12-12 0 6.627 5.373 12 12 12-6.627 0-12 5.373-12 12z"/></svg>'
            ];
        }

        if (str_contains($lowerName, 'chatgpt') || str_contains($lowerName, 'gpt') || str_contains($lowerName, 'openai') || in_array($emoji, ['chatgpt', 'apigpt'])) {
            return [
                'name' => 'ChatGPT & OpenAI',
                'telegram_icon' => '🤖',
                'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="#10a37f"><path d="M22.282 9.821a5.985 5.985 0 0 0-.516-4.91 6.046 6.046 0 0 0-6.51-2.9A6.065 6.065 0 0 0 4.981 4.18a5.985 5.985 0 0 0-3.998 2.9 6.046 6.046 0 0 0 .743 7.097 5.98 5.98 0 0 0 .51 4.911 6.051 6.051 0 0 0 6.515 2.9A5.985 5.985 0 0 0 13.26 24a6.056 6.056 0 0 0 5.772-4.206 5.99 5.99 0 0 0 3.997-2.9 6.056 6.056 0 0 0-.747-7.073zM13.26 22.43a4.476 4.476 0 0 1-2.876-1.04l.141-.081 4.779-2.758a.795.795 0 0 0 .392-.681v-6.737l2.02 1.168a.071.071 0 0 1 .038.052v5.583a4.504 4.504 0 0 1-4.494 4.494zM3.6 18.304a4.47 4.47 0 0 1-.535-3.014l.142.085 4.783 2.759a.771.771 0 0 0 .78 0l5.843-3.369v2.332a.08.08 0 0 1-.033.062L9.74 19.95a4.5 4.5 0 0 1-6.14-1.646zM2.34 8.737a4.485 4.485 0 0 1 2.366-1.973V12.6a.766.766 0 0 0 .388.677l5.815 3.355-2.02 1.169a.076.076 0 0 1-.067 0L4.01 15.023A4.504 4.504 0 0 1 2.34 8.737zm16.597 3.855l-5.833-3.387L15.119 8a.076.076 0 0 1 .067 0l4.813 2.778a4.506 4.506 0 0 1-.444 8.163v-5.328a.785.785 0 0 0-.618-.821zm2.392-3.86a4.48 4.48 0 0 1-.61 3.228l-.141-.085-4.78-2.772a.776.776 0 0 0-.783 0L9.2 12.472V10.14a.08.08 0 0 1 .034-.062l4.838-2.793a4.5 4.5 0 0 1 6.66 4.733zM12.008 13.91l-2.613-1.508 2.613-1.508 2.612 1.508-2.612 1.508z"/></svg>'
            ];
        }

        if (str_contains($lowerName, 'claude') || $emoji === 'claude') {
            return [
                'name' => 'Claude AI',
                'telegram_icon' => '✴️',
                'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="#d97706"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm1 14.5h-2v-2h2zm0-4h-2V7h2z"/></svg>'
            ];
        }

        if (str_contains($lowerName, 'grok') || $emoji === 'grok') {
            return [
                'name' => 'Grok X.AI',
                'telegram_icon' => '⚡',
                'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>'
            ];
        }

        if (str_contains($lowerName, 'cursor') || str_contains($lowerName, 'codex') || str_contains($lowerName, 'github') || in_array($emoji, ['cursor', 'github', 'replit', 'zed'])) {
            return [
                'name' => 'Cursor & Codex',
                'telegram_icon' => '💻',
                'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><polygon points="12 1 2 7 2 17 12 23 22 17 22 7" fill="none" stroke="currentColor" stroke-width="2"/><line x1="12" y1="23" x2="12" y2="12" stroke="currentColor" stroke-width="2"/><line x1="12" y1="12" x2="2" y2="7" stroke="currentColor" stroke-width="2"/><line x1="12" y1="12" x2="22" y2="7" stroke="currentColor" stroke-width="2"/></svg>'
            ];
        }

        if (str_contains($lowerName, 'youtube') || str_contains($lowerName, 'netflix') || str_contains($lowerName, 'spotify') || in_array($emoji, ['youtube', 'netflix', 'spotify', 'iqiyi', 'amazon_prime'])) {
            return [
                'name' => 'YouTube - Netflix - Spotify & Giải Trí',
                'telegram_icon' => '🍿',
                'icon' => '🍿'
            ];
        }

        if (str_contains($lowerName, 'canva') || $emoji === 'canva') {
            return [
                'name' => 'Canva Pro',
                'telegram_icon' => '🎨',
                'icon' => '🎨'
            ];
        }

        if (str_contains($lowerName, 'kling') || str_contains($lowerName, 'runway') || str_contains($lowerName, 'video') || in_array($emoji, ['kling', 'runway', 'heygen', 'dreamina', 'seedance', 'higgfield'])) {
            return [
                'name' => 'Kling & Video AI',
                'telegram_icon' => '🎬',
                'icon' => '🎬'
            ];
        }

        if (str_contains($lowerName, 'suno') || str_contains($lowerName, 'audio') || str_contains($lowerName, 'nhạc') || in_array($emoji, ['suno', 'elevenlabs'])) {
            return [
                'name' => 'Suno & Audio AI',
                'telegram_icon' => '🎵',
                'icon' => '🎵'
            ];
        }

        if (str_contains($lowerName, 'xingtu') || str_contains($lowerName, 'wink') || str_contains($lowerName, 'meitu') || in_array($emoji, ['xingtu', 'wink', 'meitu', 'alight_motion'])) {
            return [
                'name' => 'App Sửa Ảnh & Video',
                'telegram_icon' => '📸',
                'icon' => '📸'
            ];
        }

        if (str_contains($lowerName, 'office') || str_contains($lowerName, 'microsoft') || str_contains($lowerName, 'windows') || in_array($emoji, ['microsoft_office_365', 'windows'])) {
            return [
                'name' => 'Microsoft 365 & Office',
                'telegram_icon' => '🪟',
                'icon' => '🪟'
            ];
        }

        if (str_contains($lowerName, 'adobe') || $emoji === 'adobe') {
            return [
                'name' => 'Adobe All Apps',
                'telegram_icon' => '🖌️',
                'icon' => '🖌️'
            ];
        }

        if (str_contains($lowerName, 'perplexity') || $emoji === 'perplexity') {
            return [
                'name' => 'Perplexity AI',
                'telegram_icon' => '🔍',
                'icon' => '🔍'
            ];
        }

        if (str_contains($lowerName, 'mail') || str_contains($lowerName, 'gmail') || str_contains($lowerName, 'outlook') || in_array($emoji, ['gmail', 'outlook'])) {
            return [
                'name' => 'Tài Khoản Mail & OTP',
                'telegram_icon' => '✉️',
                'icon' => '✉️'
            ];
        }

        if (str_contains($lowerName, 'figma') || in_array($emoji, ['figma', 'framer'])) {
            return [
                'name' => 'Figma & Design',
                'telegram_icon' => '📐',
                'icon' => '📐'
            ];
        }

        if (str_contains($lowerName, 'kimi') || in_array($emoji, ['kimi', 'minimax', 'kiro', 'genspark'])) {
            return [
                'name' => 'Kimi & LLM AI',
                'telegram_icon' => '🧠',
                'icon' => '🧠'
            ];
        }

        return [
            'name' => 'Sản phẩm khác',
            'telegram_icon' => '📦',
            'icon' => '📦'
        ];
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $marginPercent = (int) $this->option('margin');
        $minProfit = (int) $this->option('min-profit');
        $allStock = $this->option('all-stock');

        $this->info("Bắt đầu quét và nhập sản phẩm từ Canboso API (Lãi: {$marginPercent}%, Min: {$minProfit}đ)...");

        $canbosoService = new CanbosoService();
        $res = $canbosoService->getProducts();
        $productsList = $res['products'] ?? [];

        if (empty($productsList)) {
            $this->error('Không thể lấy danh sách sản phẩm từ Canboso API.');
            return 1;
        }

        $totalApi = count($productsList);
        $this->info("Đã tìm thấy {$totalApi} sản phẩm trên Canboso API.");

        $imported = 0;
        $updated = 0;
        $skipped = 0;

        foreach ($productsList as $p) {
            $productId = $p['productId'] ?? null;
            $name = $p['name'] ?? '';
            $costPrice = (int) ($p['price']['amount'] ?? 0);
            $available = (int) ($p['availability']['available'] ?? 0);
            $emoji = $p['emoji'] ?? '';

            if (!$productId || !$name) {
                continue;
            }

            // Nếu không bật --all-stock và sản phẩm hết hàng
            if (!$allStock && $available <= 0) {
                $skipped++;
                continue;
            }

            $catConfig = self::getCategoryMapping($emoji, $name);

            // Tìm hoặc tạo Danh mục chuẩn
            $category = TelegramCategory::firstOrCreate(
                ['name' => $catConfig['name']],
                [
                    'slug' => Str::slug($catConfig['name']) . '-' . rand(10, 99),
                    'icon' => $catConfig['icon'],
                    'telegram_icon' => $catConfig['telegram_icon'],
                    'sort_order' => 1,
                    'is_active' => true,
                ]
            );

            // Cập nhật lại telegram_icon và icon chuẩn nếu chưa có
            if (empty($category->telegram_icon)) {
                $category->update([
                    'telegram_icon' => $catConfig['telegram_icon'],
                    'icon' => $catConfig['icon']
                ]);
            }

            // Tính giá bán
            $profit = max($minProfit, (int) round(($costPrice * $marginPercent) / 100));
            $sellPrice = ceil(($costPrice + $profit) / 1000) * 1000;
            $originalPrice = ceil(($sellPrice * 1.35) / 1000) * 1000;

            $existing = TelegramProduct::where('canboso_product_id', $productId)->first();

            $data = [
                'category_id' => $category->id,
                'name' => $name,
                'price' => $sellPrice,
                'original_price' => $originalPrice,
                'description' => $p['description'] ?? '',
                'guide_text' => "Đăng nhập bằng thông tin Email | Mật khẩu bên trên tại trang web hoặc ứng dụng chính thức.",
                'delivery_type' => 'canboso_api',
                'canboso_product_id' => $productId,
                'canboso_cost_price' => $costPrice,
                'canboso_stock' => $available,
                'is_active' => true,
                'sort_order' => 1,
            ];

            if ($existing) {
                $existing->update($data);
                $updated++;
            } else {
                $data['sold_count'] = rand(8, 48);
                TelegramProduct::create($data);
                $imported++;
            }
        }

        $this->info("Hoàn tất đồng bộ: Đã thêm mới {$imported} sản phẩm, Cập nhật {$updated} sản phẩm (Bỏ qua {$skipped} sản phẩm hết hàng).");
        return 0;
    }
}
