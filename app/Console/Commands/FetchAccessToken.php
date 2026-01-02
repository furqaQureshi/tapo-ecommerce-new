<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\AccessToken;

class FetchAccessToken extends Command
{
    protected $signature = 'token:fetch';
    protected $description = 'Fetch access token from API and store in database';

    public function handle()
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json'
            ])->asForm()->post('https://api-dev.pos.com.my/oauth2/token', [
                'client_id' => 'e1a1de8d-5f96-449c-870b-329660c59697',
                'client_secret' => '1a189db6-0717-4da6-93e9-1f3060a1a5f5',
                'grant_type' => 'client_credentials'
            ]);

            if ($response->successful()) {
                $data = $response->json();

                AccessToken::create([
                    'access_token' => $data['access_token'],
                    'token_type' => $data['token_type'],
                    'expires_in' => $data['expires_in'],
                ]);

                $this->info('Token successfully fetched and stored at ' . now());
            } else {
                Log::error('Failed to fetch token: ' . $response->body());
                $this->error('Failed to fetch token');
            }
        } catch (\Exception $e) {
            Log::error('Error in FetchAccessToken: ' . $e->getMessage());
            $this->error('Error fetching token: ' . $e->getMessage());
        }
    }
}
