<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\State;
use App\Models\Ticket;
use App\Models\Product;
use App\Models\Category;
use App\Mail\RegisterMail;
use App\Models\HomeSlider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductBundle;
use App\Models\MonthlyProduct;
use App\Models\ProductVariant;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\UserSubscriptionDetail;
use App\Models\AppSetting;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $freeShipping = AppSetting::where('variable','free_shipping')->first();
        view()->share('freeShippingPrice', $freeShipping->value);
    }

    
    public function index()
    {
        $products = Product::latest()->take(15)->get();
        // $products = Product::latest()->take(15)->get();

//         $featured_products = Product::whereDoesntHave('media', function ($query) {
//     $query->whereNull('image_path')       // exclude null
//           ->orWhere('image_path', '');    // exclude empty string
// })->where('is_featured', 1)->latest()->take(15)->get();

        $featured_products = Product::where('is_featured', 1)->latest()->take(15)->get();

        $homeSliders = HomeSlider::orderBy('created_at', 'DESC')->get();
        $categories = Category::take(3)->get();
        $carts = session()->get('cart');

        // foreach($carts as $key=>$cart)
        // {
        //     echo $cart;
        // }

        // exit;

        // $freeShipping = AppSetting::where('variable','free_shipping')->first();
        // $freeShippingPrice = $freeShipping->value;
        
        return view('front.home', compact('products', 'featured_products', 'homeSliders', 'categories','carts')); 
    }
    public function about()
    {
        return view('front.about');
    }
    // public function shop(Request $request)
    // {
    //     $search = $request->query('search');
    //     $minPrice = $request->query('minPrice');
    //     $maxPrice = $request->query('maxPrice');
    //     $categorySlug = $request->query('category');

    //     // Initialize the product query
    //     $productsQuery = Product::query();

    //     // Apply filters through ProductVariant if price or search filters are active
    //     $hasFilters = $search || (!is_null($minPrice) && !is_null($maxPrice) && $minPrice !== '' && $maxPrice !== '');

    //     if ($hasFilters) {
    //         $variantQuery = ProductVariant::query();

    //         // Apply price range filter
    //         if (!is_null($minPrice) && !is_null($maxPrice) && $minPrice !== '' && $maxPrice !== '') {
    //             $minPrice = (float)$minPrice;
    //             $maxPrice = (float)$maxPrice;
    //             // Ensure valid range
    //             $variantQuery->whereBetween('price', [$minPrice <= $maxPrice ? $minPrice : $maxPrice, $minPrice <= $maxPrice ? $maxPrice : $minPrice]);
    //         }

    //         // Apply search filter
    //         if ($search) {
    //             $variantQuery->whereHas('product', function ($q) use ($search) {
    //                 $q->where('name', 'like', '%' . $search . '%');
    //             });
    //         }

    //         // Get unique product IDs from filtered variants
    //         $productIds = $variantQuery->pluck('product_id')->unique();
    //         // Apply product IDs filter
    //         if ($productIds->isNotEmpty()) {
    //             $productsQuery->whereIn('id', $productIds);
    //         } else {
    //             // If no variants match, return no products
    //             $productsQuery->whereRaw('0 = 1');
    //         }
    //     }

    //     // Apply category filter
    //     if ($categorySlug) {
    //         $category = Category::where('slug', $categorySlug)->first();
    //         if ($category) {
    //             $productsQuery->where('category_id', $category->id);
    //         } else {
    //             $productsQuery->whereRaw('0 = 1');
    //         }
    //     }

    //     // Paginate results, preserving query parameters
    //     $products = $productsQuery->paginate(12)->appends($request->query());

    //     // Get categories and price range for the view
    //     $categories = Category::withCount('products')
    //         ->orderBy('products_count', 'desc')
    //         ->get();

    //     $minPrice = ProductVariant::min('price') ?? 0;
    //     $maxPrice = ProductVariant::max('price') ?? 1000;

    //     return view('front.shop', compact('products', 'categories', 'minPrice', 'maxPrice'));
    // }

    public function shop(Request $request)
    {
        $sessionKeys = array_filter(array_keys(session()->all()), function($key) {
            return str_starts_with($key, 'checkout_data_');
        });
        // Forget all matching sessions
        foreach ($sessionKeys as $key) {
            session()->forget($key);
        }
        session()->forget('subscriptionData');

        $search = $request->query('search');
        $minPrice = $request->query('minPrice');
        $maxPrice = $request->query('maxPrice');
        $categorySlug = $request->query('category');

        // Initialize the product query
        $productsQuery = Product::query();

        // Apply filters directly on products table if price or search filters are active
        $hasFilters = $search || (!is_null($minPrice) && !is_null($maxPrice) && $minPrice !== '' && $maxPrice !== '');

        if ($hasFilters) {
            // Apply price range filter on products.price
            if (!is_null($minPrice) && !is_null($maxPrice) && $minPrice !== '' && $maxPrice !== '') {
                $minPrice = (float)$minPrice;
                $maxPrice = (float)$maxPrice;
                // Ensure valid range
                $productsQuery->whereBetween('price', [$minPrice <= $maxPrice ? $minPrice : $maxPrice, $minPrice <= $maxPrice ? $maxPrice : $minPrice]);
            }

            // Apply search filter on products.name
            if ($search) {
                $productsQuery->where('name', 'like', '%' . $search . '%');
            }
        }

        // Apply category filter
        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $productsQuery->where('category_id', $category->id);
            } else {
                $productsQuery->whereRaw('0 = 1');
            }
        }

        // Paginate results, preserving query parameters
        // $products = $productsQuery->where('status', 'active')->where('is_subscription', 0)->where('is_e_ticket', 0)->paginate(12)->appends($request->query());
        $products = Product::latest()->take(15)->get();
        // $products = Product::latest()->paginate(15);

        // Get categories and price range for the view
        // $categories = Category::withCount('products')
        //     ->orderBy('products_count', 'desc')
        //     ->get();

        $categories = Category::withCount('products')
            ->with(['children' => function ($q) {
                $q->withCount('products')->orderBy('products_count', 'desc');
            }])
            ->whereNull('parent_id') // only parent categories
            ->orderBy('products_count', 'desc')
            ->get();

        // Update price range to use products.price instead of product_variants.price
        $minPrice = Product::min('price') ?? 0;
        $maxPrice = Product::max('price') ?? 1000;

        $freeShipping = AppSetting::where('variable','free_shipping')->first();
        $freeShippingPrice = $freeShipping->value;

        return view('front.shop', compact('products', 'categories', 'minPrice', 'maxPrice','freeShippingPrice'));
    }
    public function category($unique_id, $slug)
    {
        $current_category = Category::where('slug', $slug)
            ->where('unique_id', $unique_id)
            ->first();

        if (!$current_category) {
            return redirect()->back()->with('error', 'Category not found');
        }

        $query = Product::query();

        $query->where('status', 'active')
            ->where('is_subscription', 0)
            ->whereJsonContains('category_ids', (string) $current_category->id);

        $products = $query->paginate(12);

        $categories = Category::get()->map(function ($category) {
            $category->products_count = Product::where('status', 'active')
                ->whereJsonContains('category_ids', (string) $category->id)->where('is_subscription', 0)
                ->count();
            return $category;
        })->sortByDesc('products_count');

        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        return view('front.category', compact(
            'products',
            'categories',
            'minPrice',
            'maxPrice',
            'current_category'
        ));
    }

    public function monthly_products_page($month)
    {
        $month_of = date("n", strtotime($month));
        $products = MonthlyProduct::where('month_of', $month_of)->first();
        return view('front.monthly-products-page', compact('products', 'month'));
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function cart()
    {
        return view('front.cart', $data);
    }

    public function subscribePetit()
    {
        // $tickets = Ticket::where('status', 1)->get();
        $tickets = Product::where([['status', 1], ['is_e_ticket', 1]])->get();
        // $products = Product::whereNotNull('featured_image')->where('is_subscription', 1)->latest()->take(15)->get();
        $bundle = ProductBundle::where('month_of', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->first();
        return view('front.subscribe-petit', compact('bundle', 'tickets'));
    }

    public function subscriberForm()
    {
        $products = Product::whereNotNull('featured_image')->latest()->take(15)->get();
        return view('front.subscriber-form')->with('product_lists', $products);
    }

    public function saveSubscriberForm(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();

            $user = User::findOrFail(Auth::user()->id);
            $user->subscription_status = 1;
            $user->address = isset($data['address']) ? $data['address'] : null;
            $user->towncity = isset($data['customer_city']) ? $data['customer_city'] : null;
            $user->state = isset($data['customer_state']) ? $data['customer_state'] : null;
            $user->postal_code = isset($data['postal_code']) ? $data['postal_code'] : null;
            $user->save();

            $transformedData = [
                'user_id' => Auth::id(),
                'race' => $data['race'],
                'is_first_time_mother' => $data['firstTime'],
                'child_dobs' => isset($data['childrenDates']) ? json_encode($data['childrenDates']) : null, // Store array as JSON
                'date_of_birth' => $data['dob'],
                'is_currently_pregnant' => (
                    (isset($data['pregnant_first'])) ||
                    (isset($data['pregnant_not_first']))
                ) ? 1 : 0,
                'expected_due_date' => isset($data['dueDate_first'])
                    ? ($data['dueDate_first'] ?? null)
                    : ($data['dueDate_not_first'] ?? null),
                'number_of_children' => $data['numChildren'] ?? 0
            ];

            // Now save with the transformed data
            UserSubscriptionDetail::create($transformedData);

            DB::commit();

            try {
                Mail::to($user->email)->send(
                    new \App\Mail\NewSubscriberMail($user)
                );
            } catch (\Exception $mailException) {
                Log::error("New subscriber email failed: " . $mailException->getMessage());
            }

            return response()->json(['message' => 'Form submitted successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to submit form.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateSubscriberForm(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            // Update user table fields
            $user->address = $request->input('address');
            $user->towncity = $request->input('customer_city');
            $user->state = $request->input('customer_state');
            $user->postal_code = $request->input('postal_code');
            $user->save();

            // Prepare subscription data
            $subscriptionData = [
                'race' => $request->input('race'),
                'is_first_time_mother' => $request->input('is_first_time_mother', 0),
                'child_dobs' => $request->has('child_dobs') ? json_encode($request->child_dobs) : null,
                'date_of_birth' => $request->input('date_of_birth'),
                'is_currently_pregnant' => $request->input('is_currently_pregnant', 0),
                'expected_due_date' => $request->input('expected_due_date'),
                'number_of_children' => $request->input('number_of_children', 0),
            ];

            // Update or create subscription detail
            UserSubscriptionDetail::updateOrCreate(
                ['user_id' => $user->id],
                $subscriptionData
            );

            DB::commit();

            return redirect()->back()->with('success', 'Form updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to update form: ' . $e->getMessage());
        }
    }


    public function chooseProducts(Request $request)
    {
        if (session()->has('bundle_plan')) {
            session()->forget('on_hold');
        }

        $user_id = Auth::user()->id;
        $user = Auth::user();
        // $lastSubscription = Order::where('type', 1)
        //     ->where('user_id', $user->id)
        //     ->latest()
        //     ->first();
        // // return 's';
        // if ($lastSubscription) {
        //     if ($lastSubscription->status === 'cancelled') {
        //         return redirect()->route('choose-products')->with('error', 'Please resubscribe to choose products.');
        //     } elseif ($lastSubscription->on_hold) {
        //         return redirect()->route('choose-products')->with('error', 'Your subscription is on hold due to failed payment. Please reactivate.');
        //     } elseif (!$lastSubscription->isFormFilled()) {
        //         return redirect()->route('choose-products')->with('error', 'Please fill out the form to receive related products.');
        //     }
        // }
        if ($user_id && $user->is_subscription == 1) {
            $lastSubscription = Order::select('created_at')
                ->where('type', 1) // Assuming 1 = subscription
                ->where('user_id', $user_id)
                ->latest()
                ->first();

            if ($lastSubscription) {
                $createdAt = Carbon::parse($lastSubscription->created_at);
                $now = Carbon::now();

                $daysPassed = $createdAt->diffInDays($now);
                $daysLeft = 30 - $daysPassed;

                if ($daysLeft > 0) {
                    return redirect()->back()
                        ->with('error', "You can place your next subscription order in {$daysLeft} day(s).");
                }
            }
        }

        // $categories = Category::where('status', 1)->whereNull('parent_id')->whereHas('products')->get();
        // $categories = Category::where('status', 1)->whereNull('parent_id')->get();
        $plans = SubscriptionPlan::where('status', 1)->orderBy('id', 'desc')->get();
        // $products = Product::where('status','active')->where('is_affiliate', 0)->get();
        $bundle = ProductBundle::where('month_of', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->first();

            $categoryIds = $bundle->getProducts()
                ->pluck('category_ids')
                ->flatten()
                ->unique()
                ->values()
                ->all();

            json_encode($categoryIds);

            $categories = Category::where('status', 1)
                ->whereNull('parent_id')
                ->whereIn('id', $categoryIds)
                ->get();

        if (empty($bundle)) {
            return redirect()->back()
                ->with('error', 'Admin has not added a bundle. Stay tuned!');
        }

        return view('front.choose-products', compact('categories', 'bundle', 'plans'));
    }

    public function chooseNextMonthProducts(Request $request)
    {
        $user_id = Auth::user()->id;
        session()->put('on_hold', 1);
        $user = Auth::user();
        $lastSubscription = Order::where('type', 1)
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        if (!$lastSubscription || $lastSubscription->status === 'cancelled') {
            return redirect()->route('choose-products')->with('error', 'Please resubscribe to choose products.');
        } elseif ($lastSubscription->on_hold) {
            return redirect()->route('choose-products')->with('error', 'Your subscription is on hold due to failed payment. Please reactivate.');
        } elseif (!$lastSubscription->isFormFilled()) {
            return redirect()->route('choose-products')->with('error', 'Please fill out the form to receive related products.');
        }
        $bundle = ProductBundle::where('month_of', Carbon::now()->addMonth()->month)->whereYear('created_at', Carbon::now()->addMonth()->year)->first();

        if (!$bundle) {
            return redirect()->back()->with('error', 'Admin has not made a bundle for next month yet. stay tunes!');
        }

        $categoryIds = $bundle->getProducts()
                ->pluck('category_ids')
                ->flatten()
                ->unique()
                ->values()
                ->all();

            json_encode($categoryIds);

            $categories = Category::where('status', 1)
                ->whereNull('parent_id')
                ->whereIn('id', $categoryIds)
                ->get();

        $categories = Category::where('status', 1)->get();
        $plans = SubscriptionPlan::where('status', 1)->get();
        return view('front.choose-products', compact('categories', 'bundle', 'plans'));
    }
    public function terms_conditions()
    {
        return view('front.terms_conditions');
    }

    public function minusQuantity(Request $request)
    {
        $request->product_id;

        $cartItems = session()->get('cart');
        $newQuantity;

        $totalPrice = 0;
        $productTotalPrice = 0;
        $boxId = '';

        if($request->type=="box")
        {
            foreach($cartItems as $key=>$cartItem)
            {
                if($request->product_id == $key)
                {
                    // $cartItems[$key]['quantity'] = $request->quantity;
                    // $newQuantity = $request->quantity;
                    // $cartItems[$key]['total_price'] = $request->quantity*$cartItems[$key]['price'];
                    // $productTotalPrice = $request->quantity*$cartItems[$key]['price'];
                    foreach($cartItem as $subKey=>$carItem)
                    {
                        if($carItem['box'] == $request->box_id)
                        {
                            $cartItems[$key][$subKey]['quantity'] = $request->quantity;
                            $newQuantity = $request->quantity;
                            $cartItems[$key][$subKey]['total_price'] = intval($request->quantity)*$carItem['price'];
                            $boxId = $carItem['box'];
                            $productTotalPrice = intval($request->quantity)*$carItem['price'];
                            // $productTotalPrice = $request->quantity*$carItem['price'];
                        }
                    }
                }
            }
        }
        else if($request->type=="product");
        {
             foreach($cartItems as $key=>$cartItem)
            {
                if($request->product_id == $key)
                {
                    // foreach($cartItem as $subKey=>$carItem)
                    // {
                        // if($carItem['box'] == $request->box_id)
                        // {
                            $cartItems[$key][0]['quantity'] = $request->quantity;
                            $newQuantity = $request->quantity;
                            $cartItems[$key][0]['total_price'] = $request->quantity*$cartItem[0]['price'];
                            $productTotalPrice = $request->quantity*$cartItem[0]['price'];
                        // }
                    // }
                }
            }
        }

        foreach($cartItems as $key=>$cartItem)
        {
            foreach($cartItem as $carItem)
            {
                $totalPrice += $carItem['total_price'];
            }
        }

        $totalPrice = number_format($totalPrice,2);

        session()->put('cart',$cartItems);

        return response()->json(['success'=>true,'quantity'=>$newQuantity,'total_price'=>$totalPrice,'product_total_price'=>$productTotalPrice, 'box_id'=>$boxId]);
    }

    public function plusQuantity(Request $request)
    {
        $request->product_id;

        $cartItems = session()->get('cart');
        $newQuantity;

        $totalPrice = 0;
        $productTotalPrice = 0;
        $boxId = ""; 

        if($request->type=="box")
        {
            foreach($cartItems as $key=>$cartItem)
            {
                if($request->product_id == $key)
                {
                    // $cartItems[$key]['quantity'] = $request->quantity;
                    // $newQuantity = $request->quantity;
                    // $cartItems[$key]['total_price'] = $request->quantity*$cartItems[$key]['price'];
                    // $productTotalPrice = $request->quantity*$cartItems[$key]['price'];

                    foreach($cartItem as $subKey=>$carItem)
                    {
                        if($carItem['box'] == $request->box_id)
                        {
                            $cartItems[$key][$subKey]['quantity'] = $request->quantity;
                            $newQuantity = $request->quantity;
                            $cartItems[$key][$subKey]['total_price'] = intval($request->quantity)*$carItem['price'];
                            $boxId = $carItem['box'];
                            $productTotalPrice = intval($request->quantity)*$carItem['price'];

                            // $carItem['quantity'] = $request->quantity;
                            // $newQuantity = $request->quantity;
                            // $carItem['total_price'] = $request->quantity*$carItem['price'];
                        }
                    }
                }
            }
        }
        else if($request->type=="product")
        {
            foreach($cartItems as $key=>$cartItem)
            {
                if($request->product_id == $key)
                {
                    // foreach($cartItem as $subKey=>$carItem)
                    // {
                        // if($carItem['box'] == $request->box_id)
                        // // {
                            $cartItems[$key][0]['quantity'] = intval($request->quantity);
                            $newQuantity = $request->quantity;
                            $cartItems[$key][0]['total_price'] = intval($request->quantity)*$cartItem[0]['price'];
                            $productTotalPrice = intval($request->quantity)*$cartItem[0]['price'];
                        // }
                    // }
                }
            }
        }
        
        foreach($cartItems as $key=>$cartItem)
        {
            foreach($cartItem as $carItem)
            {
                $totalPrice += $carItem['total_price'];
            }
        }

        $totalPrice = number_format($totalPrice,2);

        // dd($cartItems);

        session()->put('cart',$cartItems);

        return response()->json(['success'=>true,'quantity'=>$newQuantity,'total_price'=>$totalPrice,'product_total_price'=>$productTotalPrice, 'box_id'=>$boxId]);
    }

    public function deleteItemFromCart(Request $request)
    {
        $carts = session()->get('cart');

        if($request->type == "box")
        {
            foreach($carts as $key=>$cart)
            {
                foreach($cart as $key1=>$item)
                {
                    if($request->box_id==$item['box'])
                    {
                        unset($carts[$key][$key1]);
                    }
                }                
                $carts[$key] = array_values($carts[$key]);
            }


        }
        else if($request->type == "product")
        {
            foreach($carts as $key=>$cart)
            {
                if($key == $request->product_id)
                {
                    unset($carts[$key]);
                }
            }
        }

        session()->put('cart',$carts);

        return response()->json(['success'=>true,'message'=>'Item removed from cart']);
    }

    public function checkoutPost(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'first_name'     => 'required|string',
            'last_name'      => 'required|string',
            'email'          => 'required|email',
            'phone'=>'required|numeric',
            'state'          => 'required',
            'city_id'           => 'required',
            'postal_code'=>'required',
            'address'=>'required'

        ]);

        $userData = $request->all();

        $state = State::where('name',$request->state)->first();
        $stateId = $state->id;

        $userData['name'] = $request->first_name." ".$request->last_name;
        $userData['password'] = bcrypt('12345678');
        $userData['role_id'] = 4;
        $userData['state'] = $stateId;
        $userData['city'] = $userData['city_id'];

        $cartItems = session()->get('cart');
        $totalAmount = 0;
        $grandTotal = 0;

        foreach($cartItems as $key=>$c)
        {
            foreach($c as $cartItem)
            {
                $totalAmount += $cartItem['total_price'];
                $grandTotal += $cartItem['total_price'];
            }
        }

        if($request->discount)
        {
             $totalAmount -= $request->discount;
             $grandTotal -= $request->discount;
        }
        else {
        }

        // $us = User::where('email', $userData['email'])->first();

        $user = User::updateOrCreate(
            ['email'=>$userData['email']],
            $userData);

        $userCreated = false;
        if ($user->wasRecentlyCreated) {
            // A new user was created
            $userCreated = true;
        } 
        // else {
        //     // Existing user was updated
        //     echo "User was updated";
        // }

         $order = Order::create([
                    'unique_id' => $this->generateUniqueOrderId(),
                    'user_id' => $user->id,
                    // 'order_number' => $existingOrder ? $existingOrder->order_number : $merchantOrdID,
                    // 'order_number' => 1,
                    // 'merchant_order_id' => $checkoutData['merchant_ord_id'],
                    // 'razorpay_payment_id' => $request->razorpay_payment_id,
                    // 'razorpay_subscription_id' => $request->razorpay_subscription_id,
                    // 'razorpay_customer_id' => $checkoutData['razorpay_customer_id'],
                    'total_amount' => $totalAmount,
                    'grand_total' => $grandTotal,
                    // 'subscription_total' => $checkoutData['subscription_details']['amount'] / 100 ?? $checkoutData['grandTotal'],
                    // 'coupon_id' => $checkoutData['coupon_id'],
                    // 'shipping_id' => $checkoutData['shipping_id'],
                    // 'shipping_cost' => $checkoutData['shipping_cost'],
                    'name' => $userData['first_name']." ".$userData['last_name'],
                    'first_name'=>$userData['first_name'],
                    'last_name' => $userData['last_name'],
                    'address' => $userData['address'],
                    // 'address2' => $checkoutData['address2'],
                    // 'towncity' => $checkoutData['towncity'],
                    'phone' => $userData['phone'],
                    'email' => $userData['email'],
                    'state_id'=>$stateId,
                    'city_id'=>$userData['city_id'],
                    'postal_code'=>$userData['postal_code'],
                    'phone_number'=>$userData['phone'],
                    // 'notes' => $checkoutData['notes'],
                    // 'status' => 'completed',
                    'payment_method' => 'cod',
                    // 'currency' => 'MYR',
                    // 'subscription_frequency' => $checkoutData['subscription_details']['frequency'] ?? 'monthly',
                    // 'subscription_start_at' => $checkoutData['subscription_details']['start_at'] ?? null,
                    // 'subscription_expire_at' => $checkoutData['subscription_details']['expire_at'] ?? null,
                    // 'subscription_link' => $checkoutData['subscription_details']['registration_link'] ?? null,
                    // Add new fields
                    // 'subscription_status' => $razorpaySubscription['status'] ?? 'active',
                    // 'paid_count' => $razorpaySubscription['paid_count'] ?? 0,
                    // 'remaining_count' => $razorpaySubscription['remaining_count'] ?? null,
                    // 'next_charge_at' => $razorpaySubscription['charge_at'] ? date('Y-m-d H:i:s', $razorpaySubscription['charge_at']) : null,
                ]);

                 foreach ($cartItems as $key=>$i) {
                    foreach($i as $item)
                    {
                        $order->items()->create([
                            'product_id' => $item['product_id'],
                            'attribute_id' => $item['attribute_id'] ?? null,
                            'quantity' => $item['quantity'],
                            'price' => $item['price'],
                            'order_id'=>$order->id
                        ]);
                    } 
                }

                $orderDetails = [
                    'first_name' => $order->name,
                    'email' => $order->email,
                    'phone' => $order->phone,
                    'address' => $order->address,
                    'city' => $order->city_id,
                    'state' => $order->state_id,
                ];

                $orderItems = session()->get('cart');

                foreach ($orderItems as $key => $i) {
                    foreach($i as $item)
                    {
                        $orderItems[$key]['product'] = Product::find($item['product_id']);
                    }
                }

                Mail::to($order->email)->send(
                    new OrderConfirmationMail($order, $orderDetails, $orderItems)
                );

                //giving points to users
                $user->points += $totalAmount;
                $user->save();

                auth()->login($user);


        // User::create($userData);
        $data['order'] = $order;
        $data['orderItems'] = session()->get('cart');
        session()->forget('cart');
        return view('front.order-completed', $data);

    }


    private function generateUniqueOrderId($length = 8)
    {
        do {
            $id = Str::random($length);
        } while (Order::where('unique_id', $id)->exists());

        return $id;
    }

    function logout()
    {
        auth()->logout();
        return redirect()->back();
    }

    public function test()
    {
        $data['order'] = Order::find(67);
        $data['orderItems'] = session()->get('cart');
        // dd($data['orderItems']);
        return view('front.order-completed', $data);
    }

    public function customerRegister(Request $request)
    {
        $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users',
            'phone_number'     => 'required|numeric|digits:11',
            'password'         => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6',
        ]);

        $data = $request->all();
        $rawPassword = $data['password'];
        $data['password'] = bcrypt($data['password']);
        $data['role_id'] = 4;

        $user = User::create([
            'name' => $data['first_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone_number'],
            'password' => $data['password'],
            'role_id' => $data['role_id']
        ]);

        $emailData = [
            'first_name'=>$user->first_name,
            'last_name'=>$user->last_name,
            'name'=>$user->name,
            'email'=>$user->email,
            'password'=>$rawPassword
        ];

        Mail::to($user->email)->send(new RegisterMail($emailData));

        return redirect()->back()->with('success', 'Registration successful! Please log in.');
    }

    public function shippingPolicy()
    {
        return view('front.shipping-policy');
    }

    public function termsAndConditions()
    {
        return view('front.terms-and-conditions');
    }

    public function privacyPolicy()
    {
        return view('front.privacy-policy');
    }

    public function returnsAndRefundsPolicy()
    {
        return view('front.returns-and-refunds-policy');
    }

}
