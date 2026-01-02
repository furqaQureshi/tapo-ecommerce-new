@extends('front.layouts.app')
@section('title', $blog->title . ' | ' . config('app.name'))
@section('content')
    <style>
        :root {
            --primary-color: #ff6b9d;
            --secondary-color: #ffd93d;
            --text-dark: #333;
            --text-light: #666;
            --border-color: #e0e0e0;
            --bg-light: #f8f9fa;
            --white: #ffffff;
        }

        .back-btn {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            transition: gap 0.3s ease;
        }

        .back-btn:hover {
            color: var(--primary-color);
            gap: 12px;
        }

        .hero-banner {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-align: center;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 15px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        .hero-meta {
            font-size: 1rem;
            opacity: 0.9;
            font-weight: 500;
        }

        .blog-content-section {
            padding: 80px 0;
        }
        
        .blog-single-img {
          background: var(--white);
        }

        .blog-content {
            max-width: 900px;
            margin: 0 auto;
            font-size: 1rem;
        }

        .blog-content h1 {
          font-size: 34px;
          font-weight: 400;
          margin: 0px 0 10px;
          color: var(--theme);
          line-height: 40px;
        }

        .blog-content h2 {
          font-size: 24px;
          margin: 20px 0 10px;
          color: var(--theme);
        }
        .blog-content h3 {
          font-size: 20px;
          font-weight: 400;
          margin: 15px 0 10px;
          color: var(--theme);
        }

        .blog-content h4 {
            font-size: 18px;
            font-weight: 600;
            margin: 10px 0 8px;
            color: var(--theme);
        }

        .blog-content p, .blog-content ul {
          margin-bottom: 15px;
          color: var(--theme);
        }

        .blog-content img {
            width: 100% !important;
            height: auto;
            display: block;
            margin: 20px auto;
            border-radius: 20px;
        }

        .blog-meta-info {
            background: var(--bg-light);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
            border-left: 4px solid var(--primary-color);
        }

        .publish-date {
          color: var(--theme);
          display: flex;
          align-items: center;
          gap: 8px;
        }

        .blockquote {
          margin: 30px 0 20px;
          font-weight: 600;
          border-radius: 8px;
        }

        .summary-section h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 10px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 5px;
        }

        .tags-section {
            margin-top: 20px;
        }
        
        .tags-section strong {
          color: var(--theme);
        }

        .tags-section .badge {
          font-size: 12px;
          padding: 7px 10px;
          border-radius: 20px;
          font-weight: 400;
          background: var(--theme-2) !important;
          color: var(--theme);
        }
        
        .blog-single-img img {
          height: 300px;
          object-fit: contain;
          display: block;
          background: var(--white);
          margin: 0 auto;
          box-shadow: unset;
          border-radius: 20px !important;
        }
        .blog-single-img {
          height: 300px;
          display: block;
          background: var(--white);
          border-radius: 20px;
        }

        @media (max-width: 768px) {
            .hero-banner {
                height: 250px;
            }

            .hero-title {
                font-size: 1.8rem;
            }

            .hero-meta {
                margin-bottom: 5px !important;
            }

            .blog-content-section {
                padding: 50px 0;
            }

            .blog-content {
                padding: 0 15px;
            }

            .blog-content h1 {
                font-size: 24px;
                line-height: 28px;
                padding-top: 30px;
             }

            .blog-content h2 {
                font-size: 1.2rem;
            }

            .blog-content h3 {
                font-size: 1rem;
            }

            .blog-content h4 {
                font-size: 1rem;
            }
        }
    </style>
    <!-- Hero Banner -->
    

    <!-- Blog Content -->
    <section class="blog-content-section">
        <div class="container">
            <div class="blog-content">
                <div class="row mb-5">
                    <div class="col-sm-6">
                        <div class="blog-single-img">
                            <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('front/assets/images/placeholder.jpg') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="hero-content">
                            <div class="section-title style-3 mb-4">
                                <h1 class="wow fadeInUp" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                    {{ $blog->title }}
                                </h1>
                            </div>
                            <p class="hero-meta">{{ __('lang.Categories') }}: {{ $blog->category->name }}</p>
                            <div class="publish-date">
                                <i class="fas fa-calendar-alt"></i> {{ __('lang.Publishedon') }} {{ $blog->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            
                @if ($blog->quote)
                    <blockquote class="blockquote" data-aos="fade-up">
                        <p>{{ $blog->quote }}</p>
                    </blockquote>
                @endif
                @if ($blog->summary)
                    <div class="summary-section" data-aos="fade-up">
                        <p>{{ $blog->summary }}</p>
                    </div>
                @endif
                <div class="blog-description" data-aos="fade-up">
                    {!! $blog->description !!}
                </div>
                <div class="tags-section" data-aos="fade-up">
                    <strong>{{ __('lang.Tags') }}:</strong>
                    @foreach (explode(',', $blog->tags) as $tag)
                        <span class="badge bg-secondary me-1 mb-2">{{ trim($tag) }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
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
