@extends('front.layouts.app')

@section('title')
    {{ __('lang.about') }}
@endsection

@section('content')
    <div class="hs-slider-container" id="hsSlider">
        <!-- Slide 1 -->
        <div class="hs-slide hs-active">
            <div class="row h-80 w-100 m-0">
                <div class="col-lg-6 p-0 hs-media-column">
                    <img src="front/assets/img/home-about-1.jpg" alt="Slide 1" class="hs-media-item">
                </div>
                <div class="col-lg-6 hs-content-column">
                    <h1 class="hs-heading">{{__('lang.one_price_big_value')}}</h1>
                    <div class="hs-button-group">
                        <a href="/subscriber-form" class="hs-btn hs-btn-primary"
                            aria-label="Subscribe to ZERA Mom">{{ __('lang.subscribe_now')}}</a>
                        <a href="#" class="hs-btn-2" aria-label="Learn about ZERA Mom Subscription">{{__('lang.what_is_zera_mom_subscription')}}</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="hs-slide hs-next">
            <div class="row h-100 w-100 m-0">
                <div class="col-lg-6 p-0 hs-media-column">
                    <video class="hs-media-item" autoplay muted loop>
                        <source src="front/assets/img/video/Zera-video.mp4" type="video/mp4">
                    </video>
                </div>
                <div class="col-lg-6 hs-content-column">
                    <h1 class="hs-heading">{{ __('lang.try_before_buy')}}</h1>
                    <p class="hs-description">
                       {{__('lang.choose_favorites')}}
                    </p>
                    <div class="hs-button-group">
                        <a href="#" class="hs-btn hs-btn-primary" aria-label="Go to next slide">{{ __('lang.next')}}</a>
                        <a href="/subscriber-form" class="hs-btn" aria-label="Subscribe to ZERA Mom">{{ __('lang.subscribe_now')}}</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="hs-slide hs-next">
            <div class="row h-100 w-100 m-0">
                <div class="col-lg-6 p-0 hs-media-column">
                    <img src="front/assets/img/home-about-2.jpg" alt="Slide 3" class="hs-media-item">
                </div>
                <div class="col-lg-6 hs-content-column">
                    <h1 class="hs-heading">{{__('lang.what_else_do_i_get')}}</h1>
                    <ul>
                        <li><strong>{{__('lang.free_discount_entry')}}</strong> {{__('lang.free_discount_entry_description')}}</li>
                        <li><strong>{{__('lang.discounts_up_to')}}</strong> {{__('lang.discounts_description')}}</li>
                        <li><strong>Win Premium Prizes</strong> through exclusive givaways</li>
                        <li>and many more</li>
                    </ul>
                    <div class="hs-button-group">
                        <a href="/subscriber-form" class="hs-btn hs-btn-primary" aria-label="Go to page content">{{__('lang.next')}}</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide Indicators -->
        <div class="hs-slide-indicators">
            <span class="hs-indicator hs-indicator-active"></span>
            <span class="hs-indicator"></span>
            <span class="hs-indicator"></span>
        </div>
    </div>


    <!--<section class="hero-section-2">-->
    <!--    <div class="arrow-button">-->
    <!--        <button class="array-prev">-->
    <!--            <i class="fa-light fa-chevron-left"></i>-->
    <!--        </button>-->
    <!--        <button class="array-next">-->
    <!--            <i class="fa-light fa-chevron-right"></i>-->
    <!--        </button>-->
    <!--    </div>-->
    <!--    <div class="swiper hero-slider">-->
    <!--        <div class="swiper-wrapper">-->
    <!--            <div class="swiper-slide">-->
    <!--                <div class="hero-2">-->
    <!--                    <div class="hero-bg">-->
    <!--                        <video autoplay muted loop class="bg-video">-->
    <!--                            <source src="front/assets/img/video/Zera-video.mp4" type="video/mp4" />-->
    <!--                            Your browser does not support the video tag.-->
    <!--                        </video>-->
    <!--                    </div>-->
    <!--                    <div class="container-fluid">-->
    <!--                        <div class="row g-4">-->
    <!--                            <div class="col-lg-10">-->
    <!--                                <div class="hero-content">-->
    <!--                                    <p data-animation="fadeInUp" data-delay="1.3s">-->
    <!--                                        Up To 50% Off-->
    <!--                                    </p>-->
    <!--                                    <h1 data-animation="fadeInUp" data-delay="1.5s">-->
    <!--                                        DISCOVER DISCOUNTS <br />-->
    <!--                                        YOU CAN'T FIND ANYWHERE ELSE!-->
    <!--                                    </h1>-->
    <!--                                    <div class="hero-icon-item" data-animation="fadeInUp" data-delay="1.7s">-->
    <!--                                        <div class="icon-item style-2">-->
    <!--                                            <div class="icon">-->
    <!--                                                <img src="front/assets/img/icon-3.png" alt="img" />-->
    <!--                                            </div>-->
    <!--                                            <div class="content">-->
    <!--                                                <h6>-->
    <!--                                                    Gentle <br />-->
    <!--                                                    & Soft-->
    <!--                                                </h6>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                        <div class="icon-item style-2">-->
    <!--                                            <div class="icon">-->
    <!--                                                <img src="front/assets/img/icon-2.png" alt="img" />-->
    <!--                                            </div>-->
    <!--                                            <div class="content">-->
    <!--                                                <h6>-->
    <!--                                                    Natural <br />-->
    <!--                                                    & Safe-->
    <!--                                                </h6>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                        <div class="icon-item style-2">-->
    <!--                                            <div class="icon">-->
    <!--                                                <img src="front/assets/img/icon-1.png" alt="img" />-->
    <!--                                            </div>-->
    <!--                                            <div class="content">-->
    <!--                                                <h6>-->
    <!--                                                    Comfortable <br />-->
    <!--                                                    & Cozy-->
    <!--                                                </h6>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                    <div class="hero-button" data-animation="fadeInUp" data-delay="1.3s">-->
    <!--                                        <a href="#" class="theme-btn">Discover Now <i-->
    <!--                                                class="fa-regular fa-arrow-right"></i></a>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->

    <!--            <div class="swiper-slide">-->
    <!--                <div class="hero-2">-->
    <!--                    <div class="hero-bg bg-cover" style="background-image: url(assets/img/hero/bg-2.jpg)"></div>-->
    <!--                    <div class="container-fluid">-->
    <!--                        <div class="row g-4">-->
    <!--                            <div class="col-lg-10">-->
    <!--                                <div class="hero-content">-->
    <!--                                    <p data-animation="fadeInUp" data-delay="1.3s">-->
    <!--                                        Up To 50% Off-->
    <!--                                    </p>-->
    <!--                                    <h1 data-animation="fadeInUp" data-delay="1.5s">-->
    <!--                                        DISCOVER DISCOUNTS <br />-->
    <!--                                        YOU CAN'T FIND ANYWHERE ELSE!-->
    <!--                                    </h1>-->
    <!--                                    <div class="hero-icon-item" data-animation="fadeInUp" data-delay="1.7s">-->
    <!--                                        <div class="icon-item style-2">-->
    <!--                                            <div class="icon">-->
    <!--                                                <img src="front/assets/img/icon-3.png" alt="img" />-->
    <!--                                            </div>-->
    <!--                                            <div class="content">-->
    <!--                                                <h6>-->
    <!--                                                    Gentle <br />-->
    <!--                                                    & Soft-->
    <!--                                                </h6>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                        <div class="icon-item style-2">-->
    <!--                                            <div class="icon">-->
    <!--                                                <img src="front/assets/img/icon-2.png" alt="img" />-->
    <!--                                            </div>-->
    <!--                                            <div class="content">-->
    <!--                                                <h6>-->
    <!--                                                    Natural <br />-->
    <!--                                                    & Safe-->
    <!--                                                </h6>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                        <div class="icon-item style-2">-->
    <!--                                            <div class="icon">-->
    <!--                                                <img src="front/assets/img/icon-1.png" alt="img" />-->
    <!--                                            </div>-->
    <!--                                            <div class="content">-->
    <!--                                                <h6>-->
    <!--                                                    Comfortable <br />-->
    <!--                                                    & Cozy-->
    <!--                                                </h6>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                    <div class="hero-button" data-animation="fadeInUp" data-delay="1.3s">-->
    <!--                                        <a href="#" class="theme-btn">Discover Now <i-->
    <!--                                                class="fa-regular fa-arrow-right"></i></a>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->

    <!-- Product-box Section Start -->
    <section class="product-box-section section-padding fix">
        <div class="container">
            <div class="section-title text-center style-3">
                <h2 class="wow fadeInUp" data-wow-delay=".3s">{{__('lang.why_petit_plus')}}</h2>
            </div>
            <div class="row g-0">
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="product-box-item style-2">
                        <div class="product-image">
                            <div id="step1-animation" style="width: 200px; height: 150px"></div>
                        </div>
                        <div class="product-content">
                            <h3>
                                <a href="#">{{__('lang.value_guaranteed')}}</a>
                            </h3>
                            <p>{{__('lang.value_description')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".s">
                    <div class="product-box-item">
                        <div class="product-image">
                            <div id="step2-animation" style="width: 150px; height: 150px"></div>
                        </div>
                        <div class="product-content">
                            <h3>
                                <a href="#">{{__('lang.actual_sized_only')}}</a>
                            </h3>
                            <p>{{__('lang.actual_sized_description')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                    <div class="product-box-item mb-0">
                        <div class="product-image">
                            <div id="step3-animation" style="width: 150px; height: 150px"></div>
                        </div>
                        <div class="product-content">
                            <h3>
                                <a href="#">{{__('lang.choose_what_to_try')}}</a>
                            </h3>
                            <p>
                               {{__('lang.choose_what_to_try_description')}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                    <div class="product-box-item mb-0">
                        <div class="product-image">
                            <div id="step4-animation" style="width: 150px; height: 150px"></div>
                        </div>
                        <div class="product-content">
                            <h3>
                                <a href="#">{{__('lang.real_stuff')}}</a>
                            </h3>
                            <p>{{__('lang.real_stuff_description')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="subscribe-info-section section-bg section-padding fix">
        <div class="container">
            <div class="subscribe-info-wrapper">
                <div class="row g-4">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                        <div class="subscribe-info-content">
                            <div class="content style-2">
                                <h3>
                                    {{__('lang.baby_care')}}
                                </h3>
                                <p>
                                    {{__('lang.experience_convenience')}}
                                </p>
                                @auth
                                    <a href="{{ isset(Auth::user()->subscription_status) && !Auth::user()->subscription_status ? route('subscriber-form') : 'javascript:void(0)' }}"
                                        class="theme-btn btn {{ isset(Auth::user()->subscription_status) && !Auth::user()->subscription_status ? '' : 'disabled pointer-events-none' }}"
                                        style="{{ isset(Auth::user()->subscription_status) && !Auth::user()->subscription_status ? '' : 'cursor: not-allowed;' }}"
                                        @if (isset(Auth::user()->subscription_status) && !Auth::user()->subscription_status) tabindex="-1" aria-disabled="true" @endif>
                                        {{ isset(Auth::user()->subscription_status) && !Auth::user()->subscription_status ? __('lang.subscribe_now') : 'Subscribed!' }}
                                    </a>
                                    @if (isset(Auth::user()->subscription_status) && Auth::user()->subscription_status)
                                        <a href="{{ route('choose-products') }}" class="theme-btn">Choose Products</a>
                                    @endif
                                @endauth
                                @guest
                                    <a href="{{ route('subscriber-form') }}" class="theme-btn btn">{{ __('lang.subscribe_now')}}</a>
                                @endguest
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="subscribe-info-img">
                            <img src="front/assets/img/subscribe-info.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand-section Start -->
    <div class="brand-section fix">
        <div class="container">
            <div class="section-title-area">
                <div class="section-title style-3">
                    <h2 class="wow fadeInUp" data-wow-delay=".3s">{{__('lang.brand_partners')}}</h2>
                </div>
            </div>
            <div class="brand-wrapper">
                <div class="swiper brand-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="brand-box-item style-2">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/01.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/02.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/03.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/04.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/05.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/06.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/07.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/08.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/09.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/10.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/11.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/12.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="array-buttons">
                    <button class="array-prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="array-next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Product-collection Section Start -->
    <section class="product-collection-section section-bg-2 section-padding fix">
        <div class="container">
            <div class="section-title-area">
                <div class="section-title style-3">
                    <h6 class="sub-title wow fadeInUp">{{__('lang.product_collection')}}</h6>
                    <h2 class="wow fadeInUp" data-wow-delay=".3s">
                        {{__('lang.exclusive_pick')}}
                    </h2>
                </div>
            </div>
            <div class="tab-content">
                <div class="row">


                    @if (!empty($bundle))
                        @foreach ($bundle->getProducts() as $key => $product)
                            @if($key <= 7)
                                @php
                                    $priceData =
                                        auth()->check() && auth()->user()->account_type === 'reseller'
                                            ? product_price_range($product)
                                            : normal_product_price_range($product);
                                @endphp
                                <div class="col-xl-3 col-lg-3 col-md-6 wow fadeInUp"
                                    data-wow-delay=".{{ 2 + ($loop->index % 8) * 2 }}s">
                                    <div class="product-collection-item">
                                        <a href="{{ route('product.detail', $product->slug) }}">
                                            <div class="product-image">
                                            @php
                                                $firstImage = $product->media->first();
                                                $imageSrc = $firstImage
                                                    ? asset($firstImage->image_path)
                                                    : ($product->featured_image
                                                        ? asset($product->featured_image)
                                                        : asset('assets/img/product/01.jpg'));
                                            @endphp
                                            <img src="{{ $imageSrc }}" alt="{{ $product->name }}">
                                            <div class="d-flex justify-content-between">

                                                @if ($priceData['discount_percentage'] > 0)
                                                    <div class="badge badge-discount">{{ $priceData['discount_percentage'] }}%
                                                    </div>
                                                @endif
                                                {{-- @if ($product->label === 'zeera_pick')
                                                    <div class="badge badge-warning">Zeera Pick</div>
                                                @elseif ($product->label === 'addon' && $product->addon_price)
                                                    <div class="badge badge-danger">
                                                        +RM{{ number_format($product->addon_price, 2) }}</div>
                                                @endif --}}
                                            </div>

                                            <div class="product-btn">
                                                {{--<a href="javascript:void(0);" class="theme-btn-2 add-to-cart-btn"
                                                    data-product-id="{{ $product->id }}"
                                                    data-price="{{ $product->price - ($product->price * ($product->discount ?? 0)) / 100 }}"
                                                    id="addToCartBtn-{{ $product->id }}">
                                                    {{ __('lang.Add_to_cart') }}
                                                </a>--}}
                                                {{-- <a href="{{ route('choose-products') }}" class="theme-btn-2">
                                                    {{ __('lang.subscribe_now') }}
                                                </a> --}}
                                            </div>
                                        </div>
                                        </a>
                                        <div class="product-content">
                                            <h4>
                                                <a href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                                            </h4>
                                            <ul class="doller">
                                                <li>
                                                    {{ $priceData['formatted_price'] }}
                                                    @if ($priceData['original_price'])
                                                        <del>{{ $priceData['original_price'] }}</del>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <h4 class="text-warning" style="margin:100px auto;">{{__('lang.there_are_no_products')}}</h4>
                    @endif
                </div>
                <div class="section-title-area mt-5 justify-content-center">
                    <a href="{{ route('front.shop') }}" class="theme-btn theme-btn-3">{{__('lang.view_all_products')}} <i
                            class="fa-regular fa-arrow-right"></i></a>
                </div>
            </div>
    </section>

    <div class="eticket-section fix">
        <div class="container">
            <div class="section-title-area">
                <div class="section-title style-3">
                    <h2 class="wow fadeInUp" data-wow-delay=".3s">{{__('lang.featured_eticket')}}</h2>
                </div>
            </div>
            <div class="eticket-wrapper">
                <div class="swiper eticket-slider">
                    <div class="swiper-wrapper">
                        @if (!empty($tickets))
                            @foreach ($tickets as $ticket)
                                @php
                                    $getfirstImage = $ticket->media->first();
                                    $getimageSrc = $getfirstImage
                                        ? asset($getfirstImage->image_path)
                                        : ($ticket->featured_image
                                            ? asset($ticket->featured_image)
                                            : asset('assets/img/product/01.jpg'));
                                @endphp
                                <div class="swiper-slide">
                                    <div class="brand-box-item style-2">
                                        <div class="brand-image">
                                            <a href="#">
                                                <img src="{{ $getimageSrc }}" alt="brand-img" />
                                                <h4>{{ $ticket->name }}</h4>
                                            </a>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="array-buttons">
                    <button class="array-prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="array-next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="eticket-section section-bg-2 fix">
        <div class="container">
            <div class="section-title-area">
                <div class="section-title style-3">
                    <h2 class="wow fadeInUp" data-wow-delay=".3s">Blogs</h2>
                </div>
            </div>
            <div class="eticket-wrapper">
                <div class="swiper nblog-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="brand-box-item style-2">
                                <div class="brand-image">
                                    <a href="javascript:void();">
                                        <img src="front/assets/img/home-4.jpg" alt="img" />
                                        <h4>Blog 1</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand-box-item style-2">
                                <div class="brand-image">
                                    <a href="javascript:void();">
                                        <img src="front/assets/img/home-4.jpg" alt="img" />
                                        <h4>Blog 2</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand-box-item style-2">
                                <div class="brand-image">
                                    <a href="javascript:void();">
                                        <img src="front/assets/img/home-4.jpg" alt="img" />
                                        <h4>Blog 3</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand-box-item style-2">
                                <div class="brand-image">
                                    <a href="javascript:void();">
                                        <img src="front/assets/img/home-4.jpg" alt="img" />
                                        <h4>Blog 4</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="array-buttons">
                    <button class="array-prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="array-next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonial-Section Start -->
    <section class="testimonial-section section-padding fix">
        <div class="container">
            <div class="section-title text-center style-3">
                <h6 class="sub-title wow fadeInUp">{{__('lang.customers_review')}}</h6>
                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                    {{__('lang.what_clients_say')}}
                </h2>
            </div>
            <div class="swiper testimonial-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial-box-item">
                            <div class="client-info">
                                <div class="client-image">
                                    <img src="front/assets/img/testimonial/client-1.jpg" alt="img" />
                                </div>
                            </div>
                            <div class="testimonial-content">
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-duotone fa-solid fa-star"></i>
                                </div>
                                <p>
                                    Suscipit tellus mauris a diam maecenas. Ut faucibus pulvinar
                                    elementum integer enim neque volutpat ac. Auctor urna nunc
                                    id cursus. Scelerisque purus semper eget duis at. Pharetra
                                    vel turpis nunc eget.
                                </p>
                                <div class="client-info-item">
                                    <div class="client-info">
                                        <div class="text">
                                            <h6>Eila Weary / <span>Mother</span></h6>
                                        </div>
                                    </div>
                                    <div class="shape-image">
                                        <img src="front/assets/img/testimonial/shape.png" alt="img" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-box-item">
                            <div class="client-info">
                                <div class="client-image">
                                    <img src="front/assets/img/testimonial/client-2.jpg" alt="img" />
                                </div>
                            </div>
                            <div class="testimonial-content">
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-duotone fa-solid fa-star"></i>
                                </div>
                                <p>
                                    Suscipit tellus mauris a diam maecenas. Ut faucibus pulvinar
                                    elementum integer enim neque volutpat ac. Auctor urna nunc
                                    id cursus. Scelerisque purus semper eget duis at. Pharetra
                                    vel turpis nunc eget.
                                </p>
                                <div class="client-info-item">
                                    <div class="client-info">
                                        <div class="text">
                                            <h6>Penny Tool / <span>Mother</span></h6>
                                        </div>
                                    </div>
                                    <div class="shape-image">
                                        <img src="front/assets/img/testimonial/shape.png" alt="img" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-box-item">
                            <div class="client-info">
                                <div class="client-image">
                                    <img src="front/assets/img/testimonial/client-3.jpg" alt="img" />
                                </div>
                            </div>
                            <div class="testimonial-content">
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-duotone fa-solid fa-star"></i>
                                </div>
                                <p>
                                    Suscipit tellus mauris a diam maecenas. Ut faucibus pulvinar
                                    elementum integer enim neque volutpat ac. Auctor urna nunc
                                    id cursus. Scelerisque purus semper eget duis at. Pharetra
                                    vel turpis nunc eget.
                                </p>
                                <div class="client-info-item">
                                    <div class="client-info">
                                        <div class="text">
                                            <h6>Alexa Jake / <span>Mother</span></h6>
                                        </div>
                                    </div>
                                    <div class="shape-image">
                                        <img src="front/assets/img/testimonial/shape.png" alt="img" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-dot3 mt-5">
                <div class="dot"></div>
            </div>
            <div class="section-title-area mt-5 justify-content-center">
                <a href="#" class="theme-btn btn align-center">Get Started</a>
            </div>
        </div>
    </section>

    <!-- Feature-Section Start -->
    <!--<section class="feature-section-2 section-padding pt-0 fix">-->
    <!--    <div class="container">-->
    <!--        <div class="feature-wrapper style-2">-->
    <!--            <div class="feature-item style-2 wow fadeInUp" data-wow-delay=".2s">-->
    <!--                <div class="icon">-->
    <!--                    <img src="front/assets/img/icon/05.svg" alt="img" />-->
    <!--                </div>-->
    <!--                <div class="content">-->
    <!--                    <h6>Free Delivary</h6>-->
    <!--                    <p>Orders from all item</p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="feature-item wow fadeInUp" data-wow-delay=".4s">-->
    <!--                <div class="icon">-->
    <!--                    <img src="front/assets/img/icon/06.svg" alt="img" />-->
    <!--                </div>-->
    <!--                <div class="content">-->
    <!--                    <h6>Return & Refunf</h6>-->
    <!--                    <p>Maney back guarantee</p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="feature-item wow fadeInUp" data-wow-delay=".6s">-->
    <!--                <div class="icon">-->
    <!--                    <img src="front/assets/img/icon/07.svg" alt="img" />-->
    <!--                </div>-->
    <!--                <div class="content">-->
    <!--                    <h6>Member Discount</h6>-->
    <!--                    <p>Onevery order over RM140.00</p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="feature-item wow fadeInUp" data-wow-delay=".8s">-->
    <!--                <div class="icon">-->
    <!--                    <img src="front/assets/img/icon/08.svg" alt="img" />-->
    <!--                </div>-->
    <!--                <div class="content">-->
    <!--                    <h6>Support 24/7</h6>-->
    <!--                    <p>Contact us 24 hours a day</p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--<section class="feature-section-2 section-padding pt-0 fix">-->
    <!--    <div class="container">-->
    <!--        <div class="feature-wrapper style-2">-->
    <!--            <div class="feature-item style-2 wow fadeInUp" data-wow-delay=".2s">-->
    <!--                <div class="icon">-->
    <!--                    <img src="front/assets/img/icon/05.svg" alt="img" />-->
    <!--                </div>-->
    <!--                <div class="content">-->
    <!--                    <h6>Free Delivary</h6>-->
    <!--                    <p>Orders from all item</p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="feature-item wow fadeInUp" data-wow-delay=".4s">-->
    <!--                <div class="icon">-->
    <!--                    <img src="front/assets/img/icon/06.svg" alt="img" />-->
    <!--                </div>-->
    <!--                <div class="content">-->
    <!--                    <h6>Return & Refunf</h6>-->
    <!--                    <p>Maney back guarantee</p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="feature-item wow fadeInUp" data-wow-delay=".6s">-->
    <!--                <div class="icon">-->
    <!--                    <img src="front/assets/img/icon/07.svg" alt="img" />-->
    <!--                </div>-->
    <!--                <div class="content">-->
    <!--                    <h6>Member Discount</h6>-->
    <!--                    <p>Onevery order over RM140.00</p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="feature-item wow fadeInUp" data-wow-delay=".8s">-->
    <!--                <div class="icon">-->
    <!--                    <img src="front/assets/img/icon/08.svg" alt="img" />-->
    <!--                </div>-->
    <!--                <div class="content">-->
    <!--                    <h6>Support 24/7</h6>-->
    <!--                    <p>Contact us 24 hours a day</p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <style>
        .product-image {
            position: relative;
        }

        .badge {
            position: absolute;
            top: 6px;
            padding: 7px 10px;
            font-size: 16px;
            font-weight: 500;
            color: white;
            border-radius: 4px;
        }

        .badge-discount {
            left: 10px;
            background-color: #28a745;
            /* Green for discount */
        }

        .badge-warning {
            right: 10px;
            background-color: #ffc107;
            /* Bootstrap warning color */
        }

        .badge-danger {
            right: 10px;
            background-color: #dc3545;
            /* Bootstrap danger color */
        }

        .tab-content .product-collection-item .product-image {
            position: relative;
            overflow: hidden;
            background: #fff;
        }
    </style>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let currentSlideIndex = 0;
            let totalSlides = 3;
            let canScroll = true;
            let isSliderActive = true;
        
            // Initialize
            updateSlideIndicators();
        
            // Debounce function to limit how often a function can fire
            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }
        
            // Mouse wheel event for slider navigation
            $(window).on('wheel', debounce(function(e) {
                if (!canScroll) return;
        
                const delta = e.originalEvent.deltaY;
        
                if (isSliderActive) {
                    e.preventDefault();
                }
        
                if (isSliderActive) {
                    if (delta > 0) {
                        if (currentSlideIndex < totalSlides - 1) {
                            nextSlide();
                        } else {
                            isSliderActive = false;
                            $('body').css('overflow', 'auto');
                            $('html, body').animate({
                                scrollTop: $('.hs-page-content').offset().top
                            }, 600);
                        }
                    } else if (delta < 0) {
                        if (currentSlideIndex > 0) {
                            prevSlide();
                        }
                    }
                } else {
                    if (delta < 0 && $(window).scrollTop() <= 50) {
                        isSliderActive = true;
                        $('body').css('overflow', 'hidden');
                        showSlide(currentSlideIndex);
                    }
                }
        
                canScroll = false;
                setTimeout(function() {
                    canScroll = true;
                }, 600);
            }, 50));
        
            // Button click event for "what is ZERA Mom Subscription?" on Slide 1
            $('.hs-slide:nth-child(1) .hs-btn-2').on('click', function(e) {
                e.preventDefault();
                if (!canScroll) return;
        
                if (currentSlideIndex === 0) {
                    nextSlide(); // Move to Slide 2
                }
                canScroll = false;
                setTimeout(function() {
                    canScroll = true;
                }, 600);
            });
        
            // Button click event for "Next" on Slide 2
            $('.hs-slide:nth-child(2) .hs-btn-primary').on('click', function(e) {
                e.preventDefault();
                if (!canScroll) return;
        
                if (currentSlideIndex === 1) {
                    nextSlide(); // Move to Slide 3
                }
        
                canScroll = false;
                setTimeout(function() {
                    canScroll = true;
                }, 600);
            });
        
            // Handle "{{ __('lang.subscribe_now')}}" buttons (optional, for consistency)
            $('.hs-btn-primary').on('click', function(e) {
                if ($(this).parent().closest('.hs-slide').index() === 0 || $(this).parent().closest(
                        '.hs-slide').index() === 1) {
                    e.preventDefault();
                    if (!canScroll) return;
        
                    if (currentSlideIndex < totalSlides - 1) {
                        nextSlide();
                    }
        
                    canScroll = false;
                    setTimeout(function() {
                        canScroll = true;
                    }, 600);
                }
            });
        
            function nextSlide() {
                if (currentSlideIndex < totalSlides - 1) {
                    currentSlideIndex++;
                    showSlide(currentSlideIndex);
                }
            }
        
            function prevSlide() {
                if (currentSlideIndex > 0) {
                    currentSlideIndex--;
                    showSlide(currentSlideIndex);
                }
            }
        
            function showSlide(index) {
                $('.hs-slide').removeClass('hs-active hs-prev hs-next');
        
                $('.hs-slide').each(function(i) {
                    if (i < index) {
                        $(this).addClass('hs-prev');
                    } else if (i === index) {
                        $(this).addClass('hs-active');
                    } else {
                        $(this).addClass('hs-next');
                    }
                });
        
                updateSlideIndicators();
                if (isSliderActive) {
                    $('html, body').scrollTop(0);
                }
            }
        
            function updateSlideIndicators() {
                $('.hs-indicator').removeClass('hs-indicator-active');
                $('.hs-indicator').eq(currentSlideIndex).addClass('hs-indicator-active');
            }
        
            // Disable body scroll initially
            $('body').css('overflow', 'hidden');
        
            // Touch events for mobile
            let touchStartY = 0;
            let touchEndY = 0;
        
            $(document).on('touchstart', function(e) {
                touchStartY = e.originalEvent.touches[0].clientY;
            });
        
            $(document).on('touchmove', function(e) {
                if (isSliderActive) {
                    e.preventDefault();
                }
            });
        
            $(document).on('touchend', function(e) {
                if (!canScroll) return;
        
                touchEndY = e.originalEvent.changedTouches[0].clientY;
                let deltaY = touchStartY - touchEndY;
        
                if (Math.abs(deltaY) > 50) {
                    if (deltaY > 0) {
                        if (currentSlideIndex < totalSlides - 1) {
                            nextSlide();
                        } else {
                            isSliderActive = false;
                            $('body').css('overflow', 'auto');
                        }
                    } else if (deltaY < 0) {
                        if (currentSlideIndex > 0) {
                            prevSlide();
                        } else if (!isSliderActive && $(window).scrollTop() <= 50) {
                            isSliderActive = true;
                            $('body').css('overflow', 'hidden');
                            showSlide(currentSlideIndex);
                        }
                    }
        
                    canScroll = false;
                    setTimeout(function() {
                        canScroll = true;
                    }, 600);
                }
            });
        
            // Monitor scroll position to re-enable slider when scrolling up to top
            $(window).on('scroll', debounce(function() {
                if (!isSliderActive && $(window).scrollTop() <= 50) {
                    isSliderActive = true;
                    $('body').css('overflow', 'hidden');
                    showSlide(currentSlideIndex);
                }
            }, 50));
        
            // Keyboard navigation
            $(document).on('keydown', function(e) {
                if (!isSliderActive || !canScroll) return;
        
                if (e.keyCode === 40 || e.keyCode === 39) {
                    e.preventDefault();
                    if (currentSlideIndex < totalSlides - 1) {
                        nextSlide();
                    } else {
                        isSliderActive = false;
                        $('body').css('overflow', 'auto');
                    }
                } else if (e.keyCode === 38 || e.keyCode === 37) {
                    e.preventDefault();
                    if (currentSlideIndex > 0) {
                        prevSlide();
                    }
                }
            });
        });

        // $(document).ready(function() {
        //     // Handle Add to Cart button click
        //     $('.add-to-cart-btn').off('click').on('click', function() {
        //         var $button = $(this);
        //         var product_id = $button.data('product-id');
        //         var price = $button.data('price');
        //         var quantity = 1; // Default quantity, adjust if you have a quantity input

        //         // Prepare data for AJAX request
        //         var data = {
        //             _token: '{{ csrf_token() }}', // CSRF token for Laravel
        //             product_id: product_id,
        //             price: price,
        //             quantity: quantity
        //         };

        //         // AJAX request to add item to cart
        //         $.ajax({
        //             url: "{{ route('cart.add') }}", // Same route as in your first example
        //             method: 'POST',
        //             data: data,
        //             success: function(response) {
        //                 toastr.success('Item added to cart successfully.');
        //                 setTimeout(() => {
        //                     location.reload(); // Reload page to update cart UI
        //                 }, 450);
        //             },
        //             error: function(xhr) {
        //                 toastr.error('Failed to add to cart.');
        //             }
        //         });
        //     });
        // });

        $(document).ready(function() {
            // Handle Add to Cart button click
            $('.add-to-cart-btn').off('click').on('click', function() {
                var $button = $(this);
                var product_id = $button.data('product-id');
                var price = $button.data('price');
                var quantity = 1; // Default quantity, adjust if you have a quantity input

                // Prepare data for AJAX request
                var data = {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id,
                    price: price,
                    quantity: quantity
                    // Add fields, game_user_id, etc., if needed
                };

                // AJAX request to add item to cart
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);

                            // Update cart sidebar content
                            updateCartSidebar(response.cartItems, response.totalPrice);

                            // Show the cart sidebar
                            $('.menu-cart.style-2 .cart-box').show();

                            // Update cart icon count
                            updateCartCount(response.cartCount);
                        } else {
                            toastr.error('Failed to add to cart.');
                        }
                    },
                    error: function(xhr) {
                        toastr.error('Failed to add to cart.');
                    }
                });
            });

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
                                    updateCartSidebar(response.cartItems, response
                                        .totalPrice);
                                    updateCartCount(response.cartCount);
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

            // Function to update cart sidebar content
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
            //     <li data-product-id="${item.id}" data-is-model="0">
            //         <a href="javascript:void(0);" class="remove remove-cart-item" title="Remove this item">
            //             <i class="fa fa-remove"></i>
            //         </a>
            //         <img src="${photo}" alt="${item.name}" />
            //         <div class="cart-product">
            //             <a href="{{ route('product.detail', '') }}/${item.slug}" target="_blank">
            //                 ${item.name}
            //             </a>
            //             <span>RM ${parseFloat(item.price).toFixed(2)}</span>
            //             <p class="quantity">${item.quantity} x</p>
            //         </div>
            //     </li>`;
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
            // Function to update cart icon count
            function updateCartCount(count) {
                var $cartIconCount = $('.menu-cart.style-2 .cart-icon .total-count');
                if (count > 0) {
                    $cartIconCount.text(count).show();
                } else {
                    $cartIconCount.hide();
                }
            }

            // Handle remove item from cart


            // Existing cart sidebar toggle logic
            var $menuCart = $(".menu-cart.style-2");
            var $cartBox = $menuCart.find(".cart-box");
            var $cartIcon = $menuCart.find(".cart-icon");

            $cartBox.hide();

            // Toggle on cart icon click
            $cartIcon.on("click", function(e) {
                e.preventDefault();
                $cartBox.toggle();
            });

            // Hide cart when clicking outside
            $(document).on("click", function(e) {
                if (!$menuCart.is(e.target) && $menuCart.has(e.target).length === 0) {
                    $cartBox.hide();
                }
            });

            // Close button inside header
            var $closeHeader = $("#cartCloseHeader");
            if ($closeHeader.length) {
                $closeHeader.on("click", function() {
                    $closeHeader.closest(".cart-box").hide();
                });
            }

            // Also close on outside mousedown
            $(document).on("mousedown", function(e) {
                if ($cartBox.is(":visible") && !$cartBox.is(e.target) && $cartBox.has(e.target).length ===
                    0) {
                    $cartBox.hide();
                }
            });

        });
    </script>
@endsection
