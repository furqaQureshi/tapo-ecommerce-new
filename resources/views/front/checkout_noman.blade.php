@extends('front.layouts.app')

@section('title')
    Checkout
@endsection

@section('style')
    <style>
        .modal {
            backdrop-filter: blur(3px);
            z-index: 11112;
        }

        .coupon-section {
            /* background: white; */
        }

        .coupon-input-container {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .coupon-input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
            color: #000000d9;
        }

        .coupon-input:focus {
            outline: none;
            border-color: #f58c9d;
            color: #000000d9;
        }

        .applied-coupon {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            padding: 15px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            animation: slideInUp 0.5s ease;
        }

        @keyframes slideInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .coupon-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .coupon-icon {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px;
            border-radius: 50%;
            font-size: 16px;
        }

        .remove-coupon {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 5px 8px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .remove-coupon:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .price-breakdown {
            /* background: white; */
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .price-row:last-child {
            border-bottom: none;
            font-size: 20px;
            font-weight: bold;
            color: #f58c9d;
            margin-top: 10px;
            padding-top: 15px;
            border-top: 2px solid #f0f0f0;
        }

        .original-price {
            color: #999;
            text-decoration: line-through;
        }

        .discount-amount {
            color: #00b894;
            font-weight: bold;
        }

        .success-message {
            background: #00b894;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            margin-top: 10px;
            animation: fadeIn 0.5s ease;
        }

        .error-message {
            background: #ff4757;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            margin-top: 10px;
            animation: fadeIn 0.5s ease;
        }

        .from-customradio-2 {
            margin-bottom: 3px;
            gap: 1rem;
            font-size: 1.1rem;
            font-weight: 400;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .free-shipping-bar {
            height: 10px;
            background-color: #F7941D;
            width: 100%;
        }

        .select2-container--default .select2-selection--single {
            border-radius: 0px;
            border: 1px solid #d5d8db !important;
            padding: 10px 15px;
            height: 50px !important;
        }

        .points-link {
            color: #f58c9d;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            transition: color 0.3s;
        }

        .points-link:hover {
            color: #e67e91;
            text-decoration: underline;
        }

        .points-modal .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .points-modal .modal-header {
            background: linear-gradient(135deg, #f58c9d, #e67e91);
            color: white;
            border-radius: 10px 10px 0 0;
            border-bottom: none;
        }

        .points-modal .modal-title {
            font-weight: 600;
            font-size: 1.4rem;
        }

        .points-modal .btn-close {
            filter: brightness(0) invert(1);
        }

        .points-info-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .points-balance {
            font-size: 2rem;
            font-weight: bold;
            color: #f58c9d;
            margin-bottom: 10px;
        }

        .points-conversion {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .points-input-group {
            margin-bottom: 20px;
        }

        .points-input-group label {
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        .points-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .points-input:focus {
            outline: none;
            border-color: #f58c9d;
            box-shadow: 0 0 0 0.2rem rgba(245, 140, 157, 0.25);
        }

        .conversion-display {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .conversion-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .conversion-row:last-child {
            margin-bottom: 0;
            font-weight: bold;
            color: #f58c9d;
            border-top: 1px solid #e9ecef;
            padding-top: 10px;
        }

        .apply-points-btn {
            background: linear-gradient(135deg, #f58c9d, #e67e91);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            width: 100%;
            transition: all 0.3s;
        }

        .apply-points-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(245, 140, 157, 0.3);
        }

        .apply-points-btn:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .applied-points {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            padding: 15px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            animation: slideInUp 0.5s ease;
        }

        .points-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .points-icon {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px;
            border-radius: 50%;
            font-size: 16px;
        }

        .remove-points {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 5px 8px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .remove-points:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .error-text {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
        }
    </style>
@endsection

@section('content')
    <section class="pages-banner-section">
        <div class="hero-2">
            <div class="hero-bg" style="background-image: url(front/assets/img/pages-bg.jpg)">
                <div class="hero-overlay"></div>
            </div>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="section-title-area pbanner-content">
                            <div class="">
                                <div class="section-title style-3">
                                    <h2 class="wow fadeInUp" data-wow-delay=".3s">Checkout</h2>
                                </div>
                                <ul class="list wow fadeInUp" data-wow-delay=".5s">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    -
                                    <li>Checkout</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout-section fix section-padding">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="checkout-wrapper">
                <div class="coupon-items d-flex flex-md-nowrap flex-wrap justify-content-between align-items-center gap-4">
                    @auth
                        <p></p>
                    @else
                        <p>Returning customer? <a href="{{ route('login') }}">Click here to login</a></p>
                    @endauth
                    <div class="free-shipping-box" style="display: none;">
                        <p class="free-shipping-message">
                            You are eligible for free shipping!
                        </p>
                        <div class="free-shipping-progress">
                            <div class="free-shipping-bar"></div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('checkout.process') }}" method="post" id="checkoutForm">
                    @csrf
                    <input type="hidden" name="points_redeemed" id="points_redeemed" value="0">
                    <input type="hidden" name="points_discount" id="points_discount" value="0">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="checkout-single-wrapper">
                                <div class="checkout-single boxshado-single">
                                    <h4>Billing Details</h4>
                                    <div class="checkout-single-form">
                                        <div class="row g-4">
                                            <div class="col-lg-6">
                                                <div class="input-single">
                                                    <span>First Name*</span>
                                                    <input type="text" name="name" id="userFirstName" required
                                                        placeholder="First Name"
                                                        value="{{ old('name') ?? ($subscription_user_data['name'] ?? (auth()->check() ? auth()->user()->name : '')) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-single">
                                                    <span>Last Name*</span>
                                                    <input type="text" name="last_name" id="userLastName" required
                                                        placeholder="Last Name"
                                                        value="{{ old('last_name') ?? ($subscription_user_data['last_name'] ?? (auth()->check() ? auth()->user()->last_name : '')) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <span>Email Address*</span>
                                                    <input name="email" id="email22" placeholder="Email"
                                                        value="{{ old('email') ?? ($subscription_user_data['email'] ?? (auth()->check() ? auth()->user()->email : '')) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <span>Phone Number*</span>
                                                    <input name="phone" id="phone" placeholder="Phone Number"
                                                        value="{{ old('phone') ?? ($subscription_user_data['phone'] ?? (auth()->check() ? auth()->user()->phone : '')) }}"
                                                        @if (auth()->check() && auth()->user()->phone)  @endif>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 d-none">
                                                <div class="input-single">
                                                    <span>Country*</span>
                                                    <input name="country" id="country" value="Malaysia" type="hidden"
                                                        placeholder="Select a country">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <span>City*</span>
                                                    <select name="towncity" id="towncity"
                                                        class="form-control js-example-basic-single">
                                                        <option disabled selected>Select a city</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->name }}"
                                                                @if (
                                                                    (auth()->check() && $city->name == auth()->user()->towncity) ||
                                                                        (isset($subscription_user_data['towncity']) && $city->name == $subscription_user_data['towncity'])) selected @endif>
                                                                {{ $city->name }} ({{ $city->state }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <span>Street Address*</span>
                                                    <input name="address" id="userAddress"
                                                        placeholder="Home number and street name"
                                                        value="{{ old('address') ?? ($subscription_user_data['address'] ?? (auth()->check() ? auth()->user()->address : '')) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <span>Postal Code</span>
                                                    <input name="postalcode" id="userPostalCode"
                                                        placeholder="Postal Code"
                                                        value="{{ old('postalcode') ?? ($subscription_user_data['postal_code'] ?? (auth()->check() ? auth()->user()->postal_code : '')) }}">
                                                </div>
                                            </div>
                                            <div id="differentAddressFields" style="display:none; margin-top:15px;">
                                                <div class="col-lg-12">
                                                    <div class="input-single">
                                                        <span>Shipping Address*</span>
                                                        <input name="shipping_address" id="shippingAddress"
                                                            placeholder="Home number and street name"
                                                            value="{{ old('shipping_address', request('shipping_address') ?? '') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-12">
                                                <div class="input-single">
                                                    <span>Order Notes (optional)</span>
                                                    <textarea name="notes" id="notes" placeholder="Notes about your order, e.g., special notes for delivery">{{ old('notes') }}</textarea>
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-12">
                                                <div class="input-check payment-save">
                                                    <input type="checkbox" class="form-check-input" name="save-for-next"
                                                        id="saveForNext111">
                                                    <label for="saveForNext111">Save for my next payment</label>
                                                </div>
                                                <div class="input-check payment-save style-2">
                                                    <input type="checkbox" class="form-check-input" name="ship_different" value="1" id="saveForNext2">
                                                    <label for="saveForNext2">Ship to a different address?</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="checkout-order-area">
                                <h3>Your Order</h3>
                                <div class="product-checout-area">
                                    <div class="checkout-item d-flex align-items-center justify-content-between">
                                        <p>Product</p>
                                        <p>Subtotal</p>
                                    </div>
                                    @php
                                        $subscription_subtotal = 0;
                                        $cart_item_subtotal = 0;
                                        $addonPrice = collect($cartItems)->sum(fn($item) => $item->addon_price ?? 0);
                                    @endphp
                                    <input type="hidden" name="addon_price" id="addon_price"
                                        value="{{ $addonPrice ?? 0 }}">
                                    @if (isset($bundlePlan))
                                        <input type="hidden" name="plan_id" id="plan_id"
                                            value="{{ $bundlePlan['plan_id'] }}">
                                    @endif
                                    @if (count($cartItems) > 0)
                                        @foreach ($cartItems as $key => $cart)
                                            @php
                                                $subtotal = $cart->price * $cart->quantity;
                                                $cart_item_subtotal += $subtotal;
                                            @endphp
                                            <div class="checkout-item d-flex align-items-center justify-content-between">
                                                <p>
                                                    <a href="{{ route('product.detail', $cart->product->slug) }}"
                                                        target="_blank" class="product_link">{{ $cart->product->name }}
                                                        (x{{ $cart->quantity }})
                                                    </a>
                                                    <br>
                                                    @if(isset($cart->attributes))
                                                        @foreach ($cart->attributes as $attribute)
                                                            <span class="mt-2" style="display:inline;">
                                                                <small>
                                                                    {{ $attribute['name'] }}: {{ ucfirst($attribute['value']) }}@if($loop->last).@else,@endif
                                                                </small>
                                                            </span>
                                                        @endforeach
                                                    @endif
                                                </p>
                                                <p class="price-usd">{{ config('app.currency') }}
                                                    {{ number_format($subtotal, 2) }}</p>
                                            </div>
                                            @if ($key == 1 && $addonPrice > 0)
                                                <div
                                                    class="checkout-item d-flex align-items-center justify-content-between">
                                                    <p><a href="javascipt:void(0)" class="product_link">Mystery Gift
                                                            (x1)</a></p>
                                                    <p class="price-usd">{{ config('app.currency') }}
                                                        {{ number_format(30, 2) }}</p>
                                                </div>
                                                @php
                                                    $cart_item_subtotal += 30;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <div class="checkout-item d-flex align-items-center justify-content-between">
                                            <p>Total Value of Items:</p>
                                            <p>{{ config('app.currency') }}
                                                {{ number_format($cart_item_subtotal, 2) }}</p>
                                        </div>
                                    @else
                                        <div class="checkout-item">No items in cart. Please <a href="{{ route('login') }}">login</a> to proceed.</div>
                                    @endif
                                    @if (isset($bundlePlan))
                                        <div class="checkout-item d-flex justify-content-between">
                                            <p>Shipping</p>
                                            <div class="shopping-items">
                                                {{-- @if (count(Helpers::shipping()) > 0 && Helpers::cartCount() > 0)
                                                    @foreach (Helpers::shipping() as $shipping)
                                                        <div class="form-check d-flex align-items-center from-customradio">
                                                            <label class="form-check-label">{{ $shipping->type }}:
                                                                {{ config('app.currency') }}{{ number_format($shipping->price, 2) }}</label>
                                                            <input class="form-check-input" type="radio" name="shipping"
                                                                value="{{ $shipping->id }}"
                                                                data-price="{{ $shipping->price }}"
                                                                {{ $loop->first ? 'checked' : '' }}>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="form-check d-flex align-items-center from-customradio">
                                                        <label class="form-check-label">Free Shipping</label>
                                                    </div>
                                                @endif --}}
                                                <div class="form-check d-flex align-items-center from-customradio">
                                                    <label class="form-check-label">Free Shipping</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <input type="hidden" name="shipping_cost" id="shipping_cost" value="0">
                                    <div class="coupon-section">
                                        <h3 style="margin-bottom: 15px; color: #333;">Apply Coupon</h3>
                                        <div id="appliedCoupon"></div>
                                        <div id="appliedPoints"></div>
                                        <div class="coupon-input-container">
                                            <input type="text" class="coupon-input" id="coupon_code"
                                                name="coupon_code" placeholder="Enter coupon code">
                                            <button type="button" class="theme-btn" id="apply-coupon-btn">Apply</button>
                                        </div>
                                        <div id="coupon-message"></div>
                                        <input type="hidden" name="coupon_id" id="coupon_id" value="">
                                        <input type="hidden" name="applied_coupon_code" id="applied_coupon_code"
                                            value="">
                                        @auth
                                            @if (auth()->user()->reward_points > 0)
                                                <div class="text-center mb-3">
                                                    <a href="#" class="points-link" data-bs-toggle="modal"
                                                        data-bs-target="#pointsModal">
                                                        Redeem Points for Discount
                                                    </a>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                    @php
                                        $pointSetting = \App\Models\PointSetting::first();
                                        $userPoints = auth()->check() ? auth()->user()->reward_points : 0;
                                        $rmPerPoint = $pointSetting ? $pointSetting->points_per_rm : 150; // Default to 150
                                    @endphp
                                    @auth
                                        <div class="modal fade points-modal" id="pointsModal" tabindex="-1"
                                            aria-labelledby="pointsModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="pointsModalLabel">Redeem Points</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="points-info-card">
                                                            <div class="points-balance" id="userPointsBalance">
                                                                {{ $userPoints }}</div>
                                                            <div class="points-conversion">Your Total Points</div>
                                                            <small class="points-conversion">({{ $rmPerPoint }}
                                                                point(s) is equal to {{ config('app.currency') }} 1.00)</small>
                                                        </div>
                                                        <div class="points-input-group">
                                                            <label for="pointsToRedeem">Enter Points to Redeem:</label>
                                                            <input type="number" class="points-input" id="pointsToRedeem"
                                                                placeholder="Enter points (minimum {{ $rmPerPoint }})"
                                                                min="{{ $rmPerPoint }}" max="{{ $userPoints }}"
                                                                step="1">
                                                            <div class="error-text" id="pointsError" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="conversion-display">
                                                            <div class="conversion-row">
                                                                <span>Points to Redeem:</span>
                                                                <span id="displayPoints">0</span>
                                                            </div>
                                                            <div class="conversion-row">
                                                                <span>Discount Amount:</span>
                                                                <span id="displayDiscount">{{ config('app.currency') }}
                                                                    0.00</span>
                                                            </div>
                                                            <div class="conversion-row">
                                                                <span>Remaining Points:</span>
                                                                <span id="remainingPoints">{{ $userPoints }}</span>
                                                            </div>
                                                            <div class="conversion-row">
                                                                <span>New Total:</span>
                                                                <span id="newTotal">{{ config('app.currency') }}
                                                                    {{ number_format($total + (Helpers::shipping()->first()->price ?? 0), 2) }}</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="apply-points-btn" id="applyPointsBtn"
                                                            disabled>
                                                            Apply Points Discount
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endauth
                                    <hr>
                                    <div class="price-breakdown">
                                        @if (!isset($bundlePlan))
                                            <div class="checkout-item d-flex align-items-center justify-content-between">
                                                <p>Subtotal:</p>
                                                <p id="originalPrice">{{ config('app.currency') }}
                                                    {{ number_format($total, 2) }}</p>
                                            </div>
                                        @endif
                                        <div class="checkout-item d-flex align-items-center justify-content-between"
                                            id="discountRow" style="display: none;">
                                            <p>Discount:</p>
                                            <p class="discount-amount" id="discountAmount">-
                                                {{ config('app.currency') }} 0.00</p>
                                        </div>
                                        @auth
                                            @if (!isset($bundlePlan))
                                                <div class="checkout-item d-flex align-items-center justify-content-between"
                                                    id="pointsDiscountRow" style="display: none;">
                                                    <p>Points Discount:</p>
                                                    <p class="discount-amount" id="pointsDiscountAmount">-
                                                        {{ config('app.currency') }} 0.00</p>
                                                </div>
                                            @endif
                                            <div class="checkout-item d-flex align-items-center justify-content-between">
                                                <p>Shipping Cost:</p>
                                                <p id="shippingCost">{{ config('app.currency') }} 0.00</p>
                                            </div>
                                        @else
                                            <div class="checkout-item d-flex align-items-center justify-content-between">
                                                <p>Shipping Cost:</p>
                                                <p id="shippingCost">{{ config('app.currency') }} 0.00</p>
                                            </div>
                                        @endauth
                                        @if (isset($bundlePlan))
                                            <div class="checkout-item d-flex align-items-center justify-content-between">
                                                <p>Plan ({{ $bundlePlan['name'] }})</p>
                                                <p>{{ config('app.currency') }}
                                                    {{ $bundlePlan['type'] == 2 ? number_format($bundlePlan['price'], 2) . ' x 12' : number_format($bundlePlan['price'], 2) }}
                                                </p>
                                            </div>
                                            <input type="hidden" id="order_type" name="order_type" value="1">
                                            @php
                                                $subscription_subtotal +=
                                                    $bundlePlan['type'] == 2
                                                        ? $bundlePlan['price'] * 12
                                                        : $bundlePlan['price'];
                                                $renewal_date = $bundlePlan['renewal_date'];
                                            @endphp
                                        @endif
                                        @if ($addonPrice > 0)
                                            <div class="checkout-item d-flex align-items-center justify-content-between">
                                                <p>Addon Price:</p>
                                                <p id="addonPrice" class="d-none">{{ config('app.currency') }}
                                                    {{ $addonPrice }}</p>
                                                <p>{{ config('app.currency') }}
                                                    {{ $addonPrice }}</p>
                                            </div>
                                            @php
                                                $subscription_subtotal += $addonPrice;
                                            @endphp
                                        @endif

                                        @if ($subscription_subtotal > 0)
                                            <div
                                                class="checkout-item d-flex sub-totals align-items-center justify-content-between">
                                                <p>Subtotal:</p>
                                                <p id="subscription_subtotal">{{ config('app.currency') }}
                                                    {{ number_format($subscription_subtotal, 2) }}</p>
                                            </div>
                                        @endif

                                        <div
                                            class="checkout-item d-flex align-items-center justify-content-between {{ isset($bundlePlan) ? 'd-none' : '' }}">
                                            <p>Total:</p>
                                            <p id="finalTotal">{{ config('app.currency') }}
                                                {{ number_format($total, 2) }}</p>
                                        </div>
                                        @if (isset($renewal_date) && $renewal_date != '')
                                            <div class="checkout-item d-flex align-items-center justify-content-between">
                                                <p>Renewal Date:</p>
                                                <p id="renewal_date">{{ $renewal_date }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="checkout-item-2">
                                        @if (auth()->check() && auth()->user()->walvar_balance && auth()->user()->walvar_balance > 0)
                                            <div class="form-check-3 d-flex align-items-center from-customradio-2 mt-3">
                                                <input class="form-check-input" type="radio" value="walvar"
                                                    name="payment_mode" id="payment_mode12223" checked>
                                                <label class="form-check-label" for="payment_mode12223">
                                                    Walvar
                                                </label>
                                            </div>
                                        @endif
                                        {{-- <div class="form-check-3 d-flex align-items-center from-customradio-2 mt-3">
                                            <input class="form-check-input" type="radio" value="stripe"
                                                name="payment_mode" id="payment_mode12224">
                                            <label class="form-check-label" for="payment_mode12224">
                                                Stripe
                                            </label>
                                        </div> --}}
                                        <div class="form-check-3 d-flex align-items-center from-customradio-2 mt-3">
                                            <input class="form-check-input" type="radio" value="curlec_razorpay"
                                                name="payment_mode" id="payment_mode12225" checked>
                                            <label class="form-check-label" for="payment_mode12225">
                                                Curlec (Razorpay)
                                            </label>
                                        </div>
                                        <div class="form-check-3 d-flex align-items-center from-customradio-2 mt-3">
                                            <input class="form-check-input" type="radio" name="payment_mode"
                                                value="cod" id="payment_mode12227">
                                            <label class="form-check-label" for="payment_mode12227">Cash on
                                                Delivery</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="theme-btn mt-4 w-100">
                                        Proceed to Checkout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(function() {
            // On load, check if already selected (e.g. after validation error)
            if ($("#saveForNext2").is(":checked")) {
                $("#differentAddressFields").show();
            }

            // Toggle when checkbox changes
            $("#saveForNext2").on("change", function() {
                $("#differentAddressFields").toggle(this.checked);
            });
        });
    </script>
    <script>
        function updateShipping() {
            let cityId = $('#towncity').val();
            let total = "{{ $total }}";

            if (!cityId) return; // nothing selected

            $.ajax({
                url: "{{ route('checkout.calculateShipping') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    towncity: cityId,
                    total: total
                },
                beforeSend: function () {
                    $('#shippingCost').text('Calculating...');
                    $('#finalTotal').text('Calculating...');
                },
                success: function (res) {
                    if(res.shipping == 0 || !res.shipping || res.shipping === 0){
                        $('#shippingCost').text('Free');
                        $('#shipping_cost').val(0.0);
                    } else {
                        $('#shippingCost').text('RM ' + (parseFloat(res.shipping).toFixed(2)));
                        $('#shipping_cost').val(parseFloat(res.shipping).toFixed(2));
                    }
                    $('#finalTotal').text('RM ' + parseFloat(res.grand_total).toFixed(2));
                }
            });
        }

        $('#towncity').on('change', updateShipping);

        $(document).ready(function () {
            if ($('#order_type').length) {
                let orderType = $('#order_type').val();

                if (!orderType) {
                    if ($('#towncity').val()) {
                        updateShipping();
                    }
                }
            } else {
                if ($('#towncity').val()) {
                    updateShipping();
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: "Select a City",
                allowClear: true,
                width: '100%'
            });

            $(window).resize(function() {
                $('.js-example-basic-single').css('width', '100%');
                $('.select2-container').css('width', '100%');
            });

            // var shippingRadios = $('input[name="shipping"]');
            // var shippingCost = parseFloat(shippingRadios.filter(':checked').data('price')) || 0;
            // $('#shipping_cost').val(shippingCost.toFixed(2));
            // updatePriceDisplay();

            // shippingRadios.on('change', function() {
            //     shippingCost = parseFloat($(this).data('price')) || 0;
            //     $('#shipping_cost').val(shippingCost.toFixed(2));
            //     updatePriceDisplay();
            // });

            // Initialize applied points display if previously set
            if (appliedPoints > 0) {
                showAppliedPoints(appliedPoints, appliedPointsDiscount);
                updateMainPageTotals();
            }
        });

        // Dynamic points configuration
        var POINT_CONVERSION_RATE = {{ $rmPerPoint }}; // 150 points = 1 RM
        var userTotalPoints = {{ auth()->check() ? auth()->user()->reward_points : 0 }};
        var currentSubtotal = parseFloat({{ $total ?? 0 }}) || 0;
        var shippingCost = parseFloat($('#shipping_cost').val()) || 0;
        var appliedPointsDiscount = parseFloat($('#points_discount').val()) || 0;
        var appliedPoints = parseInt($('#points_redeemed').val()) || 0;
        var appCurrency = "{{ config('app.currency') }}";
        var originalTotal = parseFloat({{ $total ?? 0 }}) || 0;
        var currentTotal = parseFloat({{ $total ?? 0 }}) || 0;
        var appliedCoupon = null;
        var addonPrice = parseFloat({{ $addonPrice ?? 0 }}) || 0;

        // DOM Elements
        var pointsInput = document.getElementById('pointsToRedeem');
        var pointsError = document.getElementById('pointsError');
        var applyPointsBtn = document.getElementById('applyPointsBtn');
        var displayPoints = document.getElementById('displayPoints');
        var displayDiscount = document.getElementById('displayDiscount');
        var remainingPoints = document.getElementById('remainingPoints');
        var newTotal = document.getElementById('newTotal');
        var pointsDiscountRow = document.getElementById('pointsDiscountRow');
        var pointsDiscountAmount = document.getElementById('pointsDiscountAmount');
        var finalTotal = document.getElementById('finalTotal');
        var appliedPointsContainer = document.getElementById('appliedPoints');
        var pointsRedeemedInput = document.getElementById('points_redeemed');
        var pointsDiscountInput = document.getElementById('points_discount');
        var addonPriceInput = document.getElementById('addon_price');
        var addonPriceDisplay = document.getElementById('addonPrice');

        // Initialize points input
        if (pointsInput) {
            pointsInput.setAttribute('max', userTotalPoints);
            pointsInput.setAttribute('min', POINT_CONVERSION_RATE);
        }

        // Points input validation and calculation
        if (pointsInput) {
            pointsInput.addEventListener('input', function() {
                var points = parseInt(this.value) || 0;
                validateAndCalculate(points);
            });
        }

        function validateAndCalculate(points) {
            pointsError.style.display = 'none';
            applyPointsBtn.disabled = true;

            if (points === 0) {
                resetDisplay();
                return;
            }

            if (points < POINT_CONVERSION_RATE) {
                showError(`Minimum ${POINT_CONVERSION_RATE} points required`);
                resetDisplay();
                return;
            }

            if (points > userTotalPoints) {
                showError('Insufficient points');
                resetDisplay();
                return;
            }

            if (points % POINT_CONVERSION_RATE !== 0) {
                showError(`Points must be in multiples of ${POINT_CONVERSION_RATE}`);
                resetDisplay();
                return;
            }

            var discountAmount = points / POINT_CONVERSION_RATE; // e.g., 150 points = 1 RM
            var maxDiscount = currentSubtotal;

            if (discountAmount > maxDiscount) {
                showError(
                    `Maximum discount available: ${appCurrency} ${maxDiscount.toFixed(2)} (${maxDiscount * POINT_CONVERSION_RATE} points)`
                );
                resetDisplay();
                return;
            }

            displayPoints.textContent = points;
            displayDiscount.textContent = `${appCurrency} ${discountAmount.toFixed(2)}`;
            remainingPoints.textContent = userTotalPoints - points;

            var calculatedTotal = currentSubtotal - discountAmount + shippingCost + addonPrice;
            newTotal.textContent = `${appCurrency} ${calculatedTotal.toFixed(2)}`;

            applyPointsBtn.disabled = false;
        }

        function showError(message) {
            pointsError.textContent = message;
            pointsError.style.display = 'block';
        }

        function resetDisplay() {
            displayPoints.textContent = '0';
            displayDiscount.textContent = `${appCurrency} 0.00`;
            remainingPoints.textContent = userTotalPoints;
            newTotal.textContent = `${appCurrency} ${(currentSubtotal + shippingCost + addonPrice).toFixed(2)}`;
        }

        // Apply points discount
        if (applyPointsBtn) {
            $(applyPointsBtn).off('click').on('click', function() {
                console.log('Apply points button clicked'); // Debug log
                applyPointsBtn.disabled = true;

                var points = parseInt(pointsInput.value) || 0;
                appliedPoints = points;
                appliedPointsDiscount = points / POINT_CONVERSION_RATE; // e.g., 150 points = 1 RM

                pointsRedeemedInput.value = appliedPoints;
                pointsDiscountInput.value = appliedPointsDiscount.toFixed(2);
                addonPriceInput.value = addonPrice.toFixed(2);

                showAppliedPoints(appliedPoints, appliedPointsDiscount);
                updateMainPageTotals();

                var modal = bootstrap.Modal.getInstance(document.getElementById('pointsModal'));
                modal.hide();

                pointsInput.value = '';
                resetDisplay();

                setTimeout(function() {
                    applyPointsBtn.disabled = false;
                }, 500);
            });
        }

        function updateMainPageTotals() {
            pointsDiscountRow.style.display = appliedPointsDiscount > 0 ? 'flex' : 'none';
            pointsDiscountAmount.textContent = `- ${appCurrency} ${appliedPointsDiscount.toFixed(2)}`;

            var newFinalTotal = currentSubtotal - appliedPointsDiscount + shippingCost + addonPrice;
            finalTotal.textContent = `${appCurrency} ${newFinalTotal.toFixed(2)}`;
        }

        function showAppliedPoints(points, discount) {
            console.log(points, discount);

            appliedPointsContainer.innerHTML = `
                <div class="applied-points">
                    <div class="points-info">
                       <span class="points-icon">⭐</span>
                        <div>
                            <strong>${points} Points Redeemed</strong>
                            <div style="font-size: 14px; opacity: 0.9;">Discount: ${appCurrency} ${discount.toFixed(2)}</div>
                        </div>
                    </div>
                    <button type="button" class="remove-points" onclick="removePoints()">Remove</button>
                </div>
            `;
        }

        function removePoints() {
            appliedPoints = 0;
            appliedPointsDiscount = 0;

            pointsRedeemedInput.value = 0;
            pointsDiscountInput.value = 0;

            pointsDiscountRow.style.display = 'none';
            pointsDiscountAmount.textContent = `- ${appCurrency} 0.00`;

            var newFinalTotal = currentSubtotal + shippingCost + addonPrice;
            finalTotal.textContent = `${appCurrency} ${newFinalTotal.toFixed(2)}`;

            appliedPointsContainer.innerHTML = '';
            updatePriceDisplay();
        }

        // Reset modal when opened
        if (document.getElementById('pointsModal')) {
            document.getElementById('pointsModal').addEventListener('show.bs.modal', function() {
                pointsInput.value = '';
                resetDisplay();
                pointsError.style.display = 'none';
                applyPointsBtn.disabled = true;
                if (appliedPoints > 0) {
                    showAppliedPoints(appliedPoints, appliedPointsDiscount);
                }
            });

            document.getElementById('pointsModal').addEventListener('hidden.bs.modal', function() {
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                    backdrop.remove();
                });
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
        }

        // Quantity update logic
        $(document).on('click', '.quantityIncrement, .quantityDecrement', function() {
            var row = $(this).closest('tr');
            var input = row.find('.quantityValue');
            var quantity = parseInt(input.val()) || 1;
            var isIncrement = $(this).hasClass('quantityIncrement');

            quantity = isIncrement ? quantity + 1 : quantity - 1;
            if (quantity < 1) quantity = 1;

            input.val(quantity);

            var priceText = row.find('.price-usd').first().text();
            var priceMatch = priceText.match(/[\d.]+/);
            var currentQuantityMatch = row.find('p').first().text().match(/x(\d+)/);
            var price = priceMatch && currentQuantityMatch ?
                parseFloat(priceMatch[0]) / parseInt(currentQuantityMatch[1]) : 0;
            var subtotal = price * quantity;

            row.find('.price-usd').last().text(appCurrency + ' ' + subtotal.toFixed(2));

            updateCartTotal();
        });

        function updateCartTotal() {
            var total = 0;

            $('.checkout-item').each(function() {
                var priceText = $(this).find('.price-usd').text();
                if (priceText) {
                    var subtotal = parseFloat(priceText.match(/[\d.]+/)) || 0;
                    if (!isNaN(subtotal)) {
                        total += subtotal;
                    }
                }
            });

            originalTotal = total || 0;
            currentSubtotal = total || 0;

            if (appliedCoupon) {
                $.ajax({
                    url: "{{ route('coupon.apply') }}",
                    type: "POST",
                    data: {
                        code: appliedCoupon.code,
                        total: originalTotal,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (!response.error) {
                            currentTotal = parseFloat(response.new_total) || originalTotal;
                            appliedCoupon.coupon_id = response.coupon_id;
                            appliedCoupon.coupon_code = response.coupon_code;
                            $('#coupon_id').val(appliedCoupon.coupon_id);
                            $('#applied_coupon_code').val(appliedCoupon.coupon_code);
                            updatePriceDisplay();
                        } else {
                            appliedcoupon = null;
                            $('#coupon_id').val('');
                            $('#applied_coupon_code').val('');
                            currentTotal = originalTotal;
                            $('#appliedCoupon').html('');
                            updatePriceDisplay();
                            showMessage('Coupon is no longer valid due to quantity change.', 'error');
                        }
                    },
                    error: function() {
                        appliedCoupon = null;
                        $('#coupon_id').val('');
                        $('#applied_coupon_code').val('');
                        currentTotal = originalTotal;
                        $('#appliedCoupon').html('');
                        updatePriceDisplay();
                        showMessage('Error reapplying coupon. Coupon removed.', 'error');
                    }
                });
            } else {
                currentTotal = originalTotal;
                $('#coupon_id').val('');
                $('#applied_coupon_code').val('');
                updatePriceDisplay();
            }
        }

        function updatePriceDisplay() {
            shippingCost = parseFloat($('#shipping_cost').val()) || 0;
            addonPrice = parseFloat(addonPriceInput.value) || 0;
            var grandTotal = currentSubtotal - appliedPointsDiscount + shippingCost + addonPrice;
            $('#originalPrice').text(appCurrency + ' ' + (originalTotal || 0).toFixed(2));
            $('#shippingCost').text(appCurrency + ' ' + (shippingCost || 0).toFixed(2));
            $('#finalTotal').text(appCurrency + ' ' + (grandTotal || 0).toFixed(2));
            if (addonPriceDisplay) {
                addonPriceDisplay.textContent = `${appCurrency} ${(addonPrice || 0).toFixed(2)}`;
            }

            if (appliedCoupon) {
                var discountAmount = originalTotal - currentTotal;
                if (discountAmount > 0) {
                    $('#discountRow').show();
                    $('#discountAmount').text('- ' + appCurrency + ' ' + discountAmount.toFixed(2));
                } else {
                    $('#discountRow').hide();
                }
            } else {
                $('#discountRow').hide();
                $('#discountAmount').text('- ' + appCurrency + ' 0.00');
            }

            pointsDiscountRow.style.display = appliedPointsDiscount > 0 ? 'flex' : 'none';
            pointsDiscountAmount.textContent = `- ${appCurrency} ${(appliedPointsDiscount || 0).toFixed(2)}`;
        }

        // Coupon Application
        $('#apply-coupon-btn').on('click', function() {
            var couponCode = $('#coupon_code').val().trim();

            if (!couponCode) {
                showMessage('Please enter a coupon code', 'error');
                return;
            }

            if (appliedCoupon && appliedCoupon.code === couponCode.toUpperCase()) {
                showMessage('This coupon is already applied!', 'error');
                return;
            }

            $.ajax({
                url: "{{ route('coupon.apply') }}",
                type: "POST",
                data: {
                    code: couponCode,
                    total: originalTotal,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.error) {
                        showMessage(response.error, 'error');
                    } else {
                        appliedCoupon = {
                            code: couponCode.toUpperCase(),
                            type: response.discount_type,
                            value: response.discount_value,
                            description: response.description,
                            coupon_id: response.ccoupon_id,
                            coupon_code: response.coupon_code
                        };

                        currentTotal = parseFloat(response.new_total) || originalTotal;
                        $('#coupon_id').val(appliedCoupon.coupon_id);
                        $('#applied_coupon_code').val(appliedCoupon.coupon_code);
                        displayAppliedCoupon();
                        updatePriceDisplay();
                        $('#coupon_code').val('');
                        showMessage('Coupon "' + couponCode.toUpperCase() + '" applied successfully!',
                            'success');
                    }
                },
                error: function() {
                    showMessage('Error applying coupon. Please try again.', 'error');
                }
            });
        });

        function displayAppliedCoupon() {
            var container = $('#appliedCoupon');
            container.html('');

            if (appliedCoupon) {
                var couponDiv = $(`
                    <div class="applied-coupon">
                        <div class="coupon-info">
                            <span class="coupon-icon">ðŸŽ«</span>
                            <div>
                                <strong>${appliedCoupon.code}</strong>
                                <div style="font-size: 14px; opacity: 0.9;">${appliedCoupon.description}</div>
                            </div>
                        </div>
                        <button type="button" class="remove-coupon" onclick="removeCoupon()">Remove</button>
                    </div>
                `);
                container.append(couponDiv);
            }
        }

        function removeCoupon() {
            appliedCoupon = null;
            currentTotal = originalTotal;
            $('#coupon_id').val('');
            $('#applied_coupon_code').val('');
            updatePriceDisplay();
            $('#appliedCoupon').html('');
            showMessage('Coupon removed successfully!', 'success');
        }

        function showMessage(message, type) {
            var messageDiv = $('#coupon-message');
            messageDiv.html(`<div class="${type}-message">${message}</div>`);

            setTimeout(() => {
                messageDiv.html('');
            }, 3000);
        }

        // Update cart sidebar content
        // function updateCartSidebar(cartItems, totalPrice) {
        //     var $cartList = $('.menu-cart.style-2 .cart-box ul');
        //     var $cartTotal = $('.totalPrice');
        //     $cartList.empty(); // Clear current cart items

        //     if (cartItems.length > 0) {
        //         // Group items by product_id to prevent duplicates
        //         var groupedItems = {};
        //         var localTotalPrice = 0;

        //         $.each(cartItems, function(index, item) {
        //             var productId = item.product_id || item.id; // Handle different response formats
        //             if (!groupedItems[productId]) {
        //                 groupedItems[productId] = {
        //                     ...item,
        //                     quantity: 0
        //                 };
        //             }
        //             groupedItems[productId].quantity += parseInt(item.quantity, 10);
        //             localTotalPrice += parseFloat(item.price) * parseInt(item.quantity, 10);
        //         });

        //         // Render grouped items
        //         $.each(groupedItems, function(productId, item) {
        //             var photo = item.image ?
        //                 (item.image.includes(',') ?
        //                     window.baseURL + '/' + item.image.split(',')[0].trim() :
        //                     window.baseURL + '/' + item.image) :
        //                 window.baseURL + '/front/assets/img/product/01.jpg';

        //             var cartItemHtml = `
        //         <li data-product-id="${item.id}" data-is-model="0">
        //             <a href="javascript:void(0);" class="remove remove-cart-item" title="Remove this item">
        //                 <i class="fa fa-remove"></i>
        //             </a>
        //             <img src="${photo}" alt="${item.name}" />
        //             <div class="cart-product">
        //                 <a href="{{ route('product.detail', '') }}/${item.slug}" target="_blank">
        //                     ${item.name}
        //                 </a>
        //                 <span>RM ${parseFloat(item.price).toFixed(2)}</span>
        //                 <p class="quantity">${item.quantity} x</p>
        //             </div>
        //         </li>`;
        //             $cartList.append(cartItemHtml);
        //         });

        //         // Update total price
        //         $cartTotal.text(`RM ${parseFloat(totalPrice).toFixed(2)}`);

        //         // Show cart buttons
        //         $('.menu-cart.style-2 .cart-box .cart-button').show();
        //     } else {
        //         $cartList.append('<li>No items in cart.</li>');
        //         $cartTotal.text(`RM 0.00`);
        //         $('.menu-cart.style-2 .cart-box .cart-button').hide();
        //     }
        // }
        // Handle remove item from cart
        $(document).on('click', '.remove-cart-item', function() {
            var $item = $(this).closest('li');
            var product_id = $item.data('product-id');
            var is_model = $item.data('is-model') === 1;

            var data = {
                _token: '{{ csrf_token() }}',
                product_id: product_id,
                is_model: is_model
            };
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to remove this item from the cart?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('cart.remove') }}",
                        method: 'POST',
                        data: data,
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message);
                                updateCartSidebar(response.cartItems, response.totalPrice);
                                updateCartCount(response.cartCount);
                                updateCartTotal();
                            } else {
                                toastr.error('Failed to remove item.');
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Failed to remove item.');
                        }
                    });
                }
            });
        });

        // Update cart icon count
        function updateCartCount(count) {
            var $cartIconCount = $('.menu-cart.style-2 .cart-icon .total-count');
            if (count > 0) {
                $cartIconCount.text(count).show();
            } else {
                $cartIconCount.hide();
            }
        }

        // Cart sidebar toggle logic
        var $menuCart = $(".menu-cart.style-2");
        var $cartBox = $menuCart.find(".cart-box");
        var $cartIcon = $menuCart.find(".cart-icon");

        $cartBox.hide();

        $cartIcon.on("click", function(e) {
            e.preventDefault();
            $cartBox.toggle();
        });

        $(document).on("click", function(e) {
            if (!$menuCart.is(e.target) && $menuCart.has(e.target).length === 0) {
                $cartBox.hide();
            }
        });

        var $closeHeader = $("#cartCloseHeader");
        if ($closeHeader.length) {
            $closeHeader.on("click", function() {
                $closeHeader.closest(".cart-box").hide();
            });
        }

        $(document).on("mousedown", function(e) {
            if ($cartBox.is(":visible") && !$cartBox.is(e.target) && $cartBox.has(e.target).length === 0) {
                $cartBox.hide();
            }
        });

        // Initialize price display
        updatePriceDisplay();
    </script>
@endsection
