{{-- @extends('front.layouts.app')

@section('title', 'Home | ' . config('app.name'))

@section('content')
    <!-- Hero Section Start -->
    <section class="hero-section-2">
        <div class="arrow-button">
            <button class="array-prev">
                <i class="fa-light fa-chevron-left"></i>
            </button>
            <button class="array-next">
                <i class="fa-light fa-chevron-right"></i>
            </button>
        </div>
        <div class="swiper hero-slider monthly-hero-slider">
            <div class="swiper-wrapper">
                @foreach ($homeSliders as $homeSlider)
                    <div class="swiper-slide">
                        <div class="hero-3">
                            <div class="hero-bg bg-cover"
                                style="background-image: url({{ asset($homeSlider->background_image) }});"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Category Section Start -->
    <section class="product-collection-section section-bg section-padding fix">
        <div class="container">
            <div class="section-title text-center style-3 mb-4">
                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                    {{ __('lang.ExploreZeraMomUniverse') }}
                </h2>
            </div>
            <div class="tab-content">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="news-card-items style-2">
                            <a href="{{ route('subscribe-petit') }}">
                                <div class="news-image">
                                    <img src="{{ asset('front/assets/img/home-1.jpg') }}" alt="img">
                                </div>
                                <div class="news-content">
                                    <h3>
                                        {{ __('lang.zera_mom_club_heading') }}
                                    </h3>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="news-card-items style-2">
                            <a href="{{ route('front.shop') }}">
                                <div class="news-image">
                                    <img src="{{ asset('front/assets/img/home-2.jpg') }}" alt="img">
                                </div>
                                <div class="news-content">
                                    <h3>
                                        {{ __('lang.shop_heading') }}
                                    </h3>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="news-card-items style-2">
                            <a href="#">
                                <div class="news-image">
                                    <img src="{{ asset('front/assets/img/home-3.jpg') }}" alt="img">
                                </div>
                                <div class="news-content">
                                    <h3>
                                        {{ __('lang.announcement_heading') }}
                                    </h3>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="news-card-items style-2">
                            <a href="{{ route('front.blog.list') }}">
                                <div class="news-image">
                                    <img src="{{ asset('front/assets/img/home-4.jpg') }}" alt="img">
                                </div>
                                <div class="news-content">
                                    <h3>
                                        {{ __('lang.blog_heading') }}
                                    </h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About-Section Start -->
    <section class="about-section about-hsection section-bg section-padding fix">
        <div class="container">
            <div class="about-wrapper style-2">
                <div class="row g-4">
                    <div class="col-xl-6">
                        <div class="about-image">
                            <img src="{{ asset('front/assets/img/home-about-1.jpg') }}" alt="img" class="wow fadeInUp"
                                data-wow-delay=".3s">
                            <div class="about-image-2">
                                <img src="{{ asset('front/assets/img/home-about-2.jpg') }}" alt="img"
                                    class="wow fadeInUp" data-wow-delay=".5s">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="about-content">
                            <div class="section-title style-2">
                                <h6 class="sub-title wow fadeInUp">
                                    {{ __('lang.AboutzeraMom') }}
                                </h6>
                                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                    {{ __('lang.perfectly_imperfect') }}
                                </h2>
                            </div>
                            <div class="text">
                                <p class="wow fadeInUp color-theme" data-wow-delay=".5s">
                                    {{ __('lang.AboutzeraMom_para1') }}
                                    <br><br>
                                    {{ __('lang.AboutzeraMom_para2') }}
                                    <br><br>
                                    {{ __('lang.AboutzeraMom_para3') }}
                                    <br><br>
                                    {{ __('lang.AboutzeraMom_para4') }}
                                </p>
                                <h3 class="mt-lg-3">{{ __('lang.HowItAllBegan') }}</h3>
                                <p class="wow fadeInUp color-theme mt-lg-2" data-wow-delay=".5s">
                                    {{ __('lang.HowItAllBegan_para1') }}
                                    <br><br>
                                    {{ __('lang.HowItAllBegan_para2') }}
                                    <br><br>
                                    {{ __('lang.HowItAllBegan_para3') }}
                                    <br><br>
                                    {{ __('lang.HowItAllBegan_para4') }}
                                </p>
                                <a href="{{ route('front.about') }}" class="theme-btn wow fadeInUp"
                                    data-wow-delay=".7s">{{ __('lang.MoreAboutUs') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- contact-us-Section Start -->
    <section class="contact-about-us contact-us-section section-bg-2 section-padding fix">
        <div class="container">
            <div class="section-title text-center style-3">
                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                    {{ __('lang.FreeMemberSignUp') }}
                </h2>
            </div>
            <p class="text-center color-theme">{{ __('lang.Getuptodateonourlatestdiscountseventshappenings') }}</p>
            <div class="conatct-main-wrapper">
                <div class="contact-box-wrapper">
                    <div class="row g-4">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="comment-form-wrap">
                                <form action="javascript:void(0);" id="contact-form2" method="POST">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="text" name="name" class="" id="name20"
                                                    placeholder="{{ __('lang.YourName') }}" value="" required=""
                                                    autocomplete="name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="text" name="last_name" class="" id="last_name20"
                                                    placeholder="{{ __('lang.last_name') }}" value="" required=""
                                                    autocomplete="last_name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="number" name="phone" class="" id="phone20"
                                                    placeholder="{{ __('lang.Phone') }}" value="" required=""
                                                    autocomplete="phone">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="email" name="email" class="" id="email20"
                                                    placeholder="{{ __('lang.your_email') }}" value="" required=""
                                                    autocomplete="email">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="password" name="password" id="password2"
                                                    placeholder="{{ __('lang.create_password') }}" class="" required=""
                                                    autocomplete="new-password">
                                                <div class="icon toggle-password" data-target="#password2">
                                                    <i class="far fa-eye-slash"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="password" name="password_confirmation" id="password3"
                                                    placeholder="{{ __('lang.Confirm_Password') }}" class="" required=""
                                                    autocomplete="new-password">
                                                <div class="icon toggle-password" data-target="#password3">
                                                    <i class="far fa-eye-slash"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="theme-btn header-btn">
                                                {{ __('lang.CreateYourFreeAccount') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {

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
            function updateCartSidebar(cartItems, totalPrice) {
                var $cartList = $('.menu-cart.style-2 .cart-box ul');
                var $cartTotal = $('.totalPrice');
                $cartList.empty(); // Clear current cart items

                if (cartItems.length > 0) {
                    // Group items by product_id to prevent duplicates
                    var groupedItems = {};
                    var localTotalPrice = 0;

                    $.each(cartItems, function(index, item) {
                        var productId = item.product_id || item.id; // Handle different response formats
                        if (!groupedItems[productId]) {
                            groupedItems[productId] = {
                                ...item,
                                quantity: 0
                            };
                        }
                        groupedItems[productId].quantity += parseInt(item.quantity, 10);
                        localTotalPrice += parseFloat(item.price) * parseInt(item.quantity, 10);
                    });

                    // Render grouped items
                    $.each(groupedItems, function(productId, item) {
                        var photo = item.image ?
                            (item.image.includes(',') ?
                                window.baseURL + '/' + item.image.split(',')[0].trim() :
                                window.baseURL + '/' + item.image) :
                            window.baseURL + '/front/assets/img/product/01.jpg';

                        var cartItemHtml = `
                <li data-product-id="${item.id}" data-is-model="0">
                    <a href="javascript:void(0);" class="remove remove-cart-item" title="Remove this item">
                        <i class="fa fa-remove"></i>
                    </a>
                    <img src="${photo}" alt="${item.name}" />
                    <div class="cart-product">
                        <a href="{{ route('product.detail', '') }}/${item.slug}" target="_blank">
                            ${item.name}
                        </a>
                        <span>RM ${parseFloat(item.price).toFixed(2)}</span>
                        <p class="quantity">${item.quantity} x</p>
                    </div>
                </li>`;
                        $cartList.append(cartItemHtml);
                    });

                    // Update total price
                    $cartTotal.text(`RM ${parseFloat(totalPrice).toFixed(2)}`);

                    // Show cart buttons
                    $('.menu-cart.style-2 .cart-box .cart-button').show();
                } else {
                    $cartList.append('<li>No items in cart.</li>');
                    $cartTotal.text(`RM 0.00`);
                    $('.menu-cart.style-2 .cart-box .cart-button').hide();
                }
            }

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
@endsection --}}

@extends('front.layouts.urwah_partials.app')
@section('content')
  <main>
                    <!--======  Start Hero Section  ======-->
                    <section class="rs-hero bg_cover" style="background-image: url(assets/images/home/hero/hero-bg-1.jpg);">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-lg-6 hero-col-1">
                                    <div class="hero-content text-center">
                                        <h1 class="text-anm">Biodegradable Food Packaging</h1>
                                        <p data-aos="fade-up" data-aos-duration="1000">Eco-friendly kraft paper-based packaging</p>
                                        <div class="bistly-button pb-5" data-aos="fade-up" data-aos-duration="1200">
                                            <a href="#" class="theme-btn style-two">Explore Our Products</a>
                                        </div>
                                        <img src="assets/images/home/hero/herogif.gif">
                                    </div>
                                </div>
                                <div class="col-lg-6 hero-col-2 bg_cover" style="background-image: url(assets/images/home/hero/hero-img3.jpg);">

                                </div>
                            </div>
                        </div>
                    </section><!--======  End Hero Section  ======-->

                    <!--======  Start About Section  ======-->
                    <section class="rs-about p-r">
                        <div class="container-fuild">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Bistly Content Box -->
                                    <div class="marquee-container">
                                      <div class="marquee-track">
                                        <span class="marquee-text">Bulk Orders Available ✸ Kraft Paper-Based Packaging ✸ Petaling Jaya-Based ✸ 100% Biodegradable Products ✸ </span>
                                        <span class="marquee-text">Bulk Orders Available ✸ Kraft Paper-Based Packaging ✸ Petaling Jaya-Based ✸ 100% Biodegradable Products ✸ </span>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--======  End About Section  ======-->

                    <!--====== Start Feature Section ======-->
                    <section class="bistly-features-sec rs-about p-r z-1 py-5">
                        <div class="shape shape-one"><span><img src="assets/images/home/about/shape3.png" alt="shape"></span></div>
                        <div class="shape shape-two"><span><img src="assets/images/home/about/shape2.png" alt="shape"></span></div>
                        <div class="shape shape-three"><span><img src="assets/images/home/about/shape1.png" alt="shape"></span></div>
                        <div class="container">
                            <div class="row align-items-center py-5 justify-content-center">
                                <div class="col-xl-6 col-lg-8">
                                    <!-- Bistly Content Box -->
                                    <div class="bistly-content-box">
                                        <div class="section-title mb-4">
                                            <span class="sub-title" data-aos="fade-down" data-aos-duration="1000">About Tapo</span>
                                            <h2 class="text-anm primary-color-1">Driven by Sustainability</h2>
                                        </div>
                                        <p class="heading-font mb-3 h5" data-aos="fade-up" data-aos-duration="1000">Tapo is a wholesale business based in Petaling Jaya, Selangor, specializing in biodegradable food packaging made from kraft paper.</p>
                                        <p>We are committed to supporting restaurants, cafes, food vendors, and retailers across West Malaysia with eco-friendly packaging solutions that align with today’s sustainability standards. As a reliable B2B supplier, we offer high-quality, durable, and affordable packaging options that help businesses reduce their environmental impact without compromising functionality. With a focus on long-term partnerships, we aim to make sustainable packaging the new standard for food-related industries.</p>
                                        <div class="row mt-3">
                                            <div class="col-sm-4">
                                                <!-- Bistly Iconic Box -->
                                                <div class="bistly-iconic-box mb-4" data-aos="fade-up" data-aos-duration="1200">
                                                    <div class="icon">
                                                        <img src="assets/images/home/about/b2b.png" alt="shape">
                                                    </div>
                                                    <div class="content">
                                                        <p>Trusted B2B Partner</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <!-- Bistly Iconic Box -->
                                                <div class="bistly-iconic-box mb-4" data-aos="fade-up" data-aos-duration="1400">
                                                    <div class="icon">
                                                        <img src="assets/images/home/about/wholesale.png" alt="shape">
                                                    </div>
                                                    <div class="content">
                                                        <p>Wholesale Expertise</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <!-- Bistly Iconic Box -->
                                                <div class="bistly-iconic-box mb-4" data-aos="fade-up" data-aos-duration="1400">
                                                    <div class="icon">
                                                        <img src="assets/images/home/about/eco.png" alt="shape">
                                                    </div>
                                                    <div class="content">
                                                        <p>Eco Commitment</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bistly-button mt-3" data-aos="fade-up" data-aos-duration="1600">
                                            <a href="{{ route('front.about') }}" class="theme-btn style-one">Read More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <!-- Bistly Image -->
                                    <div class="bistly-image text-center text-xl-end mt-xl-0 mt-5" data-aos="fade-down" data-aos-duration="1800">
                                        <img src="assets/images/home/about/about-img3.jpg" alt="Feature Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--====== End Feature Section ======-->

                    <!--======  Start Popular Section  ======-->
                    <section class="popular-section pt-5 pb-5" style="background-image: url(assets/images/home/about/tapo-bg-3.jpg);">
                        <div class="container">
                            <div class="row justify-content-center pt-5">
                                <div class="col-xl-6 col-lg-8">
                                    <!-- Section Title -->
                                    <div class="section-title text-center mb-xl-0 mb-5">
                                        <h2 class="mb-3 text-anm primary-color-1">Why Choose Tapo</h2>
                                        <p class="px-5 pb-5" data-aos="fade-up" data-aos-duration="1000">Tapo delivers eco-friendly, kraft paper-based packaging with wholesale pricing and reliable service.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-xl-4 col-md-6">
                                    <!-- Bistly Popular Item -->
                                    <div class="popular-item-list item-list-left" data-aos="fade-right" data-aos-duration="1000">
                                        <!-- Bistly Popular Item -->
                                        <div class="bistly-popular-item bistly-popular-item-left mb-5">
                                            <div class="icon">
                                                <img src="assets/images/home/about/icons/eco.png" alt="Eco-Friendly Products">
                                            </div>
                                            <div class="content">
                                                <h4>Eco-Friendly Products</h4>
                                                <p>100% biodegradable, kraft paper-based packaging for a sustainable future.</p>
                                            </div>
                                        </div>
                                        <!-- Bistly Popular Item -->
                                        <div class="bistly-popular-item bistly-popular-item-left mb-5" data-aos="fade-right" data-aos-duration="1300">
                                            <div class="icon">
                                                <img src="assets/images/home/about/icons/quality.png" alt="Quality Assurance">
                                            </div>
                                            <div class="content">
                                                <h4>Quality Assurance</h4>
                                                <p>Durable, food-grade materials tested for safety and strength.</p>
                                            </div>
                                        </div>
                                        <!-- Bistly Popular Item -->
                                        <div class="bistly-popular-item bistly-popular-item-left mb-5" data-aos="fade-right" data-aos-duration="1600">
                                            <div class="icon">
                                                <img src="assets/images/home/about/icons/product.png" alt="Wide Product Range">
                                            </div>
                                            <div class="content">
                                                <h4>Wide Product Range</h4>
                                                <p>Multiple packaging sizes and types for all food business needs.</p>
                                            </div>
                                        </div>
                                        <!-- Bistly Popular Item -->
                                        <div class="bistly-popular-item bistly-popular-item-left mb-5" data-aos="fade-right" data-aos-duration="1900">
                                            <div class="icon">
                                                <img src="assets/images/home/about/icons/branding.png" alt="Custom Branding">
                                            </div>
                                            <div class="content">
                                                <h4>Custom Branding</h4>
                                                <p>Personalized packaging options to showcase your brand.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-none d-xl-block">
                                    <!-- Bistly Item -->
                                    <div class="bistly-image text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
                                        <img src="assets/images/home/about/benefits.jpg" alt="Benefits">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6">
                                    <!-- Popular Item List -->
                                    <div class="popular-item-list item-list-right" data-aos="fade-left" data-aos-duration="1000">
                                        <!-- Bistly Popular Item -->
                                        <div class="bistly-popular-item mb-5" data-aos="fade-left" data-aos-duration="1300">
                                            <div class="icon">
                                                <img src="assets/images/home/about/icons/partner.png" alt="Trusted B2B Partner">
                                            </div>
                                            <div class="content">
                                                <h4>Trusted B2B Partner</h4>
                                                <p>Reliable supplier trusted by food businesses across West Malaysia.</p>
                                            </div>
                                        </div>
                                        <!-- Bistly Popular Item -->
                                        <div class="bistly-popular-item mb-5">
                                            <div class="icon">
                                                <img src="assets/images/home/about/icons/sustainability.png" alt="Sustainability Commitment">
                                            </div>
                                            <div class="content">
                                                <h4>Sustainability Commitment</h4>
                                                <p>Helping reduce single-use plastic waste through eco-conscious solutions.</p>
                                            </div>
                                        </div>
                                        <!-- Bistly Popular Item -->
                                        <div class="bistly-popular-item mb-5" data-aos="fade-left" data-aos-duration="1600">
                                            <div class="icon">
                                                <img src="assets/images/home/about/icons/bulk.png" alt="Bulk Stock Availability">
                                            </div>
                                            <div class="content">
                                                <h4>Bulk Stock Availability</h4>
                                                <p>Always in stock to fulfill large orders without delays.</p>
                                            </div>
                                        </div>
                                        <!-- Bistly Popular Item -->
                                        <div class="bistly-popular-item mb-5" data-aos="fade-left" data-aos-duration="1900">
                                            <div class="icon">
                                                <img src="assets/images/home/about/icons/satisfaction.png" alt="Customer Satisfaction">
                                            </div>
                                            <div class="content">
                                                <h4>Customer Satisfaction</h4>
                                                <p>A responsive team dedicated to keeping clients happy.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--======  End Popular Section  ======-->

                    <!--======  Start Popular Section  ======-->
                    <section class="review1-section pb-5" style="background-image: url(assets/images/home/about/tapo-bg-4.jpg);">
                        <div class="container">
                            <div class="row justify-content-center pt-5">
                                <div class="col-lg-12">
                                    <!-- Section Title -->
                                    <div class="section-title text-center mb-xl-0 mb-5">
                                        <h2 class="mb-3 text-anm primary-color-1">Smart Packaging You’ll Need</h2>
                                        <p class="px-5 pb-5" data-aos="fade-up" data-aos-duration="1000">Helping your business reduce waste with kraft paper-based products.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-end pb-5">
                                <div class="col-lg-4 review1-col-main" data-aos="fade-down" data-aos-duration="1000">
                                    <div class="review1-item">
                                        <div class="content">
                                            <div class="ratings">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <h3 class="mb-2">Eco & Reliable</h2>
                                            <p>Tapo delivers excellent quality packaging at fair prices. Their biodegradable products are durable and reliable, perfect for operations. Highly recommended for businesses seeking eco-friendly solutions.</p>
                                            <p class="review1by">Sarah L., Café Owner</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 review1-col-main" data-aos="fade-down" data-aos-duration="2000">
                                    <div class="review1-img">
                                        <div class="image"><img src="assets/images/home/menu/4.jpg" alt="menu image"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 review1-col-main" data-aos="fade-down" data-aos-duration="1000">
                                    <div class="review1-item">
                                        <div class="content">
                                            <div class="ratings">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <h3 class="mb-2">Trusted & Sustainable</h2>
                                            <p>We’ve been ordering from Tapo for months and are very satisfied. The products are strong, sustainable, and always delivered on time. A trustworthy partner for any business focused on green packaging.</p>
                                            <p class="review1by">Daniel K., Restaurant Manager</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--======  End Popular Section  ======-->

                    <!--======  Start Food Section  ======-->
                    <section class="rs-food-menu rs-food-categories py-5" style="background-image: url(assets/images/home/about/tapo-bg.jpg);">
                        <div class="container">
                            <div class="row py-5">
                                <div class="col-lg-12">
                                    <!-- Section Title -->
                                    <div class="section-title text-center mb-xl-0 mb-5">
                                        <h2 class="mb-3 text-anm primary-color-1">Explore Our Top Categories</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-5">
                                {{-- <div class="col-lg-4 food-category" data-aos="fade-down" data-aos-duration="1000">
                                    <div class="bistly-food-item">
                                        <div class="image"><img src="assets/images/home/menu/3.jpg" alt="menu image"></div>
                                        <div class="content">
                                            <h3 class="mb-4">Paper Cup</h2>
                                            <div class="ratings">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <p>High-quality kraft paper cups, perfect for hot or cold beverages anytime.</p>
                                            <div class="bistly-button mb-xl-4 text-center">
                                                <a href="#" class="theme-btn style-one">View Products</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 food-category" data-aos="fade-down" data-aos-duration="1200">
                                    <div class="bistly-food-item">
                                        <div class="image"><img src="assets/images/home/menu/2.jpg" alt="menu image"></div>
                                        <div class="content">
                                            <h3 class="mb-4">Paper Bowl</h2>
                                            <div class="ratings">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <p>Eco-friendly paper bowls ideal for soups, noodles, salads, and takeaways.</p>
                                            <div class="bistly-button mb-xl-4 text-center">
                                                <a href="#" class="theme-btn style-one">View Products</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                @if($categories->count()>0)
                             <div class="row">
                                @foreach($categories as $category)
                                    <div class="col-lg-4 food-category" data-aos="fade-down" data-aos-duration="1400">
                                        <div class="bistly-food-item">
                                            <div class="image">
                                                <img src="{{ asset($category->image ?? 'assets/images/placeholder.jpg') }}" alt="{{ $category->name }}">
                                            </div>
                                            <div class="content">
                                                <h3 class="mb-4">{{ $category->name }}</h3>
                                                <div class="ratings">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <p>{{ $category->description ?? 'No description available.' }}</p>
                                                <div class="bistly-button mb-xl-4 text-center">
                                                    <a href="#" class="theme-btn style-one">
                                                        View Products
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endif

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="bistly-button mb-xl-4 text-center" data-aos="fade-down" data-aos-duration="1600">
                                        @if($categories->count()>0)
                                        <a href="{{ route('front.category', [$category->unique_id, $category->slug]) }}" class="theme-btn style-one">View All Categories</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--======  End Food Section  ======-->

                    <!--======  Start Menu Section  ======-->
                    <section class="ds-menu-sec py-5">
                        <div class="container">
                            <div class="row justify-content-center py-5">
                                <div class="col-xl-12">
                                    <!-- Section Title -->
                                    <div class="section-title text-center pb-4">
                                        <h2 class="tex-anm primary-color-1">Explore Our Products</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                           <div class="menu-slider pb-5 mb-2" data-aos="fade-up" data-aos-duration="1000">
                                <!-- Bistly Product Item -->


                                <!-- Bistly Product Item -->
                                {{-- <div class="bistly-product-item mb-4">
                                    <div class="thumbnail">
                                        <img src="assets/images/home/products/bag.jpg" alt="Menu Image">
                                        <div class="wishlist-btn"><i class="fas fa-heart"></i></div>
                                    </div>
                                    <div class="content">
                                        <div class="ratings-price-wrap">
                                            <div class="ratings">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="price">RM 6.00</div>
                                            </div>
                                        </div>
                                        <h4><a href="#">Plain Brown Bag Square 205x115x337mm</a></h4>
                                        <div class="add-to-cart theme-btn style-one"><a href="#">Add to Cart</a></div>
                                    </div>
                                </div> --}}
                                @foreach($featured_products as $product)
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="bistly-product-item mb-4">
                                            <div class="thumbnail">
                                                <a href="{{ route('product.detail', $product->slug) }}"><img src="{{ asset($product->media[0]->image_path) }}" alt="{{ $product->name }}" width="392px" height="259px"></a>
                                                <div class="wishlist-btn"><i class="fas fa-heart"></i></div>
                                            </div>
                                            <div class="content">
                                                <div class="ratings-price-wrap">
                                                    <div class="ratings">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fas fa-star{{ $i <= ($product->rating ?? 5) ? '' : '-o' }}"></i>
                                                        @endfor
                                                    </div>
                                                    <div class="price-wrap">
                                                        <div class="price">RM {{ number_format($product->price, 2) }}</div>
                                                    </div>
                                                </div>
                                                <h4>
                                                    <a href="#, $product->id) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </h4>
                                                <div class="add-to-cart theme-btn style-one">
                                                    <a href="javascript:void(0);"
                                                        class="add-to-cart-btn"
                                                        data-product-id="{{ $product->id }}"
                                                        data-price="{{ $product->price }}">
                                                        Add to Cart
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                           </div>
                        </div>
                    </section><!--======  End Menu Section  ======-->

                    <!--======  Start About Section  ======-->
                    <section class="rs-about p-r">
                        <div class="container-fuild">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Bistly Content Box -->
                                    <div class="marquee-container-2">
                                      <div class="marquee-track" data-aos="fade-up" data-aos-duration="1200">
                                        <span class="marquee-text-2">Bulk Orders Available ✸ Kraft Paper-Based Packaging ✸ Petaling Jaya-Based ✸ 100% Biodegradable Products ✸ </span>
                                        <span class="marquee-text-2">Bulk Orders Available ✸ Kraft Paper-Based Packaging ✸ Petaling Jaya-Based ✸ 100% Biodegradable Products ✸ </span>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--======  End About Section  ======-->

                    <!--====== Start Intro Section ======-->
                    <section class="bistly-intro-sec rs-video-bg bg_cover py-5 p-r z-1">
                        <div class="container-fluid">
                            <div class="row justify-content-center py-xl-5">
                                <div class="col-lg-12">
                                    <div class="video-background">
                                      <video autoplay muted loop playsinline>
                                        <source src="assets/images/home/video/packaging.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                      </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--====== End Intro Section ======-->


                    <!--======  Start Menu Section  ======-->
                    <!--======  Start Food Section  ======-->
                    <section class="rs-enjoy-food primary-bgcolor-1 p-r z-1 py-5">
                        <div class="shape shape-one"><span><img src="assets/images/home/features/f-shape1.png" alt="shape"></span></div>
                        <div class="shape shape-two"><span><img src="assets/images/home/features/f-shape2.png" alt="shape"></span></div>
                        <div class="container">
                            <div class="row align-items-center my-xl-4">
                                <div class="col-xl-3 col-md-6 d-xl-block d-none">
                                    <!-- Bistly Image Box -->
                                    <div class="bistly-image-box image-box-one">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="bistly-image image-radius mb-4" data-aos="fade-down" data-aos-duration="1000">
                                                    <img src="assets/images/home/features/feat-img1.jpg" alt="food image">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bistly-image image-radius mb-4" data-aos="fade-down" data-aos-duration="1100">
                                                    <img src="assets/images/home/features/feat-img2.jpg" alt="food image">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="bistly-image image-radius mb-4" data-aos="fade-up" data-aos-duration="1200">
                                                    <img src="assets/images/home/features/feat-img3.jpg" alt="food image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-9 order-xl-2 order-2">
                                    <!-- Bistly Content Box -->
                                    <div class="bistly-content-box text-center">
                                        <div class="section-title text-center mb-4">
                                            <h2 class="text-anm primary-color">Your Business, <br>Your Way</h2>
                                        </div>
                                        <p class="mb-5 pb-2 primary-color-2" data-aos="fade-up" data-aos-duration="1000">Plan ahead with scheduled deliveries, or react fast with same day pickup. Pay over time with Grab, Shopeee & Atome, and get your stock exactly when you need it. For urgent needs, order by 3:30 PM for immediate Lalamove pickup.</p>
                                        <div class="bistly-button" data-aos="fade-up" data-aos-duration="1000">
                                            <a href="choose-product.html" class="theme-btn style-one">Subscribe</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 order-xl-3 order-1">
                                    <!-- Bistly Image Box -->
                                    <div class="bistly-image-box image-box-two mb-xl-0 mb-5">
                                        <div class="bistly-image" data-aos="fade-up" data-aos-duration="1000">
                                            <img src="assets/images/home/features/feat-img4.png" alt="food image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--======  End Food Section  ======-->

                    <!--======  Start Gallery Section  ======-->
                    <section class="rs-gallery pt-5 primary-bgcolor-3">
                        <div class="container">
                            <div class="row py-5">
                                <div class="col-lg-12">
                                    <!-- Section Title -->
                                    <div class="section-title text-center mt-4">
                                        <h2 class="primary-color-1">Trusted by Businesses Like Yours</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="home-gallery-slider">
                                <!-- Bistly Gallery Item -->
                                <div class="bistly-gallery-item">
                                    <div class="gallery-img">
                                        <img src="assets/images/home/gallery/gallery-img1.jpg" alt="Gallery Image">
                                    </div>
                                </div>
                                <!-- Bistly Gallery Item -->
                                <div class="bistly-gallery-item">
                                    <div class="gallery-img">
                                        <img src="assets/images/home/gallery/gallery-img2.jpg" alt="Gallery Image">
                                    </div>
                                </div>
                                <!-- Bistly Gallery Item -->
                                <div class="bistly-gallery-item">
                                    <div class="gallery-img">
                                        <img src="assets/images/home/gallery/gallery-img3.jpg" alt="Gallery Image">
                                    </div>
                                </div>
                                <!-- Bistly Gallery Item -->
                                <div class="bistly-gallery-item">
                                    <div class="gallery-img">
                                        <img src="assets/images/home/gallery/gallery-img2.jpg" alt="Gallery Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--======  End Gallery Section  ======-->
                    <!--======  End Testimonial Section  ======-->
                    <section class="rs-testimonial pb-5 primary-bgcolor">
                        <div class="container">
                            <div class="row justify-content-center py-5">
                                <div class="col-xl-8 col-lg-10">
                                    <div class="testimonial-slider">
                                        <!-- Bistly Testimonial Item -->
                                        <div class="bistly-testimonial-item mb-4">
                                            <div class="testimonial-content">
                                                <div class="ratings">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <p>Tapo has been our go-to packaging supplier for over a year now. Their eco-friendly paper cups and bags are top-notch in quality and always delivered on time.</p>
                                                <span>Ahmad R., Café Owner, Kuala Lumpur</span>
                                            </div>
                                        </div>
                                        <!-- Bistly Testimonial Item -->
                                        <div class="bistly-testimonial-item mb-4">
                                            <div class="testimonial-content">
                                                <div class="ratings">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <p>Switching to biodegradable packaging from Tapo was one of the best business decisions we made. Our customers love it, and it aligns perfectly with our sustainability goals.</p>
                                                <span>Melissa T., Restaurant Manager, Penang</span>
                                            </div>
                                        </div>

                                        <div class="bistly-testimonial-item mb-4">
                                            <div class="testimonial-content">
                                                <div class="ratings">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <p>The paper bowls are sturdy, the plates are reliable, and the delivery is always on schedule. Tapo makes our supply process hassle-free.</p>
                                                <span>Lim Wei Han, Food Truck Owner, Johor Bahru</span>
                                            </div>
                                        </div>
                                        <div class="bistly-testimonial-item mb-4">
                                            <div class="testimonial-content">
                                                <div class="ratings">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <p>Excellent experience with Tapo from start to finish. Their team understands B2B needs and ensures every order meets our expectations.</p>
                                                <span>Farah A., Bakery Owner, Shah Alam</span>
                                            </div>
                                        </div>
                                        <div class="bistly-testimonial-item mb-4">
                                            <div class="testimonial-content">
                                                <div class="ratings">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <p>Great quality, competitive pricing, and friendly service. We order in bulk every month and have never been disappointed.</p>
                                                <span>Hafiz S., Catering Business, Petaling Jaya</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--======  End Testimonial Section  ======-->
                </main>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script>
        $(document).ready(function() {

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

            // ✅ Handle Add to Cart
            $(document).on('click', '.add-to-cart-btn', function (e) {
                e.preventDefault();

                var product_id = $(this).data('product-id');
                var price = $(this).data('price');
                var quantity = 1;
                let freeShippingAmount = "{{ $freeShippingPrice }}";

                // console.log('Add to Cart clicked:', product_id);

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: product_id,
                        price: price,
                        quantity: quantity,
                        box:1
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            // toastr.success(response.message);
                            updateCartSidebar(response.cartItems, response.totalPrice);
                            updateCartCount(response.cartCount);



                            console.log(response);

                            let cartItemsHTML = '';

                            if(response.cartItems.length>0)
                            {
                                // alert('here');
                                for(let i=0;i<response.cartItems.length;i++)
                                {
                                    // alert(response.cartItems[i].name);
                                cartItemsHTML += `<div class="sb-cart-item">
                                                                        <img src="${response.cartItems[i].image}" alt="Curry Paste" class="sb-item-image">
                                                                        <div class="sb-item-details">
                                                                            <div class="sb-item-name">${response.cartItems[i].name}</div>
                                                                            <div class="sb-item-price">
                                                                                <div class="sb-original-price">
                                                                                    <!-- RM 220.80 -->
                                                                                    <span class="sb-discounted-price" style="margin-left:0px;">RM5 ${response.cartItems[i].price}</span></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="sb-quantity-controls">
                                                                                <button class="sb-quantity-btn" onclick="minusQuantity(${response.cartItems[i].id},'${response.cartItems[i].type}',${response.cartItems[i].box})">-</button>`;
                                                                                
                                        let box = response.cartItems[i].box;

                                        if(box == null)
                                        {
                                            box = "";
                                        }               

                                        cartItemsHTML+=`<span class="sb-quantity" id="quantity${response.cartItems[i].id}${box}">${response.cartItems[i].quantity}</span>
                                                                                <button class="sb-quantity-btn" onclick="plusQuantity(${response.cartItems[i].id},'${response.cartItems[i].type}',${response.cartItems[i].box})">+</button>`;

                                 if(response.cartItems[i].type=="box")
                                        {
                                            cartItemsHTML+=`<span class="sb-quantity" id="quantity${response.cartItems[i].id}">&nbsp;&nbsp;`;
                                            let boxText = "Box";
                                            if(response.cartItems[i].box != 1)
                                            {
                                                boxText = "Boxes";
                                            }
                                            cartItemsHTML+=`${response.cartItems[i].box} ${boxText}</span>`;
                                        }
                                                                            
                                    cartItemsHTML += `</div><button class="sb-remove-item btn btn-sm btn-outline-danger" onclick="deleteItemFromCart(${response.cartItems[i].id},'${response.cartItems[i].type}',${response.cartItems[i].box})">×</button></div>`;

                                        if(i==0)
                                        {
                                            totalAmount = response.totalPrice;
                                        }

                                                                   
                                }

                                $('.sb-cart-content').html(cartItemsHTML);


                            }


                            $('.sb-sidebar-overlay').attr('class','sb-sidebar-overlay sb-active');
                            $('.sb-cart-sidebar').attr('class','sb-cart-sidebar sb-active');
                            let cartCount = response.cartCount;
                            let iconURL = "{{ asset('assets/images/cart.svg')}}";
                            $('.cartbtn').html(`<img src="${iconURL}">${cartCount}`);

                            //  alert
                            $('.sb-new-total').html('RM '+response.totalPrice);

                            // freeShippingAmount = parseFloat(freeShippingAmount);
                            // let totalAmount = parseFloat(response.totalPrice);
                            updateProgressBar(freeShippingAmount, response.totalPrice);
                            // if(freeShippingAmount-totalAmount > 0)
                            // {
                            //     percentage = totalAmount*100/freeShippingAmount;
                            //     percentage = parseInt(percentage);
                            //     percentage += '%';
                            //     $('.sb-progress-bar').css('width',percentage);
                            //     $('#buy-amount').html('RM '+response.totalPrice);
                            // }
                            // else
                            // {
                            //     $('.sb-progress-text').html('<strong>CONGRATULATION!</strong> You Availed <strong>FREE SHIPPING</strong>');
                            //     $('.sb-progress-bar-container').css('display','none');
                            // }


                        } else {
                            toastr.error('Failed to add item to cart.');
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        toastr.error('Error adding item to cart.');
                    }
                });
            });

            // function updateProgressBar(freeShippingAmount, totalAmount)
            // {
            //     let freeShippingAmount1 = parseFloat(freeShippingAmount);
            //     let totalAmount1 = parseFloat(totalAmount);
            //     let percentage;

            //     if(freeShippingAmount-totalAmount1 > 0)
            //     {
            //         percentage = totalAmount1*100/freeShippingAmount1;
            //         percentage = parseInt(percentage);
            //         percentage += '%';
            //         $('.sb-progress-bar').css('width',percentage);
            //         $('#buy-amount').html('RM '+totalAmount1.toFixed(2));
            //         let remainingAmount = freeShippingAmount-totalAmount;
            //         $('.sb-progress-text').html(`Only RM ${remainingAmount.toFixed(2)} away from <strong>FREE SHIPPING</strong>`);
            //     }
            //     else
            //     {
            //         $('.sb-progress-text').html('<strong>CONGRATULATION!</strong> You Availed <strong>FREE SHIPPING</strong>');
            //         $('.sb-progress-bar-container').css('display','none');
            //     }
            // }

            // Function to update cart sidebar content
            function updateCartSidebar(cartItems, totalPrice) {
                var $cartList = $('.menu-cart.style-2 .cart-box ul');
                var $cartTotal = $('.totalPrice');
                $cartList.empty(); // Clear current cart items

                if (cartItems.length > 0) {
                    // Group items by product_id to prevent duplicates
                    var groupedItems = {};
                    var localTotalPrice = 0;

                    $.each(cartItems, function(index, item) {
                        var productId = item.product_id || item.id; // Handle different response formats
                        if (!groupedItems[productId]) {
                            groupedItems[productId] = {
                                ...item,
                                quantity: 0
                            };
                        }
                        groupedItems[productId].quantity += parseInt(item.quantity, 10);
                        localTotalPrice += parseFloat(item.price) * parseInt(item.quantity, 10);
                    });

                    // Render grouped items
                    $.each(groupedItems, function(productId, item) {
                        var photo = item.image ?
                            (item.image.includes(',') ?
                                window.baseURL + '/' + item.image.split(',')[0].trim() :
                                window.baseURL + '/' + item.image) :
                            window.baseURL + '/front/assets/img/product/01.jpg';

                        var cartItemHtml = `
                <li data-product-id="${item.id}" data-is-model="0">
                    <a href="javascript:void(0);" class="remove remove-cart-item" title="Remove this item">
                        <i class="fa fa-remove"></i>
                    </a>
                    <img src="${photo}" alt="${item.name}" />
                    <div class="cart-product">
                        <a href="{{ route('product.detail', '') }}/${item.slug}" target="_blank">
                            ${item.name}
                        </a>
                        <span>RM ${parseFloat(item.price).toFixed(2)}</span>
                        <p class="quantity">${item.quantity} x</p>
                    </div>
                </li>`;
                        $cartList.append(cartItemHtml);
                    });

                    // Update total price
                    $cartTotal.text(`RM ${parseFloat(totalPrice).toFixed(2)}`);

                    // Show cart buttons
                    $('.menu-cart.style-2 .cart-box .cart-button').show();
                } else {
                    $cartList.append('<li>No items in cart.</li>');
                    $cartTotal.text(`RM 0.00`);
                    $('.menu-cart.style-2 .cart-box .cart-button').hide();
                }
            }

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
