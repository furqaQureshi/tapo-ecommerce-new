<?php

namespace App\Services;

use Razorpay\Api\Api;
use Razorpay\Api\Errors;
use Illuminate\Support\Facades\Log;

class RazorpayApi extends Api
{
    public function request($method, $url, $data = [])
    {
        $response = parent::request($method, $url, $data);
        Log::info('Razorpay API Raw Response', [
            'method' => $method,
            'url' => $url,
            'data' => $data,
            'response' => $response,
            'headers' => $this->getResponseHeaders()
        ]);
        return $response;
    }

    protected function getResponseHeaders()
    {
        return curl_getinfo($this->curl);
    }
}
