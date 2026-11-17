<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CanbosoService
{
    protected string $baseUrl = 'https://canboso.com';
    protected ?string $apiKey;

    public function __construct(?string $apiKey = null)
    {
        $this->apiKey = $apiKey ?: Setting::getValue('canboso_api_key', 'tgb_8eae3646b74f7706536280e9778cf35d0f9ba900817be34b');
    }

    /**
     * Get Current Wallet Balance on Canboso
     */
    public function getBalance(): array
    {
        if (empty($this->apiKey)) {
            return ['success' => false, 'message' => 'Chưa cấu hình API Key Canboso'];
        }

        try {
            $response = Http::timeout(15)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'X-API-Key' => $this->apiKey,
                    'Accept' => 'application/json',
                ])
                ->get("{$this->baseUrl}/api/v2/telegram-buyer/balance", [
                    'key' => $this->apiKey,
                ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Canboso getBalance failed: ' . $response->body());
            return ['success' => false, 'message' => 'Lỗi kết nối Canboso: ' . $response->status()];
        } catch (\Exception $e) {
            Log::error('Canboso getBalance Exception: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Get Products Catalog from Canboso
     */
    public function getProducts(): array
    {
        if (empty($this->apiKey)) {
            return ['success' => false, 'products' => []];
        }

        try {
            $response = Http::timeout(25)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'X-API-Key' => $this->apiKey,
                    'Accept' => 'application/json',
                ])
                ->get("{$this->baseUrl}/api/v2/telegram-buyer/products", [
                    'key' => $this->apiKey,
                ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Canboso getProducts failed: ' . $response->body());
            return ['success' => false, 'products' => []];
        } catch (\Exception $e) {
            Log::error('Canboso getProducts Exception: ' . $e->getMessage());
            return ['success' => false, 'products' => []];
        }
    }

    /**
     * Purchase product by product_id using buyer wallet balance
     */
    public function purchase(string $productId, int $quantity = 1, ?string $customerEmail = null): array
    {
        if (empty($this->apiKey)) {
            return ['success' => false, 'message' => 'Chưa thiết lập Canboso API Key'];
        }

        $payload = [
            'key' => $this->apiKey,
            'product_id' => $productId,
            'quantity' => $quantity,
        ];

        if ($customerEmail) {
            $payload['customer_email'] = $customerEmail;
        }

        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'X-API-Key' => $this->apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->post("{$this->baseUrl}/api/v2/telegram-buyer/purchase", $payload);

            $data = $response->json();

            Log::info("Canboso Purchase Attempt [{$productId} x{$quantity}]:", [
                'status' => $response->status(),
                'response' => $data,
            ]);

            if ($response->successful() && ($data['success'] ?? false)) {
                return [
                    'success' => true,
                    'order' => $data['order'] ?? [],
                    'delivery' => $data['delivery'] ?? [],
                    'raw' => $data,
                ];
            }

            return [
                'success' => false,
                'message' => $data['message'] ?? ($data['error'] ?? 'Lỗi không xác định khi gọi mua hàng Canboso'),
                'raw' => $data,
            ];
        } catch (\Exception $e) {
            Log::error("Canboso purchase exception: " . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Format Delivery Content string from Canboso purchase response
     */
    public function formatDeliveryContent(array $purchaseResult): string
    {
        $delivery = $purchaseResult['delivery'] ?? [];
        $lines = [];

        // 1. Account format (user | password | verifyEmail)
        if (!empty($delivery['accounts']) && is_array($delivery['accounts'])) {
            foreach ($delivery['accounts'] as $acc) {
                $user = $acc['user'] ?? '';
                $pass = $acc['password'] ?? '';
                $extra = $acc['verifyEmail'] ?? ($acc['extra'] ?? '');
                
                $item = "{$user}|{$pass}";
                if ($extra) {
                    $item .= "|{$extra}";
                }
                $lines[] = $item;
            }
        }

        // 2. Direct keys format
        if (!empty($delivery['keys']) && is_array($delivery['keys'])) {
            foreach ($delivery['keys'] as $k) {
                $lines[] = is_string($k) ? $k : json_encode($k);
            }
        }

        // 3. Slot / Invitation message
        if (!empty($delivery['message'])) {
            $lines[] = $delivery['message'];
        }

        if (empty($lines)) {
            $lines[] = "Đơn hàng đã thanh toán thành công qua nhà cung cấp (Mã ĐH Canboso: " . ($purchaseResult['order']['orderCode'] ?? 'N/A') . ").";
        }

        return implode("\n", $lines);
    }
}
