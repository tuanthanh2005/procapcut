<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TelegramCategory;

class RestoreCategoryIconsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:restore-icons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Khôi phục toàn bộ biểu tượng SVG và Emoji chuẩn cho các danh mục Bot Telegram';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Đang khôi phục biểu tượng danh mục...');

        $definitions = [
            'CapCut' => [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" viewBox="0 0 24 24" id="capcut"><path d="M24.189 6.442V2.671l-4.535 2.383V4.91c.002-1.505-1.078-2.411-2.638-2.411H2.64C.993 2.5 0 3.407 0 4.91V8.72L6.354 12 0 15.316v3.8C0 20.595 1 21.5 2.64 21.5h14.373c1.56 0 2.639-.907 2.639-2.382v-.197l4.536 2.409v-3.828L13.64 12 24.19 6.443zM9.982 13.873l7.797 4.083H2.157l7.825-4.083zm7.741-7.828l-7.742 4.057-7.825-4.057h15.567z" fill="currentColor"></path></svg>',
                'telegram_icon' => '✂️'
            ],
            'Gemini' => [
                'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path fill="#1A73E8" d="M12 24c0-6.627-5.373-12-12-12 6.627 0 12-5.373 12-12 0 6.627 5.373 12 12 12-6.627 0-12 5.373-12 12z"/></svg>',
                'telegram_icon' => '✨'
            ],
            'ChatGPT' => [
                'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="#10a37f"><path d="M22.282 9.821a5.985 5.985 0 0 0-.516-4.91 6.046 6.046 0 0 0-6.51-2.9A6.065 6.065 0 0 0 4.981 4.18a5.985 5.985 0 0 0-3.998 2.9 6.046 6.046 0 0 0 .743 7.097 5.98 5.98 0 0 0 .51 4.911 6.051 6.051 0 0 0 6.515 2.9A5.985 5.985 0 0 0 13.26 24a6.056 6.056 0 0 0 5.772-4.206 5.99 5.99 0 0 0 3.997-2.9 6.056 6.056 0 0 0-.747-7.073zM13.26 22.43a4.476 4.476 0 0 1-2.876-1.04l.141-.081 4.779-2.758a.795.795 0 0 0 .392-.681v-6.737l2.02 1.168a.071.071 0 0 1 .038.052v5.583a4.504 4.504 0 0 1-4.494 4.494zM3.6 18.304a4.47 4.47 0 0 1-.535-3.014l.142.085 4.783 2.759a.771.771 0 0 0 .78 0l5.843-3.369v2.332a.08.08 0 0 1-.033.062L9.74 19.95a4.5 4.5 0 0 1-6.14-1.646zM2.34 8.737a4.485 4.485 0 0 1 2.366-1.973V12.6a.766.766 0 0 0 .388.677l5.815 3.355-2.02 1.169a.076.076 0 0 1-.067 0L4.01 15.023A4.504 4.504 0 0 1 2.34 8.737zm16.597 3.855l-5.833-3.387L15.119 8a.076.076 0 0 1 .067 0l4.813 2.778a4.506 4.506 0 0 1-.444 8.163v-5.328a.785.785 0 0 0-.618-.821zm2.392-3.86a4.48 4.48 0 0 1-.61 3.228l-.141-.085-4.78-2.772a.776.776 0 0 0-.783 0L9.2 12.472V10.14a.08.08 0 0 1 .034-.062l4.838-2.793a4.5 4.5 0 0 1 6.66 4.733zM12.008 13.91l-2.613-1.508 2.613-1.508 2.612 1.508-2.612 1.508z"/></svg>',
                'telegram_icon' => '🤖'
            ],
            'Claude' => [
                'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="#d97706"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm1 14.5h-2v-2h2zm0-4h-2V7h2z"/></svg>',
                'telegram_icon' => '✴️'
            ],
            'Grok' => [
                'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
                'telegram_icon' => '⚡'
            ],
            'Cursor' => [
                'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><polygon points="12 1 2 7 2 17 12 23 22 17 22 7" fill="none" stroke="currentColor" stroke-width="2"/><line x1="12" y1="23" x2="12" y2="12" stroke="currentColor" stroke-width="2"/><line x1="12" y1="12" x2="2" y2="7" stroke="currentColor" stroke-width="2"/><line x1="12" y1="12" x2="22" y2="7" stroke="currentColor" stroke-width="2"/></svg>',
                'telegram_icon' => '💻'
            ],
            'YouTube' => [
                'icon' => '🍿',
                'telegram_icon' => '🍿'
            ],
            'Kling' => [
                'icon' => '🎬',
                'telegram_icon' => '🎬'
            ],
            'Suno' => [
                'icon' => '🎵',
                'telegram_icon' => '🎵'
            ],
            'App Sửa Ảnh' => [
                'icon' => '📸',
                'telegram_icon' => '📸'
            ],
            'Canva' => [
                'icon' => '🎨',
                'telegram_icon' => '🎨'
            ],
            'VPN' => [
                'icon' => '🛡️',
                'telegram_icon' => '🛡️'
            ],
            'Microsoft' => [
                'icon' => '🪟',
                'telegram_icon' => '🪟'
            ],
            'Perplexity' => [
                'icon' => '🔍',
                'telegram_icon' => '🔍'
            ],
            'Adobe' => [
                'icon' => '🖌️',
                'telegram_icon' => '🖌️'
            ],
            'Tài Khoản Mail' => [
                'icon' => '✉️',
                'telegram_icon' => '✉️'
            ],
            'Figma' => [
                'icon' => '📐',
                'telegram_icon' => '📐'
            ],
            'Kimi' => [
                'icon' => '🧠',
                'telegram_icon' => '🧠'
            ],
            'Sản phẩm khác' => [
                'icon' => '📦',
                'telegram_icon' => '📦'
            ],
        ];

        $categories = TelegramCategory::all();
        $updated = 0;

        foreach ($categories as $cat) {
            // Xóa ảnh hỏng nếu có (như lỗi ảnh Claude trong hình)
            if ($cat->image && !file_exists(public_path('storage/' . $cat->image))) {
                $cat->image = null;
            }

            foreach ($definitions as $keyword => $data) {
                if (stripos($cat->name, $keyword) !== false) {
                    $cat->icon = $data['icon'];
                    $cat->telegram_icon = $data['telegram_icon'];
                    $cat->save();
                    $updated++;
                    $this->line("✔ Đã cập nhật: [{$cat->name}] -> Telegram: {$data['telegram_icon']}");
                    break;
                }
            }
        }

        $this->info("Hoàn tất! Đã khôi phục {$updated} danh mục.");
        return 0;
    }
}
