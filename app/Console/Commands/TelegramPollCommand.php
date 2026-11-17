<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Services\TelegramBotService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TelegramPollCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'telegram:poll';

    /**
     * The console command description.
     */
    protected $description = 'Chạy Telegram Bot bán hàng ở chế độ Long Polling (dành cho kiểm thử hoặc chạy nền)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $botService = new TelegramBotService();
        $me = $botService->getMe();

        if (!($me['ok'] ?? false)) {
            $this->error('Không thể kết nối Telegram Bot. Vui lòng kiểm tra lại Token!');
            return 1;
        }

        $botName = $me['result']['first_name'] ?? 'Bot';
        $botUser = $me['result']['username'] ?? 'bot';

        $this->info("==================================================");
        $this->info("🚀 Đang chạy Bot: {$botName} (@{$botUser})");
        $this->info("⚡ Chế độ: Long Polling (Tự động nhận tin nhắn & đơn hàng)");
        $this->info("🛑 Bấm Ctrl + C để dừng bot.");
        $this->info("==================================================");

        $token = Setting::getValue('telegram_bot_token', '8817526380:AAGibQV42H2YYMnH9vr1Y54nA8UCWur1aYA');
        $apiUrl = "https://api.telegram.org/bot{$token}";
        $offset = 0;

        while (true) {
            try {
                $response = Http::timeout(25)->get("{$apiUrl}/getUpdates", [
                    'offset' => $offset,
                    'timeout' => 20,
                ]);

                if ($response->successful()) {
                    $json = $response->json();
                    $updates = $json['result'] ?? [];

                    foreach ($updates as $update) {
                        $offset = $update['update_id'] + 1;
                        
                        $type = isset($update['message']) ? 'Message' : (isset($update['callback_query']) ? 'Callback' : 'Update');
                        $sender = $update['message']['from']['first_name'] ?? ($update['callback_query']['from']['first_name'] ?? 'User');
                        $this->line("[" . date('H:i:s') . "] {$type} từ {$sender}");

                        $botService->processUpdate($update);
                    }
                }
            } catch (\Exception $e) {
                $this->warn("[" . date('H:i:s') . "] Lỗi kết nối: " . $e->getMessage());
                sleep(2);
            }
            usleep(100000); // 0.1s sleep
        }

        return 0;
    }
}
