<?php

namespace App\Http\Controllers\Front;

use Exception;
use Stripe\Stripe;
use App\Models\Cart;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\State;
use Razorpay\Api\Api;
use App\Models\Coupon;
use App\Models\Wallet;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\UsedCoupon;
use App\Models\AccessToken;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use App\Models\GiftCardCode;
use App\Models\OrderHistory;
use App\Models\PointSetting;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Services\RazorpayApi;
use App\Models\ProductAttribute;
use App\Models\SubscriptionPlan;
use App\Jobs\ProcessMooGoldOrder;
use App\Models\OrderProccesstapu;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ProductOrderPointLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\UserSubscriptionDetail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    private $OrderIdNumber;

    private $rKey;

    private $rSecret;

    private $rApi;

    public function __construct()
    {
        $this->OrderIdNumber = $this->generateOrderId();
        $this->rKey = config('services.razorpay.key');
        $this->rSecret = config('services.razorpay.secret');
        $this->rApi = new Api($this->rKey, $this->rSecret);
    }

    private function generateOrderId()
    {
        $baseOrderId = 100001;
        $prefix = config('app.order_ref');

        // Get the latest order by numeric part of order_number
        $latestOrder = Order::where('order_number', 'like', $prefix.'%')
            ->orderByRaw("CAST(SUBSTRING(order_number, LENGTH('$prefix') + 1) AS UNSIGNED) DESC")
            ->first();

        if (! $latestOrder || ! $latestOrder->order_number) {
            return $prefix.$baseOrderId;
        }

        // Extract the numeric part (e.g., from ZEEM100039 → 100039)
        $lastNumber = (int) filter_var($latestOrder->order_number, FILTER_SANITIZE_NUMBER_INT);
        $nextOrderNumber = $lastNumber + 1;

        // Ensure uniqueness
        while (Order::where('order_number', $prefix.$nextOrderNumber)->exists()) {
            $nextOrderNumber++;
        }

        return $prefix.$nextOrderNumber;
    }

    public function checkout()
    {
        $cartItems = [];
        $total = 0;

        if (auth()->check()) {
            $cartItems = auth()->user()
                ->cartItems()
                ->with(['product' => function ($query) {
                    $query->where('is_subscription', 0);
                }])
                ->whereHas('product', function ($query) {
                    $query->where('is_subscription', 0);
                })
                ->get();

            $total = $cartItems->sum(fn ($item) => $item->price * $item->quantity);
        } else {
            $sessionCart = session('cart', []);

            foreach ($sessionCart as $i) {
                foreach($i as $item)
                {
                    $product = \App\Models\Product::where('id', $item['product_id'])
                    ->where('is_subscription', 0)
                    ->first();

                    if ($product) {
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

        // $states = City::select('state')->orderBy('state', 'asc')->distinct()->get();
        $states = State::all();
        if (Auth::check()) {
            $cities = City::select('name')->where('state', auth()->user()->state)->orderBy('name', 'asc')->get();
        } else {
            $cities = [];
        }

        $subTotal = 0;
        $grandTotal = 0;
        $discount = 0;
        $shippingPrice = AppSetting::where('variable','shipping_price')->first();
        $shippingPrice = $shippingPrice->value;

        $freeShippingPrice = AppSetting::where('variable','free_shipping')->first();
        $freeShippingPrice = $freeShippingPrice->value;

        $cartItems1 = session()->get('cart');
        if (! empty($cartItems1)) {
            foreach ($cartItems1 as $key => $c) {
                foreach($c as $cartItem)
                {
                    $subTotal += $cartItem['total_price'];
                    $grandTotal += $cartItem['total_price'];
                }
            }
        }
        $order_shippings = DB::table('order_shippings')->get();

        if(!empty($cartItems))
        {
            foreach($cartItems1 as $cartItems)
            {
                foreach($cartItems as $cartItem)
                {
                    $discount+=$cartItem['quantity']*$cartItem['discount'];
                }
            }             
        }

        if($grandTotal < $freeShippingPrice)
        {
            $grandTotal += $shippingPrice;
        }
        else
        {
            $shippingPrice = 0;
        }

        return view('front.checkout', compact('cartItems', 'total', 'cities', 'states', 'order_shippings', 'cartItems1', 'subTotal','grandTotal','discount', 'shippingPrice'));
    }

    public function getCities($state)
    {
        $cities = City::where('state', $state)->orderBy('name', 'asc')->get();

        return response()->json($cities);
    }

    public function bundleCheckout()
    {
        $cartItems = [];
        $total = 0;

        if (auth()->check()) {
            $cartItems = auth()->user()
                ->cartItems()
                ->with(['product' => function ($query) {
                    $query->where('is_subscription', 1);
                }])
                ->whereHas('product', function ($query) {
                    $query->where('is_subscription', 1);
                })
                ->get();

            $total = $cartItems->sum(fn ($item) => $item->price * $item->quantity);
        }

        $states = City::select('state')->orderBy('state', 'asc')->distinct()->get();
        $cities = City::select('name')->where('state', auth()->user()->state)->orderBy('name', 'asc')->get();
        $bundlePlan = session('bundle_plan');

        $subscription_user_data = session('subscription_user_data');

        return view('front.checkout', compact('cartItems', 'total', 'states', 'cities', 'bundlePlan', 'subscription_user_data'));
    }

    public function calculateShipping(Request $request)
    {
        $total = (float) $request->input('total');
        $cityId = $request->input('towncity');
        $cities = City::select('name')->where('state', $cityId)->orderBy('name', 'asc')->get();
        $city = DB::table('cities')->where('state', $cityId)->first();
        $plan = session()->get('bundle_plan');
        if (isset($plan['type'])) {
            $planType = $plan['type'] == 2 ? 12 : 1;
        } else {
            $planType = 1;
        }

        // Default region = peninsular
        $region = 'peninsular';

        if ($city) {
            $state = strtolower($city->state);
            if ($state === 'sabah' || $state === 'sarawak' || $state === 'labuan') {
                $region = 'sabah_sarawak';
            }
        }

        $shipping = calculateOrderShipping($region, $total);
        $newShipping = $shipping * $planType;
        $grandTotal = $total + $newShipping;

        return response()->json([
            'shipping' => $shipping,
            'shippingString' => $planType,
            'grand_total' => $grandTotal,
            'cities' => $cities,
        ]);
    }

    public function processCheckout(Request $request)
    {
        // dd($request->all());
        $payment_mode = $request->payment_mode;
        $user = auth()->user();

        $cartItems = [];
        $totalAmount = 0;
        $discountAmount = 0;
        $subscription_subtotal = 0.0;
        $addonPrice = 0.0;
        $shipping_cost = $request->shipping_cost ?? 0;

        // Subscription
        $bundlePlan = session('bundle_plan', []);
        $bundlePlanPrice = $bundlePlan['price'] ?? 0;

        $coupon_id = $request->coupon_id;
        $coupon = Coupon::find($coupon_id);
        if ($coupon && $user) {
            $used_coupon = UsedCoupon::where(['coupon_id' => $coupon_id, 'user_id' => $user->id])->first();
            if ($used_coupon) {
                $prev_usage = $used_coupon->usage;
                $used_coupon->update([
                    'usage' => $prev_usage + 1,
                ]);
            } else {
                UsedCoupon::create([
                    'coupon_id' => $coupon_id,
                    'usage' => 1,
                ]);
            }
        }

        if ($user) {
            $cartItems = $user->cartItems()->with('product', 'product_variant')->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('checkout')->with('error', 'Your cart is empty!');
            }

            $totalAmount = $cartItems->sum(fn ($item) => $item->price * $item->quantity);
        } else {
            $sessionCart = session('cart', []);

            if (empty($sessionCart)) {
                return redirect()->route('checkout')->with('error', 'Your cart is empty!');
            }

            foreach ($sessionCart as $item) {
                $variant = \App\Models\Product::find($item['product_id']);
                if ($variant) {
                    $subtotal = $item['price'] * $item['quantity'];
                    $totalAmount += $subtotal;

                    $cartItems[] = (object) [
                        'product' => $variant,
                        'quantity' => $item['quantity'],
                        'attributes' => $item['attributes'],
                        'price' => $item['price'],
                    ];
                }
            }

            $cartItems = collect($cartItems);
        }

        if ($coupon) {
            if ($coupon->type === 'fixed') {
                $discountAmount = min($coupon->value, $totalAmount);
            } elseif ($coupon->type === 'percentage') {
                $discountAmount = ($coupon->value / 100) * $totalAmount;
            }

            if ($coupon->max_discount) {
                $discountAmount = min($discountAmount, $coupon->max_discount);
            }

            $discountAmount = min($discountAmount, $totalAmount);
        }

        foreach ($cartItems as $item) {
            $addonPrice += $item->addon_price ?? 0.0;
        }

        if (isset($bundlePlan['type'])) {
            $shipping_cost = $bundlePlan['type'] == 2 ? ($shipping_cost * 12) : $shipping_cost;
        }

        if ($bundlePlan) {
            $subscription_subtotal = (($bundlePlan['type'] == 2 ? ($bundlePlanPrice * 12) : $bundlePlanPrice) + $addonPrice + $shipping_cost);
        }

        if ($subscription_subtotal > 0) {
            $grandTotal = $subscription_subtotal;
            $totalAmount = $subscription_subtotal;
        } else {
            $grandTotal = $totalAmount - $discountAmount;
        }

        if ($payment_mode === 'paydibs') {
            return $this->processPaydibsPayment($grandTotal, $totalAmount, $cartItems, $request);
        }

        if ($payment_mode === 'stripe') {
            return $this->stripeCheckout($grandTotal, $totalAmount, $cartItems, $request);
        }

        if ($request->order_type === '1') {
            // return 'Noor Khan';
            $grandTotal = $request->grandTotal;

            return $this->subscriptionCheckout($grandTotal, $totalAmount, $cartItems, $request);
        }
        if ($payment_mode === 'curlec_razorpay') {
            $grandTotal = $request->grandTotal;

            return $this->curlecCheckout($grandTotal, $totalAmount, $cartItems, $request);
        }

        if ($payment_mode === 'wallet') {
            return $this->processCheckoutWallet($grandTotal, $totalAmount, $cartItems, $request);
        }

        if ($payment_mode === 'cod') {
            return $this->processCheckoutCOD($grandTotal, $totalAmount, $cartItems, $request);
        }

        return redirect()->route('checkout')->with('error', 'Invalid payment method selected.');
    }

    public function curlec_success(Request $request)
    {

        $merchantOrdID = $request->merchant_ord_id;
        $checkoutData = session('checkout_data_'.$merchantOrdID);

        if (! $checkoutData) {

            $existingOrder = Order::where('merchant_order_id', $merchantOrdID)
                ->orWhere('razorpay_subscription_id', $request->razorpay_subscription_id)
                ->first();
            if ($existingOrder) {
                session()->forget('checkout_data_'.$merchantOrdID);

                return redirect()->route('order.success')->with('success', 'Subscription order already processed successfully!');
            }

            try {
                $api = new RazorpayApi(config('services.razorpay.key'), config('services.razorpay.secret'));
                $razorpaySubscription = $api->subscription->fetch($request->razorpay_subscription_id);

                $checkoutData = [
                    'cart_items' => [],
                    'total_amount' => $razorpaySubscription['amount'] / 100 ?? 0,
                    'grandTotal' => $razorpaySubscription['amount'] / 100 ?? 0,
                    'merchant_ord_id' => $merchantOrdID,
                    'payment_method' => 'subscription',
                    'name' => $request->name ?? 'Unknown',
                    'last_name' => '',
                    'address' => '',
                    'address2' => '',
                    'towncity' => '',
                    'phone' => '',
                    'email' => '',
                    'notes' => '',
                    'coupon_id' => null,
                    'shipping_id' => null,
                    'razorpay_subscription_id' => $request->razorpay_subscription_id,
                    'razorpay_customer_id' => $razorpaySubscription['customer_id'] ?? '',
                    'subscription_details' => [
                        'plan_id' => $razorpaySubscription['plan_id'] ?? '',
                        'amount' => $razorpaySubscription['amount'] ?? 0,
                        'frequency' => 'monthly', // Adjust based on plan configuration
                        'start_at' => $razorpaySubscription['start_at'] ?? null,
                        'expire_at' => $razorpaySubscription['expire_by'] ?? null,
                        'registration_link' => $razorpaySubscription['short_url'] ?? null,
                    ],
                ];
            } catch (Exception $e) {
                Log::error('Failed to fetch Razorpay subscription', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                return redirect()->route('bundle-checkout')->with('error', 'Subscription payment verification failed: Session data missing and unable to fetch subscription details.');
            }
        }

        if ($checkoutData['payment_method'] === 'subscription') {
            $api = new RazorpayApi(config('services.razorpay.key'), config('services.razorpay.secret'));

            try {
                $attributes = [
                    'razorpay_subscription_id' => $request->razorpay_subscription_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature,
                ];

                Log::info('Verifying Subscription Payment Signature', ['attributes' => $attributes]);
                $api->utility->verifyPaymentSignature($attributes);

                $existingOrder = Order::where('merchant_order_id', $merchantOrdID)
                    ->orWhere('razorpay_subscription_id', $request->razorpay_subscription_id)
                    ->first();

                if ($existingOrder) {
                    session()->forget('checkout_data_'.$merchantOrdID);

                    return redirect()->route('order.success')->with('success', 'Subscription payment successful! Order already placed.');
                }

                $order = Order::create([
                    'user_id' => auth()->id() ?? null,
                    'order_number' => $existingOrder ? $existingOrder->order_number : $merchantOrdID,
                    'merchant_order_id' => $checkoutData['merchant_ord_id'],
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_subscription_id' => $request->razorpay_subscription_id,
                    'razorpay_customer_id' => $checkoutData['razorpay_customer_id'],
                    'total_amount' => $checkoutData['total_amount'],
                    'grand_total' => $checkoutData['grandTotal'],
                    'subscription_total' => $checkoutData['subscription_details']['amount'] / 100 ?? $checkoutData['grandTotal'],
                    'coupon_id' => $checkoutData['coupon_id'],
                    'shipping_id' => $checkoutData['shipping_id'],
                    'shipping_cost' => $checkoutData['shipping_cost'],
                    'name' => $checkoutData['name'],
                    'last_name' => $checkoutData['last_name'],
                    'address' => $checkoutData['address'],
                    'address2' => $checkoutData['address2'],
                    'towncity' => $checkoutData['towncity'],
                    'phone' => $checkoutData['phone'],
                    'email' => $checkoutData['email'],
                    'notes' => $checkoutData['notes'],
                    'status' => 'completed',
                    'payment_method' => 'subscription',
                    'currency' => 'MYR',
                    'subscription_frequency' => $checkoutData['subscription_details']['frequency'] ?? 'monthly',
                    'subscription_start_at' => $checkoutData['subscription_details']['start_at'] ?? null,
                    'subscription_expire_at' => $checkoutData['subscription_details']['expire_at'] ?? null,
                    'subscription_link' => $checkoutData['subscription_details']['registration_link'] ?? null,
                    // Add new fields
                    'subscription_status' => $razorpaySubscription['status'] ?? 'active',
                    'paid_count' => $razorpaySubscription['paid_count'] ?? 0,
                    'remaining_count' => $razorpaySubscription['remaining_count'] ?? null,
                    'next_charge_at' => $razorpaySubscription['charge_at'] ? date('Y-m-d H:i:s', $razorpaySubscription['charge_at']) : null,
                ]);

                foreach ($checkoutData['cart_items'] as $item) {
                    $order->items()->create([
                        'product_id' => $item['product']['id'],
                        'attribute_id' => $item['attribute_id'] ?? null,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ]);
                }

                if (auth()->check()) {
                    auth()->user()->cartItems()->delete();
                }
                session()->forget('cart');
                session()->forget('checkout_data_'.$merchantOrdID);

                return redirect()->route('order.success')->with('success', 'Subscription payment successful! Subscription order placed. Order ID: '.$order->merchant_order_id.', Transaction ID: '.$request->razorpay_payment_id.', Subscription ID: '.$order->razorpay_subscription_id);
            } catch (Exception $e) {
                Log::error('Subscription Payment Verification Failed', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                    'attributes' => $attributes,
                ]);

                return redirect()->route('bundle-checkout')->with('error', 'Subscription payment verification failed: '.$e->getMessage());
            }
        }

        return redirect()->route('bundle-checkout')->with('error', 'Invalid payment method.');
    }

    // old curlecCheckout
    private function curlecCheckout($grandTotal, $totalAmount, $cartItems, Request $request)
    {
        $merchantOrdID = $this->OrderIdNumber;

        try {
            // Log input parameters
            if ($grandTotal <= 0) {
                throw new Exception('Grand total must be greater than 0');
            }

            $amountInPaise = intval($grandTotal * 100); // Convert MYR to paise
            // Build data array for Razorpay API
            $data = [
                'amount' => $amountInPaise,
                'currency' => 'MYR', // Ensure correct currency
                'receipt' => 'Receipt no. '.$merchantOrdID,
                'notes' => [
                    'merchant_order_id' => $merchantOrdID,
                ],
            ];

            $postFields = json_encode($data);
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $postFields,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'Authorization: Basic '.base64_encode(config('services.razorpay.key').':'.config('services.razorpay.secret')),
                ],
                CURLOPT_VERBOSE => true,
                CURLOPT_STDERR => $verbose = fopen('php://temp', 'w+'),
                CURLOPT_HEADER => true,
            ]);

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
            $curlError = curl_error($curl);

            // Split headers and body
            $responseHeaders = substr($response, 0, $headerSize);
            $responseBody = substr($response, $headerSize);

            // Capture verbose output
            rewind($verbose);
            $verboseLog = stream_get_contents($verbose);
            fclose($verbose);

            if ($curlError) {
                throw new Exception('cURL Error: '.$curlError);
            }

            if ($httpCode != 200) {
                if ($httpCode == 406) {
                    throw new Exception('Razorpay API 406 Not Acceptable: Check Accept header or JSON body. Response: '.$responseBody);
                }
                throw new Exception('Razorpay API returned status '.$httpCode.': '.$responseBody);
            }

            $order = json_decode($responseBody, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON response from Razorpay: '.json_last_error_msg());
            }

            if (! isset($order['id'])) {
                throw new Exception('No order ID returned from Razorpay API: '.print_r($order, true));
            }
            $shipping_address = (int) $request->ship_different === 1 ? $request->shipping_address : $request->address;
            // Store checkout data in session
            $checkoutData = [
                'cart_items' => $cartItems->toArray(),
                'total_amount' => $totalAmount,
                'merchant_ord_id' => $merchantOrdID,
                'payment_method' => $request->payment_mode,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'country' => $request->country,
                'address' => $request->address,
                'address2' => $request->address2,
                'shipping_address' => $shipping_address,
                'towncity' => $request->towncity,
                'phone' => $request->phone,
                'email' => $request->email,
                'notes' => $request->notes,
                'coupon_id' => $request->coupon_id,
                'shipping_id' => $request->shipping,
                'shipping_cost' => $request->shipping_cost,
                'grandTotal' => $grandTotal,
                'razorpay_order_id' => $order['id'],
            ];

            // Store in session with a unique key to prevent overwriting
            session(['checkout_data_'.$merchantOrdID => $checkoutData]);

            // Return payment view
            return view('front.payment.payment-with-curlec', [
                'order_id' => $order['id'],
                'amount' => $amountInPaise,
                'key' => config('services.razorpay.key'),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'merchant_ord_id' => $merchantOrdID,
            ]);
        } catch (Exception $e) {
            return redirect()->route('checkout')->with(
                'error',
                'Failed to create Razorpay checkout: '.$e->getMessage().' (Check logs for details)'
            );
        } finally {
            if (isset($curl)) {
                curl_close($curl);
            }
        }
    }

    // Noor Khan Code Starts Here
    private function executeCurl($url, $fields)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $fields,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Basic '.$this->rKey.':'.$this->rSecret,
            ],
            CURLOPT_VERBOSE => true,
            CURLOPT_STDERR => $verbose = fopen('php://temp', 'w+'),
            CURLOPT_HEADER => true,
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $curlError = curl_error($curl);
        $responseBody = substr($response, $headerSize);
        // Log everything
        if ($curlError) {
            throw new Exception('cURL Error: '.$curlError);
        }

        if ($httpCode != 200) {
            if ($httpCode == 406) {
                throw new Exception('Razorpay API 406 Not Acceptable: Check Accept header or JSON body. Response: '.$responseBody);
            }
            throw new Exception('Razorpay Subscription API returned status '.$httpCode.': '.$responseBody);
        }
        curl_close($curl);

        return $response;
    }

    private function createCustomer($cData)
    {
        $user = User::find(auth()->id());
        if (! empty($user->customer_id)) {
            return $user->customer_id;
        } else {
            $customer = $this->rApi->customer->create($cData);
            $user->customer_id = $customer['id'];
            $user->save();

            return $customer['id'];
        }
    }

    private function PlanExpiry($plan)
    {
        $currentDate = date('Y-m-d');
        if ($plan->type == 1) {
            $increase = strtotime('+1 month', strtotime($currentDate));
        } elseif ($plan->type == 2) {
            $increase = strtotime('+12 month', strtotime($currentDate));
        } else {
            $increase = strtotime('+1 day', strtotime($currentDate));
        }
        if ($plan->have_offer == 'Y') {
            $new = strtotime('+'.$plan->offer_month.' month', $increase);
        } else {
            $new = $increase;
        }

        return date('Y-m-d', $new);
    }

    private function subscriptionCheckout($grandTotal, $totalAmount, $cartItems, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',

            'address' => 'required|string|max:500',
            'postalcode' => 'required|string|max:20',
            'ship_different' => 'nullable|in:0,1',
            'shipping_address' => 'required_if:ship_different,1|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cdata['name'] = $request->name.' '.$request->last_name;
        $cdata['email'] = $request->email;
        $cdata['contact'] = $request->phone;
        $cdata['fail_existing'] = 0;
        $customer_id = $this->createCustomer($cdata);

        $shipping_address = (int) $request->ship_different === 1 ? $request->shipping_address : $request->address;
        $merchantOrdID = $this->OrderIdNumber ?? null;
        try {
            // Log input parameters
            if ($grandTotal <= 0) {
                throw new Exception('Grand total must be greater than 0');
            }
            $plan = SubscriptionPlan::find($request->plan_id);
            $planDescription = null;
            if ($plan) {
                $planAmount = $plan->price;
                $planId = $plan->curlec_plan_id;
                $paid_count = $plan->type == 'monthly' ? 12 : 1;
                $expire_by = $plan->type == 'monthly' ? strtotime('+1 year') : strtotime('+1 month');
                $planDescription = $plan->description;

            }
            $amountInPaise = intval($grandTotal * 100);
            $addonInPaise = intval($request->addon_price * 100);

            $currentTime = date('Y-m-d H:i:s');
            $expire_at = strtotime('+5 hour', strtotime($currentTime));
            //
            $oFields = [
                'amount' => $amountInPaise,
                'currency' => 'MYR',
                'receipt' => $merchantOrdID,
                'customer_id' => $customer_id,
                'method' => 'card',
                'token' => [
                    'max_amount' => 1000000,
                    'expire_at' => $expire_at,
                    'frequency' => 'as_presented'],
                'notes' => ['key1' => 'Plan ID: '.$request->plan_id]];
            $order = $this->rApi->order->create($oFields);
            // Store checkout data in session
            $ne = explode('_', $order['id']);
            $checkoutData = [
                'cart_items' => $cartItems->toArray(),
                'order_number' => 'SUB-'.$ne[1],
                'unique_id' => $this->generateUniqueOrderId(),
                'tracking_no' => $request->tracking_no ?? null,
                'total_amount' => $totalAmount,
                'razorpay_order_id' => $order['id'],
                'razorpay_customer_id' => $customer_id,
                'merchant_order_id' => $merchantOrdID,
                'payment_method' => 'subscription',
                'name' => $request->name,
                'last_name' => $request->last_name,
                'country' => $request->country,
                'address' => $request->address,
                'address2' => $request->address2,
                'towncity' => $request->towncity,
                'phone' => $request->phone,
                'email' => $request->email,
                'notes' => $request->notes,
                'coupon_id' => $request->coupon_id,
                'shipping_id' => $request->shipping,
                'shipping_cost' => $request->shipping_cost,
                'shipping_address' => $shipping_address,
                'grandTotal' => $grandTotal,
                'bundle_plan_name' => $plan->title,
                'bundle_plan_price' => $plan->price,
                'plan_id' => $plan->id,
                'subscription_status' => 'Pending',
                'subscription_frequency' => $plan->type,
                'subscription_start_at' => date('Y-m-d'),
                'subscription_expire_at' => $this->PlanExpiry($plan),
            ];

            // Store in session with a unique key to prevent overwriting
            // Noor Khan
            // $this->createOrder($checkoutData);
            User::where('id', auth()->id())->update([
                'sub_id' => $plan->id,
                'subscription_status' => 2,
            ]);
            session(['subscriptionData' => $checkoutData]);
            session(['checkout_data_'.$merchantOrdID => $checkoutData]);
            // return $subscription['id'];
            // Return payment view
            // $arr = array('url' => route('p.success'),'customer_id' => $customer_id,'order_id'=> $order['id'], 'amount' => $amountInPaise, 'key' => $this->rKey);
            // return json_encode($arr);

            return view('front.final-process', [
                'url' => route('p.success'),
                'p' => $plan,
                'customer_id' => $customer_id,
                'order_id' => $order['id'],
                'amount' => $amountInPaise,
                'key' => $this->rKey]);
        } catch (Exception $e) {
            $exception['message'] = $e->getMessage();
            $exception['trace'] = $e->getTraceAsString();
            dd($exception);

        } finally {
            if (isset($curl)) {
                curl_close($curl);
            }
        }
    }

    // Noor Khan
    private function createOrder($checkoutData)
    {
        try {
            DB::beginTransaction();
            $order = Order::create([
                'user_id' => auth()->id() ?? 0,
                'order_number' => $checkoutData['order_number'],
                'unique_id' => $checkoutData['unique_id'],
                'tracking_no' => $checkoutData['tracking_no'],
                'merchant_order_idx' => $checkoutData['merchant_order_id'],
                'razorpay_customer_id' => $checkoutData['razorpay_customer_id'],
                'razorpay_order_id' => $checkoutData['razorpay_order_id'],
                'total_amount' => $checkoutData['total_amount'],
                'grand_total' => $checkoutData['grandTotal'],
                'coupon_id' => $checkoutData['coupon_id'],
                'shipping_id' => $checkoutData['shipping_id'],
                'shipping_cost' => $checkoutData['shipping_cost'],
                'name' => $checkoutData['name'],
                'last_name' => $checkoutData['last_name'],
                'address' => $checkoutData['address'],
                'address2' => $checkoutData['address2'],
                'towncity' => $checkoutData['towncity'],
                'phone' => $checkoutData['phone'],
                'email' => $checkoutData['email'],
                'notes' => $checkoutData['notes'],
                'bundle_plan_name' => $checkoutData['bundle_plan_name'],
                'bundle_plan_price' => $checkoutData['bundle_plan_price'],
                'plan_id' => $checkoutData['plan_id'],
                'subscription_status' => $checkoutData['subscription_status'],
                'subscription_start_at' => $checkoutData['subscription_start_at'],
                'subscription_expire_at' => $checkoutData['subscription_expire_at'],
                'status' => 'failed']);

            OrderDetail::create([
                'order_id' => $order->id,
                'user_id' => auth()->id() ?? null,
                'name' => $checkoutData['name'] ?? '',
                'last_name' => $checkoutData['last_name'] ?? '',
                'address' => $checkoutData['address'] ?? '',
                'shipping_address' => $checkoutData['shipping_address'] ?? '',
                'address2' => $checkoutData['address2'] ?? '',
                'towncity' => $checkoutData['towncity'] ?? '',
                'email' => $checkoutData['email'] ?? '',
                'phone' => $checkoutData['phone'] ?? '',
                'country' => $checkoutData['country'] ?? '',
                'shipping_address' => $checkoutData['shipping_address'] ?? '',
            ]);

            // Attach cart items to the order
            foreach ($checkoutData['cart_items'] as $item) {
                $order->items()->create([
                    'product_id' => $item['product']['id'],
                    'attribute_id' => $item['attribute_id'] ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            dd('createOrder: '.$e->getMessage());
        }
    }

    // Noor Khan
    public function success(Request $request)
    {
        // Log incoming request for debugging
        Log::info('Payment Success Request', [
            'request' => $request->all(),
            'session_id' => session()->getId(),
            'merchant_ord_id' => $request->merchant_ord_id,
        ]);

        $merchantOrdID = $request->merchant_ord_id;
        $checkoutData = session('checkout_data_'.$merchantOrdID);

        if (! $checkoutData) {
            Log::warning('Checkout session data missing', [
                'merchant_ord_id' => $merchantOrdID,
                'request' => $request->all(),
            ]);

            // Fallback: Check if order already exists
            $existingOrder = Order::where('merchant_order_id', $merchantOrdID)
                ->orWhere('razorpay_order_id', $request->razorpay_order_id)
                ->first();
            if ($existingOrder) {
                session()->forget('checkout_data_'.$merchantOrdID);

                return redirect()->route('order.success')->with('success', 'Order already processed successfully!');
            }

            // Fallback: Fetch order details from Razorpay
            try {
                $api = new \Razorpay\Api\Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                $razorpayOrder = $api->order->fetch($request->razorpay_order_id);
                Log::info('Razorpay Order Fetched', ['order' => $razorpayOrder]);

                $checkoutData = [
                    'cart_items' => [], // Note: Cart items may need to be fetched separately
                    'total_amount' => $razorpayOrder['amount'] / 100,
                    'grandTotal' => $razorpayOrder['amount'] / 100,
                    'merchant_ord_id' => $merchantOrdID,
                    'payment_method' => 'curlec_razorpay',
                    'name' => $request->name ?? 'Unknown',
                    'last_name' => '',
                    'address' => '',
                    'address2' => '',
                    'towncity' => '',
                    'phone' => '',
                    'email' => '',
                    'notes' => '',
                    'coupon_id' => null,
                    'shipping_id' => null,
                    'razorpay_order_id' => $request->razorpay_order_id,
                ];
            } catch (\Exception $e) {
                Log::error('Failed to fetch Razorpay order', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                return redirect()->route('checkout')->with('error', 'Payment verification failed: Session data missing and unable to fetch order details.');
            }
        }

        if ($checkoutData['payment_method'] === 'curlec_razorpay') {
            $api = new \Razorpay\Api\Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            try {
                // Verify payment signature
                $attributes = [
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature,
                ];

                $api->utility->verifyPaymentSignature($attributes);

                // Check for duplicate orders
                $existingOrder = Order::where('merchant_order_id', $merchantOrdID)
                    ->orWhere('razorpay_order_id', $request->razorpay_order_id)
                    ->first();

                if ($existingOrder) {
                    session()->forget('checkout_data_'.$merchantOrdID);

                    return redirect()->route('order.success')->with('success', 'Payment successful! Order already placed.');
                }

                // Create order in the database
                $order = Order::create([
                    'user_id' => auth()->id() ?? null,
                    'merchant_order_id' => $checkoutData['merchant_ord_id'],
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'total_amount' => $checkoutData['total_amount'],
                    'grand_total' => $checkoutData['grandTotal'],
                    'coupon_id' => $checkoutData['coupon_id'],
                    'shipping_id' => $checkoutData['shipping_id'],
                    'shipping_cost' => $checkoutData['shipping_cost'],
                    'name' => $checkoutData['name'],
                    'last_name' => $checkoutData['last_name'],
                    'address' => $checkoutData['address'],
                    'address2' => $checkoutData['address2'],
                    'towncity' => $checkoutData['towncity'],
                    'phone' => $checkoutData['phone'],
                    'email' => $checkoutData['email'],
                    'notes' => $checkoutData['notes'],
                    'status' => 'completed',
                ]);

                OrderDetail::create([
                    'order_id' => $order->id,
                    'user_id' => auth()->id() ?? null,
                    'name' => $checkoutData['name'] ?? '',
                    'last_name' => $checkoutData['last_name'] ?? '',
                    'address' => $checkoutData['address'] ?? '',
                    'shipping_address' => $checkoutData['shipping_address'] ?? '',
                    'address2' => $checkoutData['address2'] ?? '',
                    'towncity' => $checkoutData['towncity'] ?? '',
                    'email' => $checkoutData['email'] ?? '',
                    'phone' => $checkoutData['phone'] ?? '',
                    'country' => $checkoutData['country'] ?? '',
                    'shipping_address' => $checkoutData['shipping_address'] ?? '',
                ]);

                // Attach cart items to the order
                foreach ($checkoutData['cart_items'] as $item) {
                    $order->items()->create([
                        'product_id' => $item['product']['id'],
                        'attribute_id' => $item['attribute_id'] ?? null,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ]);
                }

                // Clear cart and session
                if (auth()->check()) {
                    auth()->user()->cartItems()->delete();
                }
                session()->forget('cart');
                session()->forget('checkout_data_'.$merchantOrdID);

                return redirect()->route('order.success')->with('success', 'Payment successful! Order placed. Order ID: '.$order->merchant_order_id.', Transaction ID: '.$request->razorpay_payment_id);
            } catch (\Exception $e) {
                Log::error('Payment Verification Failed', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                    'attributes' => $attributes,
                ]);

                return redirect()->route('checkout')->with('error', 'Payment verification failed: '.$e->getMessage());
            }
        }

        return redirect()->route('checkout')->with('error', 'Invalid payment method.');
    }

    public function processCheckoutTapu(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'zipcode' => 'required|string|max:20',
            'month' => 'required|string|max:20',
            'year' => 'required|string|max:20',
            'card_number' => 'required|string|max:20',
            'security_code' => 'required|string|max:25',
            'payment_method' => 'required|string|max:50',
        ]);
        $user = User::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'password' => bcrypt('123456'),
            ]
        );

        $orderProcess = OrderProccesstapu::create($validated);

        return redirect()->back()->with('success', 'Checkout details saved successfully!');
    }

    public function processCheckoutOLD(Request $request)
    {
        $payment_mode = $request->payment_mode;
        $user = auth()->user();
        $coupon = $request->coupon_id;

        $cartItems = [];
        $totalAmount = 0;

        if ($user) {
            $cartItems = $user->cartItems()->with('product', 'product_variant')->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('checkout')->with('error', 'Your cart is empty!');
            }

            $totalAmount = $cartItems->sum(fn ($item) => $item->price * $item->quantity);
        } else {
            $sessionCart = session('cart', []);

            if (empty($sessionCart)) {
                return redirect()->route('checkout')->with('error', 'Your cart is empty!');
            }

            foreach ($sessionCart as $item) {
                $variant = \App\Models\Product::find($item['product_id']);
                if ($variant) {
                    $subtotal = $item['price'] * $item['quantity'];
                    $totalAmount += $subtotal;

                    $cartItems[] = (object) [
                        'product' => $variant,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'game_user_id' => $item['game_user_id'],
                        'game_server_id' => $item['game_server_id'],
                        'game_user_name' => $item['game_user_name'],
                        'game_email' => $item['game_email'],
                    ];
                }
            }

            $cartItems = collect($cartItems);
        }

        if ($payment_mode === 'paydibs') {
            $paydibsConfig = [
                'merchant_id' => config('paydibs.merchant_id'),
                'merchant_password' => config('paydibs.merchant_password'),
                'payment_url' => config('paydibs.payment_url'),
                'return_url' => config('paydibs.return_url'),
                'callback_url' => config('paydibs.callback_url'),
            ];

            $merchantPymtID = 'PYM-'.strtoupper(uniqid());
            $merchantOrdID = $this->OrderIdNumber;

            $paydibsData = [
                'TxnType' => 'PAY',
                'MerchantID' => $paydibsConfig['merchant_id'],
                'MerchantPymtID' => $merchantPymtID,
                'MerchantOrdID' => $merchantOrdID,
                'MerchantOrdDesc' => 'Order payment',
                'MerchantTxnAmt' => number_format($totalAmount, 2, '.', ''),
                'MerchantCurrCode' => 'MYR',
                'MerchantRURL' => str_replace('&', ';', $paydibsConfig['return_url']),
                'CustIP' => $request->ip(),
                'CustName' => $user->name ?? $request->name,
                'CustEmail' => $user->email ?? $request->email,
                'CustPhone' => $user->phone ?? $request->phone,
                'MerchantCallbackURL' => str_replace('&', ';', $paydibsConfig['callback_url']),
                'MerchantName' => config('app.name'),
                'PageTimeout' => '300',
            ];

            $sourceString = $paydibsConfig['merchant_password'].
                $paydibsData['TxnType'].
                $paydibsData['MerchantID'].
                $paydibsData['MerchantPymtID'].
                $paydibsData['MerchantOrdID'].
                $paydibsData['MerchantRURL'].
                $paydibsData['MerchantTxnAmt'].
                $paydibsData['MerchantCurrCode'].
                $paydibsData['CustIP'].
                $paydibsData['PageTimeout'].
                $paydibsData['MerchantCallbackURL'];

            $paydibsData['Sign'] = hash('sha512', $sourceString);

            session([
                'paydibs_checkout_data' => [
                    'cart_items' => $cartItems,
                    'total_amount' => $totalAmount,
                    'merchant_pymt_id' => $merchantPymtID,
                    'merchant_ord_id' => $merchantOrdID,
                    'payment_method' => $payment_mode,
                    'name' => $request->name,
                    'last_name' => $request->last_name,
                    'country' => $request->country,
                    'address' => $request->address,
                    'address2' => $request->address2,
                    'towncity' => $request->towncity,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'notes' => $request->notes,
                ],
            ]);

            $form = '<form name="frmPaydibs" method="post" action="'.$paydibsConfig['payment_url'].'">';
            foreach ($paydibsData as $key => $value) {
                $form .= '<input type="hidden" name="'.$key.'" value="'.htmlspecialchars($value).'">';
            }
            $form .= '<input type="submit" value="Pay Now" style="display:none;">';
            $form .= '</form>';
            $form .= '<script>document.frmPaydibs.submit();</script>';

            return $form;
        }

        if ($payment_mode === 'stripe') {
            return $this->stripeCheckout($totalAmount, $cartItems, $request);
        }

        if ($payment_mode === 'wallet') {
            return $this->processCheckoutWallet($totalAmount, $cartItems, $request);
        }

        return redirect()->route('checkout')->with('error', 'Invalid payment method selected.');
    }

    private function stripeCheckout($grandTotal, $totalAmount, $cartItems, $request)
    {
        Stripe::setApiKey(config('stripe.key'));

        $lineItems = $cartItems->map(function ($item) {
            return [
                'price_data' => [
                    'currency' => 'myr',
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => $item->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        })->toArray();

        $merchantOrdID = $this->OrderIdNumber;

        session([
            'checkout_data' => [
                'cart_items' => $cartItems->toArray(),
                'total_amount' => $totalAmount,
                'merchant_ord_id' => $merchantOrdID,
                'payment_method' => $request->payment_method,
                // 'user_first_name' => $request->user_first_name,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'country' => $request->country,
                'address' => $request->address,
                'address2' => $request->address2,
                'towncity' => $request->towncity,
                'phone' => $request->phone,
                'email' => $request->email,
                'notes' => $request->notes,
                'coupon_id' => $request->coupon_id,
                'shipping_id' => $request->shipping,
                'grandTotal' => $grandTotal,
            ],
        ]);

        try {
            $session = Session::create([
                // 'payment_method_types' => [$request->payment_method],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('payment.success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout'),
                'customer_email' => $request->email,
                'billing_address_collection' => 'required',
                'metadata' => [
                    'merchant_ord_id' => $merchantOrdID,
                ],
            ]);

            return redirect()->to($session->url);

            return response()->json(['sessionId' => $session->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create checkout session: '.$e->getMessage()], 500);
        }
    }

    public function handlePaymentReturn(Request $request)
    {
        // Verify payment response
        $paydibsConfig = [
            'merchant_id' => config('paydibs.merchant_id'),
            'merchant_password' => config('paydibs.merchant_password'),
        ];

        $responseData = $request->all();
        $expectedFields = [
            'MerchantID',
            'MerchantPymtID',
            'PTxnID',
            'MerchantOrdID',
            'MerchantTxnAmt',
            'MerchantCurrCode',
            'PTxnStatus',
            'AuthCode',
            'Sign',
        ];

        // Validate response
        foreach ($expectedFields as $field) {
            if (! isset($responseData[$field])) {
                return redirect()->route('checkout')->with('error', 'Invalid payment response from Paydibs.');
            }
        }

        // Verify Sign
        $sourceString = $paydibsConfig['merchant_password'].
            $responseData['MerchantID'].
            $responseData['MerchantPymtID'].
            $responseData['PTxnID'].
            $responseData['MerchantOrdID'].
            $responseData['MerchantTxnAmt'].
            $responseData['MerchantCurrCode'].
            $responseData['PTxnStatus'].
            $responseData['AuthCode'];

        $expectedSign = hash('sha512', $sourceString);

        if ($expectedSign !== $responseData['Sign']) {
            return redirect()->route('checkout')->with('error', 'Invalid payment signature from Paydibs.');
        }

        // Check if payment was successful (PTxnStatus '0' indicates success)
        if ($responseData['PTxnStatus'] !== '0') {
            return redirect()->route('checkout')->with('error', 'Payment failed with status: '.$responseData['PTxnStatus']);
        }

        // Retrieve checkout data from session
        $checkoutData = session('paydibs_checkout_data');
        if (! $checkoutData || $checkoutData['merchant_pymt_id'] !== $responseData['MerchantPymtID']) {
            return redirect()->route('checkout')->with('error', 'Invalid checkout session data.');
        }

        // Start database transaction
        DB::beginTransaction();

        try {
            $user = auth()->user();
            $cartItems = collect($checkoutData['cart_items']);
            $totalAmount = $checkoutData['total_amount'];

            // Create order
            $order = Order::create([
                'unique_id' => $this->generateUniqueOrderId(),
                'order_number' => $checkoutData['merchant_ord_id'],
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'payment_method' => 'paydibs',
                'status' => 'processing',
                'notes' => $checkoutData['notes'],
            ]);

            OrderDetail::create([
                'order_id' => $order->id,
                'user_id' => $user ? $user->id : null,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'towncity' => $request->towncity,
                'country' => $request->country,
                'address' => $request->address,
                'address2' => $request->address2,
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'] ?? $item->product_id,
                    // 'product_variant_id' => $item['variant_id'] ?? $item->variant_id,
                    'game_id' => isset($item['game_user_id']) ? $item['game_user_id'] : ($item->game_user_id ?? null),
                    'server_id' => isset($item['game_server_id']) ? $item['game_server_id'] : ($item->game_server_id ?? null),
                    'user_name' => isset($item['game_user_name']) ? $item['game_user_name'] : ($item->game_user_name ?? null),
                    'email' => isset($item['game_email']) ? $item['game_email'] : ($item->game_email ?? null),
                    'quantity' => $item['quantity'] ?? $item->quantity,
                    'price' => $item['price'] ?? $item->price,
                    'delivery_method' => 'manual',
                ]);
            }

            // Create order history
            OrderHistory::create([
                'order_id' => $order->id,
                'user_id' => $user->id,
                'status' => 'pending',
                'notes' => 'Order placed after successful Paydibs payment',
            ]);

            // Create payment record
            Payment::create([
                'order_id' => $order->id,
                'amount' => $totalAmount,
                'payment_gateway' => 'paydibs',
                'status' => 'completed',
                'transaction_id' => $responseData['PTxnID'],
                'auth_code' => $responseData['AuthCode'],
            ]);

            // Clear cart
            $user->cartItems()->delete();

            // Clear session data
            session()->forget('paydibs_checkout_data');

            DB::commit();

            return redirect()->route('front.home')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('checkout')->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function handlePaymentCallback(Request $request)
    {
        // Similar to handlePaymentReturn but for server-to-server callback
        $paydibsConfig = [
            'merchant_id' => config('paydibs.merchant_id'),
            'merchant_password' => config('paydibs.merchant_password'),
        ];

        $responseData = $request->all();
        $expectedFields = [
            'MerchantID',
            'MerchantPymtID',
            'PTxnID',
            'MerchantOrdID',
            'MerchantTxnAmt',
            'MerchantCurrCode',
            'PTxnStatus',
            'AuthCode',
            'Sign',
        ];

        // Validate response
        foreach ($expectedFields as $field) {
            if (! isset($responseData[$field])) {
                return response()->json(['status' => 'error'], 400);
            }
        }

        // Verify Sign
        $sourceString = $paydibsConfig['merchant_password'].
            $responseData['MerchantID'].
            $responseData['MerchantPymtID'].
            $responseData['PTxnID'].
            $responseData['MerchantOrdID'].
            $responseData['MerchantTxnAmt'].
            $responseData['MerchantCurrCode'].
            $responseData['PTxnStatus'].
            $responseData['AuthCode'];

        $expectedSign = hash('sha512', $sourceString);

        if ($expectedSign !== $responseData['Sign']) {
            return response()->json(['status' => 'invalid_signature'], 400);
        }

        // Check if payment was successful
        if ($responseData['PTxnStatus'] === '0') {
            // Process order creation if not already processed
            // This is a fallback in case handlePaymentReturn was not triggered
            $checkoutData = session('paydibs_checkout_data');
            if ($checkoutData && $checkoutData['merchant_pymt_id'] === $responseData['MerchantPymtID']) {
                $user = auth()->user();
                $cartItems = collect($checkoutData['cart_items']);
                $totalAmount = $checkoutData['total_amount'];

                DB::beginTransaction();
                try {
                    $order = Order::firstOrCreate(
                        ['order_number' => $checkoutData['merchant_ord_id']],
                        [
                            'unique_id' => $this->generateUniqueOrderId(),
                            'user_id' => $user->id,
                            'total_amount' => $totalAmount,
                            'payment_method' => 'paydibs',
                            'status' => 'pending',
                        ]
                    );

                    if ($order->wasRecentlyCreated) {
                        foreach ($cartItems as $item) {
                            $order_item = OrderItem::create([
                                'order_id' => $order->id,
                                'product_id' => $item['product_id'],
                                // 'product_variant_id' => $item['variant_id'],
                                'game_id' => $item['game_user_id'] ?? null,
                                'server_id' => $item['game_server_id'] ?? null,
                                'user_name' => $item['game_user_name'] ?? null,
                                'email' => $item['game_email'] ?? null,
                                'quantity' => $item['quantity'],
                                'price' => $item['price'],
                                'delivery_method' => 'manual',
                            ]);
                            if ($order_item->product->type === 'gift_card' && ! $order->code_id) {
                                $this->giftCardCode($order_item->id);
                            }
                        }

                        OrderHistory::create([
                            'order_id' => $order->id,
                            'user_id' => $user->id,
                            'status' => 'pending',
                            'notes' => 'Order placed via Paydibs callback',
                        ]);

                        Payment::create([
                            'order_id' => $order->id,
                            'amount' => $totalAmount,
                            'payment_gateway' => 'paydibs',
                            'status' => 'completed',
                            'transaction_id' => $responseData['PTxnID'],
                            'auth_code' => $responseData['AuthCode'],
                        ]);

                        $user->cartItems()->delete();
                        session()->forget('paydibs_checkout_data');
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();

                    return response()->json(['status' => 'error'], 500);
                }
            }
        }

        return response()->json(['status' => 'success'], 200);
    }

    // HeartDisk
    public function payForSubscription(Request $request)
    {
        try {
            $checkoutData = session('subscriptionData');
            DB::beginTransaction();
            $user = auth()->user();
            $cartItems = collect($checkoutData['cart_items']);
            $totalAmount = $checkoutData['total_amount'];
            $grandTotal = $checkoutData['grandTotal'];
            $cartTotal = $totalAmount;
            $coupon_id = $checkoutData['coupon_id'];

            $order = Order::create([
                'unique_id' => $this->generateUniqueOrderId(),
                'order_number' => $checkoutData['merchant_order_id'],
                'user_id' => $user ? $user->id : null,
                'total_amount' => $totalAmount,
                'payment_method' => 'curlec',
                'status' => 'processing',
                'coupon_id' => $coupon_id ?? null,
                'discount_applied' => $cartTotal - $grandTotal,
                'grand_total' => $grandTotal,
                'notes' => $checkoutData['notes'],
                'shipping_id' => $checkoutData['shipping_id'],
            ]);

            OrderDetail::create([
                'order_id' => $order->id,
                'user_id' => $user ? $user->id : null,
                'name' => $checkoutData['name'],
                'last_name' => $checkoutData['last_name'],
                'email' => $checkoutData['email'],
                'phone' => $checkoutData['phone'],
                'towncity' => $checkoutData['towncity'],
                'country' => $checkoutData['country'],
                'address' => $checkoutData['address'],
                'address2' => $checkoutData['address2'],
            ]);

            // HeartDisk
            if ($checkoutData['plan_id']) {
                $effectiveDate = date('Y-m-d');
                $plan = SubscriptionPlan::where('id', $checkoutData['plan_id'])->first();
                $months = $plan->type == 2 ? 12 : 1;
                $extraMonth = 0;
                if ($plan->have_offer == 'Y') {
                    $extraMonth = $plan->offer_month;
                }
                $month = $months + $extraMonth;
                $sub_expiry = date('Y-m-d', strtotime('+'.$month.' months', strtotime($effectiveDate)));
                User::where('id', auth()->id())->update([
                    'sub_expiry' => $sub_expiry,
                    'subscription_status' => 1,
                ]);
            }

            if ($coupon_id) {
                $coupon = Coupon::find($coupon_id);
                if ($coupon) {
                    $coupon->used_count = $coupon->used_count ? $coupon->used_count + 1 : 1;
                    $coupon->save();
                }
            }
            $cartItems = collect($cartItems)->map(function ($item) {
                return is_array($item) ? (object) $item : $item;
            });

            foreach ($cartItems as $item) {
                // $fields = $item->fields;
                $item_product = Product::find($item->product_id);
                $order_item = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id ?? $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'delivery_method' => 'manual',
                ]);
                if ($order_item->product->type === 'gift_card' && ! $order->code_id) {
                    $this->giftCardCode($order_item->id);
                }
            }

            OrderHistory::create([
                'order_id' => $order->id,
                'user_id' => $user ? $user->id : null,
                'status' => 'pending',
                'notes' => 'Order placed after successful Stripe payment',
            ]);

            Payment::create([
                'order_id' => $order->id,
                'amount' => $totalAmount,
                'payment_gateway' => 'curlec',
                'status' => 'completed',
                'payment_id' => null,
            ]);

            // $this->orderinAir($order->id, $order->order_number);

            if ($user) {
                $user->cartItems()->delete();
            } else {
                session()->forget('cart');
            }
            session()->forget('checkout_data');

            DB::commit();

            $user = User::where('id', auth()->user()->id)->first();
            Mail::to(auth()->user()->email)->send(new \App\Mail\SubscriptionRenewMail($user, $checkoutData));

            return redirect()->route('myaccount')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('checkout')->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    public function handlePaymentSuccess(Request $request)
    {
        Stripe::setApiKey(config('stripe.secret'));

        $sessionId = $request->query('session_id');
        if (! $sessionId) {
            return redirect()->route('checkout')->with('error', 'Invalid payment session.');
        }

        try {
            $session = Session::retrieve($sessionId);
            if ($session->payment_status !== 'paid') {
                return redirect()->route('checkout')->with('error', 'Payment not completed.');
            }

            $checkoutData = session('checkout_data');
            if (! $checkoutData || $checkoutData['merchant_ord_id'] !== $session->metadata->merchant_ord_id) {
                return redirect()->route('checkout')->with('error', 'Invalid checkout session data.');
            }

            DB::beginTransaction();

            $user = auth()->user();
            $cartItems = collect($checkoutData['cart_items']);
            $totalAmount = $checkoutData['total_amount'];
            $grandTotal = $checkoutData['grandTotal'];
            $cartTotal = $totalAmount;
            $coupon_id = $checkoutData['coupon_id'];
            if ($user) {
                // $user->update([
                //     // 'name' => $checkoutData['user_first_name'],
                //     'country' => $checkoutData['country'],
                //     'address' => $checkoutData['address'],
                //     'address2' => $checkoutData['address2'],
                //     'towncity' => $checkoutData['towncity'],
                //     'phone' => $checkoutData['phone'],
                //     'email' => $checkoutData['email'],
                // ]);
            }

            $order = Order::create([
                'unique_id' => $this->generateUniqueOrderId(),
                'order_number' => $checkoutData['merchant_ord_id'],
                'user_id' => $user ? $user->id : null,
                'total_amount' => $totalAmount,
                'payment_method' => 'stripe',
                'status' => 'processing',
                'coupon_id' => $coupon_id ?? null,
                'discount_applied' => $cartTotal - $grandTotal,
                'grand_total' => $grandTotal,
                'notes' => $checkoutData['notes'],
                'shipping_id' => $checkoutData['shipping'],
            ]);
            OrderDetail::create([
                'order_id' => $order->id,
                'user_id' => $user ? $user->id : null,
                'name' => $checkoutData['name'],
                'last_name' => $checkoutData['last_name'],
                'email' => $checkoutData['email'],
                'phone' => $checkoutData['phone'],
                'towncity' => $checkoutData['towncity'],
                'country' => $checkoutData['country'],
                'address' => $checkoutData['address'],
                'address2' => $checkoutData['address2'],
            ]);

            // HeartDisk
            if ($checkoutData['plan_id']) {
                $effectiveDate = date('Y-m-d');
                $plan = SubscriptionPlan::where('id', $checkoutData['plan_id'])->first();
                $months = $plan->type == 2 ? 12 : 1;
                $extraMonth = 0;
                if ($plan->have_offer == 'Y') {
                    $extraMonth = $plan->offer_month;
                }
                $month = $months + $extraMonth;
                $sub_expiry = date('Y-m-d', strtotime('+'.$month.' months', strtotime($effectiveDate)));
                User::where('id', auth()->id())->update([
                    'sub_expiry' => $sub_expiry,
                    'subscription_status' => 1,
                ]);
            }

            if ($coupon_id) {
                $coupon = Coupon::find($coupon_id);
                if ($coupon) {
                    $coupon->used_count = $coupon->used_count ? $coupon->used_count + 1 : 1;
                    $coupon->save();
                }
            }
            $cartItems = collect($cartItems)->map(function ($item) {
                return is_array($item) ? (object) $item : $item;
            });

            foreach ($cartItems as $item) {
                // $fields = $item->fields;
                $item_product = Product::find($item->product_id);
                $order_item = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id ?? $item->product_id,
                    // 'product_variant_id' => $item->product_variant->id ?? $item->variant_id,

                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'delivery_method' => 'manual',
                    // 'fields' => $fields,
                    // 'source' => $item_product->source,
                ]);
                if ($order_item->product->type === 'gift_card' && ! $order->code_id) {
                    $this->giftCardCode($order_item->id);
                }

                // if ($order_item->product->source == 'M') {
                //     // return $item;
                //     ProcessMooGoldOrder::dispatch($order, $order_item, $item);
                // }
            }

            OrderHistory::create([
                'order_id' => $order->id,
                'user_id' => $user ? $user->id : null,
                'status' => 'pending',
                'notes' => 'Order placed after successful Stripe payment',
            ]);

            Payment::create([
                'order_id' => $order->id,
                'amount' => $totalAmount,
                'payment_gateway' => 'stripe',
                'status' => 'completed',
                'payment_id' => $session->payment_intent,
            ]);

            // $this->orderinAir($order->id, $order->order_number);

            if ($user) {
                $user->cartItems()->delete();
            } else {
                session()->forget('cart');
            }
            session()->forget('checkout_data');

            DB::commit();

            return redirect()->route('front.home')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('checkout')->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    public function handleWebhook(Request $request)
    {
        Stripe::setApiKey(config('stripe.secret'));
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\Exception $e) {
            return response()->json(['status' => 'invalid_signature'], 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            if ($session->payment_status === 'paid') {
                $checkoutData = session('checkout_data');
                if ($checkoutData && $checkoutData['merchant_ord_id'] === $session->metadata->merchant_ord_id) {
                    DB::beginTransaction();
                    try {
                        $user = auth()->user();
                        $cartItems = collect($checkoutData['cart_items']);
                        $totalAmount = $checkoutData['total_amount'];

                        if ($user) {
                            // $user->update([
                            //     // 'name' => $checkoutData['user_first_name'],
                            //     'country' => $checkoutData['country'],
                            //     'address' => $checkoutData['address'],
                            //     'address2' => $checkoutData['address2'],
                            //     'towncity' => $checkoutData['towncity'],
                            //     'phone' => $checkoutData['phone'],
                            //     'email' => $checkoutData['email'],
                            // ]);
                        }

                        $order = Order::firstOrCreate(
                            ['order_number' => $checkoutData['merchant_ord_id']],
                            [
                                'unique_id' => $this->generateUniqueOrderId(),
                                'user_id' => $user ? $user->id : null,
                                'total_amount' => $totalAmount,
                                'payment_method' => 'stripe',
                                'status' => 'pending',
                            ]
                        );

                        // if ($order->wasRecentlyCreated) {
                        foreach ($cartItems as $item) {
                            OrderItem::create([
                                'order_id' => $order->id,
                                'product_id' => $item['product_id'],
                                // 'product_variant_id' => $item['variant_id'],
                                'game_id' => $item['game_user_id'] ?? null,
                                'server_id' => $item['game_server_id'] ?? null,
                                'user_name' => $item['game_user_name'] ?? null,
                                'email' => $item['game_email'] ?? null,
                                'quantity' => $item['quantity'],
                                'price' => $item['price'],
                                'delivery_method' => 'manual',
                            ]);
                        }

                        OrderHistory::create([
                            'order_id' => $order->id,
                            'user_id' => $user ? $user->id : null,
                            'status' => 'pending',
                            'notes' => 'Order placed via Stripe webhook',
                        ]);

                        Payment::create([
                            'order_id' => $order->id,
                            'amount' => $totalAmount,
                            'payment_gateway' => 'stripe',
                            'status' => 'completed',
                            'payment_id' => $session->payment_intent,
                        ]);

                        if ($user) {
                            $user->cartItems()->delete();
                        }
                        session()->forget('checkout_data');
                        // }

                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();

                        return response()->json(['status' => 'error'], 500);
                    }
                }
            }
        }

        return response()->json(['status' => 'success'], 200);
    }

    private function generateUniqueOrderId($length = 8)
    {
        do {
            $id = Str::random($length);
        } while (Order::where('unique_id', $id)->exists());

        return $id;
    }

    private function processCheckoutWalletOLD($totalAmount, $cartItems, $request)
    {
        $user = auth()->user();
        $cartTotal = $totalAmount;
        $useWallet = $request->has('use_wallet');
        $weeklySpent = getWeeklySpent($user->id);
        if (($weeklySpent + $cartTotal) > $user->weekly_limit) {
            return redirect()->back()->with([
                'error' => 'You have exceeded your weekly purchase limit.',
            ]);
        }
        $wallet = $user->wallet ?? Wallet::create(['user_id' => $user->id, 'balance' => $totalAmount]);
        $walletBalance = $wallet ? $wallet->balance : 0;

        $paidFromWallet = 0;
        $remainingToPay = $cartTotal;

        if ($walletBalance > 0) {
            if ($walletBalance >= $cartTotal) {
                $paidFromWallet = $cartTotal;
                $remainingToPay = 0;
            } else {
                $paidFromWallet = $walletBalance;
                $remainingToPay = $cartTotal - $walletBalance;
            }

            $wallet->transactions()->create([
                'type' => 'debit',
                'amount' => $paidFromWallet,
                'payment_method' => 'wallet',
                'description' => 'Used for order payment',
                'status' => 'approved',
            ]);
            $user->wallet_balance -= $totalAmount;
            $user->save();
        }

        // check

        try {

            DB::beginTransaction();

            $user = auth()->user();

            $orderNumber = $this->OrderIdNumber;

            $order = Order::create([
                'unique_id' => $this->generateUniqueOrderId(),
                'order_number' => $orderNumber,
                'user_id' => $user ? $user->id : null,
                'total_amount' => $totalAmount,
                'payment_method' => 'wallet',
                'status' => 'processing',
                'notes' => $request->notes,
            ]);

            OrderDetail::create([
                'order_id' => $order->id,
                'user_id' => $user ? $user->id : null,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'towncity' => $request->towncity,
                'country' => $request->country,
                'address' => $request->address,
                'address2' => $request->address2,
            ]);

            foreach ($cartItems as $item) {
                $order_item = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    // 'product_variant_id' => $item['variant_id'],
                    'game_id' => $item['game_user_id'] ?? null,
                    'server_id' => $item['game_server_id'] ?? null,
                    'user_name' => $item['game_user_name'] ?? null,
                    'email' => $item['game_email'] ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'delivery_method' => 'manual',
                ]);
                if ($order_item->product->type === 'gift_card' && ! $order->code_id) {
                    $this->giftCardCode($order_item->id);
                }
            }

            OrderHistory::create([
                'order_id' => $order->id,
                'user_id' => $user ? $user->id : null,
                'status' => 'pending',
                'notes' => 'Order placed after successful Wallet payment',
            ]);

            Payment::create([
                'order_id' => $order->id,
                'amount' => $totalAmount,
                'payment_gateway' => 'wallet',
                'status' => 'completed',
            ]);

            if ($user) {
                $user->cartItems()->delete();
            }
            session()->forget('checkout_data');

            DB::commit();

            return redirect()->route('front.home')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('checkout')->with('error', 'Something went wrong: '.$e->getMessage());
        }

        // Save order items...

        if ($remainingToPay > 0) {
            return redirect()->route('payment.gateway', ['order_id' => $order->id]);
        }

        return redirect()->route('order.success')->with('success', 'Order placed using wallet!');
    }

    private function processCheckoutWallet($grandTotal, $totalAmount, $cartItems, $request)
    {
        $user = auth()->user();
        $cartTotal = $totalAmount;
        $useWallet = $request->has('use_wallet');
        $weeklySpent = getWeeklySpent($user->id);
        $coupon_id = $request->coupon_id;
        if (($weeklySpent + $cartTotal) > $user->weekly_limit) {
            return redirect()->back()->with([
                'error' => 'You have exceeded your weekly purchase limit.',
            ]);
        }

        $wallet = $user->wallet ?? Wallet::create(['user_id' => $user->id, 'balance' => $cartTotal]);
        $walletBalance = $wallet ? $wallet->balance : 0;

        $paidFromWallet = 0;
        $remainingToPay = $cartTotal;

        if ($walletBalance > 0) {
            if ($walletBalance >= $cartTotal) {
                $paidFromWallet = $cartTotal;
                $remainingToPay = 0;
            } else {
                $paidFromWallet = $walletBalance;
                $remainingToPay = $cartTotal - $walletBalance;
            }

            $wallet->transactions()->create([
                'type' => 'debit',
                'amount' => $paidFromWallet,
                'payment_method' => 'wallet',
                'description' => 'Used for order payment',
                'status' => 'approved',
            ]);
            $user->wallet_balance -= $cartTotal;
            $user->save();
        }

        try {
            DB::beginTransaction();

            $orderNumber = $this->OrderIdNumber;

            // Create the order and save the coupon, discount, and grand_total
            $order = Order::create([
                'unique_id' => $this->generateUniqueOrderId(),
                'order_number' => $orderNumber,
                'user_id' => $user ? $user->id : null,
                'total_amount' => $cartTotal,
                'payment_method' => 'wallet',
                'status' => 'processing',
                'coupon_id' => $coupon_id ?? null, // Save coupon_id
                'discount_applied' => $cartTotal - $grandTotal,  // Discount applied
                'grand_total' => $grandTotal,  // Grand total after discount
                'notes' => $request->notes,
                'shipping_id' => $request->shipping,
            ]);

            OrderDetail::create([
                'order_id' => $order->id,
                'user_id' => $user ? $user->id : null,
                'name' => $request->name ?? '',
                'last_name' => $request->last_name ?? '',
                'email' => $request->email ?? '',
                'phone' => $request->phone ?? '',
                'towncity' => $request->towncity ?? '',
                'country' => $request->country ?? '',
                'address' => $request->address ?? '',
                'address2' => $request->address2 ?? '',

            ]);

            foreach ($cartItems as $item) {
                // $fields = $item->fields;
                $item_product = Product::find($item['product_id']);
                $OrderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    // 'product_variant_id' => $item['variant_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'delivery_method' => 'manual',
                    // 'fields' => $fields,
                    // 'source' => $item_product->source,
                ]);
                // $this->orderinAir($order->id, $order->order_number);
                // if ($OrderItem->product->source == 'M') {
                //     ProcessMooGoldOrder::dispatch($order, $OrderItem, $item);
                // }
            }
            if ($coupon_id) {
                $coupon = Coupon::find($coupon_id);
                if ($coupon) {
                    $coupon->used_count = $coupon->used_count ? $coupon->used_count + 1 : 1;
                    $coupon->save();
                }
            }
            if ($user) {
                $user->cartItems()->delete();
            } else {
                session()->forget('cart');
            }
            session()->forget('checkout_data');

            DB::commit();

            return redirect()->route('front.home')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('checkout')->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    private function processCheckoutCOD($grandTotal, $totalAmount, $cartItems, $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'towncity' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'postalcode' => 'required|string|max:20',
            'ship_different' => 'nullable|in:0,1',
            'shipping_address' => 'required_if:ship_different,1|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $bundlePlan = session('bundle_plan', []);
        $on_hold = session('on_hold');
        $bundlePlanPrice = $bundlePlan['price'] ?? 0;
        $addonPrice = 0.0;
        $subscription_subtotal = 0.0;
        $user = auth()->user();
        $coupon_id = $request->coupon_id;
        $points_redeemed = $request->points_redeemed ?? 0;
        $points_discount = $request->points_discount ?? 0;

        $shipping_address = (int) $request->ship_different === 1 ? $request->shipping_address : $request->address;

        foreach ($cartItems as $item) {
            $addonPrice += $item->addon_price ?? 0.0;
        }

        try {
            DB::beginTransaction();

            $orderNumber = $this->OrderIdNumber;

            // Validate points redemption
            $pointSetting = PointSetting::first();
            $rmPerPoint = $pointSetting ? $pointSetting->points_per_rm : 100;
            if ($points_redeemed > 0) {
                if ($user->reward_points < $points_redeemed) {
                    throw new \Exception('Insufficient reward points.');
                }
                $expectedDiscount = $points_redeemed / $rmPerPoint;
                if (abs($expectedDiscount - $points_discount) > 0.01) {
                    throw new \Exception('Invalid points discount calculation.');
                }
            }

            // Calculate subscription total
            if ($bundlePlan) {
                $subscription_subtotal = (($bundlePlan['type'] == 2 ? ($bundlePlanPrice * 12) : $bundlePlanPrice) + $addonPrice);
            }

            // Create the order
            $order = Order::create([
                'unique_id' => $this->generateUniqueOrderId(),
                'order_number' => $orderNumber,
                'type' => $request->has('order_type') ? $request->order_type : 0,
                'user_id' => $user ? $user->id : null,
                'total_amount' => $totalAmount,
                'payment_method' => 'cod',
                'status' => 'processing',
                'on_hold' => session('on_hold', 0),
                'coupon_id' => $coupon_id ?? null,
                'discount_applied' => $totalAmount - $grandTotal,
                'points_discount' => $points_discount,
                'grand_total' => $grandTotal,
                'subscription_total' => $subscription_subtotal,
                'shipping_id' => $request->shipping,
                'bundle_plan_name' => $bundlePlan['name'] ?? null,
                'bundle_plan_price' => $bundlePlanPrice,
                'plan_id' => $bundlePlan['plan_id'] ?? null,
                'total_addon_price' => $addonPrice,
                'shipping_cost' => $request->shipping_cost,
            ]);

            $Token = AccessToken::first();
            // Prepare API call to create order
            $curl = curl_init();
            $accessToken = $Token->access_token ?? '';

            // Determine if the order has multiple parcels
            $isMultiParcel = count($cartItems) > 1;

            $orderDetails = [
                'account_number' => '8800649634',
                'product_code' => '80000000',
                'item_type' => '1',
                'parcel' => 'domestic',
                'webhook' => true,
                'service_level' => 'Standard',
                'subscription_code' => 'ZERA001',
                'platform' => 'API',
                'mps' => $isMultiParcel, // Dynamically set based on cart items
                'reference' => [
                    'merchant_order_number' => 'BX-'.$order->order_number,
                    'merchant_reference_number' => 'ABC'.$order->order_number,
                ],
                'pickup' => [
                    'required' => true,
                    'timeslot' => [
                        'start_time' => '09:00',
                        'end_time' => '12:00',
                    ],
                ],
                'sender' => [
                    'name' => $request->name ?? 'Sender Name',
                    'phone_number' => $request->phone ?? '+6012345678',
                    'email' => $request->email ?? 'sender@email.com',
                    'address' => [
                        'address1' => $request->address ?? '10 Jalan Sultan Hishamuddin',
                        'address2' => $request->address2 ?? '',
                        'area' => 'Daya Bumi',
                        'city' => $request->towncity ?? 'Kuala Lumpur',
                        'state' => 'WP Kuala Lumpur',
                        'address_type' => 'Others',
                        'country' => 'MY',
                        'postcode' => '50050',
                    ],
                ],
                'receiver' => [
                    'name' => $request->name ?? 'Receiver Name',
                    'phone_number' => $request->phone ?? '+60123456789',
                    'email' => $request->email ?? 'receiver@email.com',
                    'address' => [
                        'address1' => $request->address ?? 'No.5 Jalan P16 1/2',
                        'address2' => $request->address2 ?? 'Presint 16',
                        'area' => 'Putrajaya',
                        'city' => $request->towncity ?? 'Putrajaya',
                        'state' => 'Selangor',
                        'address_type' => 'Home',
                        'country' => 'MY',
                        'postcode' => '16250',
                    ],
                ],
                'return_info' => [
                    'name' => $request->name ?? 'Receiver Name',
                    'phone_number' => $request->phone ?? '+60123456789',
                    'email' => $request->email ?? 'receiver@email.com',
                    'address' => [
                        'address1' => $request->address ?? 'No.5 Jalan P16 1/2',
                        'address2' => $request->address2 ?? 'Presint 16',
                        'area' => 'Putrajaya',
                        'city' => $request->towncity ?? 'Putrajaya',
                        'state' => 'Selangor',
                        'address_type' => 'Home',
                        'country' => 'MY',
                        'postcode' => 'BB47000',
                    ],
                ],
                'parcel_details' => array_map(function ($item) {
                    // $product = Product::find($item['product_id'] ?? ($item['product']['id'] ?? null));
                    $productId = $item->product_id ?? ($item->product->id ?? null);
                    $product = Product::find($productId);

                    return [
                        'weight' => (float) ($product->weight ?? 1), // Use product weight if available
                        'length' => (float) ($product->length ?? 0),
                        'width' => (float) ($product->width ?? 0),
                        'height' => (float) ($product->height ?? 0),
                        'item_count' => (int) ($item->quantity ?? 1),
                        'parcel_notes' => 'Text for details to be added',
                        'details' => [
                            [
                                'item_description' => $item->product->name ?? 'Item',
                                'quantity' => (int) ($item->quantity ?? 1),
                                'hscode' => '', // Empty for domestic shipment
                                'value' => (float) ($item->price ?? 25.1),
                            ],
                        ],
                    ];
                }, $cartItems->toArray()),
            ];

            // Log the API payload for debugging
            Log::info('API Payload: '.json_encode($orderDetails));

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api-dev.pos.com.my/api/order/v2.1/create',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($orderDetails),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$accessToken,
                ],
            ]);

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            // Log the API response for debugging
            Log::info('API Response: '.$response);

            // Accept both HTTP 200 and 201 as success
            if (! in_array($httpCode, [200, 201])) {
                throw new \Exception('Failed to create order via API: HTTP '.$httpCode.' - '.$response);
            }

            $apiResponse = json_decode($response, true);
            if (! is_array($apiResponse) || ! isset($apiResponse['message']) || $apiResponse['message'] !== 'success') {
                throw new \Exception('API order creation failed: '.($apiResponse['message'] ?? 'Unknown error').' - '.json_encode($apiResponse));
            }

            // Save API response data to the order
            $order->tracking_no = $apiResponse['data']['tracking_no'] ?? null;
            $order->child_tracking_no = json_encode($apiResponse['data']['child_tracking_no'] ?? []);
            $order->tracking_url = $apiResponse['data']['tracking_url'] ?? null;
            $order->consignment_jpeg = $apiResponse['data']['consignment']['jpeg'] ?? null;
            $order->consignment_pdf = $apiResponse['data']['consignment']['pdf'] ?? null;
            $order->consignment_zpl = $apiResponse['data']['consignment']['zpl'] ?? null;
            $order->routing_code = $apiResponse['data']['routing_code'] ?? null;
            $order->estimated_cost = $apiResponse['data']['estimated_cost'] ?? null;
            $order->total_weight = $apiResponse['data']['total_weight'] ?? null;
            $order->save();

            // Handle user subscription
            if (isset($user)) {
                $user_subscription = UserSubscriptionDetail::where('user_id', $user->id)->first();
                if (! empty($user_subscription)) {
                    $user_subscription->bundle_plan_name = $bundlePlan['name'] ?? null;
                    $user_subscription->bundle_plan_price = $bundlePlan['price'] ?? 0;
                    $user_subscription->plan_id = $bundlePlan['plan_id'] ?? null;
                    $user_subscription->renewal_date = $bundlePlan['renewal_date'] ?? null;
                    $user_subscription->save();
                }
            }

            // Save order detail (address, contact info)
            OrderDetail::create([
                'order_id' => $order->id,
                'user_id' => $user ? $user->id : null,
                'name' => $request->name ?? '',
                'last_name' => $request->last_name ?? '',
                'email' => $request->email ?? '',
                'phone' => $request->phone ?? '',
                'towncity' => $request->towncity ?? '',
                'country' => $request->country ?? '',
                'address' => $request->address ?? '',
                'address2' => $request->address2 ?? '',
                'shipping_address' => $shipping_address ?? '',
            ]);

            // Save each cart item as an order item and log points
            $totalPoints = 0;
            foreach ($cartItems as $item) {
                $product_id = $item->product->id ?? $item['product_id'];
                $attributes = $item->attributes;
                $quantity = $item->quantity ?? $item['quantity'];
                $price = $item->price ?? $item['price'];
                $product = Product::find($product_id);

                if ($product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product_id,
                        'attributes' => $attributes ? json_encode($attributes) : null,
                        'quantity' => $quantity,
                        'price' => $price,
                        'addon_price' => $item->addon_price ?? 0,
                        'delivery_method' => 'manual',
                    ]);
                    // Log points earned for each product
                    $points_earned = $product->points * $quantity;
                    $totalPoints += $points_earned;

                    if ($user && $points_earned > 0) {
                        if (auth()->user()->subscription_status == 1) {
                            ProductOrderPointLog::create([
                                'user_id' => $user->id,
                                'order_id' => $order->id,
                                'product_id' => $product_id,
                                'points_earned' => $points_earned,
                                'status' => 'earned',
                            ]);
                        }
                    }

                    $product->qty -= $quantity;
                    $product->save();

                    if (! empty($attributes)) {
                        foreach ($attributes as $attr) {
                            $attribute = ProductAttribute::where('product_id', $product_id)
                                ->where('attribute_id', $attr['id'])
                                ->where('attribute_value', $attr['value'])
                                ->first();

                            if ($attribute) {
                                $attribute->qty -= $quantity;
                                $attribute->save();
                            }
                        }
                    }
                }
            }

            // Log redeemed points and update user points
            if ($user && $points_redeemed > 0) {
                if (auth()->user()->subscription_status == 1) {
                    ProductOrderPointLog::create([
                        'user_id' => $user->id,
                        'order_id' => $order->id,
                        'product_id' => null,
                        'points_earned' => $points_redeemed,
                        'status' => 'redeemed',
                    ]);
                }

                $user->reward_points -= $points_redeemed;
                $user->redeemed_points = ($user->redeemed_points ?? 0) + $points_redeemed;
                $user->save();
            }

            // Update user's reward points for earned points
            if ($user && $totalPoints > 0) {
                $user->reward_points += $totalPoints;
                $user->save();
            }

            // Mark coupon as used
            if ($coupon_id) {
                $coupon = Coupon::find($coupon_id);
                if ($coupon) {
                    $coupon->used_count = $coupon->used_count ? $coupon->used_count + 1 : 1;
                    $coupon->save();
                }
            }

            // Clear user's cart
            if ($user) {
                $user->cartItems()->delete();
            } else {
                session()->forget('cart');
            }

            session()->forget('checkout_data');
            session()->forget('on_hold');
            session()->forget('bundle_plan');

            DB::commit();

            $orderItems = OrderItem::where('order_id', $order->id)->get();
            $orderDetails = OrderDetail::where('order_id', $order->id)->first();

            try {
                Mail::to($orderDetails->email)->send(
                    OrderConfirmationMail($order, $orderDetails, $orderItems)
                );
            } catch (\Exception $mailException) {
                Log::error('Order confirmation email failed: '.$mailException->getMessage());
            }

            return view('front.thankyou', [
                'order' => $order,
                'orderDetails' => $orderDetails,
                'orderItems' => $orderItems,
                'success' => 'Order placed successfully using Cash on Delivery!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout COD Error: '.$e->getMessage());

            return redirect()->route('checkout')->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    private function giftCardCode($orderId)
    {
        $order_item = OrderItem::findOrFail($orderId);

        $code = GiftCardCode::where('product_id', $order_item->product_id)->where('variant_id', $order_item->product_variant_id)
            ->where('status', 'unused')
            ->first();

        if ($code) {
            $order_item->code_id = $code->id;
            $order_item->delivery_status = 'code_assigned';
            $order_item->save();

            $code->used_date = now();
            $code->status = 'used';
            $code->save();
        } else {
            $order_item->delivery_status = 'pending_code';
            $order_item->save();

            Log::warning("No gift card code available for Order #{$order_item->id}");
        }
    }

    public function orderinAir($orderid, $orderNumber)
    {
        $orderItems = OrderItem::select('product_id', 'fields', 'id', 'quantity', 'product_variant_id')->where('order_id', $orderid)->get();
        foreach ($orderItems as $oi) {
            $product = Product::select('products.source', 'products.source_id', 'product_variants.source_id as variant_source_id', 'product_variants.sku', 'product_variants.name')
                ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
                ->where('products.id', $oi->product_id)->where('product_variants.id', $oi->product_variant_id)
                ->first();
            $fields = $oi->fields;

            if (isset($product)) {
                Log::info(['product->source:- ' => $product->source]);
                switch ($product->source) {
                    case 'S':
                        $body = [
                            'user_data' => $this->synnData($oi->fields),
                            'slug' => $product->source_id,
                            'product_type_id' => $product->variant_source_id,
                        ];
                        Log::info(['synnOrder:- ' => $body]);

                        $response = $this->synnOrder($body);
                        Log::info(['synnOrder response:- ' => $response]);

                        $oi->response = $response;
                        $oi->update();
                        break;

                    case 'A':
                        $body = [
                            'product_code' => $product->sku,
                            'referenceNumber' => $orderNumber,
                            'data' => $this->acidData($fields),
                            'telp' => '082113664006',
                            'callback_url' => '',
                        ];
                        Log::info(['acidOrder:- ' => $body]);
                        Log::info(['product:- ' => $product]);

                        $response = $this->acidOrder($body);
                        Log::info(['acidOrder response:- ' => $response]);

                        $oi->response = $response;
                        $oi->update();
                        break;

                    case 'M':
                        $moogold = new \App\Services\MooGoldService;
                        $body = [
                            'category' => '1',
                            'product-id' => $product->source_id,
                            'quantity' => $oi->quantity,
                        ];
                        array_push($body, $this->moogoldData($oi->fields));
                        Log::info(['moogoldOrder:- ' => $body]);

                        $response = $moogold->createOrder($body, $orderNumber);
                        $oi->response = $response;
                        $oi->update();
                        Log::info(['moogoldOrder response:- ' => $response]);

                        break;
                }
            }
        }
    }

    private function synnData($json)
    {
        $data = json_decode($json, true);
        $result = [];
        foreach ($data as $item) {
            foreach ($item as $key => $value) {
                $result[] = [
                    'name' => str_replace('-', '_', $key),
                    'value' => $value,
                ];
            }
        }

        return json_encode($result, JSON_UNESCAPED_SLASHES);
    }

    private function acidData($json)
    {
        $data = json_decode($json, true);

        return implode('|', array_column($data, array_key_first($data[0])));
    }

    private function moogoldData($json)
    {
        $data = json_decode($json, true);
        $result = [];
        foreach ($data as $item) {
            foreach ($item as $key => $value) {
                $formattedKey = ucwords(str_replace('-', ' ', $key));
                $result[$formattedKey] = (int) $value;
            }
        }

        return $result;
    }

    private function synnOrder($body)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_INTERFACE, '217.21.95.211');
        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://synnmlbb.com/api/v1/transaction',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => ['x-user-key: mdh0NIXRgPSixriu3LL8'],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    private function acidOrder($body)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.acidgameshop.com/api/order',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'X-API-KEY: 9876535345melpadigitalx',
                'Authorization: Bearer 7DMp3FnNTPmrQ8s2HEkALLKJ5cGzyS4H0lSf3ubB',
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $resp = json_decode($response, true);

        return $resp;
    }

    public function thankyou()
    {
        return view('front.thankyou');
    }
}
