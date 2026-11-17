<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\TelegramCategory;
use App\Models\TelegramProduct;
use App\Models\TelegramProductKey;

class TelegramBotSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Settings
        Setting::setValue('telegram_bot_token', '8817526380:AAGibQV42H2YYMnH9vr1Y54nA8UCWur1aYA');
        Setting::setValue('telegram_bot_username', 'tap_hoa_ai_gia_re_bot');
        Setting::setValue('telegram_admin_id', '8199725778');
        Setting::setValue('telegram_ref_commission', '10');
        Setting::setValue('telegram_support_phone', '0772698113');
        Setting::setValue('telegram_support_phone_2', '0708910952');
        Setting::setValue('telegram_support_admin', '@specademy');
        Setting::setValue('telegram_support_websites', 'dungthu.com | aicuatoi.com | aicuatoi.net | vpnstore.pro');
        Setting::setValue('sepay_webhook_token', 'RX2FPYARHKQE0TTIZZGEF7KLUUUC9THJD8JA3Z51HIXMONSS1PXXWRGVG89EH4EN');

        // 2. Categories
        $categoriesData = [
            ['name' => 'ChatGPT & OpenAI', 'slug' => 'chatgpt', 'icon' => '🤖', 'sort' => 1],
            ['name' => 'CapCut Pro', 'slug' => 'capcut', 'icon' => '✂️', 'sort' => 2],
            ['name' => 'Canva Pro', 'slug' => 'canva', 'icon' => '🎨', 'sort' => 3],
            ['name' => 'Google Gemini', 'slug' => 'gemini', 'icon' => '✦', 'sort' => 4],
            ['name' => 'Claude AI', 'slug' => 'claude', 'icon' => '✳️', 'sort' => 5],
            ['name' => 'Cursor & Codex', 'slug' => 'cursor', 'icon' => '🚀', 'sort' => 6],
            ['name' => 'Adobe All Apps', 'slug' => 'adobe', 'icon' => '🖌️', 'sort' => 7],
            ['name' => 'Microsoft 365 & Office', 'slug' => 'office365', 'icon' => '🪟', 'sort' => 8],
            ['name' => 'Suno & Audio AI', 'slug' => 'suno', 'icon' => '🎵', 'sort' => 9],
            ['name' => 'Kling & Video AI', 'slug' => 'kling', 'icon' => '🎬', 'sort' => 10],
            ['name' => 'VPN & Proxy Riêng', 'slug' => 'vpn', 'icon' => '🛡️', 'sort' => 11],
            ['name' => 'Spotify Premium', 'slug' => 'spotify', 'icon' => '🎧', 'sort' => 12],
        ];

        foreach ($categoriesData as $c) {
            $cat = TelegramCategory::updateOrCreate(
                ['slug' => $c['slug']],
                [
                    'name' => $c['name'],
                    'icon' => $c['icon'],
                    'sort_order' => $c['sort'],
                    'is_active' => true,
                ]
            );

            // Populate products for popular categories
            if ($c['slug'] === 'chatgpt') {
                $prods = [
                    [
                        'name' => 'OTP Ver Codex/GPT',
                        'price' => 9000,
                        'original_price' => 15000,
                        'description' => "📖 Hướng dẫn nhận mã:\n1. Mở dịch vụ cần xác minh đến bước nhập số điện thoại.\n2. Mở link được cấp -> bấm \"Nhận\" -> Copy số điện thoại.\n3. Dán số vào dịch vụ, bấm gửi mã.\n4. Giữ trang mở, mã sẽ tự hiện -> Copy và nhập vào dịch vụ.\nLưu ý: Số chỉ thuê/dùng 1 lần.",
                        'guide' => "Link nhận mã OTP sẽ được gửi ngay lập tức bên dưới.",
                        'delivery_type' => 'key_stock',
                        'stock_keys' => [
                            'OTP_LINK: https://otp-service.internal/code/token_88921a7b',
                            'OTP_LINK: https://otp-service.internal/code/token_99182b8c',
                            'OTP_LINK: https://otp-service.internal/code/token_11728c9d',
                            'OTP_LINK: https://otp-service.internal/code/token_55621d0e',
                            'OTP_LINK: https://otp-service.internal/code/token_33419e1f',
                        ]
                    ],
                    [
                        'name' => 'ChatGPT Offer Trial Plus 1 tháng',
                        'price' => 12000,
                        'original_price' => 25000,
                        'description' => "Tài khoản ChatGPT đăng ký gói Plus dùng thử 1 tháng. Dùng riêng tư đầy đủ tính năng GPT-4o, Canvas, Voice Mode.",
                        'guide' => "Đăng nhập tại chatgpt.com với email và password bên dưới.",
                        'delivery_type' => 'key_stock',
                        'stock_keys' => [
                            'gpt_trial_01@gmail.com|PassSecure#2026',
                            'gpt_trial_02@gmail.com|PassSecure#2026',
                            'gpt_trial_03@gmail.com|PassSecure#2026',
                        ]
                    ],
                    [
                        'name' => 'ChatGPT Go 3 tháng BH 3 ngày',
                        'price' => 99000,
                        'original_price' => 150000,
                        'description' => "Gói ChatGPT Plus Go 3 tháng, bảo hành login 3 ngày, hỗ trợ giải đáp 24/7.",
                        'guide' => "Đăng nhập tài khoản tại chatgpt.com",
                        'delivery_type' => 'key_stock',
                        'stock_keys' => [
                            'gpt_go_01@gmail.com|P@ssword2026!',
                            'gpt_go_02@gmail.com|P@ssword2026!',
                        ]
                    ],
                    [
                        'name' => 'ChatGPT Plus 1 tháng BHF',
                        'price' => 145000,
                        'original_price' => 200000,
                        'description' => "ChatGPT Plus dùng chung chất lượng cao, bảo hành full thời gian sử dụng 30 ngày.",
                        'guide' => "Đăng nhập tại chatgpt.com",
                        'delivery_type' => 'key_stock',
                        'stock_keys' => [
                            'plus_share_01@hotmail.com|Aistore2026#',
                            'plus_share_02@hotmail.com|Aistore2026#',
                        ]
                    ],
                    [
                        'name' => 'Gia hạn ChatGPT Plus 1 tháng',
                        'price' => 330000,
                        'original_price' => 450000,
                        'description' => "Gia hạn trực tiếp trên tài khoản email chính chủ của bạn qua thẻ thanh toán quốc tế sạch.",
                        'guide' => "Vui lòng nhắn tin gửi tài khoản email của bạn cho Admin @specademy để gia hạn ngay.",
                        'delivery_type' => 'static_text',
                        'static_content' => "Cảm ơn bạn! Vui lòng liên hệ Admin @specademy kèm mã đơn hàng để được cấp quyền gia hạn vào mail của bạn.",
                        'stock_keys' => []
                    ],
                ];

                foreach ($prods as $p) {
                    $prod = TelegramProduct::updateOrCreate(
                        ['category_id' => $cat->id, 'name' => $p['name']],
                        [
                            'price' => $p['price'],
                            'original_price' => $p['original_price'],
                            'description' => $p['description'],
                            'guide_text' => $p['guide'],
                            'delivery_type' => $p['delivery_type'],
                            'static_content' => $p['static_content'] ?? null,
                            'is_active' => true,
                        ]
                    );

                    foreach ($p['stock_keys'] as $key) {
                        TelegramProductKey::firstOrCreate([
                            'product_id' => $prod->id,
                            'account_data' => $key,
                        ], [
                            'is_used' => false,
                        ]);
                    }
                }
            } elseif ($c['slug'] === 'capcut') {
                $prods = [
                    [
                        'name' => 'CapCut Pro 1 Tháng Nâng Cấp Mail',
                        'price' => 49000,
                        'original_price' => 89000,
                        'description' => "Nâng cấp CapCut Pro 1 tháng trên chính email của bạn hoặc nhận tài khoản cấp sẵn full tính năng Pro, 100GB Cloud.",
                        'guide' => "Mã kích hoạt CapCut Pro hoặc tài khoản nhận bên dưới.",
                        'delivery_type' => 'key_stock',
                        'stock_keys' => [
                            'CAPCUT-PRO-1M-AA821-BB991',
                            'CAPCUT-PRO-1M-CC412-DD882',
                        ]
                    ],
                    [
                        'name' => 'CapCut Pro 1 Năm Chính Chủ',
                        'price' => 250000,
                        'original_price' => 450000,
                        'description' => "Gói 1 năm CapCut Pro chính chủ, bảo hành 12 tháng, dùng trên PC, Mobile, Web không giới hạn.",
                        'guide' => "Nhập mã kích hoạt tại trang quản lý CapCut hoặc nhắn Admin @specademy để hỗ trợ.",
                        'delivery_type' => 'key_stock',
                        'stock_keys' => [
                            'CAPCUT-PRO-1Y-XX781-YY291',
                            'CAPCUT-PRO-1Y-ZZ991-KK382',
                        ]
                    ],
                ];

                foreach ($prods as $p) {
                    $prod = TelegramProduct::updateOrCreate(
                        ['category_id' => $cat->id, 'name' => $p['name']],
                        [
                            'price' => $p['price'],
                            'original_price' => $p['original_price'],
                            'description' => $p['description'],
                            'guide_text' => $p['guide'],
                            'delivery_type' => $p['delivery_type'],
                            'is_active' => true,
                        ]
                    );

                    foreach ($p['stock_keys'] as $key) {
                        TelegramProductKey::firstOrCreate([
                            'product_id' => $prod->id,
                            'account_data' => $key,
                        ], [
                            'is_used' => false,
                        ]);
                    }
                }
            } elseif ($c['slug'] === 'canva') {
                $prod = TelegramProduct::updateOrCreate(
                    ['category_id' => $cat->id, 'name' => 'Canva Pro Nâng Cấp Email Chính Chủ'],
                    [
                        'price' => 99000,
                        'original_price' => 250000,
                        'description' => "Nâng cấp Canva Pro vào email cá nhân qua link mời gia đình/đội ngũ edu vĩnh viễn, không mất dữ liệu thiết kế.",
                        'guide_text' => "Bấm vào link bên dưới để gia nhập nhóm Canva Pro của bạn.",
                        'delivery_type' => 'key_stock',
                        'is_active' => true,
                    ]
                );

                TelegramProductKey::firstOrCreate([
                    'product_id' => $prod->id,
                    'account_data' => 'LINK_CANVA: https://www.canva.com/brand/join?inviteToken=CANVA_PRO_INVITE_VIP_2026',
                ], ['is_used' => false]);
            }
        }
    }
}
