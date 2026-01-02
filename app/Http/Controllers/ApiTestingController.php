<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;

class ApiTestingController extends Controller
{
    public function synnProducts()
    {
        $curl = curl_init();
        $postData = array('slug' => '');
        curl_setopt($curl, CURLOPT_INTERFACE, "217.21.95.211");
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://synnmlbb.com/api/v1/products',
            //CURLOPT_URL => 'http://synnmlbb.com/api/v1/detail-product',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                'x-user-key: mdh0NIXRgPSixriu3LL8',
                'slug' => 'pubg'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    public function calculateAmount($price) {}

    public function synnProductDetail($slug)
    {
        $curl = curl_init();
        $postData = array('slug' => $slug);
        curl_setopt($curl, CURLOPT_INTERFACE, "217.21.95.211");
        curl_setopt_array($curl, array(

            CURLOPT_URL => 'http://synnmlbb.com/api/v1/detail-product',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                'x-user-key: mdh0NIXRgPSixriu3LL8',

            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    public function synn_store($code)
    {
        if ($code == 'P') {
            $synnProducts = Product::where('source', 'S')->where('status', 'active')->get();

            $continue = 0;
            if (isset($synnProducts)) {
                $setting = Setting::where('id', 1)->first();
                $percentage = $setting->product_margin;
                $variations = array();
                foreach ($synnProducts as $res) {
                    $productDetailResp = $this->synnProductDetail($res->source_id);
                    dd($productDetailResp);
                    if (isset($productDetailResp['data'])) {

                        $proDetail = $productDetailResp['data']['product'][0];
                        $variations  = $proDetail['type'];
                        $product_id = $res->id;


                        if (isset($variations)) {
                            foreach ($variations as $okey => $vari) {
                                $per = $vari['price'] * ($percentage / 100);
                                $price = $vari['price'] + $per;
                                ProductVariant::updateOrCreate(
                                    ['source_id' => $vari['product_type_id'], 'product_id' => $product_id], // Match attributes
                                    [
                                        'source_id' => $vari['product_type_id'],
                                        'product_id' => $product_id,
                                        'sku' => 'SYNN-' . strtoupper(Str::random(4)) . $vari['product_type_id'],
                                        'price' => $price,
                                        'percent' => $percentage,
                                        'region' => 'MY',
                                        'order' => $okey
                                    ]
                                );
                            }
                        }
                    }
                }
            }
        }
    }

    public function acid_curl($url, $postdata)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postdata),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'X-API-KEY: 9876535345melpadigitalx',
                'Authorization: Bearer 7DMp3FnNTPmrQ8s2HEkALLKJ5cGzyS4H0lSf3ubB'
            ]
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $resp = json_decode($response, TRUE);
        return $resp;
    }

    public function acid_cateogry()
    {
        return array(
            //array('category_name' => 'League of Legends: Wild Rift (MY)', 'category_slug' => 'League-of-Legends-Wild-Rift'),
            //array('category_name' => 'Mobile Legends (Malaysia)', 'category_slug' => 'mobile-legends-malaysia'),
            array('category_name' => 'Valorant (Malaysia)', 'category_slug' => 'Valorant-Malaysia'),
            //array('category_name' => 'PUBG Mobile (Malaysia)', 'category_slug' => 'Pubg-Mobile-Malaysia'),
            //array('category_name' => 'Garena Free Fire (Malaysia)', 'category_slug' => 'FreeFire-Malaysia'),
            //array('category_name' => 'Honor of Kings (Malaysia)', 'category_slug' => 'honor-of-kings')
        );
    }

    public function acid_games()
    {
        $products = Product::select('id', 'slug')->where('status', 'active')->where('source', 'A')->get();
        $setting = Setting::where('id', 1)->first();
        $percentage = $setting->product_margin;
        foreach ($products as $pro) {
            $productData = ['category_slug' => $pro->slug, 'mode' => 'sandbox'];
            $productsVariations = $this->acid_curl('https://api.acidgameshop.com/api/product', $productData);

            foreach ($productsVariations['data'] as $pvkey => $pv) {
                $per = $pv['product_price'] * ($percentage / 100);
                $price = $pv['product_price'] + $per;;
                ProductVariant::updateOrCreate(
                    ['source_id' => $pv['product_code']], // Match attributes
                    [
                        'source_id' => $pv['product_code'],
                        'product_id' => $pro->id,
                        'name' => $pv['product_title'],
                        'sku' => $pv['product_code'] . date('his'),
                        'price' => $price,
                        'percent' => $percentage
                    ] // Values to update/create
                );
            }
        }
    }

    public function getVariable($array, $variabletype)
    {
        if (!empty($array)) {
            foreach ($array as $akey => $aval) {
                if ($aval == 'User ID' && $variabletype == 'game_user_id') {
                    return 1;
                } else if ($aval == 'Player ID' && $variabletype == 'game_user_name') {
                    return 1;
                } else if ($aval == 'Server' && $variabletype == 'game_server_id') {
                    return 1;
                } else if ($aval == 'Server ID' && $variabletype == 'game_server_id') {
                    return 1;
                } else if ($aval == 'Player Email' && $variabletype == 'game_email') {
                    return 1;
                } else {
                    return 0;
                }
            }
        } else {
            return 0;
        }
    }

    public function moo_gold_products()
    {
        $moogold = new \App\Services\MooGoldService();
        $MooResult = $moogold->listProducts();
        $continue = 1;
        foreach ($MooResult as $res) {
            $productArray[] = array(
                'source_id' => $res['ID'],
                'source' => 'M',
                'name' => $res['post_title'],
                'slug' => Str::slug($res['post_title']) . $continue . '-moogold',
                'description' => $res['post_title'],
                'short_description' => $res['post_title'],
                'category_id' => 1
            );
            $continue++;
        }
        //DB::table('products')->insert($productArray);
    }

    public function moo_gold_product_detail()
    {
        $products = Product::where('source', 'M')->where('status', 'active')->paginate(500);
        //echo $products->links();
        $setting = Setting::where('id', 1)->first();
        $percentage = $setting->product_margin;
        $moogold = new \App\Services\MooGoldService();
        $continue = 0;
        foreach ($products as $res) {
            $productDetail = $moogold->productDetail($res->source_id);
            $product_id = $res->id;
            if (isset($productDetail)) {
                if (isset($productDetail['Variation'])) {
                    $variations = $productDetail['Variation'];
                }

                if (isset($productDetail['Image_URL'])) {
                    DB::table('products')->where('id', $res->id)->update(['featured_image' => $productDetail['Image_URL']]);

                    if (isset($product_id)) {
                        // if (isset($productDetail['fields'])) {
                        //     $fields = $productDetail['fields'];
                        //     if (is_array($fields)) {
                        //         foreach ($fields as $fvalue) {
                        //             DB::table('product_fields')->insert(['product_id' => $product_id, 'field_name' => $fvalue]);
                        //         }
                        //     }
                        // }
                        $order = 0;
                        foreach ($variations as $vari) {
                            $order++;
                            $continue++;
                            $sku = 'MG-' . $continue . date('his') . $res->source_id;
                            $cleanName = preg_replace('/\s*\(#\d+\)$/', '', $vari['variation_name']);

                            $per = $vari['variation_price'] * ($percentage / 100);
                            $price = $vari['variation_price'] + $per;

                            ProductVariant::updateOrCreate(
                                ['source_id' => $vari['variation_id'], 'product_id' => $product_id], // Match attributes
                                [
                                    'source_id' => $vari['variation_id'],
                                    'product_id' => $product_id,
                                    'name' => $cleanName,
                                    'sku' => $sku,
                                    'price' => $price,
                                    'percent' => $percentage
                                ]
                            );
                        }

                        //DB::table('product_variants')->insert($data);

                    }
                }
            }
        }
    }


    public function moo_gold($code)
    {
        if ($code == 'P') {
            $this->moo_gold_products();
        } else if ($code == 'PD') {
            $this->moo_gold_product_detail();
        }
    }
}
