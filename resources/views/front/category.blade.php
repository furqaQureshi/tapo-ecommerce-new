@extends('front.layouts.app')
@section('title')
    {{ $current_category->name }} | Category
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
                    <div class="col-lg-6">
                        <div class="section-title-area pbanner-content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Shop Left Sidebar Section Start -->
    <section class="shop-left-sideber-section section-padding fix">
        <div class="container">
            <div class="product-details-wrapper">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a class="mob-shop-filter theme-btn w-100" href="javascript:void(0);" id="mobileFilterToggle">Shop by filter</a>
                        <div class="main-sideber shop-main-sidebar">
                            <!-- Close Icon for Mobile -->
                            <div class="close-sidebar" id="closeSidebar">
                                <i class="fa-solid fa-times"></i>
                            </div>
                            <!-- Search Form -->
                            <div class="single-sidebar-widget-2">
                                <div class="wid-title">
                                    <h5>{{ __('lang.search') }}</h5>
                                </div>
                                <form action="{{ route('front.shop') }}" method="GET" id="widget-search-form">
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                    <div class="row g-4">
                                        <div class="col-lg-9">
                                            <div class="form-clt">
                                                <input type="text" name="search" id="search"
                                                    value="{{ request('search') }}" placeholder="Search">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="submit" class="theme-btn">
                                                <i class="fa-solid fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Hidden inputs for price range to ensure submission -->
                                    <input type="hidden" name="minPrice" class="input-min-hidden"
                                        value="{{ request('minPrice', $minPrice) }}">
                                    <input type="hidden" name="maxPrice" class="input-max-hidden"
                                        value="{{ request('maxPrice', $maxPrice) }}">
                                </form>
                            </div>
                            <!-- Categories -->
                            <!-- <div class="single-sidebar-widget-2">
                                <div class="wid-title">
                                    <h5>{{ __('lang.Categories') }}</h5>
                                </div>
                                <div class="widget-categories">
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li>
                                                <a
                                                    href="{{ route('front.category', ['unique_id' => $category->unique_id, 'slug' => $category->slug]) }}">
                                                    {{ $category->name }}
                                                </a>
                                                <span>{{ $category->products_count }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div> -->
                            <div class="single-sidebar-widget-2">
                                <div class="wid-title">
                                    <h5>{{ __('lang.Categories') }}</h5>
                                </div>
                                <div class="widget-categories">
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li class="category-item">
                                                <div class="category-header">
                                                    <div>
                                                        <a href="{{ route('front.category', ['unique_id' => $category->unique_id, 'slug' => $category->slug]) }}">
                                                            {{ $category->name }}
                                                        </a>
                                                        <span>({{ $category->products_count }})</span>
                                                    </div>    
                                                    @if ($category->children->count() > 0)
                                                        <i class="fas fa-chevron-down toggle-arrow"></i>
                                                    @endif
                                                </div>
                                                @if ($category->children->count() > 0)
                                                    <ul class="subcategories" style="display: none;">
                                                        @foreach ($category->children as $child)
                                                            <li>
                                                                <a href="{{ route('front.category', ['unique_id' => $child->unique_id, 'slug' => $child->slug]) }}">
                                                                    {{ $child->name }}
                                                                </a>
                                                                <span>({{ $child->products_count }})</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- Price Filter -->
                            <div class="single-sidebar-widget-2">
                                <div class="wid-title">
                                    <h5>{{ __('lang.price_filter') }}</h5>
                                </div>
                                <div class="range__barcustom">
                                    @php
                                        $minPercent = (request('minPrice', $minPrice) / ($maxPrice - $minPrice)) * 100;
                                        $maxPercent = 100 - (request('maxPrice', $maxPrice) / ($maxPrice - $minPrice)) * 100;
                                    @endphp
                                    <div class="slider">
                                        <div class="progress"
                                            style="left: {{ $minPercent }}%; right: {{ $maxPercent }}%;"></div>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" class="range-min" min="{{ $minPrice }}"
                                            max="{{ $maxPrice }}" value="{{ request('minPrice', $minPrice) }}">
                                        <input type="range" class="range-max" min="{{ $minPrice }}"
                                            max="{{ $maxPrice }}" value="{{ request('maxPrice', $maxPrice) }}">
                                    </div>
                                    <div class="range-items">
                                        <div class="price-input d-flex">
                                            <div class="field">
                                                <span>{{ config('app.currency') }}</span>
                                                <input type="number" class="input-min"
                                                    value="{{ request('minPrice', $minPrice) }}" step="0.1">
                                            </div>
                                            <div class="separators">-</div>
                                            <div class="field">
                                                <span>{{ config('app.currency') }}</span>
                                                <input type="number" class="input-max"
                                                    value="{{ request('maxPrice', $maxPrice) }}" step="0.1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Reset and Apply Buttons -->
                            <div class="d-flex justify-content-center">
                                <div>
                                    <a href="{{ route('front.shop') }}" class="custom-filterbtnr theme-btn-2"
                                        id="resetFilter">
                                        <span>{{ __('lang.Reset') }}</span>
                                    </a>
                                </div>
                                <div class="px-2">
                                    <button type="submit" form="widget-search-form" class="custom-resetbtnr theme-btn"
                                        id="applyFilter">
                                        <span>{{ __('lang.Apply_Filter') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 shop-products-grid">
                        <div class="tab-content">
                            @include('front.components.filtered-products', ['products' => $products])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <!-- SweetAlert2 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $('#mobileFilterToggle').on('click', function (e) {
        e.preventDefault();
        $('.shop-main-sidebar').addClass('active');
    });
    
    // Close the sidebar on close icon click
    $('#closeSidebar').on('click', function () {
        $('.shop-main-sidebar').removeClass('active');
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
        $(document).ready(function() {
            // Handle Add to Cart button click
            // $('.add-to-cart-btn').off('click').on('click', function() {
            //     var $button = $(this);
            //     var product_id = $button.data('product-id');
            //     var price = $button.data('price');
            //     var quantity = 1; // Default quantity, adjust if needed

            //     var data = {
            //         _token: '{{ csrf_token() }}',
            //         product_id: product_id,
            //         price: price,
            //         quantity: quantity
            //     };

            //     $.ajax({
            //         url: "{{ route('cart.add') }}",
            //         method: 'POST',
            //         data: data,
            //         success: function(response) {
            //             toastr.success('Item added to cart successfully.');
            //             setTimeout(() => {
            //                 location.reload();
            //             }, 450);
            //         },
            //         error: function(xhr) {
            //             toastr.error('Failed to add to cart.');
            //         }
            //     });
            // });

            // Price filter synchronization
            const inputMin = document.querySelector('.input-min');
            const inputMax = document.querySelector('.input-max');
            const rangeMin = document.querySelector('.range-min');
            const rangeMax = document.querySelector('.range-max');
            const progress = document.querySelector('.progress');
            const inputMinHidden = document.querySelector('.input-min-hidden');
            const inputMaxHidden = document.querySelector('.input-max-hidden');

            function updateProgress() {
                const minVal = parseFloat(inputMin.value) || parseFloat(rangeMin.min);
                const maxVal = parseFloat(inputMax.value) || parseFloat(rangeMax.max);
                const minRange = parseFloat(rangeMin.min);
                const maxRange = parseFloat(rangeMax.max);
                const minPercent = ((minVal - minRange) / (maxRange - minRange)) * 100;
                const maxPercent = 100 - ((maxVal - minRange) / (maxRange - minRange)) * 100;
                progress.style.left = minPercent + '%';
                progress.style.right = maxPercent + '%';
                inputMinHidden.value = minVal;
                inputMaxHidden.value = maxVal;
            }

            inputMin.addEventListener('input', () => {
                const minVal = parseFloat(inputMin.value) || parseFloat(rangeMin.min);
                const maxVal = parseFloat(inputMax.value) || parseFloat(rangeMax.max);
                if (minVal >= maxVal) {
                    inputMin.value = (maxVal - 0.1).toFixed(1);
                }
                rangeMin.value = inputMin.value;
                updateProgress();
            });

            inputMax.addEventListener('input', () => {
                const minVal = parseFloat(inputMin.value) || parseFloat(rangeMin.min);
                const maxVal = parseFloat(inputMax.value) || parseFloat(rangeMax.max);
                if (maxVal <= minVal) {
                    inputMax.value = (minVal + 0.1).toFixed(1);
                }
                rangeMax.value = inputMax.value;
                updateProgress();
            });

            rangeMin.addEventListener('input', () => {
                inputMin.value = rangeMin.value;
                updateProgress();
            });

            rangeMax.addEventListener('input', () => {
                inputMax.value = rangeMax.value;
                updateProgress();
            });

            // Initialize progress bar
            updateProgress();

            // AJAX filtering
            function fetchFilteredProducts() {
                let min = $('.input-min').val();
                let max = $('.input-max').val();
                let search = $('#search').val();
                let category = $('input[name="category"]').val();

                $.ajax({
                    url: "{{ route('filter.products') }}",
                    method: "GET",
                    data: {
                        min_price: min,
                        max_price: max,
                        search: search,
                        category: category
                    },
                    beforeSend: function() {
                        $('.shop-products-grid').html('<p>Loading...</p>');
                    },
                    success: function(response) {
                        $('.shop-products-grid .tab-content').html(response.html);
                    },
                    error: function() {
                        $('.shop-products-grid .tab-content').html('<p>Error loading products.</p>');
                    }
                });
            }

            $('.input-min, .input-max, .range-min, .range-max, #search').on('input change', function() {
                updateProgress();
                fetchFilteredProducts();
            });

            $('#applyFilter').on('click', function(e) {
                e.preventDefault();
                fetchFilteredProducts();
            });

            // Reset filter confirmation
            $('#resetFilter').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This will reset all filters.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, reset!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('front.shop') }}";
                    }
                });
            });
        });
    </script>
@endsection
