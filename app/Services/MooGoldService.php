<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class MooGoldService
{
    protected $client;
    protected $partnerId = 'd81932d77b4a1204d0114646f97c96cd';
    protected $secretKey = 'kNtBbm96Tr';
    protected $baseUrl = 'https://moogold.com/wp-json/v1/api/';
    protected $localIp = '217.21.95.211';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout'  => 10.0,
        ]);
    }

    protected function buildHeaders(string $payload, string $path): array
    {
        $timestamp = time();
        $stringToSign = $payload . $timestamp . $path;
        $signature = hash_hmac('SHA256', $stringToSign, $this->secretKey);
        $authBasic = base64_encode($this->partnerId . ':' . $this->secretKey);

        return [
            'timestamp'     => $timestamp,
            'auth'          => $signature,
            'Authorization' => 'Basic ' . $authBasic,
            'Content-Type'  => 'application/json',
        ];
    }

    public function send(string $path, array $body): ?array
    {
        $payload = json_encode($body);
        $headers = $this->buildHeaders($payload, $path);

        try {
            $response = $this->client->post($path, [
                'headers' => $headers,
                'body'    => $payload,
                'curl'    => [CURLOPT_INTERFACE => $this->localIp],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error('MooGold API error: ' . $e->getMessage());
            return null;
        }
    }

    public function listProducts($categoryId = 50)
    {
        return $this->send('product/list_product', [
            'path' => 'product/list_product',
            'category_id' => $categoryId
        ]);
    }

    public function productDetail($productId)
    {
        return $this->send('product/product_detail', [
            'path' => 'product/product_detail',
            'product_id' => $productId
        ]);
    }

    public function getBalance()
    {
        return $this->send('user/balance', [
            'path' => 'user/balance'
        ]);
    }

    public function reloadBalance($amount, $method = 'usdt-trc20-payment-gateway')
    {
        return $this->send('user/reload_balance', [
            'path' => 'user/reload_balance',
            'payment_method' => $method,
            'amount' => $amount
        ]);
    }

    public function createOrder(array $data, $partnerOrderId = null)
    {
        return $this->send('order/create_order', [
            'path' => 'order/create_order',
            'data' => $data,
            'partnerOrderId' => $partnerOrderId
        ]);
    }
}
