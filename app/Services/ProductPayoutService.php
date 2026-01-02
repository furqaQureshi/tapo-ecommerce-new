<?php

namespace App\Services;

use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;

class ProductPayoutService
{
    protected $service;

    public function __construct($serviceClass)
    {
        $this->service = $serviceClass;
    }

    public function MooGoldprocess(OrderItem $orderItem)
    {
        $categoryIds = [
            50, 51, 1391, 1444, 766, 538, 2433, 1223,
            874, 765, 451, 1261, 3563, 992, 993,
            2377, 3154, 3737, 3381, 3351, 3075, 3382,
        ];

        $productName = strtolower($orderItem->product->name);

        foreach ($categoryIds as $categoryId) {
            $products = $this->service->listProducts($categoryId);
            
            if (!is_array($products)) {
                continue;
            }

            foreach ($products as $remoteProduct) {
                $remoteName = strtolower($remoteProduct['post_title'] ?? '');
                
                if (str_contains($remoteName, $productName) || similar_text($remoteName, $productName) > 75) {
                    $productId = $remoteProduct['ID'];
                    $details = $this->service->productDetail($productId);

                    if (!isset($details['Variation'])) {
                        continue;
                    }

                    $matchedVariation = null;
                    $targetName = strtolower($orderItem->variant?->name ?? '');
                    $targetPrice = (float) $orderItem->price;

                    foreach ($details['Variation'] as $variation) {
                        $variationName = strtolower($variation['variation_name'] ?? '');
                        $variationPrice = (float) $variation['variation_price'];
                        $variantSimilarity = 0;
                        similar_text($variationName, $targetName, $variantSimilarity);
                        if (
                            $variantSimilarity > 75 &&
                            ($targetPrice - $variationPrice) > 0.01
                        ) {
                            $matchedVariation = $variation;
                            break;
                        }
                    }

                    if (empty($matchedVariation)) {
                        continue;
                    }

                    $orderData = [
                            'category' => 1,
                            'product-id' => $matchedVariation['variation_id'],
                            'quantity' => $orderItem->quantity ?? 1,
                            'User ID' => "664194"
                    ];

                    // $orderData = [
                    //         'category' => 1,
                    //         'product-id' => 4085924,
                    //         'quantity' => 1,
                    //         'Character ID' => "51587369264", // Valid Character ID
                    // ];

                    $response = $this->service->createOrder($orderData);
                    
                    if(isset($response['status']) && $response['status'] == true) {
                        $orderItem->delivery_status = 'completed';
                        $orderItem->save();
                        return true;
                    }

                }
            }
        }

        $orderItem->delivery_status = 'pending';
        $orderItem->save();
        return false;
    }

    public function SynnStoreProcess(OrderItem $orderItem): bool
    {
        $product = $orderItem->product;
        $variant = $orderItem->variant;

        if (!$product || !$variant) {
            Log::warning("OrderItem ID {$orderItem->id}: Missing product or variant.");
            return false;
        }

        // Step 1: Fetch products from API
        $productsResponse = $this->service->getProducts();

        if (!$productsResponse || empty($productsResponse['data'])) {
            Log::error("OrderItem ID {$orderItem->id}: Failed to fetch products from SynnStore.");
            return false;
        }

        // Step 2: Match product by slug
       $matchedProduct = collect($productsResponse['data'])->first(function ($apiProduct) use ($product) {
            return str_contains($product->name, $apiProduct['name']);
        });


        if (!$matchedProduct) {
            Log::warning("OrderItem ID {$orderItem->id}: Product slug '{$product->slug}' not found in SynnStore.");
            return false;
        }

        // Step 3: Get product details
        $productDetailResponse = $this->service->getProductDetail($product->slug);

        if (!$productDetailResponse || empty($productDetailResponse['data']['product'][0])) {
            Log::error("OrderItem ID {$orderItem->id}: Failed to fetch product details for '{$product->slug}'.");
            return false;
        }

        $productDetail = $productDetailResponse['data']['product'][0];

        // Step 4: Match variant by number in name (e.g. "475 UC" => 475)
        preg_match('/\d+/', $variant->name, $matches);
        $variantNumber = $matches[0] ?? null;

        if (!$variantNumber) {
            Log::warning("OrderItem ID {$orderItem->id}: Could not extract number from variant name '{$variant->name}'.");
            return false;
        }

        $matchedVariant = collect($productDetail['type'])
            ->firstWhere('name', (string) $variantNumber);

        if (!$matchedVariant) {
            Log::warning("OrderItem ID {$orderItem->id}: Variant '{$variantNumber}' not found in SynnStore product types.");
            return false;
        }

        // Step 5: Check if all required form fields are filled in OrderItem
        $formFields = $productDetail['form'] ?? [];
        $inputs = is_array($orderItem->inputs) ? $orderItem->inputs : json_decode($orderItem->inputs, true);

        $fields = [];
        foreach ($formFields as $field) {
            $key = $field['key'] ?? null;
            if($key == 'user_id') {
                if (empty($orderItem->game_id)) {
                    Log::warning("OrderItem ID {$orderItem->id}: Required form field '{$key}' is missing.");
                    return false;
                } else {
                    $fields[] = array('name' => 'user_id',
                                'value' => $orderItem->game_id);
                }
            }
            if($key == 'server_id') {
                if (empty($orderItem->server_id)) {
                    Log::warning("OrderItem ID {$orderItem->id}: Required form field '{$key}' is missing.");
                    return false;
                } else {
                    $fields[] = array('name' => 'server_id',
                                'value' => $orderItem->server_id);
                }
            }
            if($key == 'riot_id' || $key == 'riot_username') {
                if (empty($orderItem->user_name)) {
                    Log::warning("OrderItem ID {$orderItem->id}: Required form field '{$key}' is missing.");
                    return false;
                } else {
                    $fields[] = array('name' => $key,
                                'value' => $orderItem->user_name);
                }
            }
        }

        // Step 6: Validate price
        $apiPrice = (float) $matchedVariant['price'];
        $orderPrice = (float) $orderItem->price;

        if ($apiPrice < $orderPrice) {
            Log::warning("OrderItem ID {$orderItem->id}: API price ({$apiPrice}) is less than order price ({$orderPrice}).");
            return false;
        }

        // Step 7: Create Transaction
        $response = $this->service->createTransaction([
            'user_data' => json_encode($fields),
            'slug' => $matchedProduct['slug'],
            'product_type_id' => $matchedVariant['product_type_id']
        ]);
        if ($response) {
            return true;
        }

        return true;
    }

}