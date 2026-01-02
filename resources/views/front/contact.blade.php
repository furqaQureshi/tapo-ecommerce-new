@extends('front.layouts.app')
@section('title')
    Contact
@endsection
@section('content')
    <section class="pages-banner-section">
        <div class="hero-2">
            <div class="hero-bg" style="background-image: url({{ asset('front/assets/img/zera-pattern.jpg') }})">
                <div class="hero-overlay"></div>
            </div>
        </div>
    </section>

    <!-- contact-us-Section Start -->
    <section class="contact-us-section section-padding fix">
        <div class="container">
            <div class="section-title text-center style-3 mb-4">
                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                    {{ __('lang.contactus') }}
                </h2>
                
                <h6 class="sub-title wow fadeInUp">{{ __('lang.KEEPINTOUCH') }}</h6>
            </div>
            <div class="conatct-main-wrapper">
                <div class="contact-box-wrapper">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="comment-form-wrap">
                                <h3>{{ __('lang.SentAMessage') }}</h3>
                                <form action="contact.php" id="contact-form2" method="POST">
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
                                            <div class="from-cheak-items">
                                                <div class="form-check d-flex gap-2 from-customradio">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                        id="flexRadioDefault2" />
                                                    <label class="form-check-label color-theme" for="flexRadioDefault2">
                                                        {{ __('lang.Savemy') }} <b>{{ __('lang.NameEmailPhone') }}</b> {{ __('lang.nexttimeIcomment') }}
                                                    </label>
                                                </div>
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
                        <div class="col-lg-4">
                            <div class="contact-right">
                                <div class="contact-item d-flex gap-3 align-items-center">
                                    <div class="icon">
                                        <img src="{{ asset('front/assets/img/email.svg') }}" alt="img" />
                                    </div>
                                    <div class="content">
                                        <h6>
                                            <a href="mailto:hello@zerapostpartum.com">
                                                hello@zerapostpartum.com
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="contact-item d-flex gap-3 align-items-center">
                                    <div class="icon">
                                        <img src="{{ asset('front/assets/img/pin.svg') }}" alt="img" />
                                    </div>
                                    <div class="content">
                                        <h6>
                                            8A, Jalan Melaka Raya 15, 75000 Melaka
                                        </h6>
                                    </div>
                                </div>
                                <div class="contact-item mb-0 contact-item-mob">
                                    <div class="content">
                                        <h6>{{ __('lang.Connectwithus') }}</h6>
                                    </div>
                                </div>
                                <div class="social-icon d-flex align-items-center contact-item-mob">
                                    <a href="#"><img src="{{ asset('front/assets/img/instagram.svg') }}" alt="img" /></a>
                                    <a href="#" class="bg-2"><img src="{{ asset('front/assets/img/facebook.svg') }}" alt="img" /></a>
                                    <a href="#"><img src="{{ asset('front/assets/img/tiktok.svg') }}" alt="img" /></a>
                                </div>
                                <p class="color-theme contact-item-mob">@zeramom.official</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- map-Section Start -->
    <div class="map-section section-padding pt-0">
        <div class="container">
            <div class="map-items">
                <div class="googpemap">
                    <iframe src="" style="display: none" allowfullscreen="" loading="lazy"></iframe>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.9162460454518!2d102.25778517582239!3d2.185453958318635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1ee1c7e5cb98b%3A0xf9b53d50cae06df2!2s8%2C%20Jalan%20Melaka%20Raya%2015%2C%20Taman%20Melaka%20Raya%2C%2075000%20Melaka%2C%20Malaysia!5e0!3m2!1sen!2s!4v1751396765052!5m2!1sen!2s"
                        width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
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
