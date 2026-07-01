<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Setting;
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

        if (empty($configuredToken) || $requestToken !== $configuredToken) {
            Log::warning('SePay Webhook: Unauthorized request received.', [
                'ip' => $request->ip(),
                'token_provided' => $requestToken
            ]);
            return response()->json(['status' => 'unauthorized', 'message' => 'Invalid Token'], 401);
        }

        // 2. Parse payload details
        $content = $request->input('content', '');
        $transferAmount = (int) $request->input('transferAmount', 0);
        
        Log::info('SePay Webhook: Received transaction log.', [
            'content' => $content,
            'amount' => $transferAmount,
            'transaction_id' => $request->input('id')
        ]);

        // 3. Search for order ID pattern (e.g. OD1005 or OD5)
        if (preg_match('/OD([0-9]+)/i', $content, $matches)) {
            $formattedId = (int) $matches[1];
            // Order ID is $formattedId - 1000 if it starts at 1000, otherwise check if ID directly exists
            $orderId = $formattedId > 1000 ? ($formattedId - 1000) : $formattedId;

            $order = Order::find($orderId);

            if ($order) {
                if ($order->status === 'completed' || $order->status === 'processing') {
                    return response()->json(['success' => true, 'message' => 'Order already paid or completed']);
                }

                // Check if amount matches or is sufficient
                if ($transferAmount >= $order->price) {
                    // Generate dynamic license activation key
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

                    Log::info('SePay Webhook: Order successfully auto-completed.', [
                        'order_id' => $order->id,
                        'price' => $order->price,
                        'transferred' => $transferAmount
                    ]);

                    return response()->json(['success' => true, 'message' => 'Order auto-completed successfully']);
                } else {
                    Log::warning('SePay Webhook: Amount mismatch.', [
                        'order_id' => $order->id,
                        'expected' => $order->price,
                        'received' => $transferAmount
                    ]);
                    return response()->json(['success' => false, 'message' => 'Insufficient payment amount'], 400);
                }
            } else {
                Log::warning('SePay Webhook: Order not found.', ['extracted_id' => $orderId]);
                return response()->json(['success' => false, 'message' => 'Order not found'], 404);
            }
        }

        Log::warning('SePay Webhook: No order ID pattern found in description.', ['content' => $content]);
        return response()->json(['success' => false, 'message' => 'No order ID pattern found'], 400);
    }
}
