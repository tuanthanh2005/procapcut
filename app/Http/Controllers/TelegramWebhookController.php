<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\TelegramBotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends Controller
{
    /**
     * Handle incoming Telegram webhook updates
     */
    public function handle(Request $request, ?string $token = null)
    {
        $botToken = Setting::getValue('telegram_bot_token', '8817526380:AAGibQV42H2YYMnH9vr1Y54nA8UCWur1aYA');

        // Optional token security check in route if passed
        if ($token && $token !== $botToken) {
            Log::warning("Telegram Webhook: Invalid token received in URL: {$token}");
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        $update = $request->all();

        if (empty($update)) {
            return response()->json(['status' => 'ok']);
        }

        Log::info("Telegram Webhook: Received update.", [
            'update_id' => $update['update_id'] ?? null,
            'has_message' => isset($update['message']),
            'has_callback' => isset($update['callback_query']),
        ]);

        try {
            $botService = new TelegramBotService($botToken);
            $botService->processUpdate($update);
        } catch (\Exception $e) {
            Log::error("Telegram Webhook Error: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
        }

        return response()->json(['status' => 'ok']);
    }
}
