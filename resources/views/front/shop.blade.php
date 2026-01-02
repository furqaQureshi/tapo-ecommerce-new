{{-- @extends('front.layouts.app')
@section('title')
    {{ __('lang.products') }}
@endsection
@section('content')

    <!-- Shop Left Sidebar Section Start -->
    <section class="shop-left-sideber-section section-padding">
        <div class="container">
            <div class="product-details-wrapper">
                <div class="row g-4">
                    <div class="col-lg-3 mobile-shopsfil">
                        <a class="mob-shop-filter theme-btn w-100" href="javascript:void(0);" id="mobileFilterToggle"><i class="fas fa-filter"></i> Shop by filter</a>
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
                            <!--<div class="single-sidebar-widget-2">-->
                            <!--    <div class="wid-title">-->
                            <!--        <h5>{{ __('lang.Categories') }}</h5>-->
                            <!--    </div>-->
                            <!--    <div class="widget-categories">-->
                            <!--        <ul>-->
                            <!--            @foreach ($categories as $category)-->
                            <!--                <li>-->
                            <!--                    <a-->
                            <!--                        href="{{ route('front.category', ['unique_id' => $category->unique_id, 'slug' => $category->slug]) }}">-->
                            <!--                        {{ $category->name }}-->
                            <!--                    </a>-->
                            <!--                    <span>{{ $category->products_count }}</span>-->
                            <!--                </li>-->
                            <!--            @endforeach-->
                            <!--        </ul>-->
                            <!--    </div>-->
                            <!--</div>-->
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
    <!-- SweetAlert2 CDN (for reset confirmation) -->
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
        // $(document).ready(function() {
        //     // Handle Add to Cart button click
        //     $('.add-to-cart-btn').off('click').on('click', function() {
        //         var $button = $(this);
        //         var product_id = $button.data('product-id');
        //         var price = $button.data('price');
        //         var quantity = 1; // Default quantity, adjust if you have a quantity input

        //         // Prepare data for AJAX request
        //         var data = {
        //             _token: '{{ csrf_token() }}', // CSRF token for Laravel
        //             product_id: product_id,
        //             price: price,
        //             quantity: quantity
        //         };

        //         // AJAX request to add item to cart
        //         $.ajax({
        //             url: "{{ route('cart.add') }}", // Same route as in your first example
        //             method: 'POST',
        //             data: data,
        //             success: function(response) {
        //                 toastr.success('Item added to cart successfully.');
        //                 setTimeout(() => {
        //                     location.reload(); // Reload page to update cart UI
        //                 }, 450);
        //             },
        //             error: function(xhr) {
        //                 toastr.error('Failed to add to cart.');
        //             }
        //         });
        //     });
        // });
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
                    title: '{{ __('lang.are_you_sure') }}',
                    text: '{{ __('lang.do_you_to_remove_this_item') }}',
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
                                    toastr.error(
                                        '{{ __('lang.failed_to_remove_item') }}');
                                }
                            },
                            error: function(xhr) {
                                toastr.error(
                                    '{{ __('lang.failed_to_remove_item') }}');
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
                // Update hidden inputs for form submission
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

            inputMax.addEventListener('input', () => { // Fixed 'inputend' to 'input'
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
@push('styles')
    <style>
        .page-nav-wrap .pagination {
            display: inline-flex;
        }

        .range__barcustom .slider .progress {
            background-color: #F7941D;
        }

        .range__barcustom .range-input input {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 5px;
            background: #ddd;
            outline: none;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .range__barcustom .range-input input:hover {
            opacity: 1;
        }

        .range__barcustom .range-input input::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 15px;
            height: 15px;
            background: #F7941D;
            cursor: pointer;
            border-radius: 50%;
        }

        .range__barcustom .range-input input::-moz-range-thumb {
            width: 15px;
            height: 15px;
            background: #F7941D;
            cursor: pointer;
            border-radius: 50%;
        }
    </style>
@endpush --}}




@extends('front.layouts.urwah_partials.app')
@section('content')
  <main>
                    <!--====== Start Page Banner ======-->
                    <section class="page-banner bg_cover p-r z-1" style="background-image: url(assets/images/home/hero/hero-bg-1.jpg);">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="page-content text-center">
                                        <h1>Shop</h1>
                                        <ul>
                                            <li><a href="#">Home</a></li>
                                            <li>/</li>
                                            <li>Shop</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--====== End Page Banner ======-->
                    <!--====== Start Shop Section ======-->
                     <section class="bistly-shop-sec py-5 primary-bgcolor-3">
                        <div class="container">
                            <div class="row align-items-center py-5">
                                <div class="col-lg-6">
                                    <div class="show-text" data-aos="fade-up" data-aos-duration="1000">
                                        <p>Showing all {{ $products->count() }} results</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="product-search" data-aos="fade-up" data-aos-duration="1000">
                                        <form>
                                            <div class="form-group">
                                                <!-- <input type="search" class="form_control" placeholder="Search...">
                                                <button class="submit-btn"><i class="far fa-search"></i></button> -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($products as $product)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                    <!-- Bistly Product Item -->
                                    <div class="bistly-product-item mb-4">
                                        <div class="thumbnail">
                                            <a href="{{ route('product.detail', $product->slug) }}"><img src="{{ asset($product->media[0]->image_path ?? '') }}" alt="Menu Image"></a>
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
                                                <a href="{{ url('product').'/'.$product->slug }}">
                                                    {{ $product->name }}
                                                </a>
                                            </h4>
                                            @if(!empty($product->box_price_2_discount))
                                            <div class="add-to-cart theme-btn style-one">
                                                <a href="{{ url('product/'.$product->slug) }}"
                                                class=""
                                                data-product-id="{{ $product->id }}"
                                                data-price="{{ $product->price }}">
                                                Select Option
                                                </a>
                                            </div>
                                            @else
                                            <div class="add-to-cart theme-btn style-one">
                                                <a href="javascript:void(0);"
                                                class="add-to-cart-btn"
                                                data-product-id="{{ $product->id }}"
                                                data-price="{{ $product->price }}">
                                                Add to Cart
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- <div class="row py-5">
                                <div class="col-lg-12">
                                    <div class="bistly-pagination text-center pb-xl-4" data-aos="fade-up" data-aos-duration="2400">
                                        <ul>
                                            <li><a href="#">01</a></li>
                                            <li><a href="#">02</a></li>
                                            <li><a href="#"><i class="far fa-long-arrow-right"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </section><!--====== End Shop Section ======-->
                </main>
@stop

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $(document).on('click', '.add-to-cart-btn', function (e) {
        e.preventDefault();

        var product_id = $(this).data('product-id');
        var price = $(this).data('price');
        var quantity = 1;

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
                                                                            <span class="sb-discounted-price" style="margin-left:0px;">RM ${response.cartItems[i].price}</span></div>
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

                    //alert
                    $('.sb-new-total').html('RM '+response.totalPrice);

                    let freeShippingPrice = "{{ $freeShippingPrice }}";
                    updateProgressBar(freeShippingPrice, response.totalPrice);


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
