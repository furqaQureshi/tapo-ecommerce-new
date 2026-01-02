@extends('front.layouts.app')

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
            <div class="section-title-area">
                <div class="section-title style-3">
                    <h2 class="wow fadeInUp" data-wow-delay=".3s">
                        {{ __('lang.ExploreZeraMomUniverse') }}
                    </h2>
                </div>
            </div>
            <div class="tab-content">
                {{-- <div class="row"> --}}
                {{-- @foreach ($categories as $category)
                        <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                            <div class="news-card-items style-2">
                                <div class="news-image">
                                    <img src="{{ $category->image ? asset($category->image) : asset('front/assets/img/home-1.jpg') }}"
                                        alt="category-img">
                                </div>
                                <div class="news-content">
                                    <h3>
                                        <a
                                            href="{{ route('front.category', ['unique_id' => $category->unique_id, 'slug' => $category->slug]) }}">{{ $category->name }}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}
                {{-- </div> --}}
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="news-card-items style-2">
                            <a href="{{ route('subscribe-petit') }}">
                                <div class="news-image">
                                    <img src="{{ asset('front/assets/img/home-1.jpg') }}" alt="img">
                                </div>
                                <div class="news-content">
                                    <h3>
                                        ZERA Mom Club
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
                                        Shop
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
                                        Announcement</a>
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
                                        Blog
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
    <section class="about-section about-hsection section-padding fix">
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
                                    About ZeeraMom
                                </h6>
                                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                    Trying is Believing
                                </h2>
                            </div>
                            <div class="text">
                                <p class="wow fadeInUp" data-wow-delay=".5s">
                                    ZeeraMom is dedicated to providing high-quality postpartum care products and services to
                                    support new mothers during their recovery journey.
                                    <br><br>
                                <h3>How It All Begins</h3>
                                Our journey began with a passion for empowering mothers by offering solutions that promote
                                comfort, health, and confidence during the postpartum period.
                                </p>
                                <a href="{{ route('front.about') }}" class="theme-btn wow fadeInUp"
                                    data-wow-delay=".7s">More About Us <i class="fa-regular fa-arrow-right"></i></a>
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
                <p>{{ __('lang.Getuptodateonourlatestdiscountseventshappenings') }}</p>
            </div>
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
                                                <input type="text" name="fullname" id="name"
                                                    placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="text" name="phone" id="phone"
                                                    placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="email" name="email" id="email20" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="theme-btn w-100">
                                                {{ __('lang.register') }}
                                            </button>
                                        </div>
                                        {{-- <p class="text-center"><b>{{ __('lang.or') }}</b></p> --}}
                                        {{-- <div class="col-lg-6">
                                            <button type="button" class="theme-btn w-100 social-btn social-google-btn">
                                                <i class="fab fa-google me-2"></i> Google
                                            </button>
                                        </div>
                                        <div class="col-lg-6">
                                            <button type="button" class="theme-btn w-100 social-btn social-tiktok-btn">
                                                <i class="fab fa-tiktok me-2"></i> TikTok
                                            </button>
                                        </div> --}}
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
