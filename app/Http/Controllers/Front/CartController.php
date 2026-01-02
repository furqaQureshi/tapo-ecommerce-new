<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductField;
use App\Models\ProductMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // public function addToCart(Request $request)
    // {
    //     // $variantId = $request->variant_id;
    //     $productId = $request->product_id;
    //     $proFields = ProductField::where('product_id', $productId)->get();

    //     $fields = [];
    //     foreach ($proFields as $fieldKey => $pf) {
    //         $field_object = Str::slug($pf->field_name);

    //         $fields[] = array($field_object => $request->fields[$field_object]);
    //     }
    //     // dd($fields);
    //     $price = $request->price;
    //     $game_user_id = $request->game_user_id;
    //     $game_server_id = $request->game_server_id;
    //     $game_user_name = $request->game_user_name;
    //     $game_email = $request->game_email;
    //     $quantity = $request->quantity ?? 1;
    //     if (Auth::check()) {
    //         Cart::updateOrCreate(
    //             [
    //                 'user_id' => Auth::id(),
    //                 // 'variant_id' => $variantId,
    //                 'game_user_id' => $game_user_id,
    //                 'fields' => json_encode($fields)
    //             ],
    //             [
    //                 'product_id' => $productId,
    //                 'quantity' =>  $quantity,
    //                 'price' => $price,
    //                 'fields' => json_encode($fields),
    //                 'game_user_id' => $game_user_id,
    //                 'game_server_id' => $game_server_id,
    //                 'game_user_name' => $game_user_name,
    //                 'game_email' => $game_email,
    //             ]
    //         );
    //     } else {
    //         $cart = session()->get('cart', []);

    //         if (isset($cart[$productId])) {
    //             $cart[$productId]['quantity'] += $quantity;
    //         } else {
    //             $cart[$productId] = [
    //                 'product_id' => $productId,
    //                 // 'variant_id' => $variantId,
    //                 'quantity' => $quantity,
    //                 'price' => $price,
    //                 'fields' => $fields,
    //                 'game_user_id' => $game_user_id,
    //                 'game_server_id' => $game_server_id,
    //                 'game_user_name' => $game_user_name,
    //                 'game_email' => $game_email,
    //             ];
    //         }

    //         session()->put('cart', $cart);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Product added to cart',
    //         'cart_count' => $this->getCartCount()
    //     ]);
    // }

    // public function addToCart(Request $request)
    // {
    //     $productId = $request->product_id;
    //     $proFields = ProductField::where('product_id', $productId)->get();

    //     $fields = [];
    //     foreach ($proFields as $fieldKey => $pf) {
    //         $field_object = Str::slug($pf->field_name);
    //         $fields[] = [$field_object => $request->fields[$field_object]];
    //     }

    //     $price = $request->price;
    //     $game_user_id = $request->game_user_id;
    //     $game_server_id = $request->game_server_id;
    //     $game_user_name = $request->game_user_name;
    //     $game_email = $request->game_email;
    //     $quantity = $request->quantity ?? 1;

    //     if (Auth::check()) {
    //         Cart::updateOrCreate(
    //             [
    //                 'user_id' => Auth::id(),
    //                 'game_user_id' => $game_user_id,
    //                 'fields' => json_encode($fields)
    //             ],
    //             [
    //                 'product_id' => $productId,
    //                 'quantity' => $quantity,
    //                 'price' => $price,
    //                 'fields' => json_encode($fields),
    //                 'game_user_id' => $game_user_id,
    //                 'game_server_id' => $game_server_id,
    //                 'game_user_name' => $game_user_name,
    //                 'game_email' => $game_email,
    //             ]
    //         );

    //         // Fetch cart items for authenticated user
    //         $cartItems = Cart::where('user_id', Auth::id())->with('product')->get()->map(function ($item) {
    //             return [
    //                 'id' => $item->product_id,
    //                 'name' => $item->product->name,
    //                 'slug' => $item->product->slug,
    //                 'featured_image' => $item->product->featured_image,
    //                 'price' => $item->price,
    //                 'quantity' => $item->quantity,
    //                 'fields' => json_decode($item->fields, true),
    //                 'game_user_id' => $item->game_user_id,
    //                 'game_server_id' => $item->game_server_id,
    //                 'game_user_name' => $item->game_user_name,
    //                 'game_email' => $item->game_email,
    //             ];
    //         })->toArray();
    //     } else {
    //         $cart = session()->get('cart', []);

    //         if (isset($cart[$productId])) {
    //             $cart[$productId]['quantity'] += $quantity;
    //         } else {
    //             $cart[$productId] = [
    //                 'product_id' => $productId,
    //                 'quantity' => $quantity,
    //                 'price' => $price,
    //                 'fields' => $fields,
    //                 'game_user_id' => $game_user_id,
    //                 'game_server_id' => $game_server_id,
    //                 'game_user_name' => $game_user_name,
    //                 'game_email' => $game_email,
    //             ];
    //         }

    //         session()->put('cart', $cart);

    //         // Fetch product details for guest cart
    //         $cartItems = [];
    //         foreach ($cart as $id => $item) {
    //             $product = Product::find($id);
    //             if ($product) {
    //                 $cartItems[] = [
    //                     'id' => $item['product_id'],
    //                     'name' => $product->name,
    //                     'slug' => $product->slug,
    //                     'featured_image' => $product->featured_image,
    //                     'price' => $item['price'],
    //                     'quantity' => $item['quantity'],
    //                     'fields' => $item['fields'],
    //                     'game_user_id' => $item['game_user_id'],
    //                     'game_server_id' => $item['game_server_id'],
    //                     'game_user_name' => $item['game_user_name'],
    //                     'game_email' => $item['game_email'],
    //                 ];
    //             }
    //         }
    //     }

    //     // Calculate total price
    //     $totalPrice = array_sum(array_map(function ($item) {
    //         return $item['price'] * $item['quantity'];
    //     }, $cartItems));

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Product added to cart',
    //         'cartItems' => $cartItems,
    //         'totalPrice' => number_format($totalPrice, 2),
    //         'cartCount' => count($cartItems),
    //     ]);
    // }
    public function addToCart(Request $request)
    {
        // dd($request->all());
        if (session()->has('bundle_plan')) {
            session()->forget('bundle_plan');
        }

        $productId = $request->product_id;
        $variantId = $request->variant_id;
        $attributeId = $request->attribute_id;
        $available_stock = $request->stock;

        // Check if product exists and has is_subscription = 0
        $product = \App\Models\Product::where('id', $productId)
            // ->where('is_subscription', 0)
            ->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found or not available for regular cart.',
            ], 400);
        }

        $proFields = ProductField::where('product_id', $productId)->get();
        $fields = [];
        foreach ($proFields as $fieldKey => $pf) {
            $field_object = Str::slug($pf->field_name);
            $fields[] = [$field_object => $request->fields[$field_object] ?? null];
        }

        $price = $request->price;
        $discount = $request->discount;
        $game_user_id = $request->game_user_id ?? null;
        $game_server_id = $request->game_server_id ?? null;
        $game_user_name = $request->game_user_name ?? null;
        $game_email = $request->game_email ?? null;
        
        $quantity = $request->quantity ?? 1;


        // if (Auth::check()) {
        //     // Cart::updateOrCreate(
        //     //     [
        //     //         'user_id' => Auth::id(),
        //     //         'game_user_id' => $game_user_id,
        //     //         'fields' => json_encode($fields),
        //     //         'product_id' => $productId,
        //     //     ],
        //     //     [
        //     //         'product_id' => $productId,
        //     //         'quantity' => $quantity,
        //     //         'price' => $price,
        //     //         'fields' => json_encode($fields),
        //     //         'game_user_id' => $game_user_id,
        //     //         'game_server_id' => $game_server_id,
        //     //         'game_user_name' => $game_user_name,
        //     //         'game_email' => $game_email,
        //     //     ]
        //     // );
        //     $cartItem = Cart::where('user_id', Auth::id())
        //         ->where('product_id', $productId)
        //         ->first();


        //     if ($cartItem) {
        //         // Increment quantity
        //         $cartItem->quantity += $quantity;
        //         $cartItem->price = $price; // update price if needed
        //         $cartItem->game_server_id = $game_server_id;
        //         $cartItem->game_user_name = $game_user_name;
        //         $cartItem->game_email = $game_email;
        //         $cartItem->save();
        //     } else {
        //         // Create new row
        //         Cart::create([
        //             'user_id' => Auth::id(),
        //             'product_id' => $productId,
        //             'variant_id' => $variantId,
        //             'attributes' => $attributeId,
        //             'quantity' => $quantity,
        //             'price' => $price,
        //             'discount' => $discount,
        //             'fields' => json_encode($fields),
        //             'game_user_id' => $game_user_id,
        //             'game_server_id' => $game_server_id,
        //             'game_user_name' => $game_user_name,
        //             'game_email' => $game_email,
        //         ]);
        //     }

        //     // Fetch cart items for authenticated user with is_subscription = 0
        //     $cartItems = Cart::where('user_id', Auth::id())
        //         ->with(['product' => function ($query) {
        //             $query->where('is_subscription', 0);
        //         }])
        //         ->whereHas('product', function ($query) {
        //             $query->where('is_subscription', 0);
        //         })
        //         ->get()
        //         ->map(function ($item) {
        //             // Fetch the first image_path from product_media
        //             $productMedia = ProductMedia::where('product_id', $item->product_id)->first();
        //             $image = $productMedia ? $productMedia->image_path : $item->product->featured_image;

        //             return [
        //                 'id' => $item->product_id,
        //                 'variant_id' => $item->variant_id,
        //                 'attributes' => $item->attributes,
        //                 'name' => $item->product->name,
        //                 'slug' => $item->product->slug,
        //                 'image' => $image,
        //                 'price' => $item->price,
        //                 'discount' => $item->discount,
        //                 'quantity' => $item->quantity,
        //                 'fields' => json_decode($item->fields, true),
        //                 'game_user_id' => $item->game_user_id,
        //                 'game_server_id' => $item->game_server_id,
        //                 'game_user_name' => $item->game_user_name,
        //                 'game_email' => $item->game_email,
        //             ];
        //         })->toArray();

                


        // } else {

            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {

                $cartItems = session()->get('cart');

                //if box has been selected from frontend
                if($request->box) // if box has been selected from frontend
                {
                    $boxInList = false;

                    foreach($cartItems as $key=>$cartIt)
                    {
                        foreach($cartIt as $cartItem)
                        {
                            if($cartItem['box'] == $request->box)
                            {
                                $boxInList = true;
                            }
                        }
                    }

                    foreach($cartItems as $key=>$cartItem)
                    {
                        $boxFound = false;
                        $numberOfBox = $request->box;
                        $cartItemKey;
                        $cartItemQuantity;
                        $cartItemNewQuantity;

                        if($cartItem[0]['type'] == "box")
                        {
                            foreach($cartItem as $key1=>$item)
                            {
                                if($numberOfBox == $item['box']&&$item['type']=="box")
                                {
                                    $boxFound = true;
                                    $cartItemKey = $key1;
                                    $cartItemQuantity = intval($item['quantity']);
                                    $cartItemNewQuantity = $cartItemQuantity+1; 
                                }
                            }
                            
                            if($boxFound)
                                {
                                    if($request->box == 1)
                                    {
                                        // $product->price;
                                        // $totalPrice =  $cartItemNewQuantity*$product->price;
                                        // $price = $product->price;

                                        $discount = $product->price*$product->discount/100;
                                        $productPrice = $product->price-$discount;
                                        $productPrice = number_format($productPrice, 2);
                                        $totalPrice = $cartItemNewQuantity*$productPrice;
                                        $price = $productPrice;
                                    }
                                    else if($request->box == 2)
                                    {
                                        $totalPrice = $cartItemNewQuantity*$product->box_price_2_discount;
                                        $price = $product->box_price_2_discount;
                                    }
                                    else if($request->box == 3)
                                    {
                                        $totalPrice = $cartItemNewQuantity*$product->box_price_3_discount;
                                        $price = $product->box_price_3_discount;
                                    }

                                    $cartListItem = [
                                        'product_id' => $productId,
                                        'variant_id' => $variantId,
                                        'attributes' => $attributeId,
                                        // 'quantity' => $cartItemNewQuantity,
                                        'price' => $price,
                                        'discount' => $discount,
                                        'fields' => $fields,
                                        'game_user_id' => $game_user_id,
                                        'game_server_id' => $game_server_id,
                                        'game_user_name' => $game_user_name,
                                        'game_email' => $game_email,
                                        'name'=>$product->name,
                                        'image'=>$product->media[0]->image_path ?? '',
                                        'quantity'=>$cartItemNewQuantity,
                                        'total_price'=>$totalPrice,
                                        'box'=>$request->box
                                    ];

                                    if($request->box)
                                    {
                                        $cartListItem['type'] =  'box';
                                    }
                                    else
                                    {
                                        $cartListItem['type'] =  'product';
                                    }

                                    $cartItems[$key][$cartItemKey]= $cartListItem;

                                }                     
                                else if(!$boxFound)
                                {         
                                    if($request->box == 1)
                                    {
                                        // $product->price;
                                        // $totalPrice = $request->quantity*$product->price;
                                        // $price = $product->price;

                                        $discount = $product->price*$product->discount/100;
                                        $productPrice = $product->price-$discount;
                                        $productPrice = number_format($productPrice, 2);
                                        $totalPrice = $request->quantity*$productPrice;
                                        $price = $productPrice;
                                    }
                                    else if($request->box == 2)
                                    {
                                        $totalPrice = $request->quantity*$product->box_price_2_discount;
                                        $price = $product->box_price_2_discount;
                                    }
                                    else if($request->box == 3)
                                    {
                                        $totalPrice = $request->quantity*$product->box_price_3_discount;
                                        $price = $product->box_price_3_discount;
                                    }

                                    $cartListItem = [
                                        'product_id' => $productId,
                                        'variant_id' => $variantId,
                                        'attributes' => $attributeId,
                                        'quantity' => $request->quantity,
                                        'price' => $price,
                                        'discount' => $discount,
                                        'fields' => $fields,
                                        'game_user_id' => $game_user_id,
                                        'game_server_id' => $game_server_id,
                                        'game_user_name' => $game_user_name,
                                        'game_email' => $game_email,
                                        'name'=>$product->name,
                                        'image'=>$product->media[0]->image_path ?? '',
                                        'quantity'=>$quantity,
                                        'total_price'=>$totalPrice,
                                        'box'=>$request->box,
                                        'type'=>'box'
                                    ];
                                    $cartItems[$key][]= $cartListItem;
                                }   
                            }

                            session()->put('cart', $cartItems);
                            session()->save();

                    $cart = session()->get('cart');  

                    $cartItems = [];
           
                    foreach ($cart as $id => $it) {
                        foreach($it as $item)
                        {
                            $product = Product::where('id', $id)
                            // ->where('is_subscription', 0)
                            ->first();
                            
                            if ($product) 
                                {
                                    $productMedia = ProductMedia::where('product_id', $id)->first();
                                    $image = $productMedia ? $productMedia->image_path : $product->featured_image;

                                    $cartItem = [
                                        'id' => $item['product_id'],
                                        'variant_id' => $item['variant_id'],
                                        'attributes' => $item['attributes'],
                                        'name' => $product->name,
                                        'slug' => $product->slug,
                                        'image' => $image,
                                        'price' => $item['price'],
                                        'discount' => $item['discount'],
                                        'quantity' => $item['quantity'],
                                        'fields' => $item['fields'],
                                        'game_user_id' => $item['game_user_id'],
                                        'game_server_id' => $item['game_server_id'],
                                        'game_user_name' => $item['game_user_name'],
                                        'game_email' => $item['game_email'],
                                        'type'=>$item['type'],
                                        'box'=>$item['box'],
                                        'total_price'=>$item['total_price']
                                    ];

                                $cartItems[] = $cartItem;
                            }
                        }
                    }

                    $totalPrice = array_sum(array_map(function ($item) {
                        if($item['type'] == 'box')
                        {
                            return $item['price'] * $item['quantity'];
                            // return $item['total_price'];
                        }
                        else
                        {
                            return $item['price'] * $item['quantity'];
                        }
                        
                    }, $cartItems));

                      return response()->json([
                            'success' => true,
                            'message' => 'Product added to cart',
                            'cartItems' => $cartItems,
                            // 'totalPrice' => number_format($totalPrice, 2),
                            'totalPrice' => number_format($totalPrice, 2),
                            'cartCount' => count($cartItems)
                            // 'cart'=>$cart
                        ]);

                        }
                } //if box
                else //
                {
                    $cart = session()->get('cart');  

                    $productFound = false;
                    $haveToAdd = true;
                    $itemQuantity;
                    $productKey;
                    $itemKey;
                    $productNotToAdd = [];

                    foreach($cart as $key=>$product)
                    {
                        if($key == $productId)
                        {
                            $productFound = true;

                            foreach($product as $item)
                            {
                                $itemQuantity = $item['quantity'];
                                $quantity = $itemQuantity+1; 
                                $productKey = $key;
                            }
                        }

                        if($product[0]['type'] == "box")
                        {
                            $productNotToAdd[] = $key;
                        }



                        // foreach($product as $p)
                        // {
                        //     if($p['type'] == "box")
                        //     {
                        //         $haveToAdd = false;
                        //     }
                        // }

                        // foreach($product as $subKey=>$item)
                        // {
                        //     if($item['product_id'] == $productId && $item['type'] == "product")
                        //     {
                        //         $productFound = true;
                        //         $itemQuantity = $item['quantity'];
                        //         $quantity = $itemQuantity+1; 
                        //         $productKey = $key;
                        //         $itemKey = $subKey;
                        //     }
                        // }
                    }

                    $product = Product::with('media')->where('id', $productId)
                    // ->where('is_subscription', 0)
                    ->first();

                    $totalPrice = $price*$quantity;

                    $cartListItem = [
                        'product_id' => $productId,
                        'variant_id' => $variantId,
                        'attributes' => $attributeId,
                        'quantity' => $quantity,
                        'price' => $price,
                        'discount' => $discount,
                        'fields' => $fields,
                        'game_user_id' => $game_user_id,
                        'game_server_id' => $game_server_id,
                        'game_user_name' => $game_user_name,
                        'game_email' => $game_email,
                        'name'=>$product->name,
                        'image'=>$product->media[0]->image_path ?? '',
                        'quantity'=>$quantity,
                        'total_price'=>$totalPrice,
                        'box'=>$request->box,
                        'type'=>'product'
                    ];

                    // $productInCart = false;
                    // foreach($cart as $key=>$cartItem)
                    // {
                    //     if($key == $productId)
                    //     {
                    //         $productInCart = true;
                    //     }
                    // }


                    if($productFound)
                    {
                        // if(!array_search($cartListItem['product_id'],$productNotToAdd))
                        // {
                            $cart[$productKey][0] = $cartListItem;
                        // }
                        // else
                        // {
                            

                        // }
                    }
                    else
                    {
                        // $searchProductInList = array_search($productId,$productNotToAdd);
                        // if($searchProductInList)
                        // {
                            $cart[$productId][] = $cartListItem;
                        // }   
                    }

                    session()->put('cart', $cart);
                    session()->save();

                    $cart = session()->get('cart');  

                    $cartItems = [];
           
                    foreach ($cart as $id => $it) {
                        foreach($it as $item)
                        {
                            $product = Product::where('id', $id)
                            // ->where('is_subscription', 0)
                            ->first();
                            
                            if ($product) 
                                {
                                    $productMedia = ProductMedia::where('product_id', $id)->first();
                                    $image = $productMedia ? $productMedia->image_path : $product->featured_image;

                                    $cartItem = [
                                        'id' => $item['product_id'],
                                        'variant_id' => $item['variant_id'],
                                        'attributes' => $item['attributes'],
                                        'name' => $product->name,
                                        'slug' => $product->slug,
                                        'image' => $image,
                                        'price' => $item['price'],
                                        'discount' => $item['discount'],
                                        'quantity' => $item['quantity'],
                                        'fields' => $item['fields'],
                                        'game_user_id' => $item['game_user_id'],
                                        'game_server_id' => $item['game_server_id'],
                                        'game_user_name' => $item['game_user_name'],
                                        'game_email' => $item['game_email'],
                                        'type'=>$item['type'],
                                        'box'=>$item['box'],
                                        'total_price'=>$item['total_price']
                                    ];

                                $cartItems[] = $cartItem;
                            }
                        }
                    }

                    $totalPrice = array_sum(array_map(function ($item) {
                        if($item['type'] == 'box')
                        {
                            // return $item['total_price'];
                            return $item['price'] * $item['quantity'];
                        }
                        else
                        {
                            return $item['price'] * $item['quantity'];
                        }
                        
                    }, $cartItems));

                      return response()->json([
                            'success' => true,
                            'message' => 'Product added to cart',
                            'cartItems' => $cartItems,
                            // 'totalPrice' => number_format($totalPrice, 2),
                            'totalPrice' => number_format($totalPrice, 2),
                            'cartCount' => count($cartItems)
                            // 'cart'=>$cart
                        ]);

                }

                // $cart[$productId]['quantity'] += $quantity;

                //   $product = Product::with('media')->where('id', $productId)
                //     // ->where('is_subscription', 0)
                //     ->first();

                //total price will be change at boxes
                // $totalPrice; 
                // if($request->box)
                // {
                //     if($request->box == 1)
                //     {
                //         $product->price;
                //         $totalPrice = $request->quantity*$product->price;
                //         $price = $totalPrice;
                //     }
                //     else if($request->box == 2)
                //     {
                //         $totalPrice = $request->quantity*$product->box_price_2_discount;
                //         $price = $totalPrice;
                //     }
                //     else if($request->box == 3)
                //     {
                //         $totalPrice = $request->quantity*$product->box_price_3_discount;
                //         $price = $totalPrice;
                //     }
                // }
                // else
                // {
                //     $totalPrice = $price*$quantity;
                // }
                //total price will be change at boxes


                // if($request->box) // if box has been selected from frontend
                // {
                //     foreach($cartItems as $key=>$cartItem)
                //     {
                //         $numberOfBox = $request->box;
                //         if($cartItem['box'] == $numberOfBox)
                //         {
                //         }
                //         else
                //         {
                //             $cartListItem = [
                //                 'product_id' => $productId,
                //                 'variant_id' => $variantId,
                //                 'attributes' => $attributeId,
                //                 'quantity' => $quantity,
                //                 'price' => $price,
                //                 'discount' => $discount,
                //                 'fields' => $fields,
                //                 'game_user_id' => $game_user_id,
                //                 'game_server_id' => $game_server_id,
                //                 'game_user_name' => $game_user_name,
                //                 'game_email' => $game_email,
                //                 'name'=>$product->name,
                //                 'image'=>$product->media[0]->image_path ?? '',
                //                 'quantity'=>$quantity,
                //                 'total_price'=>$totalPrice,
                //                 'box'=>$request->box
                //             ];

                //              if($request->box)
                //             {
                //                 $cartListItem['type'] =  'box';
                //             }
                //             else
                //             {
                //                 $cartListItem['type'] =  'product';
                //             }

                //              $cart[$productId][] = $cartListItem;

                            
                //         }
                //     }
                // }


                //  $cart[$productId] = [
                //                 'product_id' => $productId,
                //                 'variant_id' => $variantId,
                //                 'attributes' => $attributeId,
                //                 'quantity' => $quantity,
                //                 'price' => $price,
                //                 'discount' => $discount,
                //                 'fields' => $fields,
                //                 'game_user_id' => $game_user_id,
                //                 'game_server_id' => $game_server_id,
                //                 'game_user_name' => $game_user_name,
                //                 'game_email' => $game_email,
                //                 'name'=>$product->name,
                //                 'image'=>$product->media[0]->image_path ?? '',
                //                 'quantity'=>$quantity,
                //                 'total_price'=>$totalPrice,
                //                 'box'=>$request->box
                //             ];

                // if($request->box)
                // {
                //     $cart[$productId]['type'] =  'box';
                // }
                // else
                // {
                //     $cart[$productId]['type'] =  'product';
                // }

            } else { //if product is not in list

                $cart = session()->get('cart');  

                $product = Product::with('media')->where('id', $productId)
                    // ->where('is_subscription', 0)
                    ->first();

                $totalPrice; 

                if($request->box)
                {
                    if($request->box == 1)
                    {
                        $discount = $product->price*$product->discount/100;
                        $productPrice = $product->price-$discount;
                        $productPrice = number_format($productPrice, 2);
                        $totalPrice = $request->quantity*$productPrice;
                        $price = $totalPrice;
                    }
                    else if($request->box == 2)
                    {
                        $totalPrice = $request->quantity*$product->box_price_2_discount;
                        $price = $totalPrice;
                    }
                    else if($request->box == 3)
                    {
                        $totalPrice = $request->quantity*$product->box_price_3_discount;
                        $price = $totalPrice;
                    }
                }
                else
                {
                    $totalPrice = $price*$quantity;
                }

                $cartListItem = [
                    'product_id' => $productId,
                    'variant_id' => $variantId,
                    'attributes' => $attributeId,
                    'quantity' => $quantity,
                    'price' => $price,
                    'discount' => $discount,
                    'fields' => $fields,
                    'game_user_id' => $game_user_id,
                    'game_server_id' => $game_server_id,
                    'game_user_name' => $game_user_name,
                    'game_email' => $game_email,
                    'name'=>$product->name,
                    'image'=>$product->media[0]->image_path ?? '',
                    'quantity'=>$quantity,
                    'total_price'=>$totalPrice,
                    'box'=>$request->box
                ];

                if($request->box)
                {
                    $cartListItem['type'] =  'box';
                }
                else
                {
                    $cartListItem['type'] =  'product';
                }
                
                // $cart = $cartListItem;

                $cart[$productId][] = $cartListItem;
   
                session()->put('cart', $cart);
                session()->save();

            }

          
    

            // Fetch product details for guest cart with is_subscription = 0
            $cartItems = [];
            foreach ($cart as $id => $it) {
                foreach($it as $item)
                {
                    $product = Product::where('id', $id)
                    // ->where('is_subscription', 0)
                    ->first();
                if ($product) {
                    $productMedia = ProductMedia::where('product_id', $id)->first();
                    $image = $productMedia ? $productMedia->image_path : $product->featured_image;

                    $cartItem = [
                        'id' => $item['product_id'],
                        'variant_id' => $item['variant_id'],
                        'attributes' => $item['attributes'],
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'image' => $image,
                        'price' => number_format($item['price'],2),
                        'discount' => $item['discount'],
                        'quantity' => $item['quantity'],
                        'fields' => $item['fields'],
                        'game_user_id' => $item['game_user_id'],
                        'game_server_id' => $item['game_server_id'],
                        'game_user_name' => $item['game_user_name'],
                        'game_email' => $item['game_email'],
                        'type'=>$item['type'],
                        'box'=>$item['box']
                    ];

                    //  if($item['type']=='box')
                    // {
                    //     if($item['quantity'] == 1)
                    //     {
                    //         $cartItem['price'] = $product->price; 
                    //     }
                    //     else if($item['quantity'] == 2)
                    //     {
                    //         $cartItem['price'] = $product->box_price_2_discount; 
                    //     }
                    //     else if($item['quantity'] == 3)
                    //     {
                    //         $cartItem['price'] = $product->box_price_3_discount;
                    //     }
                        
                    // }

                    $cartItems[] = $cartItem; 
                }   

                }
            }
        // }

        // Calculate total price
        $totalPrice = array_sum(array_map(function ($item) {
            if($item['type'] == 'box')
            {
                return $item['price'];
            }
            else
            {
                return $item['price'] * $item['quantity'];
            }
            
        }, $cartItems));

        $freeShipping = AppSetting::where('variable','free_shipping')->first();
        $freeShippingAmount = $freeShipping->value;


        return response()->json([
            'success' => true,
            'message' => 'Product added to cart',
            'cartItems' => $cartItems,
            // 'totalPrice' => number_format($totalPrice, 2),
            'totalPrice' => number_format($totalPrice, 2),
            'cartCount' => count($cartItems)
            // 'cart'=>$cart
        ]);
    }

    public function addBundleToCart(Request $request)
    {
        // dd($request->all());
        $old_cart = Cart::where('user_id', Auth::id())->get();
        if (count($old_cart) > 0) {
            foreach ($old_cart as $o_item) {
                $o_item->delete();
            }
        }

        $selectedProducts = $request->input('products');
        $plan = $request->plan; // ['name' => ..., 'price' => ...]
        $gameUserId = $request->input('game_user_id');
        $gameServerId = $request->input('game_server_id');
        $gameUserName = $request->input('game_user_name');
        $gameEmail = $request->input('game_email');

        // dd($selectedProducts);

        $cartItems = [];

        foreach ($selectedProducts as $product) {
            // Check if product exists and has is_subscription = 1
            $dbProduct = \App\Models\Product::where('id', $product['id'])
                ->where('is_subscription', 1)
                ->first();

            if (!$dbProduct) {
                continue; // Skip products that don't exist or have is_subscription != 1
            }

            $fields = []; // Fill this if capturing dynamic product fields

            $cartItems[] = [
                'product_id' => $product['id'],
                'price' => $product['price'],
                'attributes' => isset($product['attributes']) ? $product['attributes'] : [],
                'addon_price' => (float)($product['addonPrice'] ?? 0),
                'fields' => json_encode($fields),
                'game_user_id' => $gameUserId,
                'game_server_id' => $gameServerId,
                'game_user_name' => $gameUserName,
                'game_email' => $gameEmail,
                'quantity' => 1,
                'is_subscription' => 1,
            ];
        }

        if (empty($cartItems)) {
            return response()->json([
                'success' => false,
                'message' => 'No valid subscription products found to add to bundle cart.',
            ], 400);
        }

        if (Auth::check()) {
            foreach ($cartItems as $item) {
                Cart::create(array_merge([
                    'user_id' => Auth::id(),
                ], $item));
            }
        } else {
            $sessionCart = session()->get('cart', []);
            foreach ($cartItems as $index => $item) {
                $key = 'bundle_' . time() . '_' . $index;
                $sessionCart[$key] = $item;
            }
            session()->put('cart', $sessionCart);
        }

        session(['bundle_plan' => $plan]);

        return response()->json([
            'success' => true,
            'message' => 'Bundle added to cart.',
            'cart_count' => $this->getCartCount(),
        ]);
    }


    public function getCartCount()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())
                ->whereHas('product', function ($query) {
                    $query->where('is_subscription', 0);
                })
                ->count();
        } else {
            $sessionCart = session('cart', []);
            $count = 0;

            foreach ($sessionCart as $item) {
                $product = \App\Models\Product::where('id', $item['product_id'])
                    ->where('is_subscription', 0)
                    ->first();
                if ($product) {
                    $count++;
                }
            }

            return $count;
        }
    }

    public function showCart()
    {
        $cartItems1 = session()->get('cart');
        $cartItems = [];
        $total = 0;

        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())
                ->with(['product' => function ($query) {
                    $query->where('is_subscription', 0);
                }])
                ->whereHas('product', function ($query) {
                    $query->where('is_subscription', 0);
                })
                ->get();

            foreach ($cartItems as $item) {
                $total += $item->quantity * $item->price;
            }
        } else {
            $sessionCart = session('cart', []);
            foreach ($sessionCart as $items) {
                foreach($items as $item)
                {
                    $product = \App\Models\Product::where('id', $item['product_id'])
                    ->where('is_subscription', 0)
                    ->first();

                    if ($product) 
                    {
                        $subtotal = $item['quantity'] * $item['price'];
                        $total += $subtotal;

                        $cartItems[] = (object) [
                            'product' => $product,
                            'quantity' => $item['quantity'],
                            'attributes' => $item['attributes'],
                            'price' => $item['price'],
                            'game_user_id' => $item['game_user_id'] ?? null,
                            'game_server_id' => $item['game_server_id'] ?? null,
                            'game_user_name' => $item['game_user_name'] ?? null,
                            'game_email' => $item['game_email'] ?? null,
                        ];
                    }
                }
            }
        }

        $subTotal = 0;
        $grandTotal = 0;
        
        if(!empty($cartItems1))
        {
            foreach($cartItems1 as $key=>$cartItems)
            {
                foreach($cartItems as $cartItem)
                {
                    $subTotal += $cartItem['total_price'];
                    $grandTotal += $cartItem['total_price'];
                }
            }
        }       

        return view('front.cart', compact('cartItems', 'total','cartItems1','subTotal','grandTotal'));
    }

    public function update(Request $request)
    {
        foreach ($request->items as $item) {
            if ($item['is_model'] === 'true') {
                $cartItem = \App\Models\Cart::where('product_id', $item['product_id'])
                    ->first();

                if ($cartItem) {
                    $cartItem->quantity = $item['quantity'];
                    $cartItem->save();
                }
            } else {
                $cart = session()->get('cart', []);
                foreach ($cart as &$cartRow) {
                    if ($cartRow['product_id'] == $item['product_id']) {
                        $cartRow['quantity'] = $item['quantity'];
                    }
                }
                session()->put('cart', $cart);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully.'
        ]);
    }

    // public function remove(Request $request)
    // {
    //     $productId = $request->product_id;
    //     $isModel = $request->is_model === "true";
    //     if (Auth::check()) {
    //         \App\Models\Cart::where('product_id', $productId)
    //             ->where('user_id', auth()->id())
    //             ->delete();
    //     } else {
    //         $cart = session()->get('cart', []);
    //         foreach ($cart as $key => $item) {
    //             if ($item['product_id'] == $productId) {
    //                 unset($cart[$key]);
    //                 break;
    //             }
    //         }
    //         session()->put('cart', $cart);
    //     }

    //     return response()->json(['message' => 'Item removed from cart successfully.']);
    // }
    public function remove(Request $request)
    {
        // Validate input
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            // 'is_model' => 'boolean',
        ]);

        $productId = $request->product_id;
        $isModel = $request->boolean('is_model', false); // Safely cast to boolean

        if (Auth::check()) {
            // Remove cart item for authenticated user
            \App\Models\Cart::where('product_id', $productId)
                ->where('user_id', auth()->id())
                ->delete();

            // Fetch updated cart items for authenticated user
            $cartItems = \App\Models\Cart::where('user_id', Auth::id())
                ->with('product')
                ->get()
                ->map(function ($item) {
                    // Fetch the first image_path from product_media
                    $productMedia = \App\Models\ProductMedia::where('product_id', $item->product_id)->first();
                    $image = $productMedia ? $productMedia->image_path : $item->product->featured_image;

                    return [
                        'id' => $item->product_id,
                        'name' => $item->product->name,
                        'slug' => $item->product->slug,
                        'image' => $image, // Use image instead of featured_image, matching addToCart
                        'price' => floatval($item->price), // Ensure numeric format
                        'quantity' => (int) $item->quantity, // Ensure integer
                        'fields' => json_decode($item->fields, true) ?? [],
                        'game_user_id' => $item->game_user_id,
                        'game_server_id' => $item->game_server_id,
                        'game_user_name' => $item->game_user_name,
                        'game_email' => $item->game_email,
                    ];
                })->toArray();
        } else {
            // Remove cart item for guest user
            $cart = session()->get('cart', []);
            foreach ($cart as $key => $item) {
                if ($item['product_id'] == $productId) {
                    unset($cart[$key]);
                    break;
                }
            }
            session()->put('cart', array_values($cart)); // Reindex array to avoid JSON issues

            // Fetch updated cart items for guest user
            $cartItems = [];
            foreach ($cart as $item) {
                $product = \App\Models\Product::find($item['product_id']);
                if ($product) {
                    // Fetch the first image_path from product_media
                    $productMedia = \App\Models\ProductMedia::where('product_id', $item['product_id'])->first();
                    $image = $productMedia ? $productMedia->image_path : $product->featured_image;

                    $cartItems[] = [
                        'id' => $item['product_id'],
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'image' => $image, // Use image instead of featured_image, matching addToCart
                        'price' => floatval($item['price']), // Ensure numeric format
                        'quantity' => (int) $item['quantity'], // Ensure integer
                        'fields' => $item['fields'] ?? [],
                        'game_user_id' => $item['game_user_id'],
                        'game_server_id' => $item['game_server_id'],
                        'game_user_name' => $item['game_user_name'],
                        'game_email' => $item['game_email'],
                    ];
                }
            }
        }

        // Calculate total price
        $totalPrice = array_sum(array_map(function ($item) {
            return floatval($item['price']) * (int) $item['quantity'];
        }, $cartItems));

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart successfully.',
            'cartItems' => array_values($cartItems), // Ensure consistent array indexing
            'totalPrice' => number_format($totalPrice, 2, '.', ''), // e.g., "100.00"
            'cartCount' => count($cartItems),
        ], 200);
    }
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'total' => 'required|numeric'
        ]);

        $user = auth()->user();

        $coupon = Coupon::where('code', strtoupper($request->code))->where('status','active')->first();
        $cart_items = Cart::where('user_id', auth()->id())->get();

        

        if (!$coupon) {
            return response()->json(['error' => 'Invalid coupon code.']);
        }

        if (!$coupon->canBeUsed()) {
            return response()->json(['error' => 'This coupon cannot be used.']);
        }


        //if (!$coupon->isApplicable($cart_items)) {
          //  return response()->json(['error' => 'This coupon is not applicable.']);
       // }

        if ($request->total < $coupon->min_amount) {
            return response()->json(['error' => 'Minimum amount required for this coupon is ' . number_format($coupon->min_amount, 2)]);
        }

        if ($user) {
            if (!$coupon->hasUserExceededUsageLimit($user->id)) {
                return response()->json(['error' => 'Limit exceeded for this coupon.']);
            }
        }

        $discount = $coupon->calculateDiscount($request->total);

        // dd($discount);
        $shippingPrice = AppSetting::where('variable','shipping_price')->first();
        $shippingPrice = $shippingPrice->value;

        $freeShippingPrice = AppSetting::where('variable','free_shipping')->first();
        $freeShippingPrice = $freeShippingPrice->value;

        if($request->total >= $freeShippingPrice)
        {
            $shippingPrice = 0;
        }
        

        return response()->json([
            
            'success' => true,
            'coupon_code' => $coupon->code,
            'coupon_id' => $coupon->id,
            'discount' => $discount,
            'formatted' => '-' . number_format($discount, 2),
            'new_total' => round($request->total - $discount + $shippingPrice, 2),
            'discount_type' => $coupon->type,
            'discount_value' => $coupon->value,
            'description' => $coupon->type === 'percentage' ? $coupon->value . '% OFF' : config('app.currency') . ' ' . $coupon->value . ' OFF' // Optional: Add description from backend
        ]);
    }
    // public function checkout(Request $request)
    // {
    //     $cartItems = Cart::where('user_id',auth()->id())->get();
    //     $order = Order::create([
    //         'user_id' => auth()->id(),
    //         'total' => $cartItems->sum(fn ($item) => $item->price * $item->quantity)
    //     ]);

    //     foreach ($cartItems as $item) {
    //         OrderItem::create([
    //             'order_id' => $order->id,
    //             'product_id' => $item->product_id,
    //             'variant_id' => $item->product_variant_id,
    //             'price' => $item->price,
    //             'quantity' => $item->quantity,
    //         ]);
    //     }

    //     Cart::truncate();

    //     return redirect()->route('order.success')->with('success', 'Order placed successfully!');
    // }


}
