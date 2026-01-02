@extends('front.layouts.app')
@section('title', 'Blogs | ' . config('app.name'))
@section('content')
    <style>
        .blog-section {
            padding: 80px 0;
            background: var(--theme-4);
        }

        .blog-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }

        .blog-card:hover {
            transform: translateY(-10px);
        }

        .blog-image {
            position: relative;
            overflow: hidden;
        }

        .blog-image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .blog-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .blog-meta {
            color: var(--theme);
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .blog-content h3 {
          line-height: 26px;
        }

        .blog-title {
          font-size: 20px;
          margin-bottom: 10px;
          color: var(--theme);
          line-height: 22px !important;
          text-decoration: none;
        }

        .blog-summary {
          color: var(--theme);
          margin-bottom: 15px;
          display: -webkit-box;
          -webkit-line-clamp: 2;
          -webkit-box-orient: vertical;
          overflow: hidden;
          margin-top: 15px;
        }

        .read-more {
            color: var(--theme);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: gap 0.3s ease;
        }

        .read-more:hover {
            color: var(--theme);
            gap: 12px;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        .pagination .page-item .page-link {
            border: 2px solid var(--border-color);
            color: var(--text-dark);
            padding: 12px 18px;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 10px;
            margin: 0 5px;
        }

        .pagination .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--white);
        }

        .pagination .page-item .page-link:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--white);
        }

        .pagination .page-item.disabled .page-link {
            border-color: var(--border-color);
            color: var(--text-light);
        }

        @media (max-width: 768px) {
            .blog-card {
                flex-direction: column;
                height: auto;
            }
            
            .blog-content h3 {
              line-height: 20px;
            }
            
            .blog-title {
              font-size: 16px;
              margin-bottom: 0px;
            }

            .blog-image,
            .blog-content {
                width: 100%;
            }

            .blog-section {
                padding: 50px 0 0px;
            }
        }
    </style>
    <!-- Blog Section -->
    <section class="blog-section">
        <div class="container">
            <div class="section-title text-center style-3 mb-4">
                <h2 class="wow fadeInUp" data-wow-delay=".3s">{{ __('lang.ZeRAMOMBLOG') }}</h2>
            </div>
            <div class="row">
                @forelse ($blogs as $index => $blog)
                    <div class="col-lg-4 col-md-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <article class="blog-card">
                            <div class="blog-image">
                                @if ($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                                @else
                                    <img src="{{ asset('front/assets/images/placeholder.jpg') }}" alt="Placeholder">
                                @endif
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <i class="fas fa-calendar-alt"></i> {{ $blog->created_at->format('M d, Y') }}
                                </div>
                                <h3>
                                    <a href="{{ route('front.blog.show', $blog->id) }}" class="blog-title">
                                        {{ $blog->title }}
                                    </a>
                                </h3>
                                <p class="blog-summary">
                                    {{ Str::limit($blog->summary ?? $blog->description, 80) }}
                                </p>
                                <a href="{{ route('front.blog.show', $blog->id) }}" class="read-more">
                                    {{ __('lang.ReadMore') }} <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>{{ __('lang.Noblogsavailableatthemoment') }}</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper" data-aos="fade-up">
                <nav>
                    {{ $blogs->links() }}
                </nav>
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
