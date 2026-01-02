@extends('front.layouts.app')
@section('title')
    {{ __('lang.monthly_page') }}
@endsection
@section('content')
    <!-- Pages Banner Section Start -->
    <section class="pages-banner-section">
        <div class="hero-2">
            <div class="hero-bg" style="background-image: url({{ asset('front/assets/img/pages-bg.jpg') }})">
                <div class="hero-overlay"></div>
            </div>
            <div class="container">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="section-title-area pbanner-content text-center">
                            <!-- Banner (able to slide) -->
                            <div class="banner-slider">
                                <div class="banner-slide">
                                    {{-- <img src="{{ asset('front/assets/img/banner-slide.jpg') }}" alt="Banner Slide" class="img-fluid"> --}}
                                    <div class="banner-text">
                                        <h2>Get Your Beauty Delivered <br> to Your Doorstep</h2>
                                        {{-- <p>The best deal on beauty just got better. Join today and get 5% off your first order!</p>
                                        <a href="#" class="btn btn-primary">Get Glam Now</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section Start -->
    <section class="products-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h2>Discover what you get in {{ ucfirst($month) }}</h2>
                    <p class="text-muted">Below are products featured in the {{ ucfirst($month) }} lineup. Members received {{ $products->getProducts() ? count($products->getProducts()) : 0 }} products from this collection.</p>
                </div>
                <div class="col-12 mt-4">
                    <div class="row g-4 product-grid" id="default-products">
                        @if (!empty($products))
                            @foreach ($products->getProducts() as $product)
                                @php
                                    $priceData = normal_product_price_range($product);
                                    $firstImage = $product->media->first();
                                    $imageSrc = $firstImage ? asset($firstImage->image_path) : ($product->featured_image ? asset($product->featured_image) : asset('assets/img/product/01.jpg'));
                                @endphp
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="product-item">
                                        <a href="{{ route('product.detail', $product->slug) }}">
                                            <div class="product-image">
                                                <img src="{{ $imageSrc }}" alt="{{ $product->name }}" class="img-fluid">
                                                
                                            </div>
                                            <div class="product-content">
                                                <h4>{{ $product->name }}</h4>
                                                <div class="product-price">{{ $priceData['formatted_price'] }}</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h4 class="text-warning text-center">{{ __('lang.there_are_no_products') }}</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Announcement Section Start -->
    <section class="announcement-section py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 text-center">
                    <h2>{{ __('lang.announcement') }}</h2>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <img src="{{ asset('front/assets/img/home-1.jpg') }}" alt="Announcement 1" class="img-fluid">
                            <p class="mt-2">4 IPSY Stashers Share Why They’re Obsessed With This JO MALONE Scent</p>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('front/assets/img/home-2.jpg') }}" alt="Announcement 2" class="img-fluid">
                            <p class="mt-2">Glitter? Check. SPPS Double Cheek. Your Festive Beauty List Starts Here</p>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('front/assets/img/home-3.jpg') }}" alt="Announcement 3" class="img-fluid">
                            <p class="mt-2">Turns Out Brown Mascara Is the Vibe This Spring—These Are Our Faves</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tips and Trends Section Start -->
    <section class="tips-trends-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h2>{{ __('lang.the_tips_and_trends_you_need_to_know') }}</h2>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <img src="{{ asset('front/assets/img/instagram/01.jpg') }}" alt="Tip 1" class="img-fluid">
                        <p class="mt-2">Decoding Sebum: Sneaky Effects on Your Skin and How to Fight It</p>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('front/assets/img/instagram/02.jpg') }}" alt="Tip 2" class="img-fluid">
                        <p class="mt-2">Our Favorite Latinx-Led Beauty Brands to Try Now and Forever</p>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('front/assets/img/instagram/03.jpg') }}" alt="Tip 3" class="img-fluid">
                        <p class="mt-2">These Spooky Season Makeup Looks Are All About the Eyes</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .banner-slider {
            position: relative;
            overflow: hidden;
        }
        .banner-slide {
            display: none;
        }
        .banner-slide img {
            width: 100%;
            height: auto;
        }
        .banner-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
        }
        .product-item {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .product-image {
            position: relative;
            overflow: hidden;
        }
        .product-price {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
        }
        @media (max-width: 768px) {
            .product-grid {
                flex-direction: column;
            }
            .product-item {
                margin-bottom: 20px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Simple slider for banner
        let slideIndex = 0;
        const slides = document.getElementsByClassName("banner-slide");
        function showSlides() {
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 5000); // Change slide every 5 seconds
        }
        showSlides();
    </script>
@endpush