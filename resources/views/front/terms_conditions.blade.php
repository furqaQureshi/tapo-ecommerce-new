@extends('front.layouts.app')
@section('title')
    Terms of Service
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
    <section class="term-of-service-section section-padding fix">
        <div class="container">
            <div class="section-title text-center style-3 mb-4">
                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                    {{ __('lang.termandconditons') }}
                </h2>
            </div>
            <div class="conatct-main-wrapper">
                <div class="contact-box-wrapper">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <h4>{{ __('lang.Welcometc') }}</h4>
                            <p>{{ __('lang.Welcometc_desc') }}</p>
                            
                            <h4>{{ __('lang.SubscriptionService') }}</h4>
                            <p>{{ __('lang.SubscriptionService_desc1') }}</p>
                            <p>{{ __('lang.SubscriptionService_desc2') }}</p>
                            <p>{{ __('lang.SubscriptionService_desc3') }}</p>
                            
                            <h4>{{ __('lang.EcommercePurchases') }}</h4>
                            <p>{{ __('lang.EcommercePurchases_desc1') }}</p>
                            <p>{{ __('lang.EcommercePurchases_desc2') }}</p>
                            <p>{{ __('lang.EcommercePurchases_desc3') }}</p>
                            
                            <h4>{{ __('lang.NoRefundPolicy') }}</h4>
                            <p>{{ __('lang.NoRefundPolicy_desc1') }}</p>
                            <p>{{ __('lang.NoRefundPolicy_desc2') }}</p>
                            <p>{{ __('lang.NoRefundPolicy_desc3') }}</p>
                            <p>{{ __('lang.NoRefundPolicy_desc4') }}</p>
                            
                            <h4>{{ __('lang.DataPrivacy') }}</h4>
                            <p>{{ __('lang.DataPrivacy_desc1') }}</p>
                            <p>{{ __('lang.DataPrivacy_desc2') }}</p>
                            <p>{{ __('lang.DataPrivacy_desc3') }}</p>
                            <p>{{ __('lang.DataPrivacy_desc4') }}</p>
                            <p>{{ __('lang.DataPrivacy_desc5') }}</p>
                            
                            <h4>{{ __('lang.IntellectualProperty') }}</h4>
                            <p>{{ __('lang.IntellectualProperty_desc') }}</p>
                            
                            <h4>{{ __('lang.ServiceProduct') }}</h4>
                            <p>{{ __('lang.ServiceProduct_desc') }}</p>
                            
                            <h4>{{ __('lang.LimitationLiability') }}</h4>
                            <p>{{ __('lang.LimitationLiability_desc') }}</p>
                            
                            <h4>{{ __('lang.GoverningLaw') }}</h4>
                            <p>{{ __('lang.GoverningLaw_desc') }}</p>
                            
                            <h4>{{ __('lang.ContactUstc') }}</h4>
                            <p>{{ __('lang.ContactUstc_desc1') }}</p>
                            <p>{{ __('lang.ContactUstc_desc2') }}</p>"
                        </div>
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
