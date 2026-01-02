{{-- @extends('front.layouts.app')

@section('title')
    {{ __('lang.subscribe_petit') }}
@endsection --}}

{{-- @section('content')
    <div class="hs-slider-container" id="hsSlider">
        <!-- Slide 1 -->
        <div class="hs-slide hs-active">
            <div class="row h-80 w-100 m-0">
                <div class="col-lg-6 p-0 hs-media-column">
                    <img src="front/assets/img/subscription-box-1.jpg" alt="Slide 1" class="hs-media-item">
                </div>
                <div class="col-lg-6 hs-content-column">
                    <h1 class="hs-heading">{{ __('lang.everything_a_mom_deserves')}}<br> {{ __('lang.all_in_one')}}</h1>
                    <p class="hs-description">
                       {{__('lang.one_price_big_value')}}
                    </p>
                    <div class="hs-button-group">
                        <a href="{{route('myaccount')}}" class="hs-btn hs-btn-primary" aria-label="Subscribe to ZERA Mom">{{ __('lang.subscribe_now')}}</a>
                        <a href="{{ route('front.about') }}" class="hs-btn-2" aria-label="Learn about ZERA Mom Subscription">{{__('lang.what_is_zera_mom_subscription')}}</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="hs-slide hs-next">
            <div class="row h-100 w-100 m-0">
                <div class="col-lg-6 p-0 hs-media-column">
                    <img src="front/assets/img/subscription-box.jpg" alt="Slide 1" class="hs-media-item">
                    <!--<video class="hs-media-item" autoplay muted loop>-->
                    <!--    <source src="front/assets/img/video/Zera-video.mp4" type="video/mp4">-->
                    <!--</video>-->
                </div>
                <div class="col-lg-6 hs-content-column">
                    <h1 class="hs-heading">{{ __('lang.try_before_buy')}}</h1>
                    <p class="hs-description">
                       {!! __('lang.choose_favorites') !!}
                    </p>
                    <div class="hs-button-group">
                        <a href="{{route('myaccount')}}" class="hs-btn hs-btn-primary" aria-label="Go to next slide">{{ __('lang.next')}}</a>
                        <a href="/subscriber-form" class="hs-btn" aria-label="Subscribe to ZERA Mom">{{ __('lang.subscribe_now')}}</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="hs-slide hs-next">
            <div class="row h-100 w-100 m-0">
                <div class="col-lg-6 p-0 hs-media-column">
                    <img src="front/assets/img/subscription-box-2.jpg" alt="Slide 3" class="hs-media-item">
                </div>
                <div class="col-lg-6 hs-content-column">
                    <h1 class="hs-heading">{{__('lang.what_else_do_i_get')}}</h1>
                    <ul>
                        <li><img src="front/assets/img/sub-slide-1.png" alt="Slide 3" class="hs-li-item">{{__('lang.free_discount_entry')}}</li>
                        <li><img src="front/assets/img/sub-slide-2.png" alt="Slide 3" class="hs-li-item">{{__('lang.Funeducationalclasses')}}</li>
                        <li><img src="front/assets/img/sub-slide-3.png" alt="Slide 3" class="hs-li-item">{{__('lang.Specialmemberonlyshoppingdiscounts')}}</li>
                        <li><img src="front/assets/img/sub-slide-4.png" alt="Slide 3" class="hs-li-item">{{__('lang.Excitingmonthlygiveaways')}}</li>
                        <li>{{__('lang.AndMANYMORE')}}</li>
                    </ul>
                    <div class="hs-button-group">
                        <a href="{{route('myaccount')}}" class="hs-btn hs-btn-primary" aria-label="Go to page content">{{__('lang.next')}}</a>
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


    <!-- Product-box Section Start -->
    <section class="product-box-section subscribe-steps section-padding fix">
        <div class="container">
            <div class="section-title text-center style-3 mb-4">
                <h2 class="wow fadeInUp" data-wow-delay=".3s">{{__('lang.why_petit_plus')}}</h2>
            </div>
            <div class="row g-0">
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="product-box-item style-2">
                        <div class="product-image">
                            <img src="front/assets/img/sub-box-1.svg" alt="Slide 3" class="substep-box">
                        </div>
                        <div class="product-content">
                            <h3>{{__('lang.value_guaranteed')}}</h3>
                            <p>{{__('lang.value_description')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".s">
                    <div class="product-box-item">
                        <div class="product-image">
                            <img src="front/assets/img/o-2.svg" alt="Slide 3" class="substep-box">
                        </div>
                        <div class="product-content">
                            <h3>{{__('lang.actual_sized_only')}}</h3>
                            <p>{{__('lang.actual_sized_description')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                    <div class="product-box-item mb-0">
                        <div class="product-image">
                            <img src="front/assets/img/o-3.svg" alt="Slide 3" class="substep-box">
                        </div>
                        <div class="product-content">
                            <h3>{{__('lang.choose_what_to_try')}}</h3>
                            <p>
                               {{__('lang.choose_what_to_try_description')}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                    <div class="product-box-item mb-0">
                        <div class="product-image">
                            <img src="front/assets/img/o-1.svg" alt="Slide 3" class="substep-box">
                        </div>
                        <div class="product-content">
                            <h3>{{__('lang.real_stuff')}}</h3>
                            <p>{{__('lang.real_stuff_description')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Brand-section Start -->
    <div class="brand-section fix">
        <div class="container">
            <div class="section-title text-center style-3 mb-4">
                <h2 class="wow fadeInUp" data-wow-delay=".3s">{{__('lang.brand_partners')}}</h2>
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
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/13.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/14.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/15.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/16.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/17.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/18.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/19.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/20.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/21.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/22.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/23.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/24.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/25.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/26.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/27.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/28.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/29.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/30.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/31.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/32.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/33.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/34.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/35.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/36.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/37.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/38.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/39.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/40.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/41.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/42.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/43.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/44.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/45.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/46.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/47.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/48.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/49.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/50.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/51.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/52.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/53.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/54.png" alt="brand-img" />
                                </div>
                            </div>
                        </div>
                         <div class="swiper-slide">
                            <div class="brand-box-item">
                                <div class="brand-image">
                                    <img src="front/assets/img/brand/55.png" alt="brand-img" />
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
    <section class="product-collection-section section-bg section-padding fix">
        <div class="container">
            <div class="section-title text-center style-3 mb-4">
                <h6 class="sub-title wow fadeInUp">{{__('lang.product_collection')}}</h6>
                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                    {{__('lang.exclusive_pick')}}
                </h2>
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
                                                @endif --}}
                                                {{-- @if ($product->label === 'zeera_pick')
                                                    <div class="badge badge-warning">Zeera Pick</div>
                                                @elseif ($product->label === 'addon' && $product->addon_price)
                                                    <div class="badge badge-danger">
                                                        +RM{{ number_format($product->addon_price, 2) }}</div>
                                                @endif --}}
                                            {{-- </div>

                                            <div class="product-btn"> --}}
                                                {{--<a href="javascript:void(0);" class="theme-btn-2 add-to-cart-btn"
                                                    data-product-id="{{ $product->id }}"
                                                    data-price="{{ $product->price - ($product->price * ($product->discount ?? 0)) / 100 }}"
                                                    id="addToCartBtn-{{ $product->id }}">
                                                    {{ __('lang.Add_to_cart') }}
                                                </a>--}}
                                                {{-- <a href="{{ route('choose-products') }}" class="theme-btn-2">
                                                    {{ __('lang.subscribe_now') }}
                                                </a> --}}
                                            {{-- </div>
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
                    <a href="{{ route('choose-products') }}" class="theme-btn">{{__('lang.view_all_products')}}</a>
                </div>
            </div>
    </section>

    <div class="eticket-section fix">
        <div class="container">
            <div class="section-title text-center style-3 mb-4">
                <h2 class="wow fadeInUp" data-wow-delay=".3s">{{__('lang.featured_eticket')}}</h2>
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
                                            <a href="{{ route('product.detail', $ticket->slug) }}">
                                                <img src="{{ $getimageSrc }}" alt="brand-img" />
                                                <p>{{ $ticket->name }}</p>
                                                <!--<h5>{{ $ticket->price }}</h5>-->
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


    <!-- Testimonial-Section Start -->
    <section class="testimonial-section section-padding fix">
        <div class="container">
            <div class="section-title text-center style-3">
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
                                    <img src="front/assets/img/testi-1.jpg" alt="img" />
                                </div>
                            </div>
                            <div class="testimonial-content"> --}}
                                {{-- <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-duotone fa-solid fa-star"></i>
                                </div> --}}
                                {{-- <p>刚刚收到了他们寄来的包裹，一打开就被惊喜到了！🎁
                                    不仅收到了我自选的两组心仪产品，官方居然还额外为我搭配了一组专属产品！💝
                                    整个包裹的价值直接超过RM100！而且还塞满了各种试用装，真的太贴心、太大方了！🤩</p>

                                    <p>在这里必须狠狠夸一下这个妈咪俱乐部，简直是我们忙碌生活中的一束光！✨</p>

                                    <p>这种花小钱就能提升生活品质和幸福感的方式，真的太适合我们妈妈了！已经迫不及待想试试这次收到的所有好东西啦！🥳</p>
                                <div class="client-info-item">
                                    <div class="client-info">
                                        <div class="text">
                                            <h6>小红书 ：@Bnylsy_</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-box-item">
                            <div class="client-info">
                                <div class="client-image">
                                    <img src="front/assets/img/testi-2.gif" alt="img" />
                                </div>
                            </div>
                            <div class="testimonial-content"> --}}
                                {{-- <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-duotone fa-solid fa-star"></i>
                                </div> --}}
                                {{-- <p>I can get mom & kids essentials worth above RM100 from @zeramom!<br>Choose 2 items, and the rest is a surprise box just for us 💛</p>
                                <p>Try premium products at affordable price, plus enjoy so many member perks.<br>Go join ZÉRA Mom Club, best gila! 💛</p>
                                <p>#ZeraMomClub #MomLife #MomMalaysia #ZeraMom #UnboxingZèraMomClub #MomEssentials #KidsEssentials</p>
                                <div class="client-info-item">
                                    <div class="client-info">
                                        <div class="text">
                                            <h6>Instagram : @zainabaniaz</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-box-item">
                            <div class="client-info">
                                <div class="client-image">
                                    <img src="front/assets/img/testi-3.jpg" alt="img" />
                                </div>
                            </div>
                            <div class="testimonial-content"> --}}
                                {{-- <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-duotone fa-solid fa-star"></i>
                                </div> --}}
                                {{-- <p>Every month, I get 3 full-sized premium products (worth over RM100!), fun perks for playlands and parks, member-only discounts, and even self-care sessions just for moms. 🌿</p>
                                <p>Honestly, this couldn’t have come at a better time — saving money and discovering products I actually like? Yes, please. </p>
                                <div class="client-info-item">
                                    <div class="client-info">
                                        <div class="text">
                                            <h6>Instagram : @sammxavierrr</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-dot3 mt-3">
                <div class="dot"></div>
            </div>
            <div class="section-title-area mt-3 justify-content-center">
                <a href="{{route('myaccount')}}" class="theme-btn align-center">{{__('lang.get_started')}}</a>
            </div>
        </div>
    </section> --}}
{{-- @endsection --}}
    {{-- <style>
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

    </style> --}}
{{-- @endsection --}}
{{-- @section('scripts')
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
@endsection --}}



@extends('front.layouts.urwah_partials.app')
@section('content')


<main>
                    <!--====== Start Page Banner ======-->
                    <section class="page-banner bg_cover p-r z-1" style="background-image: url(assets/images/home/hero/hero-bg-1.jpg);">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="page-content text-center">
                                        <h1>Subscription</h1>
                                        <ul>
                                            <li><a href="#">Home</a></li>
                                            <li>/</li>
                                            <li>Subscription</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--====== End Page Banner ======-->
                    <section class="cs-subscribe-sec primary-bgcolor-3 py-lg-0 py-5">
                        <div class="container">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-lg-4 col-md-6 order-lg-1 order-1">
                                    <!-- Bistly Content Box -->
                                    <div class="bistly-content-box mb-lg-0 mb-5 text-center text-lg-start" data-aos="fade-up" data-aos-duration="1000">
                                        <h2 class="text-anm primary-color-1">Never Run Out of Essentials</h2>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 order-lg-2 order-3">
                                    <!-- Bistly Image -->
                                    <div class="bistly-image">
                                        <img src="{{asset('assets/images/home/about/about-img3.jpg')}}" alt="about image">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 order-lg-3 order-2">
                                    <!-- CS Text Box -->
                                    <div class="text-box mb-lg-0 mb-5 text-center text-lg-start" data-aos="fade-up" data-aos-duration="1200">
                                        <p  class="heading-font mb-3 ms-4 h5" data-aos="fade-up" data-aos-duration="1000">Keep your shelves stocked, save on costs, and focus on running your business. With Tapo’s subscription service, you’ll always have the eco-friendly packaging you need—delivered to you on time, every time.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--====== Start About Section ======-->

                    <!--====== Start Fun Fact Section ======-->
                    <section class="bistly-fun-fact how-its-work-sec py-5 primary-bgcolor-2">
                        <div class="container">
                            <div class="counter-item-wrapper">
                                <div class="row py-lg-4">
                                    <div class="bistly-content-box mb-5 text-center" data-aos="fade-up" data-aos-duration="1000">
                                        <h2 class="text-anm primary-color-1">How It Works</h2>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 counter-item-border">
                                        <!-- Bistly Counter Item -->
                                        <div class="bistly-counter-item text-center mb-4" data-aos="fade-up" data-aos-duration="800">
                                            <div class="icon">
                                                <img src="{{asset('assets/images/home/subscription/choose.svg')}}" alt="subscription Image">
                                            </div>
                                            <div class="content">
                                                <h4 class="primary-color-1">Select Your Products</h4>
                                                <p>Choose the eco-friendly packaging your business uses most and build a subscription that fits your needs.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 counter-item-border">
                                        <!-- Bistly Counter Item -->
                                        <div class="bistly-counter-item text-center mb-4" data-aos="fade-up" data-aos-duration="1000">
                                            <div class="icon">
                                                <img src="{{asset('assets/images/home/subscription/schedule.svg')}}" alt="subscription Image">
                                            </div>
                                            <div class="content">
                                                <h4 class="primary-color-1">Set Your Schedule</h4>
                                                <p>Pick a delivery frequency—weekly, bi-weekly, or monthly—so you always get supplies on time.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 counter-item-border">
                                        <!-- Bistly Counter Item -->
                                        <div class="bistly-counter-item text-center mb-4" data-aos="fade-up" data-aos-duration="1200">
                                            <div class="icon">
                                                <img src="{{asset('assets/images/home/subscription/save.svg')}}" alt="subscription Image">
                                            </div>
                                            <div class="content">
                                                <h4 class="primary-color-1">Save & Relax</h4>
                                                <p>Enjoy 5% off, guaranteed stock, and hassle-free deliveries that keep your business moving smoothly.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bistly-button mt-3 text-center" data-aos="fade-up" data-aos-duration="1600">
                                    <a href="choose-product.html" class="theme-btn style-one">Subscribe Now & Save 5%</a>
                                </div>
                            </div>
                        </div>
                    </section><!--====== End Fun Fact Section ======-->

                    <!--======  Start About Section  ======-->
                    <section class="rs-about p-r">
                        <div class="container-fuild">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Bistly Content Box -->
                                    <div class="marquee-container-2 primary-bgcolor">
                                      <div class="marquee-track" data-aos="fade-up" data-aos-duration="1200">
                                        <span class="marquee-text-2 primary-color-1">Bulk Orders Available ✸ Kraft Paper-Based Packaging ✸ Petaling Jaya-Based ✸ 100% Biodegradable Products ✸ </span>
                                        <span class="marquee-text-2 primary-color-1">Bulk Orders Available ✸ Kraft Paper-Based Packaging ✸ Petaling Jaya-Based ✸ 100% Biodegradable Products ✸ </span>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--======  End About Section  ======-->
                    <!--====== Start Fun Fact Section ======-->
                    <section class="bistly-fun-fact why-subscribe-sec py-5 primary-bgcolor-1">
                        <div class="container">
                            <div class="counter-item-wrapper">
                                <div class="row py-lg-4">
                                    <div class="bistly-content-box mb-5 text-center" data-aos="fade-up" data-aos-duration="1000">
                                        <h2 class="text-anm primary-color">Why Subscribe?</h2>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 counter-item-border">
                                        <!-- Bistly Counter Item -->
                                        <div class="bistly-counter-item text-center mb-4" data-aos="fade-up" data-aos-duration="800">
                                            <div class="icon">
                                                <img src="{{asset('assets/images/home/about/client.png')}}" alt="about Image">
                                            </div>
                                            <div class="content">
                                                <h4 class="primary-color-2">Peace of Mind</h4>
                                                <p class="primary-color-2">Automatic deliveries mean you never worry about running low on packaging.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 counter-item-border">
                                        <!-- Bistly Counter Item -->
                                        <div class="bistly-counter-item text-center mb-4" data-aos="fade-up" data-aos-duration="1000">
                                            <div class="icon">
                                                <img src="{{asset('assets/images/home/about/order.png')}}" alt="about Image">
                                            </div>
                                            <div class="content">
                                                <h4 class="primary-color-2">Exclusive Savings</h4>
                                                <p class="primary-color-2">Enjoy an extra 5% discount on every subscription order.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 counter-item-border">
                                        <!-- Bistly Counter Item -->
                                        <div class="bistly-counter-item text-center mb-4" data-aos="fade-up" data-aos-duration="1200">
                                            <div class="icon">
                                                <img src="{{asset('assets/images/home/about/eco-com.png')}}" alt="about Image">
                                            </div>
                                            <div class="content">
                                                <h4 class="primary-color-2">Flexible Plans</h4>
                                                <p class="primary-color-2">Choose quantities and delivery schedules that match your business needs.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 counter-item-border">
                                        <!-- Bistly Counter Item -->
                                        <div class="bistly-counter-item text-center mb-4" data-aos="fade-up" data-aos-duration="1400">
                                            <div class="icon">
                                                <img src="{{asset('assets/images/home/about/expertise.png" alt="about Image')}}">
                                            </div>
                                            <div class="content">
                                                <h4 class="primary-color-2">Sustainable Choice</h4>
                                                <p class="primary-color-2">Every order supports your shift towards greener, biodegradable solutions.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--====== End Fun Fact Section ======-->
                </main>


@stop
