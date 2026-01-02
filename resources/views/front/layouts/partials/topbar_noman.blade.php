<!-- fix-area Start -->
<div class="fix-area">
    <div class="offcanvas__info">
        <div class="offcanvas__wrapper">
            <div class="offcanvas__content">
                <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                    <div class="offcanvas__logo">
                        <a href="{{ route('front.home') }}">
                            <img src="{{ asset('front/assets/img/logo/logo.png') }}" alt="logo-img">
                        </a>
                    </div>
                    <div class="offcanvas__close">
                        <button>
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <p class="text d-none d-xl-block">
                    Nullam dignissim, ante scelerisque the is euismod fermentum odio sem semper the is erat, a feugiat
                    leo urna eget eros. Duis Aenean a imperdiet risus.
                </p>
                <div class="mobile-menu fix mb-3"></div>
                <div class="offcanvas__contact">
                    <h4>Contact Info</h4>
                    <ul>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon">
                                <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a target="_blank" href="#">8A, JALAN MELAKA RAYA 15, 75000 Melaka</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a href="mailto:hello@zerapostpartum.com">hello@zerapostpartum.com</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="fal fa-clock"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a target="_blank" href="#">Mon-Friday, 09am -05pm</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="far fa-phone"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a href="tel:+60172834522">+60 17-283 4522</a>
                            </div>
                        </li>
                    </ul>
                    <a href="{{ route('front.contact') }}" class="theme-btn"><span>LetÃ¢â‚¬â„¢s Talk <i
                                class="fa-solid fa-arrow-right"></i></span></a>
                    <div class="social-icon d-flex align-items-center">
                        @php
                            $iconMap = [
                                'Facebook' => 'fab fa-facebook-f',
                                'Twitter' => 'fab fa-twitter',
                                'Instagram' => 'fab fa-instagram',
                                'Youtube' => 'fab fa-youtube',
                                'WhatsApp' => 'fab fa-whatsapp',
                            ];
                        @endphp
                        @foreach ($followUsFooterSections['Follow Us'] ?? [] as $item)
                            <a href="{{ $item->link_url }}" target="_blank" rel="noopener">
                                <i class="{{ $iconMap[$item->link_text] ?? 'fas fa-globe' }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas__overlay"></div>

<!-- Sidebar Area Here -->
<div id="targetElement" class="side_bar slideInRight side_bar_hidden">
    <div class="side_bar_overlay"></div>
    <div class="cart-title mb-50">
        <h4>{{ __('lang.login') }}</h4>
    </div>
    <div class="login-sidebar">
        <form action="{{ route('login') }}" id="contact-form2" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="form-clt">
                        <span>{{ __('lang.email_address') }} *</span>
                        <input type="email" name="email" id="email20" placeholder="{{ __('lang.your_email') }}"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-clt">
                        <span>{{ __('lang.password') }} *</span>
                        <input type="password" name="password" id="password2" placeholder="{{ __('lang.password') }}"
                            class="@error('password') is-invalid @enderror" required autocomplete="current-password">
                        <div class="icon toggle-password" data-target="#password2">
                            <i class="far fa-eye-slash"></i>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <button class="theme-btn style-2" type="submit"><span>{{ __('lang.login') }}</span></button>
                </div>
                <div class="col-lg-12">
                    <div class="from-cheak-items">
                        <div class="form-check d-flex gap-2 from-customradio">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                {{ __('lang.remember_me') }}
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <p><a
                                    href="{{ route('password.request') }}"><span>{{ __('lang.forgot_password') }}</span></a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </form>
        <p class="text">{{ __('lang.or_login_with') }}</p>
        <div class="social-item">
            <a href="#" class="facebook-text style-2"><img src="{{ asset('front/assets/img/facebook.png') }}"
                    alt="img">{{ __('lang.facebook') }}</a>
            <a href="#" class="facebook-text google-text style-2"><img
                    src="{{ asset('front/assets/img/google.png') }}" alt="img">{{ __('lang.google') }}</a>
        </div>
        <div class="user-icon-box">
            <img src="{{ asset('front/assets/img/user.png') }}" alt="img">
            <p>{{ __('lang.no_account_yet') }}</p>
            <a href="{{ route('register') }}">{{ __('lang.create_an_account') }}</a>
        </div>
    </div>
    <button id="closeButton" class="x-mark-icon"><i class="fas fa-times"></i></button>
</div>

<!-- Header top Section Start -->
<div class="header-top-section style-2">
    <div class="container-fluid">
        <div class="header-top-wrapper style-2">
            <ul class="contact-list">
                <li>
                    <i class="fa-brands fa-facebook-f"></i>
                    {{ __('lang.followers') }}
                </li>
                <li>
                    <i class="fa-solid fa-phone"></i>
                    <a href="tel:+60172834522">+60 17-283 4522</a>
                </li>
            </ul>

            <marquee class="text-white" style="width: 60%;">{!! __('lang.free_shipping') !!}</marquee>

            <div class="flag-wrapper">
                <div class="flag-wrap">
                    <div class="language-switcher" id="languageSwitcher">
                        <!-- Current Language Display -->
                        <div class="language-display" id="languageDisplay">
                            <div class="current-lang">
                                <span class="flag-emoji" id="currentFlag">
                                    {{ app()->getLocale() == 'en' ? '🇺🇸¸' : (app()->getLocale() == 'bm' ? '🇲🇾' : '🇨🇳') }}
                                </span>
                                <span id="currentLang">
                                    {{ app()->getLocale() == 'en' ? 'English' : (app()->getLocale() == 'bm' ? 'Bahasa Malaysia' : '中文') }}
                                </span>
                            </div>
                            <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="6,9 12,15 18,9"></polyline>
                            </svg>
                        </div>

                        <!-- Dropdown Options -->
                        <div class="language-dropdown" id="languageDropdown">
                            <div class="language-option {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                                data-lang="en" data-flag="🇺🇸">
                                <span class="flag-emoji">🇺🇸</span>
                                <span>English</span>
                            </div>
                            <div class="language-option {{ app()->getLocale() == 'bm' ? 'active' : '' }}"
                                data-lang="bm" data-flag="🇲🇾">
                                <span class="flag-emoji">🇲🇾</span>
                                <span>Bahasa Malaysia</span>
                            </div>
                            <div class="language-option {{ app()->getLocale() == 'zh' ? 'active' : '' }}"
                                data-lang="zh" data-flag="🇨🇳">
                                <span class="flag-emoji">🇨🇳</span>
                                <span>中文</span>
                            </div>
                        </div>

                        <!-- Hidden Select for Accessibility -->
                        <select id="language-select" class="hidden-select">
                            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                            <option value="bm" {{ app()->getLocale() == 'bm' ? 'selected' : '' }}>Bahasa Malaysia
                            </option>
                            <option value="zh" {{ app()->getLocale() == 'zh' ? 'selected' : '' }}>中文</option>
                        </select>
                    </div>
                </div>
                <div class="content d-flex justifu-content-end gap-2">

                    @auth
                        <a href="{{ route('myaccount') }}" class="account-text d-flex align-items-center gap-2">
                            <i class="fa-regular fa-user"></i>
                            <span>{{ __('lang.myaccount') }}</span>
                        </a>
                        @if (auth()->user()->hasRole('admin'))
                            <a href="{{ route('admin.dashboard') }}"
                                class="account-text d-flex align-items-center gap-2">
                                <i class="fa fa-dashboard"></i>
                                <span>{{ __('lang.dashboard') }}</span>
                            </a>
                        @endif
                    @else
                        <button id="openButton" class="account-text d-flex align-items-center gap-2">
                            <i class="fa-regular fa-user"></i>
                            <span>{{ __('lang.login') }}</span>
                        </button>
                    @endauth

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Header Section Start -->
<header id="header-sticky" class="header-1 header-2">
    <div class="container-fluid">
        <div class="mega-menu-wrapper">
            <div class="header-main">
                <div class="header-left">
                    <div class="logo">
                        <a href="{{ route('front.home') }}" class="header-logo">
                            <img src="{{ asset('front/assets/img/logo/logo.png') }}" alt="logo-img">
                        </a>
                        <a href="{{ route('front.home') }}" class="header-logo-2 d-none">
                            <img src="{{ asset('front/assets/img/logo/logo.png') }}" alt="logo-img">
                        </a>
                    </div>
                </div>
                <div class="header-center">
                    <div class="mean__menu-wrapper">
                        <div class="main-menu">
                            <nav id="mobile-menu" style="display: block;">
                                <ul>
                                    <li class="{{ request()->routeIs('subscribe-petit') ? 'active' : '' }}">
                                        <a href="{{ route('subscribe-petit') }}">{{ __('lang.subscribe_petit') }}</a>
                                    </li>
                                    <li class="{{ request()->routeIs('front.shop') ? 'active' : '' }}">
                                        <a href="{{ route('front.shop') }}">{{ __('lang.shop') }}</a>
                                    </li>
                                     <li class="{{ request()->routeIs('front.blog') ? 'active' : '' }}">
                                        <a href="{{ route('front.blog.list') }}">{{ __('lang.blog') }}</a>
                                    </li>
                                    <li class="{{ request()->routeIs('front.about') ? 'active' : '' }}">
                                        <a href="{{ route('front.about') }}">{{ __('lang.aboutus') }}</a>
                                    </li>                                   
                                    @if (isset(Auth::user()->subscription_status) && Auth::user()->subscription_status)
                                        <li class="{{ request()->routeIs('choose-products') ? 'active' : '' }}">
                                            <a
                                                href="{{ route('choose-products') }}">{{ __('lang.choose_products') }}</a>
                                        </li>
                                    @endif
                                    <li class="{{ request()->routeIs('front.contact') ? 'active' : '' }}">
                                        <a href="{{ route('front.contact') }}">{{ __('lang.contactus') }}</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="header-right d-flex justify-content-end align-items-center">
                    <a href="#0" class="search-trigger search-icon"><i
                            class="fa-regular fa-magnifying-glass"></i></a>
                    <ul class="header-icon">
                        <li>
                            <a href="#"><i class="fa-regular fa-heart"></i><span class="number">0</span></a>
                        </li>
                    </ul>
                    <div class="menu-cart style-2">
                        <div class="cart-box" style="scroll-behavior: smooth;">
                            <div class="shopping-items"
                                style="border-bottom: 1px solid var(--border); padding-bottom: 10px;">
                                <span>{{ __('lang.shopping_cart') }} </span>
                                <h5 id="cartCloseHeader"
                                    style="display: flex; justify-content: center; align-items: center; gap: 10px; cursor: pointer; user-select: none;">
                                    <span><i class="fa-solid fa-xmark" style="margin-left: 10px"></i></span>
                                    <span>close</span>
                                </h5>
                            </div>
                            <ul>
                                @if (topBarCarts()->count() > 0)
                                    @foreach (topBarCarts() as $data)
                                        @php
                                            $product = is_array($data->product)
                                                ? (object) $data->product
                                                : $data->product;
                                            $firstMedia = $product->media->first();
                                            $imageSrc = $firstMedia
                                                ? asset($firstMedia->image_path)
                                                : ($product->featured_image
                                                    ? asset($product->featured_image)
                                                    : asset('assets/img/product/01.jpg'));
                                        @endphp
                                        <li data-product-id="{{ $data->product['id'] }}"
                                            data-is-model="{{ $data->is_model ?? 0 }}">
                                            <a href="javascript:void(0);" class="remove remove-cart-item"
                                                title="Remove this item">
                                                <i class="fa fa-remove"></i>
                                            </a>
                                            <img src="{{ $imageSrc }}" alt="{{ $data->product['name'] }}" />
                                            <div class="cart-product">
                                                <a href="{{ route('product.detail', $data->product['slug']) }}"
                                                    target="_blank">
                                                    {{ $data->product['name'] }}
                                                </a>
                                                @if(isset($data->attributes))
                                                    <div class="mt-2">
                                                        @foreach ($data->attributes as $attribute)
                                                            <span class="mt-2" style="display:inline;">
                                                                <small>
                                                                    {{ $attribute['name'] }}: {{ $attribute['value'] }}
                                                                </small>
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <span>RM {{ number_format($data->price, 2) }}</span>
                                                <p class="quantity">{{ $data->quantity }} x</p>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li>{{ __('lang.no_item_cart') }}</li>
                                    @auth
                                    @else
                                        <li>{{ __('lang.please') }} <a
                                                href="{{ route('login') }}">{{ __('lang.login') }}</a>{{ __('lang.to_view_your_cart') }}
                                        </li>
                                    @endauth
                                @endif
                            </ul>
                            @if (topBarCarts()->count() > 0)
                                <div class="cartbox-btm">
                                    <div class="cartbox-total">
                                        <span>{{ __('lang.Total') }} :</span>
                                        <span class="totalPrice">RM
                                            {{ number_format(Helpers::totalCartPrice(), 2) }}</span>
                                    </div>
                                    <div class="cart-button">
                                        <a href="{{ route('checkout') }}"
                                            class="theme-btn w-100">{{ __('lang.Checkout') }}</a>
                                    </div>
                                    <div class="cart-button">
                                        <a href="{{ route('front.cart') }}"
                                            class="theme-btn theme-btn-3 w-100">{{ __('lang.view_cart') }}</a>
                                    </div>
                                </div>
                            @else
                                <div class="cartbox-btm">
                                    <div class="cartbox-total">
                                        <span>{{ __('lang.Total') }} :</span>
                                        <span class="totalPrice">RM 0.00</span>
                                    </div>
                                    <div class="cart-button">
                                        <a href="{{ route('front.cart') }}"
                                            class="theme-btn theme-btn-3 w-100">{{ __('lang.view_cart') }}</a>
                                    </div>
                                    <div class="cart-button">
                                        <a href="{{ route('checkout') }}"
                                            class="theme-btn w-100">{{ __('lang.Checkout') }}</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <a href="#" class="cart-icon">
                            <i class="fa-sharp fa-regular fa-bag-shopping"></i>
                            @auth
                                <span class="total-count"
                                    style="display: {{ Helpers::cartCount() > 0 ? 'inline' : 'none' }};">
                                    {{ Helpers::cartCount() }}
                                </span>
                            @else
                                <span class="total-count"
                                    style="display: {{ count(topBarCarts()) > 0 ? 'inline' : 'none' }};">
                                    {{ count(topBarCarts()) }}
                                </span>
                            @endauth
                        </a>
                    </div>
                    <div class="header__hamburger d-xl-none my-auto">
                        <div class="sidebar__toggle">
                            <i class="fas fa-bars"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- search-wrap Start -->
<div class="search-wrap">
    <div class="search-inner">
        <i class="fas fa-times search-close" id="search-close"></i>
        <div class="search-cell">
            <form method="get" action="{{ route('front.shop') }}">
                <div class="search-field-holder" style="position: relative;">
                    <input type="search" name="search" id="search-input" class="main-search-input"
                        placeholder="Search..." autocomplete="off" value="{{ request('search') }}">
                    <ul id="suggestion-box"
                        style="position:absolute; top:100%; left:0; right:0; background:#fff; z-index:999; list-style:none; padding:0; margin:0; display:none; border:1px solid #ddd;">
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>
