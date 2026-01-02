<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class SynnStoreService
{
    protected Client $client;
    protected string $apiKey = 'mdh0NIXRgPSixriu3LL8';
    protected string $baseUrl = 'http://synnmlbb.com/api/v1/';
    protected string $localIp = '217.21.95.211';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 10.0,
        ]);
    }

    protected function getHeaders(): array
    {
        return [
            'x-user-key' => $this->apiKey,
        ];
    }

    protected function post(string $path, array $formParams = [], bool $isJson = false): ?array
    {
        try {
            $options = [
                'headers' => $this->getHeaders(),
                'curl' => [CURLOPT_INTERFACE => $this->localIp],
            ];

            if ($isJson) {
                $options['json'] = $formParams;
            } else {
                $options['form_params'] = $formParams;
            }

            $response = $this->client->post($path, $options);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("SynnStore API Error [{$path}]: " . $e->getMessage());
            return  array($e->getMessage());
        }
    }
    
    public function getBalance(): ?array
    {
        return $this->post('balance');
    }

    public function getProducts(): ?array
    {
        return $this->post('products');
    }

    public function getProductDetail(string $slug): ?array
    {
        return $this->post('detail-product', [
            'slug' => $slug,
        ]);
    }

    public function createTransaction(array $data): ?array
    {
        return $this->post('transaction', $data);
    }

    public function getTransactionDetail(string $invoice): ?array
    {
        return $this->post('detail-transaction', [
            'invoice' => $invoice,
        ]);
    }

    public function checkMLAccount(string $userId, string $zoneId): ?array
    {
        try {
            $response = $this->client->post('ml-checker', [
                'headers' => $this->getHeaders(),
                'curl' => [CURLOPT_INTERFACE => $this->localIp],
                'query' => [
                    'user_id' => $userId,
                    'zone_id' => $zoneId,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("SynnStore API ML Checker Error: " . $e->getMessage());
            return null;
        }
    }
}