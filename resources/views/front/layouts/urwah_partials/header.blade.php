@php

 $carts = session()->get('cart');
 $totalAmount = 0;
 if(!empty($carts))
    {
        foreach($carts as $key=>$car)
        {
            foreach($car as $cart)
                {
                     $totalAmount += $cart['total_price'];
                }
           
        }
    }

    $freeShipping = \App\Models\AppSetting::where('variable','free_shipping')->first();
    $freeShippingPrice = $freeShipping->value;

    $requireAmountForFreeShipping = $freeShippingPrice-$totalAmount;
    $percentage = $totalAmount*100/$freeShippingPrice;
    if($percentage == 0)
    {
        $percentage = 12; 
    }

    $text = "Only RM ".number_format($requireAmountForFreeShipping,2)." away from <strong>FREE SHIPPING</strong>";
    $availedFreeShipping = false;
    if($requireAmountForFreeShipping <= 0)
    {
        $text = "<strong>CONGRATULATION!</strong> You Availed <strong>FREE SHIPPING</strong>";
        $availedFreeShipping = true;
    }
@endphp
<style>
    .main-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
}

.main-menu > li {
    position: relative;
    padding: 10px 15px;
}

.main-menu > li > a {
    text-decoration: none;
    color: #333;
}

/* --- FIRST LEVEL DROPDOWN --- */
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background: #fff;
    min-width: 180px;
    list-style: none;
    padding: 10px 0;
    margin: 0;
    display: none;
    border: 1px solid #ddd;
    z-index: 999;
}

.dropdown:hover > .dropdown-menu {
    display: block;
}

/* --- SECOND LEVEL SUBMENU --- */
.sub-dropdown {
    position: absolute;
    top: 0;
    left: 100%;
    background: #f8f8f8;
    min-width: 180px;
    padding: 10px 0;
    border: 1px solid #ddd;
    list-style: none;
    display: none;
}

.dropdown-subitem:hover > .sub-dropdown {
    display: block;
}

.dropdown-menu a, .sub-dropdown a {
    display: block;
    padding: 8px 15px;
    text-decoration: none;
    color: #333;
}

.dropdown-menu a:hover,
.sub-dropdown a:hover {
    background: #eee;
}

    </style>
<header class="header-area header-one transparent-header">
            <div class="container">
                <!--====  Header Navigation  ===-->
                <div class="header-navigation">
                    <!--====  Header Nav Inner  ===-->
                    <div class="nav-inner-menu">
                        <!--====  Primary Menu  ===-->
                        <div class="primary-menu">
                            <!--====  Site Branding  ===-->
                            <div class="site-branding">
                                <a href="{{ route('front.home') }}" class="brand-logo"><img src="{{ asset('assets/images/home/logo/logo.svg')}}" alt="Brand Logo"></a>
                            </div>
                            <!--=== Theme Main Menu ===-->
                            <div class="theme-nav-menu">
                                <!-- Theme Menu Top -->
                                <div class="theme-menu-top d-flex justify-content-between d-block d-lg-none mb-4">
                                    <div class="site-branding">
                                        <a href="#" class="brand-logo"><img src="{{ asset('assets/images/home/logo/logo.svg') }}" alt="Brand Logo"></a>
                                    </div>
                                    <div class="navbar-close">
                                        <i class="far fa-times"></i>
                                    </div>
                                </div>
                                <!--=== Main Menu ===-->
                                <nav class="main-menu">
                                    <ul>
                                        <li class="menu-item"><a href="{{ route('front.about') }}">About Us</a></li>
                                        <li class="menu-item"><a href="{{ route('front.shop') }}">Shop</a></li>
                                        <li class="menu-item"><a href="{{ route('subscribe-petit') }}">Subscribe</a></li>
                                        <li class="menu-item"><a href="#">Blog</a></li>
                                        @if(empty(auth()->user()))
                                        <li class="menu-item"><a href="{{ route('admin.login') }}">Login</a></li>
                                        @else
                                        <li class="menu-item"><a href="{{ route('logout') }}">Logout</a></li>
                                        @endif
                                    </ul>
                                </nav>
                                <!--=== Theme Nav Button ===-->
                                <div class="theme-nav-button mt-3 d-block d-md-none">
                                    <a href="contact.html" class="theme-btn style-one">Contact1</a>
                                </div>
                                <!--=== Theme Menu Bottom ===-->
                                <div class="theme-menu-bottom mt-5 d-block d-lg-none">
                                    <h5>Follow Us</h5>
                                    <ul class="social-link">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!--=== Header Nav Right ===-->
                            <div class="nav-right-item">
                                <div class="nav-button d-none d-md-block">
                                    <a href="#" class="theme-btn style-one">Contact</a>
                                    @if(auth()->user())
                                    <a href="{{ url('my-account') }}"style="color: #3f4e9f;
    font: 400 24px var(--body-font);
    margin-left: 10px;
    font-weight: 700;">My Account</a>
                                    @endif
                                </div>
                                <div class="nav-button">
                                    @php
                                    $totalItemsInCart=0;
                                    if(!empty($carts))
                                        {
                                            $totalItemsInCart = count($carts);
                                        }
                                    @endphp
                                <a href="javascript:void(0)" class="cartbtn"><img src="{{ asset('assets/images/cart.svg')}}">{{$totalItemsInCart}}</a>
                                </div>
                                <div class="navbar-toggler">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Overlay -->
                        <div class="sb-sidebar-overlay"></div>

                        <!-- Cart Sidebar -->
                        <div class="sb-cart-sidebar">
                            <!-- Header -->
                            <div class="sb-sidebar-header">
                                <h3 class="primary-color-2">Shopping Cart</h3>
                                <button class="sb-close-btn btn-close btn-close-white" aria-label="Close"></button>
                            </div>

                            <!-- Shipping Progress -->
                            <div class="sb-shipping-progress">
                                <div class="sb-progress-text">
                                    <!-- Only RM {{ $requireAmountForFreeShipping }} away from <strong>FREE SHIPPING</strong> -->
                                     {!! $text !!}
                                </div>
                                @if(!$availedFreeShipping)
                                <div class="sb-progress-bar-container">
                                    <div class="sb-progress-bar" style="width:{{$percentage}}%;">
                                        <div class="sb-free-gift-badge"></div>
                                        <div class="sb-progress-icon sb-active" style="position: absolute;right: 0px;top: -10px;">
                                            <img src="{{ url('assets/images/home/single-product/delivery.png') }}">
                                            <p id="buy-amount" style="position: absolute;
                                                    top: 48px;
                                                    right: -17px;
                                                    color: #424e9b;
                                                    font-size: 19px;
                                                    font-weight: 600;
                                                    width: 64px;">RM {{ number_format($totalAmount,2) }}</p>
                                        </div>
                                    </div>
                                    <div class="sb-progress-icons">
                                        <!-- <div class="sb-progress-icon sb-active"><img src="assets/images/home/single-product/delivery.png"></div> -->
                                        <div class="sb-progress-icon" style="position: absolute;right: 0px;top: -23px;">
                                            <img src="{{ url('assets/images/home/single-product/package.png') }}">
                                        </div>
                                             <p style="position: absolute;top: 26px;right: -16px;color: #424e9b;font-size: 19px;font-weight: 600;width: 64px;">RM {{$freeShippingPrice}}</p>
                                    </div>
                                </div>
                                @endif
                                <div class="sb-progress-amounts">
                                    <!-- <span>RM {{$totalAmount}}</span> -->
                                    <!-- <span>RM {{$freeShippingPrice}}</span> -->
                                </div>
                            </div>

                            <!-- Cart Content -->
                            <div class="sb-cart-content">
                                <!-- Cart Item -->
                                @if(!empty($carts))
                                    @foreach($carts as $key=>$c1)
                                        @foreach($c1 as $cart)
                                    <div class="sb-cart-item">
                                        <img src="{{ url($cart['image']) }}" alt="Curry Paste" class="sb-item-image">
                                        <div class="sb-item-details">
                                            <div class="sb-item-name">{{ $cart['name'] }}</div>
                                            <div class="sb-item-price">
                                                <div class="sb-original-price">
                                                    <!-- RM 220.80 -->
                                                    <span class="sb-discounted-price" style="margin-left:0px;">RM {{ $cart['price'] }}</span></div>
                                            </div>
                                        </div>
                                        <div class="sb-quantity-controls">
                                                <button class="sb-quantity-btn" onclick="minusQuantity({{ $cart['product_id'] }}, '{{ $cart["type"] }}', {{ $cart['box'] }})">-</button>
                                                    <span class="sb-quantity" id="quantity{{$cart['product_id']}}{{$cart['box']}}">{{ $cart['quantity'] }}</span>
                                                <button class="sb-quantity-btn" onclick="plusQuantity({{ $cart['product_id'] }}, '{{ $cart["type"] }}', {{ $cart['box'] }})">+</button>


                                            @if($cart['type'] == "box")
                                            @php
                                            $boxText = "Box";
                                            if($cart['box'] != '1')
                                            {
                                                $boxText = "Boxes";
                                            }
                                            @endphp
                                            <span class="sb-quantity" id="quantity{{$cart['product_id']}}{{$cart['box']}}">&nbsp;&nbsp;{{ $cart['box']." ".$boxText}}</span>
                                            @endif






                                            </div>
                                        <button class="sb-remove-item btn btn-sm btn-outline-danger" onclick="deleteItemFromCart({{ $cart['product_id'] }}, '{{ $cart["type"] }}', {{ $cart['box'] }})">&times;</button>
                                    </div>
                                    @endforeach
                                    @endforeach
                                @endif

                                <!-- <div class="sb-pantry-section">
                                    <div class="sb-pantry-title">Stock up your business</div>

                                    <div class="sb-pantry-item">
                                        <img src="{{ asset('assets/images/home/single-product/2.jpg')}}" alt="Curry Paste" class="sb-item-image">
                                        <div class="sb-pantry-info">
                                            <div class="sb-pantry-name">Paper Bowl</div>
                                        </div>
                                        <button class="sb-add-btn">ADD - RM 11.90</button>
                                    </div>

                                    <div class="sb-pantry-item">
                                        <img src="{{ asset('assets/images/home/single-product/2.jpg')}}" alt="Curry Paste" class="sb-item-image">
                                        <div class="sb-pantry-info">
                                              <div class="sb-pantry-name">Paper Plate</div>
                                        </div>
                                        <button class="sb-add-btn">ADD - RM 8.50</button>
                                    </div>

                                </div> -->
                            </div>

                            <!-- Footer -->
                            <div class="sb-sidebar-footer">
                                <div class="sb-total-section">
                                    <div class="sb-total-row">
                                        <div class="sb-total-label">Total:</div>
                                        <div class="sb-total-amount">
                                            <!-- <span class="sb-old-total">RM 220.80</span> -->
                                            <span class="sb-new-total">RM {{ number_format($totalAmount, 2) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="voucher-container">
                                    <div class="voucher-field">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Enter Voucher Code">
                                            <button class="apply-btn theme-btn style-three">Apply</button>
                                        </div>
                                    </div>
                                </div> -->

                                <button class="theme-btn style-three w-100"><span class="secure-icon"><i class="fas fa-solid fa-lock"></i></span><a href="{{ route('checkout') }}">CHECKOUT</a></button>

                                    <button class="theme-btn style-three w-100" style="margin-top:10px;background-color:#ada8a8;    border: 1px solid #ada8a8"><span class="secure-icon"><i class="fas fa-solid fa-lock"></i></span><a href="{{ url('cart') }}">VIEW CART</a></button>



                                <!-- <div class="sb-shipping-note">
                                    SHIPPING & TAXES WILL BE CALCULATED AT CHECKOUT
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
