{{-- @extends('front.layouts.app')
@section('title')
    Carts
@endsection
@section('content')
    <!-- pages-banner-section Start -->
    <section class="pages-banner-section">
        <div class="hero-2">
            <div class="hero-bg" style="background-image: url({{ asset('front/assets/img/pages-bg.jpg') }})">
                <div class="hero-overlay"></div>
            </div>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="section-title-area pbanner-content">
                            <div>
                                <div class="section-title style-3">
                                    <h2 class="wow fadeInUp" data-wow-delay=".3s">Shopping Cart</h2>
                                </div>
                                <ul class="list wow fadeInUp" data-wow-delay=".5s">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li>-</li>
                                    <li>Shopping Cart</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- pages-banner-section End -->

    <!-- cart section start -->
    {{-- <div class="cart-section section-padding">
        <div class="container">
            @if (!empty($cartItems) && count($cartItems) > 0)
                <div class="cart-list-area">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($cartItems)
                        <div class="table-responsive">
                            <table class="table common-table">
                                <thead data-aos="fade-down">
                                    <tr>
                                        <th class="text-left">{{ __('lang.Product') }}</th>
                                        <th class="text-center">{{ __('lang.Price') }}</th>
                                        <th class="text-center">{{ __('lang.Quantity') }}</th>
                                        <th class="text-end">{{ __('lang.Subtotal') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($cartItems as $cartItem)
                                        @php
                                            $subtotal = $cartItem->price * $cartItem->quantity;
                                            $total += $subtotal;
                                        @endphp
                                        <tr class="align-items-center py-3"
                                            data-product-id="{{ isset($cartItem->product_id) ? $cartItem->product_id : (isset($cartItem->product['id']) ? $cartItem->product['id'] : '') }}"
                                            data-variant-id="{{ isset($cartItem->variant_id) ? $cartItem->variant_id : (isset($cartItem->product_variant['id']) ? $cartItem->product_variant['id'] : '') }}"
                                            data-is-model="{{ isset($cartItem->id) ? 'true' : 'false' }}">
                                            <td>
                                                <div class="cart-item-thumb d-flex align-items-center gap-4">
                                                    <i class="fas fa-times remove-cart" style="cursor:pointer;"
                                                        title="Remove item"></i>
                                                    <img src="{{ $cartItem->product->media->first() ? asset($cartItem->product->media->first()->image_path) : ($cartItem->product->featured_image ? asset($cartItem->product->featured_image) : asset('assets/img/cart/03.jpg')) }}"
                                                        alt="{{ $cartItem->product->name }}">

                                                    <div class="d-flex flex-column">
                                                        <span class="head">{{ $cartItem->product->name }}</span>
                                                        @if(isset($cartItem->attributes))
                                                            <div>
                                                                @foreach ($cartItem->attributes as $attribute)
                                                                    <span class="mt-2 {{ !$loop->first ? 'ms-1' : '' }}" style="display:inline;">
                                                                        <small>
                                                                            {{ $attribute['name'] }}: {{ ucfirst($attribute['value']) }}
                                                                        </small>
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="price-usd">
                                                    {{ config('app.currency') }} {{ number_format($cartItem->price, 2) }}<br>
                                                    @if(isset($cartItem->discount))
                                                    <del>RM {{ number_format(($cartItem->price + $cartItem->discount), 2) }}</del>
                                                    @else
                                                    <del>RM {{ number_format(($cartItem->price + 0), 2) }}</del>
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="price-quantity text-center">
                                                <div
                                                    class="quantity d-inline-flex align-items-center justify-content-center gap-1 py-2 px-4 border n50-border_20 text-sm">
                                                    <button class="quantityDecrement"><i class="fal fa-minus" onclick="minusQuantityCart({{$cartItem['id']}})"></i></button>
                                                    <input type="text" value="{{ $cartItem->quantity }}"
                                                        class="quantityValue">
                                                    <button class="quantityIncrement"><i class="fal fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <span class="price-usd">
                                                    {{ number_format($subtotal, 2) }} {{ config('app.currency') }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="py-3">
                                        <td colspan="3">
                                            <div class="cart-item-thumb d-flex justify-content-end gap-4">
                                                <span class="head">{{ __('lang.Total') }}</span>
                                                <span class="price-usd head">{{ config('app.currency') }}
                                                    {{ number_format($total, 2) }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div
                            class="coupon-items d-flex flex-md-nowrap flex-wrap justify-content-end align-items-center gap-4 pt-4">

                            <button type="button" class="theme-btn alt-color radius-xs">Update Cart</button>
                            <a href="{{ route('checkout') }}"
                                class="theme-btn alt-color radius-xs">{{ __('lang.Checkout') }}</a>
                        </div>
                        <div class="coupon-items row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <div id="coupon-error" class="text-danger mt-2"></div>
                            </div>
                        </div>
                    @endif
                    <input type="hidden" id="update-cart-url" value="{{ route('cart.update') }}">
                </div>
            @else
                <div class="text-center">
                    <h2>{{ __('lang.no_item_cart') }}</h2>
                </div>
            @endif
        </div>
    </div>
    <!-- cart section end -->
@endsection --}}
{{-- @section('scripts')
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
            //         $cartList.append('<li>{{ __('lang.no_item_cart') }}</li>');
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
    <script>
        var appCurrency = "{{ config('app.currency') }}";

        $(document).off('click', '.quantityIncrement, .quantityDecrement').on('click',
            '.quantityIncrement, .quantityDecrement',
            function() {
                const row = $(this).closest('tr');
                const input = row.find('.quantityValue');
                let quantity = parseInt(input.val());
                const isIncrement = $(this).hasClass('quantityIncrement');

                quantity = isIncrement ? quantity + 1 : quantity - 1;
                if (quantity < 0) quantity = 0;

                input.val(quantity);

                handleQuantityChange(row, quantity);
            });

        $(document).on('keyup', '.quantityValue', function() {
            const input = $(this);
            const row = input.closest('tr');
            let quantity = parseInt(input.val());

            if (isNaN(quantity) || quantity < 0) {
                quantity = 0;
            }

            input.val(quantity);
            handleQuantityChange(row, quantity);
        });

        function handleQuantityChange(row, quantity) {
            const productId = row.data('product-id');
            const variantId = row.data('variant-id');
            const isModel = row.data('is-model');

            if (quantity === 0) {
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
                            url: '{{ route('cart.remove') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                product_id: productId,
                                variant_id: variantId,
                                is_model: isModel
                            },
                            success: function(res) {
                                row.remove();
                                toastr.success(res.message);
                                updateCartTotal();
                                Swal.fire(
                                    'Removed!',
                                    '{{ __('lang.The_item_has_been_removed_from_the_cart') }}',
                                    'success'
                                );
                            },
                            error: function() {
                                toastr.error('{{ __('lang.Error_removing_item') }}');
                            }
                        });
                    }
                });
            } else {
                const price = parseFloat(row.find('.price-usd').first().text().replace(/[^\d.]/g, ''));
                const subtotal = price * quantity;
                row.find('.price-usd').last().text(subtotal.toFixed(2) + ' ' + appCurrency);
                updateCartTotal();
            }
        }

        function updateCartTotal() {
            let total = 0;

            $('tr[data-product-id]').each(function() {
                const row = $(this);
                const price = parseFloat(row.find('.price-usd').first().text().replace(/[^\d.]/g, ''));
                const quantity = parseInt(row.find('.quantityValue').val());
                if (!isNaN(quantity)) {
                    total += price * quantity;
                }
            });

            $('.cart-item-thumb.d-flex.justify-content-end .price-usd.head').text(appCurrency + ' ' + total.toFixed(2));
        }

        $(document).on('click', '.theme-btn:contains("Update Cart")', function() {
            let items = [];

            $('tr[data-product-id]').each(function() {
                const row = $(this);
                const productId = row.data('product-id');
                const variantId = row.data('variant-id');
                const isModel = row.data('is-model');
                const quantity = parseInt(row.find('.quantityValue').val());

                if (!isNaN(quantity) && quantity >= 0) {
                    items.push({
                        product_id: productId,
                        variant_id: variantId,
                        is_model: isModel,
                        quantity: quantity
                    });
                }
            });

            const url = $('#update-cart-url').val();

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    items: items
                },
                success: function(res) {
                    if (res.success) {
                        toastr.success(res.message);
                    } else {
                        toastr.error('Something went wrong.');
                    }
                },
                error: function() {
                    toastr.error('Error updating cart.');
                }
            });
        });

        $(document).on('click', '.remove-cart', function() {
            const row = $(this).closest('tr');
            const productId = row.data('product-id');
            // const variantId = row.data('variant-id');
            const isModel = row.data('is-model');
            const url = "{{ route('cart.remove') }}";

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
                        url: url,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            product_id: productId,
                            // variant_id: variantId,
                            is_model: isModel
                        },
                        success: function(res) {
                            row.remove();
                            toastr.success(res.message);
                            updateCartTotal();
                            Swal.fire(
                                'Removed!',
                                '{{ __('lang.The_item_has_been_removed_from_the_cart') }}',
                                'success'
                            );
                        },
                        error: function() {
                            toastr.error(
                            '{{ __('lang.Error_occurred_while_removing_item') }}');
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            $('#apply-coupon-form').on('submit', function(e) {
                e.preventDefault();

                let code = $('#coupon_code').val();
                let total = parseFloat("{{ $total ?? 0 }}");

                $.ajax({
                    url: "{{ route('coupon.apply') }}",
                    type: "POST",
                    data: {
                        code: code,
                        total: total,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.error) {
                            $('#coupon-error').text(response.error);
                        } else {
                            $('#coupon-error').text('');
                            toastr.success('Coupon applied! Discount: ' + response.formatted);
                            $('.cart-item-thumb.d-flex.justify-content-end .price-usd.head')
                                .text(appCurrency + ' ' + response.new_total.toFixed(2));
                        }
                    }
                });
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
                                        <h1>Cart</h1>
                                        <ul>
                                            <li><a href="#">Home</a></li>
                                            <li>/</li>
                                            <li>Cart</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--====== End Page Banner ======-->
                    <!--====== Start Cart Section ======-->
                    <section class="bistly-cart-sec py-5 primary-bgcolor-3">
                        <div class="container">
                            <div class="row py-5">
                                <div class="col-xxl-8">
                                    <!-- Cart Wrapper -->
                                    <div class="cart-wrapper mb-40" data-aos="fade-up" data-aos-duration="1000">
                                        <!-- Cart Table -->
                                          @if(!empty($cartItems1))
                                        <div class="cart-table table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="title">Product Cart</th>
                                                        <th class="price">Price</th>
                                                        <th class="quantity">Quantity</th>
                                                        <th>Type</th>
                                                        <th class="sub-total">Total</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        @foreach($cartItems1 as $key=>$cartItemm)
                                                            @foreach($cartItemm as $cartItem)
                                                            <tr>
                                                                <td>
                                                                    <div class="product-thumb-item">
                                                                        <div class="product-thumbnail">
                                                                            <img src="{{ $cartItem['image'] }}" alt="Product Thumbnail">
                                                                        </div>
                                                                        <div class="product-info">
                                                                            <h6 class="title"><a href="#">{{ $cartItem['name'] }}</a></h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="price">RM {{$cartItem['price']}}</div>
                                                                </td>
                                                                <td>
                                                                    <div class="quantity-cart">
                                                                        <div class="quantity-input">
                                                                            <button class="quantity-down" onclick="minusQuantityCart({{$cartItem['product_id']}}, '{{ $cartItem["type"] }}', {{ $cartItem['box'] }})"><i class="far fa-minus"></i></button>
    @php
        $boxId;
        if($cartItem['type'] == "box")
        {
            $boxId = $cartItem['box'];
        }
    @endphp                                                                
                                                                            <input class="quantity" type="number" value="{{$cartItem['quantity']}}" name="quantity" id="qty{{$cartItem['product_id']}}{{$cartItem['box']}}" disabled>
                                                                            <button class="quantity-up" onclick="plusQuantityCart({{$cartItem['product_id']}}, '{{ $cartItem["type"] }}', {{ $cartItem['box'] }})"><i class="far fa-plus"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    @if($cartItem['type'] == "box")
                                                                        @php
                                                                        $box = "Box";
                                                                        if($cartItem['box'] != 1)
                                                                            {
                                                                                $box = "Boxes";
                                                                            }
                                                                        @endphp
                                                                        {{ $cartItem['box'] }} {{ $box }}
                                                                    @elseif($cartItem['type'] == "product")
                                                                        {{ ucfirst($cartItem['type']) }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <div class="product-total-price{{$cartItem['product_id']}}{{$cartItem['box']}}">RM {{$cartItem['total_price']}}</div>
                                                                </td>
                                                                <td>
                                                                    <div class="cart-remove" onclick="deleteItemFromCartCart({{$cartItem['product_id']}},'{{$cartItem['type']}}',{{$cartItem['box']}})"><i class="far fa-trash-alt"></i></div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @endforeach
                                                </tbody>
                                            </table>
                                            @else
                                            <h3>No item in cart</h3>
                                            @endif
                                        </div>
                                        <div class="cart-bottom d-flex mt-40">
                                            <div class="cart-coupon" data-aos="fade-up" data-aos-duration="1100">
                                                <form autocomplete="off">
                                                    <!-- <div class="form-group">
                                                        <input type="text" class="form_control" placeholder="Promo Code" name="coupon" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="theme-btn style-one">Apply Code <i class="far fa-arrow-right"></i></button>
                                                        <a href="#">Continue Shopping </a>
                                                    </div> -->
                                                </form>
                                            </div>
                                            <div class="ct-shopping" data-aos="fade-up" data-aos-duration="1200">
                                                <!-- <button class="theme-btn style-one">Update Cart<i class="far fa-angle-double-right"></i></button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="cart-total-area mt-xl-0 mt-5">
                                        <div class="cart-total-box mb-4">
                                            <h3>Order Summary</h3>
                                            <ul class="cart-list">
                                                <li>
                                                    <div class="list-item">
                                                        <div class="item-title">Subtotal</div>
                                                        <div class="sub-total1">RM {{ $subTotal }}</div>
                                                    </div>
                                                </li>
                                                <!-- <li>
                                                    <div class="list-item">
                                                        <div class="item-title">Shipping</div>
                                                        <div class="shipping-total">RM 20.00</div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="list-item">
                                                        <div class="item-title">Discount</div>
                                                        <div class="discount-total">RM 10.00</div>
                                                    </div>
                                                </li> -->
                                                <li>
                                                    <div class="list-item">
                                                        <div class="item-title">Grand Total</div>
                                                        <div class="total-price">RM {{ $grandTotal }}</div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="checkout-button">
                                            <button class="theme-btn style-one"><a href="{{ route('checkout') }}">Proceed to Checkout</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--====== End Cart Section ======-->
                </main>

@stop

<script>
      function minusQuantityCart(productId, typee, boxId)
        {
            let quantity
            if(boxId != undefined)
            {
                quantity = $('#qty'+productId+boxId).val();
            }
            else
            {
                quantity = $('#qty'+productId).val();
            }
            quantity--;
            if(quantity != 0)
            {
                $.ajax({
                url: "{{ url('minus-quantity') }}",
                type:"POST",
                data:{
                    _token: "{{ csrf_token() }}",
                    product_id:productId,
                    quantity:quantity,
                    type: typee,
                    box_id: boxId
                },
                dataType:"JSON",
                success:function(result){
                    if(boxId != undefined)
                    {
                        $('#qty'+productId+boxId).html(result.quantity);
                    }
                    else
                    {
                        $('#qty'+productId).html(result.quantity);
                    }
                    $('.sub-total1').html('RM '+result.total_price);
                    $('.total-price').html('RM '+result.total_price);
                    $('.product-total-price'+productId+boxId).html('RM '+result.product_total_price);
                }});
            }
        }

         function plusQuantityCart(productId, typee, boxId)
        {
            let quantity;
            if(boxId != undefined)
            {
                quantity = $('#qty'+productId+boxId).val();
            }
            else
            {
                quantity = $('#qty'+productId).val();
            }
            quantity++;
            $.ajax({
               url: "{{ url('plus-quantity') }}",
               type:"POST",
               data:{
                _token: "{{ csrf_token() }}",
                product_id:productId,
                quantity:quantity,
                type: typee,
                box_id: boxId
            },
               dataType:"JSON",
               success:function(result){
                if(boxId != undefined)
                {
                    $('#qty'+productId+boxId).html(result.quantity);
                    $('.product-total-price'+productId+boxId).html('RM '+result.product_total_price);
                }
                else
                {
                    $('#qty'+productId).html(result.quantity);
                    $('.product-total-price'+productId).html('RM '+result.product_total_price);
                }
                $('.sub-total1').html('RM '+result.total_price);
                $('.total-price').html('RM '+result.total_price);
                
               }
            });
        }

         function deleteItemFromCartCart(productId,typee,boxId)
        {
            //   $.ajax({
            //    url: "{{ url('delete-item-from-cart') }}",
            //    type:"POST",
            //    data:{
            //     _token: "{{ csrf_token() }}",
            //     product_id:productId
            // },
            //    dataType:"JSON",
            //    success:function(result){
            //     window.location.href = "{{ url('/cart') }}";
            //    }
            // });

             $.ajax({
               url: "{{ url('delete-item-from-cart') }}",
               type:"POST",
               data:{
                _token: "{{ csrf_token() }}",
                product_id:productId,
                type: typee,
                box_id: boxId
            },
               dataType:"JSON",
               success:function(result){
                window.location.href = "{{ url('/cart') }}";
               }
            });
        }
        </script>
