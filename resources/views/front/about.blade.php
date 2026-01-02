{{-- @extends('front.layouts.app')

@section('title')
    {{ __('lang.about') }}
@endsection

@section('content')
    <section class="about-section-1 section-padding fix">
        <div class="container">
            <div class="about-wrapper-2">
                <div class="row g-4">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <div class="section-title style-2">
                            <h6 class="sub-title wow fadeInUp">{{ __('lang.our_story') }}</h6>
                            <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                {{ __('lang.perfectly_imperfect') }}
                            </h2>
                        </div>
                        <p class="wow fadeInUp color-theme" data-wow-delay=".5s">
                            {{ __('lang.AboutzeraMom_para1') }}
                            <br><br>
                            {{ __('lang.AboutzeraMom_para2') }}
                            <br><br>
                            {{ __('lang.AboutzeraMom_para3') }}
                            <br><br>
                            {{ __('lang.AboutzeraMom_para4') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="about-section section-padding fix">
        <div class="container">
            <div class="about-wrapper-2">
                <div class="row g-4 align-items-center">
                    <div class="col-xl-6 col-lg-6 col-md-6 about-img-con">
                        <div class="about-image">
                            <img src="{{ asset('front/assets/img/about-1.jpg') }}" alt="img" />
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="about-right">
                            <div class="section-title style-2">
                                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                   {{ __('lang.HowItAllBegan') }}
                                </h2>
                            </div>
                            <p class="wow fadeInUp color-theme mt-lg-2" data-wow-delay=".5s">
                                {{ __('lang.HowItAllBegan_para1') }}
                                <br><br>
                                {{ __('lang.HowItAllBegan_para2') }}
                                <br><br>
                                {{ __('lang.HowItAllBegan_para3') }}
                                <br><br>
                                {{ __('lang.HowItAllBegan_para4') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding section-bg fix about-boxes-section">
        <div class="container">
            <div class="section-title text-center style-3">
                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                     {{ __('lang.Ourphilosophy') }}
                </h2>
            </div>
            <div class="row g-0">
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="product-box-item style-2">
                        <div class="product-image">
                            <img src="{{ asset('front/assets/img/about-2.svg') }}" alt="img" />
                        </div>
                        <div class="product-content">
                            <h3>
                                <a href="#">{{ __('lang.DiscoverProductsServices') }}</a>
                            </h3>
                            <p>
                                {{ __('lang.DiscoverProductsServices_desc') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".s">
                    <div class="product-box-item">
                        <div class="product-image">
                            <img src="{{ asset('front/assets/img/about-3.svg') }}" alt="img" />
                        </div>
                        <div class="product-content">
                            <h3>
                                <a href="#">{{ __('lang.Sustainable') }}</a>
                            </h3>
                            <p>
                                {{ __('lang.Sustainable_desc') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                    <div class="product-box-item mb-0">
                        <div class="product-image">
                            <img src="{{ asset('front/assets/img/about-4.svg') }}" alt="img" />
                        </div>
                        <div class="product-content">
                            <h3>
                                <a href="#">{{ __('lang.Experience') }}</a>
                            </h3>
                            <p>
                                {{ __('lang.Experience_desc') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-about-us contact-us-section section-bg-2 section-padding fix">
        <div class="container">
            <div class="section-title text-center style-3">
                <h2 class="wow fadeInUp" data-wow-delay=".3s">{{ __('lang.ContactForm') }}</h2>
            </div>
            <div class="conatct-main-wrapper">
                <div class="contact-box-wrapper">
                    <div class="row g-4">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="comment-form-wrap">
                                <form action="javascript::void();" id="contact-form2" method="POST">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="text" name="name" id="name"
                                                    placeholder="{{ __('lang.YourName') }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="text" name="email" id="email20"
                                                    placeholder="{{ __('lang.email_address') }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="text" name="phone" id="email20"
                                                    placeholder="{{ __('lang.phone_number') }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <textarea name="message" id="message" placeholder="{{ __('lang.Typeyourmessage') }}"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="theme-btn">
                                                {{ __('lang.submit') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
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
                    <!--====== Start Page Banner ======-->
                    <section class="page-banner bg_cover p-r z-1" style="background-image: url(assets/images/home/hero/hero-bg-1.jpg);">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="page-content text-center">
                                        <h1>About Us</h1>
                                        <ul>
                                            <li><a href="#">Home</a></li>
                                            <li>/</li>
                                            <li>About Us</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--====== End Page Banner ======-->
                    <!--====== Start About Section ======-->
                    <section class="bistly-about-sec primary-bgcolor-3 py-5">
                        <div class="container">
                            <div class="row py-5 align-items-end justify-content-center">
                                <div class="col-lg-7 col-md-12">
                                    <!-- Bistly Content Box -->
                                    <div class="bistly-content-box">
                                        <!-- Section Title -->
                                        <div class="section-title mb-4">
                                            <span class="sub-title" data-aos="fade-down" data-aos-duration="1000">About Tapo</span>
                                            <h2 class="text-anm primary-color-1">Built for Modern Businesses</h2>
                                        </div>
                                        <p  class="heading-font mb-3 h5" data-aos="fade-up" data-aos-duration="1000">Tapo is a wholesale business based in Petaling Jaya, Selangor, specializing in biodegradable food packaging made from kraft paper.</p>
                                        <!-- Gallery Slider -->
                                        <div class="gallery-slider-wrap mt-lg-5 pt-lg-5">
                                            <div class="gallery-slider about-gallery-slider">
                                                <div class="gallery-item">
                                                    <div class="thumbnail">
                                                        <img src="assets/images/home/gallery/gallery-img1.jpg" alt="gallery-img">
                                                    </div>
                                                </div>
                                                <div class="gallery-item">
                                                    <div class="thumbnail">
                                                        <img src="assets/images/home/gallery/gallery-img2.jpg" alt="gallery-img">
                                                    </div>
                                                </div>
                                                <div class="gallery-item">
                                                    <div class="thumbnail">
                                                        <img src="assets/images/home/gallery/gallery-img3.jpg" alt="gallery-img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-8">
                                    <!-- Bistly Image -->
                                    <div class="bistly-image mb-3 pb-3 mt-xl-0 mt-5" data-aos="fade-down" data-aos-duration="1000">
                                        <img src="assets/images/home/about/about-page-1.jpg" alt="about Image">
                                    </div>
                                    <div class="text-box" data-aos="fade-up" data-aos-duration="1000">

                                        <p class="mb-3 pb-2">We are committed to supporting restaurants, cafes, food vendors, and retailers across West Malaysia with eco-friendly, reliable, and innovative packaging solutions that align with today’s global sustainability standards.</p>

                                        <p class="mb-3 pb-2">As a reliable B2B supplier, we offer high-quality, durable, and affordable packaging options that help businesses reduce their environmental impact without compromising functionality. With a focus on long-term partnerships, we aim to make sustainable packaging the new standard for food-related industries.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--====== End About Section ======-->
                    <!--====== Start Fun Fact Section ======-->
                    <section class="bistly-fun-fact py-5 primary-bgcolor-2">
                        <div class="container">
                            <div class="counter-item-wrapper">
                                <div class="row py-lg-4">
                                    <div class="col-lg-3 col-sm-6 counter-item-border">
                                        <!-- Bistly Counter Item -->
                                        <div class="bistly-counter-item text-center mb-4" data-aos="fade-up" data-aos-duration="800">
                                            <div class="icon">
                                                <img src="assets/images/home/about/client.png" alt="about Image">
                                            </div>
                                            <div class="content">
                                                <h2><span class="counter">25000</span>+</h2>
                                                <p>Happy Clients Served</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 counter-item-border">
                                        <!-- Bistly Counter Item -->
                                        <div class="bistly-counter-item text-center mb-4" data-aos="fade-up" data-aos-duration="1000">
                                            <div class="icon">
                                                <img src="assets/images/home/about/order.png" alt="about Image">
                                            </div>
                                            <div class="content">
                                                <h2><span class="counter">100000</span>+</h2>
                                                <p>Orders Successfully Delivered</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 counter-item-border">
                                        <!-- Bistly Counter Item -->
                                        <div class="bistly-counter-item text-center mb-4" data-aos="fade-up" data-aos-duration="1200">
                                            <div class="icon">
                                                <img src="assets/images/home/about/eco-com.png" alt="about Image">
                                            </div>
                                            <div class="content">
                                                <h2><span class="counter">100</span>%</h2>
                                                <p>Eco-Friendly Commitment</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 counter-item-border">
                                        <!-- Bistly Counter Item -->
                                        <div class="bistly-counter-item text-center mb-4" data-aos="fade-up" data-aos-duration="1400">
                                            <div class="icon">
                                                <img src="assets/images/home/about/expertise.png" alt="about Image">
                                            </div>
                                            <div class="content">
                                                <h2><span class="counter">9</span>+</h2>
                                                <p>Years - Industry Experience</p>
                                            </div>
                                        </div>
                                    </div>
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
                    <!--======  End Testimonial Section  ======-->
                    <section class="pb-5 primary-bgcolor-1">
                        <div class="container">
                            <div class="row pt-5">
                                <div class="col-lg-12">
                                    <!-- Section Title -->
                                    <div class="section-title text-center mt-5">
                                        <h2 class="primary-color">Trusted by Businesses Like Yours</h2>
                                    </div>
                                </div>
                            </div>
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

@endsection


