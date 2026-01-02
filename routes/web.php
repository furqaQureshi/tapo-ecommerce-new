<?php

use App\Models\User;
use Razorpay\Api\Api;
use GuzzleHttp\Client;
use App\Models\Product;
use App\Models\OrderItem;
use App\Services\RazorpayApi;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use GuzzleHttp\Exception\ClientException;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ApiTestingController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Front\ReviewController;
use App\Http\Controllers\Front\WalletController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Front\AccountController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\APIServiceController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Front\OnboardingController;
use App\Http\Controllers\Admin\ManageOrderController;
use App\Http\Controllers\Admin\SalesReportController;
use App\Http\Controllers\Admin\WalletTopupController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\GiftCardCodeController;
use App\Http\Controllers\Admin\PointSettingController;
use App\Http\Controllers\Admin\ProductBundleController;
use App\Http\Controllers\Admin\MonthlyProductController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Admin\SubscriptionPlanController;
use App\Http\Controllers\Front\BlogController as FrontBlogController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Http\Controllers\Admin\FreeShippingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/create-subscription', function () {
    $key_id = "rzp_test_RD1RQWUJvlpT8m";
    $key_secret = "w2PSFm4EVxkzRHpG1r4DIkkN";

    $response = Http::withBasicAuth($key_id, $key_secret)
        ->withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->post('https://api.razorpay.com/v1/subscriptions', [
            "plan_id" => "plan_RO6yEGPhsH1FGC", // <-- REAL plan_id
            "total_count" => 6,
            "start_at" => now()->addMinutes(5)->timestamp, // abhi se 5 min baad start
            "notes" => [
                "name" => "Subscription B",
            ],
        ]);


    // response ko return karenge as JSON
    return response()->json($response->json());
});


Route::get('/create-plan', function () {
    $api = new Api(
        env('RAZORPAY_KEY'),
        env('RAZORPAY_SECRET')
    );

    try {
        $plan = $api->plan->create([
            'period' => 'monthly',
            'interval' => 1,
            'item' => [
                'name' => 'Test Plan',
                'description' => 'Save up to 5.85% per month',
                'amount' => 3700,
                'currency' => 'MYR'
            ],
            'notes' => [
                'key1' => 'value3',
                'key2' => 'value2'
            ]
        ]);

        return response()->json([
            'success' => true,
            'plan' => $plan->toArray()
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
})->name('create.plan');

Route::get('/test-razorpay', function () {
    $api = new RazorpayApi(config('services.razorpay.key'), config('services.razorpay.secret'));
    try {
        $customer = $api->customer->create([
            'name' => 'Test Customer',
            'email' => 'test@example.com',
            'contact' => '1234567890',
            'fail_existing' => '0'
        ]);
        Log::info('Customer Created', ['customer' => $customer->toArray()]);
        dd($customer->toArray());
    } catch (\Razorpay\Api\Errors\Error $e) {
        Log::error('Customer Creation Error', [
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'http_status' => $e->getHttpStatusCode(),
            'field' => $e->getField(),
            'description' => $e->getDescription()
        ]);
        dd(['error' => $e->getMessage(), 'http_status' => $e->getHttpStatusCode()]);
    }
});
Route::get('/onboarding', [OnboardingController::class, 'show'])->name('onboarding.show');
Route::post('/onboarding', [OnboardingController::class, 'store'])->name('onboarding.store');
Route::get('curlec-checkout', function () {
    $client = new Client();
    $headers = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
        'Authorization' => 'Basic cnpwX3Rlc3RfUkQxUlFXVUp2bHBUOG06dzJQU0ZtNEVWeGt6UkhwRzFyNERJa2tO'
    ];
    $body = [
        'amount' => 5200,
        'currency' => 'MYR',
        'receipt' => 'Receipt no. 2',
        'notes' => [
            'notes_key_1' => 'Tea, Earl Grey, Hot',
            'notes_key_2' => 'Tea, Earl Grey… decaf.'
        ]
    ];

    try {
        $request = new \GuzzleHttp\Psr7\Request('POST', 'https://api.razorpay.com/v1/orders', $headers, json_encode($body));
        $response = $client->send($request);
        return $response->getBody()->getContents();
    } catch (ClientException $e) {
        // Log full response details
        $response = $e->getResponse();
        return response()->json([
            'error' => $e->getMessage(),
            'status_code' => $response->getStatusCode(),
            'response_body' => $response->getBody()->getContents(),
            'response_headers' => $response->getHeaders()
        ], $response->getStatusCode());
    } catch (\Exception $e) {
        return response()->json(['error' => 'Unexpected error: ' . $e->getMessage()], 500);
    }
});
Route::get('/blogs', [FrontBlogController::class, 'list'])->name('front.blog.list');
Route::get('/blog/{id}', [FrontBlogController::class, 'show'])->name('front.blog.show');

// Route::get('/', [HomeController::class, 'index'])->name('front.home');
Route::match(['get', 'head'], '/', [HomeController::class, 'index'])->name('front.home');
Route::get('/terms-of-service', [HomeController::class, 'terms_conditions'])->name('terms.conditions');
Route::get('cart-view', function () {
    return     session('cart', []);
});
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'bm', 'zh'])) {
        session(['locale' => $locale]);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('synn-detail-transaction', function () {
    $invoice = "SYNNAPI9334876825";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_INTERFACE, "217.21.95.211");

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://www.synnmlbb.com/api/v1/detail-transaction',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode([
            'invoice' => $invoice
        ]),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'x-user-key: mdh0NIXRgPSixriu3LL8'
        ]
    ]);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        return ['error' => curl_error($curl)];
    }

    curl_close($curl);

    return json_decode($response, true);
});

Route::get('acidgames-top-products', function () {
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'X-API-KEY' => '9876535345melpadigitalx',
        'Authorization' => 'Bearer 7DMp3FnNTPmrQ8s2HEkALLKJ5cGzyS4H0lSf3ubB'
    ])->post('https://api.acidgameshop.com/api/product', [
        // sandbox => false by default, isliye parameter nahi bhej rahe
    ]);

    if ($response->failed()) {
        return response()->json([
            'error' => true,
            'message' => 'Failed to fetch products',
            'details' => $response->json()
        ], $response->status());
    }

    $products = $response->json();

    // Sirf top 5 products return karo
    return array_slice($products, 0, 5);
});

Route::get('place-order-aciggames', function () {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.acidgameshop.com/api/order",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode([
            'product_code' => '45-405',
            'referenceNumber' => 'ZEEM100062',
            'data' => '090067800',
            'telp' => '082113664006',
            'callback_url' => ''
        ]),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'X-API-KEY: 9876535345melpadigitalx',
            'Authorization: Bearer 7DMp3FnNTPmrQ8s2HEkALLKJ5cGzyS4H0lSf3ubB'
        ]
    ]);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        return ['error' => curl_error($curl)];
    }

    curl_close($curl);

    return json_decode($response, true);
});

Route::get('/run-migrate', function () {
    try {
        Artisan::call('migrate', ['--force' => true]); // --force avoids confirmation in production
        return 'Migration run successfully: <br><pre>' . Artisan::output() . '</pre>';
    } catch (\Exception $e) {
        return 'Migration failed: ' . $e->getMessage();
    }
})->name('artisan.migrate');

Route::get('/run-migrate-specific', function () {
    try {
        Artisan::call('migrate', [
            '--path'  => 'database/migrations/2025_09_08_162916_add_variant_qty_col_to_product_variants_table.php',
            '--force' => true
        ]);

        return 'Specific migration run successfully: <br><pre>' . Artisan::output() . '</pre>';
    } catch (\Exception $e) {
        return 'Migration failed: ' . $e->getMessage();
    }
})->name('artisan.migrate.specific');

Route::get('/artisan/{command}', function ($command) {
    $allowedCommands = [
        'storage-link' => 'storage:link',
        'cache-clear' => 'cache:clear',
        'config-clear' => 'config:clear',
        'config-cache' => 'config:cache',
        'route-clear' => 'route:clear',
        'route-cache' => 'route:cache',
        'view-clear' => 'view:clear',
        'permission-cache-reset' => 'permission:cache-reset',
        'optimize' => 'optimize',
        'migrate' => 'migrate',
        'migrate-refresh' => 'migrate:refresh',
        'migrate-rollback' => 'migrate:rollback',
        'db-seed' => 'db:seed',
        'queue-work' => 'queue:work',
        'queue-restart' => 'queue:restart',
        'synn-update-transactions' => 'synn:update-transactions',
    ];

    if (!array_key_exists($command, $allowedCommands)) {
        abort(403, 'Command not allowed.');
    }

    Artisan::call($allowedCommands[$command]);
    return response()->json(['status' => 'success', 'message' => 'Command executed: ' . $allowedCommands[$command]]);
});
// Route::get('/home', [HomeController::class, 'index'])->name('front.home');
Route::get('/about', [HomeController::class, 'about'])->name('front.about');


Route::get('/{month}/products', [HomeController::class, 'monthly_products_page'])->name('monthly-product.page');
Route::get('/subscribe-petit', [HomeController::class, 'subscribePetit'])->name('subscribe-petit');
Route::get('/subscriber-form', [HomeController::class, 'subscriberForm'])->name('subscriber-form')->middleware(['auth', 'check.subscription']);
Route::post('/subscriber-form', [HomeController::class, 'saveSubscriberForm'])->name('subscriber-form-submit');
Route::post('/subscriber-form/{id}', [HomeController::class, 'updateSubscriberForm'])->name('subscriber-form-update');
Route::get('/choose-product', [HomeController::class, 'chooseProducts'])->name('choose-products')->middleware('auth');
Route::get('/choose-next-month-products', [HomeController::class, 'chooseNextMonthProducts'])->name('choose-next-month-products');
Route::get('/products', [HomeController::class, 'shop'])->name('front.shop');
Route::get('/category/{unique_id}/{slug}', [HomeController::class, 'category'])->name('front.category');
Route::get('/contact', [HomeController::class, 'contact'])->name('front.contact');
Route::get('/product/{slug}', [FrontProductController::class, 'show'])->name('product.detail');
Route::get('/product-search-suggestions', [FrontProductController::class, 'autocomplete'])->name('product.autocomplete');
Route::get('/shop/filters', [FrontProductController::class, 'ajaxFilter'])->name('filter.products');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('front.cart');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/checkout', [CartController   ::class, 'checkout'])->name('cart.checkout');
Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('coupon.apply');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/bundle-to-cart', [CartController::class, 'addBundleToCart'])->name('bundle.to.cart');
Route::get('/bundle-checkout', [OrderController::class, 'bundleCheckout'])->name('bundle-checkout');
Route::post('/checkout/shipping', [OrderController::class, 'calculateShipping'])->name('checkout.calculateShipping');
Route::post('/checkout/process', [OrderController::class, 'processCheckout'])->name('checkout.process');
Route::post('/checkout', [HomeController::class, 'checkoutPost'])->name('checkout.save');
Route::get('/payment/return', [OrderController::class, 'handlePaymentReturn'])->name('payment.return');
Route::post('/payment/callback', [OrderController::class, 'handlePaymentCallback'])->name('payment.callback');
Route::post('/webhook/stripe', [OrderController::class, 'handleWebhook'])->name('webhook.stripe');
Route::get('/payment/success', [OrderController::class, 'handlePaymentSuccess'])->name('payment.success');
Route::get('/payment/p/success', [OrderController::class, 'payForSubscription'])->name('p.success');
Route::post('/curlec/payment/success', [OrderController::class, 'success'])->name('curlec.payment.success');
Route::get('/order/invoice/{unique_id}', [ManageOrderController::class, 'generateInvoice'])->name('user.order.invoice');
Route::get('/order/invoice/download/{unique_id}', [ManageOrderController::class, 'downloadInvoice'])->name('user.order.invoice.download');
Route::get('/get-cities/{state}', [OrderController::class, 'getCities'])->name('get.cities');


Route::post('c/payment/success', [OrderController::class, 'curlec_success'])->name('curlec_success.success');
Route::get('order/success', function () {
    return view('front.payment.order-success'); // Adjust as needed
})->name('order.success');
Route::get('/thank-you', [OrderController::class, 'thankyou'])->name('thankyou');

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
// Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('redirectToGoogle');

// Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Auth::routes();


Auth::routes(['verify' => true]);
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $user = User::find(auth()->user()->id);

    if ($user) {
        $user->email_verified_at = date('now');
        $user->save();

        Auth::logout();
        return redirect()->route('login')->with('success', 'Email Verified Successfully. Please login now.');
    }
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/my-account', [AccountController::class, 'index'])->name('myaccount');
Route::post('/subscriptions/cancellation/{user_id}', [UserController::class, 'cancelSubscription'])->name('user.subscription.cancellation');
Route::post('/account-update/{id}', [AccountController::class, 'update'])->name('user.updateProfile');
Route::get('/order/detail/{id}', [AccountController::class, 'order_detail'])->name('user.order.details');
Route::get('/order/list/data', [AccountController::class, 'getOrderList'])->name('order.get.data');
Route::get('/reward-points/data', [AccountController::class, 'getRewardPointsData'])
    ->name('reward.points.data')
    ->middleware('auth');

Route::post('/notifications/read/{id}', [AccountController::class, 'markAsRead'])
    ->name('notifications.read');

// wallet
Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
Route::post('/wallet/topup', [WalletController::class, 'topUp'])->name('wallet.topup');
Route::get('/wallet/stripe/success', [WalletController::class, 'handleStripeSuccess'])->name('wallet.stripe.success');
Route::get('/wallet/paydibs/success', [WalletController::class, 'handlePaydibsSuccess'])->name('wallet.paydibs.success');
Route::get('/wallet/transactions/data', [WalletController::class, 'getWalletTransactions'])->name('wallet.transactions.data');

Route::group(['middleware' => ['auth', 'verified']], function () {});
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
Route::get('/admin/footer', [FooterController::class, 'index'])->name('admin.footer.index');
Route::post('/admin/footer', [FooterController::class, 'store'])->name('admin.footer.store');
Route::put('/admin/footer/{id}', [FooterController::class, 'update'])->name('admin.footer.update');
Route::delete('/admin/footer/{id}', [FooterController::class, 'destroy'])->name('admin.footer.destroy');
Route::get('/footer-data', [FooterController::class, 'getFooterData'])->name('footer.data');
Route::post('/refund-request', [RefundController::class, 'requestRefund'])->name('refund.request.store');
Route::post('admin/upload-image', [BlogController::class, 'uploadImage'])->name('admin.upload.image');


Route::get('/admin/language', [LanguageController::class, 'index'])->name('admin.lang.index');
Route::post('/admin/language/update', [LanguageController::class, 'update'])->name('admin.lang.update');



// Admin routes with 'admin' prefix
Route::prefix('account')->group(function () {


    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
        Route::post('/customerRegister', [HomeController::class, 'customerRegister'])->name('customerRegister');
    });
    // GOOGLE
    // LOGIN WITH GOOGLE
    Route::get('login/google', [SocialController::class, 'redirectToGoogle'])
        ->name('login.google');

    Route::get('callback/google', [SocialController::class, 'handleGoogleCallback'])
    ->name('callback.google');

    Route::get('/settings/free-shipping-data', [FreeShippingController::class, 'freeShippingData'])->name('admin.settings.free-shipping.index');
    Route::get('settings/free-shipping', [FreeShippingController::class, 'list'])->name('admin.free-shipping');
    Route::get('settings/free-shipping/create', [FreeShippingController::class, 'create'])->name('admin.free-shipping.create');

    Route::get('settings/free-shipping/{id}/edit', [FreeShippingController::class, 'edit'])->name('admin.free-shipping.create');
    Route::post('settings/free-shipping', [FreeShippingController::class, 'update'])->name('admin.settings.free-shipping.update');

    // FACEBOOK
    // Route::get('login/facebook', [SocialController::class, 'redirectToFacebook'])->name('login.facebook');
    // Route::get('callback/facebook', [SocialController::class, 'handleFacebookCallback'])->name('callback.facebook');

    Route::post('product/delete-image', [ProductController::class, 'deleteImage'])->name('admin.product.delete-image');
    Route::get('blog-categories', [BlogCategoryController::class, 'index'])->name('admin.blogcategories.index');
    Route::get('blog-categories/get', [BlogCategoryController::class, 'getCategories'])->name('admin.blogcategories.get');
    Route::get('blog-category/add', [BlogCategoryController::class, 'create'])->name('admin.blogcategory.add');
    Route::post('blog-category', [BlogCategoryController::class, 'store'])->name('admin.blogcategory.store');
    Route::get('blog-category/{id}/edit', [BlogCategoryController::class, 'edit'])->name('admin.blogcategory.edit');
    Route::put('blog-category/{id}', [BlogCategoryController::class, 'update'])->name('admin.blogcategory.update');
    Route::delete('blog-category/{id}', [BlogCategoryController::class, 'destroy'])->name('admin.blogcategory.destroy');
    Route::post('blog-category/{id}/status', [BlogCategoryController::class, 'updateStatus'])->name('admin.blogcategory.status');

    // Blogs
    Route::get('blogs', [BlogController::class, 'index'])->name('admin.blogs.index');
    Route::get('blogs/get', [BlogController::class, 'getBlogs'])->name('admin.blogs.get');
    Route::get('blog/add', [BlogController::class, 'create'])->name('admin.blog.add');
    Route::post('blog', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('blog/{id}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('blog/{id}', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('blog/{id}', [BlogController::class, 'destroy'])->name('admin.blog.destroy');
    Route::post('blog/{id}/status', [BlogController::class, 'updateStatus'])->name('admin.blog.status');

    Route::middleware(['auth', 'role:admin|staff', 'global.permission'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        // logs routes
        Route::get('logs', [LogController::class, 'list'])->name('admin.logs.list');
        Route::get('logs/get', [LogController::class, 'get'])->name('admin.logs.get');



        // category routes
        Route::get('/categories', [CategoryController::class, 'list'])->name('admin.categories.list');
        Route::get('/categories/get', [CategoryController::class, 'get'])->name('admin.categories.get');
        Route::prefix('category')->group(function () {
            Route::get('/add', [CategoryController::class, 'add'])->name('admin.category.add');
            Route::post('/store', [CategoryController::class, 'store'])->name('admin.category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
            Route::post('/status/{id}', [CategoryController::class, 'status'])->name('admin.category.status');
            Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        });

        // category routes
        Route::get('/attributes', [AttributeController::class, 'list'])->name('admin.attributes.list');
        Route::get('/attributes/get', [AttributeController::class, 'get'])->name('admin.attributes.get');
        Route::prefix('attribute')->group(function () {
            Route::get('/add', [AttributeController::class, 'create'])->name('admin.attribute.add');
            Route::post('/store', [AttributeController::class, 'store'])->name('admin.attribute.store');
            Route::get('/edit/{id}', [AttributeController::class, 'edit'])->name('admin.attribute.edit');
            Route::put('/update/{id}', [AttributeController::class, 'update'])->name('admin.attribute.update');
            Route::post('/status/{id}', [AttributeController::class, 'status'])->name('admin.attribute.status');
            Route::delete('/delete/{id}', [AttributeController::class, 'destroy'])->name('admin.attribute.destroy');
        });

        // tickets
        Route::get('/tickets', [TicketController::class, 'list'])->name('admin.tickets.list');
        Route::get('/tickets/get', [TicketController::class, 'get'])->name('admin.tickets.get');
        Route::prefix('ticket')->group(function () {
            Route::get('/add', [TicketController::class, 'create'])->name('admin.ticket.add');
            Route::post('/store', [TicketController::class, 'store'])->name('admin.ticket.store');
            Route::get('/edit/{id}', [TicketController::class, 'edit'])->name('admin.ticket.edit');
            Route::put('/update/{id}', [TicketController::class, 'update'])->name('admin.ticket.update');
            Route::post('/status/{id}', [TicketController::class, 'status'])->name('admin.ticket.status');
            Route::delete('/delete/{id}', [TicketController::class, 'destroy'])->name('admin.ticket.destroy');
        });

        // subscribers
        Route::get('/subscribers', [UserController::class, 'subscriber_list'])->name('admin.subscriber.index');
        Route::get('/subscribers/get', [UserController::class, 'get_subscribers'])->name('admin.subscriber.get');
        Route::get('/subscriptions', [UserController::class, 'subscriptions_list'])->name('admin.subscription.index');
        Route::get('/subscriptions/get', [UserController::class, 'get_subscriptions'])->name('admin.subscription.get');
        Route::post('/subscriptions/reminder/{user_id}', [UserController::class, 'sendReminder'])->name('admin.subscription.reminder');
        Route::post('/subscriptions/cancellation/{user_id}', [UserController::class, 'cancelSubscription'])->name('admin.subscription.cancellation');
        Route::post('/subscriptions/cancel/{user_id}', [UserController::class, 'sendCancellationMail'])->name('admin.subscription.cancellation.mail');
        Route::post('/subscriptions/renew/{user_id}', [UserController::class, 'renewSubscription'])->name('admin.subscription.renew');
        Route::post('/subscriptions/renewal/{user_id}', [UserController::class, 'sendRenewalMail'])->name('admin.subscription.renewal.mail');
        Route::get('/subscriptions/order/create/{user_id}', [UserController::class, 'create_subscription_order'])->name('admin.subscriber.order.create');

        // products routes
        Route::get('/products/list', [ProductController::class, 'list'])->name('admin.products.list');
        Route::get('/products/get', [ProductController::class, 'get'])->name('admin.products.get');
        Route::prefix('product')->group(function () {
            Route::get('/add', [ProductController::class, 'add'])->name('admin.product.add');
            Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
            Route::post('/status/{id}', [ProductController::class, 'status'])->name('admin.product.status');
            Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
        });
        Route::post('save-product-margin', [ProductController::class, 'setProductMargin'])->name('setProductMargin');
        // coupons routes

        Route::get('/coupons', [CouponController::class, 'list'])->name('admin.coupon.index');
        Route::get('/coupons/get', [CouponController::class, 'get'])->name('admin.coupon.get');
        Route::get('/get-variants-by-products', [CouponController::class, 'getVariantsByProducts'])->name('admin.code.variantsByProducts');
        Route::prefix('coupon')->group(function () {
            Route::get('/add', [CouponController::class, 'add'])->name('admin.coupon.add');
            Route::post('/store', [CouponController::class, 'store'])->name('admin.coupon.store');
            Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('admin.coupon.edit');
            Route::put('/update/{id}', [CouponController::class, 'update'])->name('admin.coupon.update');
            Route::post('/status/{id}', [CouponController::class, 'status'])->name('admin.coupon.status');
            Route::delete('/delete/{id}', [CouponController::class, 'destroy'])->name('admin.coupon.destroy');
            Route::post('/bulk', [CouponController::class, 'bulkAction'])->name('admin.coupon.bulk');
        });

        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::get('/profile-settings', [ProfileController::class, 'settings'])->name('admin.profile.settings');
        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');

        // user management
        Route::get('/users', [StaffController::class, 'list'])->name('admin.users.list');
        Route::get('/users/get', [StaffController::class, 'get'])->name('admin.users.get');
        Route::prefix('user')->group(function () {
            Route::get('/add', [StaffController::class, 'add'])->name('admin.user.add');
            Route::post('/store', [StaffController::class, 'store'])->name('admin.user.store');
            Route::get('/edit/{id}', [StaffController::class, 'edit'])->name('admin.user.edit');
            Route::get('/view/{id}', [StaffController::class, 'view'])->name('admin.user.view');
            Route::put('/update/{id}', [StaffController::class, 'update'])->name('admin.user.update');
            Route::post('/status/{id}', [StaffController::class, 'status'])->name('admin.user.status');
            Route::delete('/delete/{id}', [StaffController::class, 'destroy'])->name('admin.user.destroy');
            Route::post('/{id}/change-password', [UserController::class, 'changePassword'])->name('admin.users.change-password')->middleware('throttle:5,60');
        });

        // subsciption plans
        Route::get('/subscription-plan', [SubscriptionPlanController::class, 'list'])->name('admin.subscription-plan.list');
        Route::get('/subscription-plan/get', [SubscriptionPlanController::class, 'get'])->name('admin.subscription-plan.get');
        Route::prefix('subscription-plan')->group(function () {
            Route::get('/add', [SubscriptionPlanController::class, 'add'])->name('admin.subscription-plan.add');
            Route::post('/store', [SubscriptionPlanController::class, 'store'])->name('admin.subscription-plan.store');
            Route::get('/edit/{id}', [SubscriptionPlanController::class, 'edit'])->name('admin.subscription-plan.edit');
            Route::get('/view/{id}', [SubscriptionPlanController::class, 'view'])->name('admin.subscription-plan.view');
            Route::put('/update/{id}', [SubscriptionPlanController::class, 'update'])->name('admin.subscription-plan.update');
            Route::post('/status/{id}', [SubscriptionPlanController::class, 'status'])->name('admin.subscription-plan.status');
            Route::delete('/delete/{id}', [SubscriptionPlanController::class, 'destroy'])->name('admin.subscription-plan.destroy');
        });
        // customer management
        Route::get('/customers', [UserController::class, 'list'])->name('admin.customers.list');
        Route::get('/customers/get', [UserController::class, 'get'])->name('admin.customers.get');
        Route::prefix('customer')->group(function () {
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.customer.edit');
            Route::get('/view/{id}', [UserController::class, 'view'])->name('admin.customer.view');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('admin.customer.update');
            Route::post('/status/{id}', [UserController::class, 'status'])->name('admin.customer.status');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('admin.customer.destroy');
            Route::post('/toggle-suspend', [UserController::class, 'toggleSuspend'])->name('admin.customer.toggle_suspend');
            Route::post('/add-balance', [UserController::class, 'addBalance'])->name('admin.customer.add_balance');
            Route::post('/user/update-weekly-limit', [UserController::class, 'updateWeeklyLimit'])->name('customer.updateWeeklyLimit');
            Route::get('/transactions', [UserController::class, 'fetchTransactions'])->name('admin.customer.transactions');
        });
        // Permissions management
        Route::get('/permissions', [PermissionController::class, 'list'])->name('admin.permissions.list');
        Route::get('/permissions/get', [PermissionController::class, 'get'])->name('admin.permissions.get');
        Route::get('/permissions/manage/{role}', [PermissionController::class, 'manage'])->name('admin.permissions.manage');
        Route::put('/permissions/update/{role}', [PermissionController::class, 'update'])->name('admin.permissions.update');
        // gift card inventory management
        Route::get('/gift-card-codes', [GiftCardCodeController::class, 'list'])->name('admin.code.list');
        Route::get('/gift-card-codes/get', [GiftCardCodeController::class, 'get'])->name('admin.code.get');
        Route::prefix('gift-card-code')->group(function () {
            Route::get('/add', [GiftCardCodeController::class, 'add'])->name('admin.code.add');
            Route::post('/store', [GiftCardCodeController::class, 'store'])->name('admin.code.store');
            Route::get('/edit/{id}', [GiftCardCodeController::class, 'edit'])->name('admin.code.edit');
            Route::put('/update/{id}', [GiftCardCodeController::class, 'update'])->name('admin.code.update');
            Route::post('/status/{id}', [GiftCardCodeController::class, 'status'])->name('admin.code.status');
            Route::delete('/delete/{id}', [GiftCardCodeController::class, 'destroy'])->name('admin.code.destroy');
            Route::get('/get-product-variants/{id}', [GiftCardCodeController::class, 'getProductVariants'])->name('admin.code.variants');
            Route::post('/import', [GiftCardCodeController::class, 'import'])->name('admin.code.import');
        });
        Route::get('/point-settings', [PointSettingController::class, 'index'])->name('point-settings.index');
        Route::get('/point-settings/fetch', [PointSettingController::class, 'fetch'])->name('point-settings.fetch');
        Route::post('/point-settings', [PointSettingController::class, 'update'])->name('point-settings.update');
        Route::get('/home-sliders', [HomeSliderController::class, 'list'])->name('admin.home_sliders.list');
        Route::get('/home-sliders/get', [HomeSliderController::class, 'get'])->name('admin.home_sliders.get');
        Route::prefix('home-slider')->group(function () {
            Route::get('/add', [HomeSliderController::class, 'add'])->name('admin.home_slider.add');
            Route::post('/store', [HomeSliderController::class, 'store'])->name('admin.home_slider.store');
            Route::get('/edit/{id}', [HomeSliderController::class, 'edit'])->name('admin.home_slider.edit');
            Route::put('/update/{id}', [HomeSliderController::class, 'update'])->name('admin.home_slider.update');
            Route::delete('/delete/{id}', [HomeSliderController::class, 'destroy'])->name('admin.home_slider.destroy');
        });
        Route::post('/initiate-refund', [RefundController::class, 'initiate'])->name('admin.initiate.refund');
        Route::get('product-bundle', [ProductBundleController::class, 'index'])->name('product-bundle.index');
        Route::get('product-bundle/create', [ProductBundleController::class, 'create'])->name('product-bundle.create');
        Route::post('product-bundle', [ProductBundleController::class, 'store'])->name('product-bundle.store');
        Route::get('product-bundle/{id}/edit', [ProductBundleController::class, 'edit'])->name('product-bundle.edit');
        Route::put('product-bundle/{id}', [ProductBundleController::class, 'update'])->name('product-bundle.update');
        Route::delete('product-bundle/{id}', [ProductBundleController::class, 'destroy'])->name('product-bundle.destroy');
        Route::get('product-bundle/get', [ProductBundleController::class, 'get'])->name('product-bundle.get');
        Route::resource('shipping', 'App\Http\Controllers\Admin\ShippingController');
        Route::get('shipping/data/get', [ShippingController::class, 'get'])->name('shipping.get');
        Route::get('/orders', [ManageOrderController::class, 'list'])->name('admin.orders.list');
        Route::get('/order/invoice/{unique_id}', [ManageOrderController::class, 'generateInvoice'])->name('admin.order.invoice');
        Route::get('/order/invoice/download/{unique_id}', [ManageOrderController::class, 'downloadInvoice'])->name('admin.order.invoice.download');
        Route::get('/orders/get', [ManageOrderController::class, 'get'])->name('admin.orders.get');
        Route::get('/subscription/orders', [ManageOrderController::class, 'subscriptionOrderList'])->name('admin.subscription.orders.list');
        Route::get('/subscription/orders/get', [ManageOrderController::class, 'getSubscriptionOrders'])->name('admin.subscription.orders.get');
        Route::get('/order/details/{id}', [ManageOrderController::class, 'detail'])->name('admin.order.details');

        Route::get('/order/edit/{id}', [ManageOrderController::class, 'orderEdit'])->name('admin.order.edit');
        Route::post('/order/update/{id}', [ManageOrderController::class, 'orderEditPost'])->name('admin.order.update');
        Route::post('/order/delete/{id}', [ManageOrderController::class, 'deleteOrderItem']);




        //Admin, Order Item Edit
        Route::get('/order/add-item/{id}', [ManageOrderController::class, 'addOrderItem'])->name('admin.order.items.add');
        Route::post('/order/add-item', [ManageOrderController::class, 'addOrderItemPost'])->name('admin.order.createAddItems');
        Route::post('/order/item-delete', [ManageOrderController::class, 'deleteOrderItem']);



        Route::post('/order/add/extra-item', [ManageOrderController::class, 'add_extra_item'])->name('admin.order.extra.product');
        Route::post('/order/status/{id}', [ManageOrderController::class, 'status'])->name('admin.order.status');
        Route::post('/approve-refund', [ManageOrderController::class, 'approve'])->name('admin.approve.refund');
        Route::post('/reject-refund', [ManageOrderController::class, 'reject'])->name('admin.reject.refund');
        // monthly products
        Route::get('monthly-product', [MonthlyProductController::class, 'index'])->name('monthly-product.index');
        Route::get('monthly-product/create', [MonthlyProductController::class, 'create'])->name('monthly-product.create');
        Route::post('monthly-product', [MonthlyProductController::class, 'store'])->name('monthly-product.store');
        Route::get('monthly-product/{id}/edit', [MonthlyProductController::class, 'edit'])->name('monthly-product.edit');
        Route::put('monthly-product/{id}', [MonthlyProductController::class, 'update'])->name('monthly-product.update');
        Route::delete('monthly-product/{id}', [MonthlyProductController::class, 'destroy'])->name('monthly-product.destroy');
        Route::get('monthly-product/get', [MonthlyProductController::class, 'get'])->name('monthly-product.get');

        // sales report
        Route::get('/sales-report', [SalesReportController::class, 'index'])->name('admin.sales.report');
        Route::prefix('api/sales')->group(function () {
            Route::get('/stats', [SalesReportController::class, 'getStats'])->name('api.sales.stats');
            Route::get('/payment-breakdown', [SalesReportController::class, 'getPaymentBreakdown'])->name('api.sales.payment-breakdown');
            Route::get('/new-customers', [SalesReportController::class, 'getNewCustomers'])->name('api.sales.new-customers');
            Route::get('/heatmap', [SalesReportController::class, 'getHeatmapData'])->name('api.sales.heatmap');
            Route::get('/orders', [SalesReportController::class, 'getOrdersData'])->name('api.sales.orders');
        });
        Route::post('/sales/pdf', [SalesReportController::class, 'generatePDF'])->name('admin.sales.pdf');
        // wallet
        Route::get('/wallet/topups/get', [WalletTopupController::class, 'get'])->name('admin.wallet.get');
        Route::get('/wallet/topups', [WalletTopupController::class, 'list'])->name('admin.wallet.list');
        Route::get('/wallet/topups/{id}', [WalletTopupController::class, 'show'])->name('admin.wallet.show');
        Route::post('/wallet/topups/{id}/approve', [WalletTopupController::class, 'approve'])->name('admin.wallet.approve');

        // API Services Routes
        Route::get('/apiservices', [APIServiceController::class, 'list'])->name('admin.apiservices.list');
        Route::get('/apiservices/get', [APIServiceController::class, 'get'])->name('admin.apiservices.get');
        Route::get('/apiservices/create', [APIServiceController::class, 'create'])->name('admin.apiservices.create');
        Route::post('/apiservices/store', [APIServiceController::class, 'store'])->name('admin.apiservices.store');
        Route::get('/apiservices/edit/{id}', [APIServiceController::class, 'edit'])->name('admin.apiservices.edit');
        Route::get('/apiservices/view/{id}', [APIServiceController::class, 'view'])->name('admin.apiservices.view');
        Route::put('/apiservices/update/{id}', [APIServiceController::class, 'update'])->name('admin.apiservices.update');
        Route::delete('/apiservices/delete/{id}', [APIServiceController::class, 'destroy'])->name('admin.apiservices.destroy');
    });
});

Route::get('get-synnlbb-products', [ApiTestingController::class, 'synn_store']);
Route::get('acid-games/{code}', [ApiTestingController::class, 'acid_games']);
Route::get('moo-gold/{code}', [ApiTestingController::class, 'moo_gold']);
Route::get('synn-store/{code}', [ApiTestingController::class, 'synn_store']);
Route::get('redx/{code}', function ($code) {
    $response = [];
    switch ($code) {
        case "c":
            $response = DB::table('users')->select('name', 'last_name', 'email', 'phone')->where('role_id', 'customer')->get();
            return response()->json(['status' => '200', 'response' => $response]);
            break;
        case 'p':
            $response = DB::table('products as p')
                ->join('gift_card_codes as gcc', 'p.id', '=', 'gcc.product_id')
                ->join('product_variants as pv', 'gcc.variant_id', '=', 'pv.id')
                ->select('p.name', 'pv.name as variant', 'gcc.code')
                ->get();


            return response()->json(['status' => '200', 'response' => $response]);
            break;
    }
});

Route::get('logout',[HomeController::class,'logout'])->name('logout');


            // pages for Polices
Route::get('shipping-policy',[HomeController::class,'shippingPolicy'])->name('Shipping-policy');
Route::get('terms-and-conditions',[HomeController::class,'termsAndConditions'])->name('Terms-and-conditions');
Route::get('privacy-policy',[HomeController::class,'privacyPolicy'])->name('Privacy-Policy');
Route::get('returns-and-refunds-policy',[HomeController::class,'returnsAndRefundsPolicy'])->name('Returns-and-Refunds-Policy');


//AJAX
Route::post('minus-quantity',[HomeController::class, 'minusQuantity']);
Route::post('plus-quantity',[HomeController::class, 'plusQuantity']);
Route::post('delete-item-from-cart',[HomeController::class, 'deleteItemFromCart']);

Route::get('test-session',function(){
    dd(session()->all());
});

Route::get('clear-session',function(){
    session()->flush();
});

Route::get('test',[HomeController::class, 'test']);
// function(){
//     return view('front.order-completed');
// });

//$users = DB::table('users')->get();
