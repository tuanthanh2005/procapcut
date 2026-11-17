<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Setting;
use App\Models\TelegramOrder;
use App\Models\TelegramUser;
use App\Models\TelegramTransaction;
use App\Services\TelegramBotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SePayWebhookController extends Controller
{
    /**
     * Handle incoming SePay Webhook requests
     */
    public function handle(Request $request)
    {
        // 1. Verify token/Authorization
        $configuredToken = Setting::getValue('sepay_webhook_token');
        $validTokens = array_filter([
            $configuredToken,
            'RX2FPYARHKQE0TTIZZGEF7KLUUUC9THJD8JA3Z51HIXMONSS1PXXWRGVG89EH4EN',
            'B4ZUXALYPQHVKO0GLF8NWHOUMLAHIT53BELMQORM9TG2DDQ6R9V3Q2HW7JPCAVCF',
            'CAPCUTSTORESECURETOKEN2026'
        ]);

        $requestToken = $request->query('token') 
            ?? $request->header('x-sepay-token');

        if (!$requestToken) {
            $authHeader = $request->header('Authorization') ?? '';
            if (preg_match('/^Apikey\s+(.+)$/i', trim($authHeader), $matches)) {
                $requestToken = trim($matches[1]);
            } else {
                $requestToken = trim($authHeader);
            }
        }

        if (!in_array($requestToken, $validTokens, true)) {
            Log::warning('SePay Webhook: Unauthorized request received.', [
                'ip' => $request->ip(),
                'token_provided' => $requestToken
            ]);
            return response()->json(['status' => 'unauthorized', 'message' => 'Invalid Token'], 401);
        }

        // 2. Parse payload details
        $content = (string) $request->input('content', '');
        $transferAmount = (int) $request->input('transferAmount', 0);
        $transactionId = (string) $request->input('id', '');
        
        Log::info('SePay Webhook: Received transaction log.', [
            'content' => $content,
            'amount' => $transferAmount,
            'transaction_id' => $transactionId
        ]);

        $botService = new TelegramBotService();

        // 3. CASE A: Check Telegram Wallet Top-up (NAP{telegram_id})
        if (preg_match('/NAP\s*([0-9]+)/i', $content, $matches)) {
            $telegramId = (int) $matches[1];
            $telegramUser = TelegramUser::where('telegram_id', $telegramId)->first();

            if ($telegramUser) {
                $balanceBefore = $telegramUser->balance;
                $telegramUser->increment('balance', $transferAmount);

                TelegramTransaction::create([
                    'telegram_user_id' => $telegramUser->id,
                    'type' => 'deposit',
                    'amount' => $transferAmount,
                    'balance_before' => $balanceBefore,
                    'balance_after' => $telegramUser->balance,
                    'description' => "Nạp tiền tự động qua VietQR/SePay (GD #{$transactionId})",
                    'reference_id' => $transactionId,
                ]);

                // Send instant notification to user on Telegram
                $amountFormatted = number_format($transferAmount, 0, ',', '.') . 'đ';
                $newBalanceFormatted = number_format($telegramUser->balance, 0, ',', '.') . 'đ';

                $msg = "💰 <b>NẠP TIỀN THÀNH CÔNG!</b>\n";
                $msg .= "━━━━━━━━━━━━━━━━━━━━\n";
                $msg .= "💵 Số tiền nạp: <b>+{$amountFormatted}</b>\n";
                $msg .= "👛 Số dư ví hiện tại: <b>{$newBalanceFormatted}</b>\n";
                $msg .= "Mã giao dịch: <code>{$transactionId}</code>\n\n";
                $msg .= "Cảm ơn bạn! Bạn có thể sử dụng số dư ví để mua sắm ngay tại bot.";

                $keyboard = [
                    'inline_keyboard' => [
                        [['text' => '🛒 Mua sắm ngay', 'callback_data' => 'menu_store']],
                        [['text' => '👛 Kiểm tra ví', 'callback_data' => 'menu_wallet']]
                    ]
                ];

                $botService->sendMessage($telegramUser->telegram_id, $msg, $keyboard);

                // Alert Admin via Telegram
                $userHandle = $telegramUser->username ? "@{$telegramUser->username}" : "Không có";
                $adminAlert = "💰 <b>[KHÁCH HÀNG NẠP VÍ THÀNH CÔNG]</b>\n";
                $adminAlert .= "━━━━━━━━━━━━━━━━━━━━\n";
                $adminAlert .= "👤 Khách nạp: <b>" . htmlspecialchars($telegramUser->full_name) . "</b> ({$userHandle} | ID: <code>{$telegramUser->telegram_id}</code>)\n";
                $adminAlert .= "💵 Số tiền: <b>+{$amountFormatted}</b>\n";
                $adminAlert .= "👛 Số dư ví mới: <b>{$newBalanceFormatted}</b>\n";
                $adminAlert .= "🏦 Ngân hàng: <b>{$gateway}</b> | GD: <code>{$transactionId}</code>\n";
                $adminAlert .= "📝 Nội dung CK: <code>{$content}</code>\n";
                $adminAlert .= "⏰ Thời gian: " . now()->format('d/m/Y H:i:s');

                $botService->notifyAdmin($adminAlert);

                Log::info('SePay Webhook: Telegram wallet topup completed.', [
                    'telegram_id' => $telegramId,
                    'amount' => $transferAmount
                ]);

                return response()->json(['success' => true, 'message' => 'Telegram wallet topup completed']);
            }
        }

        // 4. CASE B: Check Telegram Order (TG{number} or code like TG1001)
        if (preg_match('/(TG[0-9]+)/i', $content, $matches)) {
            $orderCode = strtoupper($matches[1]);
            $telegramOrder = TelegramOrder::where('order_code', $orderCode)->first();

            if ($telegramOrder) {
                if ($telegramOrder->status === 'completed') {
                    return response()->json(['success' => true, 'message' => 'Telegram order already completed']);
                }

                // Check if order expired (> 5 minutes)
                if ($telegramOrder->status === 'expired' || ($telegramOrder->expires_at && now()->gt($telegramOrder->expires_at))) {
                    $telegramOrder->update([
                        'status' => 'expired',
                        'sepay_transaction_id' => $transactionId,
                    ]);

                    // Automatically credit to user wallet so customer never loses money
                    $buyer = TelegramUser::find($telegramOrder->telegram_user_id);
                    if ($buyer) {
                        $balanceBefore = $buyer->balance;
                        $buyer->increment('balance', $transferAmount);

                        TelegramTransaction::create([
                            'telegram_user_id' => $buyer->id,
                            'type' => 'deposit',
                            'amount' => $transferAmount,
                            'balance_before' => $balanceBefore,
                            'balance_after' => $buyer->balance,
                            'description' => "Hoàn tiền đơn hàng quá hạn 5 phút #{$orderCode} vào ví",
                            'reference_id' => $transactionId,
                        ]);

                        $amountFmt = number_format($transferAmount, 0, ',', '.') . 'đ';
                        $walletFmt = number_format($buyer->balance, 0, ',', '.') . 'đ';
                        $msg = "⏰ <b>ĐƠN HÀNG #{$orderCode} ĐÃ HẾT HẠN (QUÁ 5 PHÚT)!</b>\n";
                        $msg .= "━━━━━━━━━━━━━━━━━━━━\n";
                        $msg .= "Do bạn chuyển khoản sau khi đơn hàng đã hết hạn (5 phút), hệ thống đã tự động cộng số tiền <b>+{$amountFmt}</b> vào Ví của bạn.\n";
                        $msg .= "👛 Số dư ví hiện tại: <b>{$walletFmt}</b>\n\n";
                        $msg .= "Bạn có thể dùng số dư ví để mua lại sản phẩm ngay tức thì chỉ với 1 click!";

                        $botService->sendMessage($buyer->telegram_id, $msg, [
                            'inline_keyboard' => [
                                [['text' => '🛒 Mua lại sản phẩm ngay', 'callback_data' => 'menu_store']],
                                [['text' => '👛 Kiểm tra ví', 'callback_data' => 'menu_wallet']]
                            ]
                        ]);

                        // Alert Admin about late payment converted to wallet
                        $adminAlert = "⏰ <b>[KHÁCH THANH TOÁN TRỄ >5P - ĐÃ HOÀN VÍ]</b>\n";
                        $adminAlert .= "━━━━━━━━━━━━━━━━━━━━\n";
                        $adminAlert .= "🧾 Mã đơn trễ: <b>#{$orderCode}</b>\n";
                        $adminAlert .= "👤 Khách hàng: <b>" . htmlspecialchars($buyer->full_name) . "</b> (ID: <code>{$buyer->telegram_id}</code>)\n";
                        $adminAlert .= "💵 Số tiền: <b>+{$amountFmt}</b> (Đã tự động cộng vào ví)\n";
                        $adminAlert .= "👛 Số dư ví hiện tại: <b>{$walletFmt}</b>\n";
                        $adminAlert .= "📝 Nội dung CK: <code>{$content}</code>";

                        $botService->notifyAdmin($adminAlert);
                    }

                    return response()->json(['success' => true, 'message' => 'Telegram order was expired. Amount credited to wallet.']);
                }

                if ($transferAmount >= $telegramOrder->total_amount) {
                    $telegramOrder->update([
                        'sepay_transaction_id' => $transactionId,
                        'payment_method' => 'vietqr',
                        'paid_at' => now(),
                    ]);

                    $botService->deliverOrder($telegramOrder);

                    Log::info('SePay Webhook: Telegram order completed and delivered.', [
                        'order_code' => $orderCode,
                        'amount' => $transferAmount
                    ]);

                    return response()->json(['success' => true, 'message' => 'Telegram order completed and delivered']);
                } else {
                    Log::warning('SePay Webhook: Telegram order amount mismatch.', [
                        'order_code' => $orderCode,
                        'expected' => $telegramOrder->total_amount,
                        'received' => $transferAmount
                    ]);
                    return response()->json(['success' => false, 'message' => 'Insufficient payment amount for Telegram order'], 400);
                }
            }
        }

        // 5. CASE C: Check Web Orders or general OD{number}
        if (preg_match('/OD([0-9]+)/i', $content, $matches)) {
            $formattedId = (int) $matches[1];
            $orderId = $formattedId > 1000 ? ($formattedId - 1000) : $formattedId;

            // Also check if there's a telegram order matching OD or TG
            $tgOrder = TelegramOrder::where('order_code', 'TG' . $formattedId)
                ->orWhere('order_code', 'OD' . $formattedId)
                ->first();

            if ($tgOrder && $tgOrder->status !== 'completed' && $transferAmount >= $tgOrder->total_amount) {
                $tgOrder->update([
                    'sepay_transaction_id' => $transactionId,
                    'paid_at' => now(),
                ]);
                $botService->deliverOrder($tgOrder);
                return response()->json(['success' => true, 'message' => 'Telegram order completed via OD code']);
            }

            $order = Order::find($orderId);

            if ($order) {
                if ($order->status === 'completed' || $order->status === 'processing') {
                    return response()->json(['success' => true, 'message' => 'Order already paid or completed']);
                }

                if ($transferAmount >= $order->price) {
                    $prefix = 'KEY';
                    if (str_contains(strtolower($order->product_name), 'capcut')) {
                        $prefix = 'CAPCUT-PRO';
                    } elseif (str_contains(strtolower($order->product_name), 'gpt')) {
                        $prefix = 'GPT-PLUS';
                    } elseif (str_contains(strtolower($order->product_name), 'canva')) {
                        $prefix = 'CANVA-PRO';
                    }

                    $activationKey = $prefix . '-' . strtoupper(Str::random(5)) . '-' . strtoupper(Str::random(5));

                    $order->update([
                        'status' => 'processing',
                        'activation_key' => $activationKey
                    ]);

                    Log::info('SePay Webhook: Web Order successfully auto-completed.', [
                        'order_id' => $order->id,
                        'price' => $order->price,
                        'transferred' => $transferAmount
                    ]);

                    return response()->json(['success' => true, 'message' => 'Order auto-completed successfully']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Insufficient payment amount'], 400);
                }
            }
        }

        Log::warning('SePay Webhook: No matching order or wallet top-up pattern found.', ['content' => $content]);
        return response()->json(['success' => false, 'message' => 'No order or top-up pattern found'], 400);
    }
}
