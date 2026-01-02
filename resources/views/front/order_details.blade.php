@extends('front.layouts.app')
@section('title')
    Order Details {{ $order->order_number }}
@endsection
@section('content')
    <!-- My-account-Section Start -->
    <section class="my-account-section section-padding fix">
        <div class="container">
            <div class="my-account-wrapper">
                <div class="row g-4">

                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <h3>Order Details #{{ $order->order_number }}</h3>
                            </div>
                            <div class="">
                                <h6>Status: <span style="color:#666C78">{{ ucfirst($order->status) }}</span></h6>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div id="Curriculum" class="tab-pane show active">
                                <div class="cart-list-area">
                                    <div class="table-responsive">
                                        <table class="table common-table">
                                            <thead data-aos="fade-down">
                                                <tr>
                                                    <th class="text-center">Product</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $gift_worth = 0;
                                                @endphp
                                                @foreach ($order->items as $item)
                                                    <tr class="align-items-center py-3">
                                                        <td>
                                                            <div class="cart-item-thumb d-flex align-items-center gap-4">
                                                                {{-- <i class="fas fa-times"></i> --}}

                                                                <img src="{{ $item->product->media->first() ? asset($item->product->media->first()->image_path) : ($item->product->featured_image ? asset($item->product->featured_image) : asset('assets/img/cart/03.jpg')) }}"
                                                                    alt="{{ $item->product->name }}">
                                                                <div class="d-flex flex-column bd-highlight mb-3">
                                                                    <div class="bd-highlight">
                                                                        <a
                                                                            href="{{ route('product.detail', $item->product->slug) }}"><span
                                                                                class="text-nowrap">{{ $item->product->name }}</span></a>
                                                                        @if (!empty($item->attributes))
                                                                            @php
                                                                                $data = json_decode(
                                                                                    $item->attributes,
                                                                                    true,
                                                                                );
                                                                            @endphp
                                                                            @foreach ($data as $attribute)
                                                                                <p class="mb-0" style="display:inline;">
                                                                                    <span
                                                                                        class="text-dark">{{ $attribute['name'] }}:
                                                                                    </span><span
                                                                                        class="fw-medium text-muted">{{ ucfirst($attribute['value']) }}</span>
                                                                                </p>{{ $loop->last ? '' : '|' }}
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                    <div class="bd-highlight">
                                                                        @if ($item->giftCardCode && $item->giftCardCode->code)
                                                                            {{-- <div class="gift-card-container">
                                                                                <div class="gift-card-label">YOUR GIFT CARD
                                                                                    CODE
                                                                                </div>
                                                                                <div class="gift-card-code-wrapper">
                                                                                    <div class="gift-card-code">
                                                                                        {{ $item->giftCardCode->code }}
                                                                                    </div>
                                                                                    <button class="copy-button"
                                                                                        onclick="navigator.clipboard.writeText('{{ $item->giftCardCode->code }}')">Copy</button>
                                                                                </div>
                                                                            </div> --}}
                                                                            <div
                                                                                class="gift-card-containmultiple codes gift-card-container">
                                                                                <div class="gift-card-label">YOUR GIFT CARD
                                                                                    CODE</div>
                                                                                <div class="gift-card-code-wrapper">
                                                                                    <div class="gift-card-code">
                                                                                        {{ $item->giftCardCode->code }}
                                                                                    </div>
                                                                                    <button class="copy-button"
                                                                                        onclick="copyToClipboard(this, '{{ $item->giftCardCode->code }}')">Copy</button>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="price-usd">
                                                                {{ $item->quantity }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="price-usd">
                                                                {{ number_format($item->price * $item->quantity, 2) }}
                                                                {{ config('app.currency') }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @if ($order->type == 1)
                                                    @php
                                                        $gift_worth = 30;
                                                    @endphp
                                                    <tr class="align-items-center py-3">
                                                        <td>
                                                            <div class="cart-item-thumb d-flex align-items-center gap-4">
                                                                {{-- <i class="fas fa-times"></i> --}}

                                                                <img src="{{ asset('front/assets') }}/img/gift.jpg"
                                                                    alt="gift">
                                                                <div class="d-flex flex-column bd-highlight mb-3">
                                                                    <div class="bd-highlight">
                                                                        <a href="javascipt:void(0)"><span
                                                                                class="text-nowrap">Mystery Gift</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="price-usd">1</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="price-usd">
                                                                {{ number_format(30 * 1, 2) }}
                                                                {{ config('app.currency') }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr class="border-top border-top-dashed">
                                                    <td colspan="2"></td>
                                                    <td colspan="2" class="fw-medium p-0">
                                                        <table class="table table-borderless mb-0">
                                                            <tbody>

                                                                <tr>
                                                                    @if ($order->type == 1)
                                                                        <td>Total Value of Products :</td>
                                                                    @else
                                                                        <td>Sub Total :</td>
                                                                    @endif
                                                                    <td class="text-center">
                                                                        {{ number_format($order->total_amount + $gift_worth, 2) }}
                                                                        {{ config('app.currency') }}</td>
                                                                </tr>
                                                                {{-- @if ($order->shipping_id)
                                                                    <tr>
                                                                        <td>Shipping :</td>
                                                                        <td class="text-end">
                                                                            <div class="d-flex flex-wrap"
                                                                                style="    flex-direction: column;text-align: center;">
                                                                                <div class="">
                                                                                    {{ $order->shipping->type }}
                                                                                </div>
                                                                                <div class="mt-2">

                                                                                    {{ number_format($order->shipping->price, 2) }}
                                                                                    {{ config('app.currency') }}
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endif --}}
                                                                @if ($order->points_discount > 0)
                                                                    <tr>
                                                                        <td>Points Discount :</td>
                                                                        <td class="text-center">
                                                                            {{ moneyFormat($order->points_discount) }}</td>
                                                                    </tr>
                                                                @endif
                                                                @if ($order->discount_applied > 0)
                                                                    <tr>
                                                                        <td>Discount :</td>
                                                                        <td class="text-center">
                                                                            {{ moneyFormat($order->discount_applied) }}
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                                @if ($order->type == 1)
                                                                    @if ($order->total_addon_price > 0)
                                                                        <tr>
                                                                            <td>Add-on Price :</td>
                                                                            <td class="text-center">
                                                                                {{ moneyFormat($order->total_addon_price) }}
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                    @if ($order->bundle_plan_price != null && $order->bundle_plan_price > 0)
                                                                        <tr>
                                                                            <td>Plan ({{ $order->bundle_plan_name }}) :
                                                                            </td>
                                                                            <td class="text-center">
                                                                                {{ moneyFormat($order->bundle_plan_price) }}
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endif
                                                                {{-- <tr class="border-top border-top-dashed">
                                                                    <th scope="row">Total :</th>
                                                                    <th class="text-center">
                                                                        @if ($order->type == 1)
                                                                            {{ number_format($order->subscription_total ?? 0.0, 2) }}
                                                                        @else
                                                                            {{ number_format($grand_total, 2) }}
                                                                        @endif
                                                                        {{ config('app.currency') }}
                                                                    </th>
                                                                </tr> --}}


                                                                @if (!empty($order->tracking_no))
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h5 class="card-title mb-0"><i
                                                                                    class="ri-secure-payment-line align-bottom me-1 text-muted"></i>
                                                                                Shipping Details</h5>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <div class="flex-shrink-0">
                                                                                    <p class="text-muted mb-0">Tracking No:
                                                                                    </p>
                                                                                </div>
                                                                                <div class="flex-grow-1 ms-2">
                                                                                    <h6 class="mb-0"><a
                                                                                            href="{{ $order->tracking_url }}"
                                                                                            target="_blank">
                                                                                            {{ $order->tracking_no }}</a>
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <div class="flex-shrink-0">
                                                                                    <p class="text-muted mb-0">Total:</p>
                                                                                </div>
                                                                                <div class="flex-grow-1 ms-2">
                                                                                    <h6 class="mb-0">
                                                                                        @if ($order->type == 1)
                                                                                            {{ number_format($order->subscription_total ?? 0.0, 2) }}
                                                                                        @else
                                                                                            {{ number_format($grand_total ?? ($order->grand_total ?? 0.0), 2) }}
                                                                                        @endif
                                                                                        {{ config('app.currency') }}
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex align-items-start flex-column mb-2">
                                                                                <div class="flex-grow-1 ms-2">
                                                                                    <img src="{{ $order->consignment_jpeg }}"
                                                                                        alt="{{ $order->tracking_no }}"
                                                                                        width="200">
                                                                                </div>
                                                                            </div>
                                                                            <!-- Tracking History Section -->

                                                                            @if ($order_shippings->isNotEmpty())
                                                                                <div class="mt-3">
                                                                                    <h6 class="mb-2">Tracking History</h6>
                                                                                    <div class="table-responsive">
                                                                                        <table
                                                                                            class="table table-bordered table-sm">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>Date</th>
                                                                                                    <th>Process</th>
                                                                                                    <th>Type</th>
                                                                                                    <th>Office</th>
                                                                                                    <th>Source</th>
                                                                                                    <th>Event Type</th>
                                                                                                    <th>Error Details</th>
                                                                                                    <th>Failure Reason</th>
                                                                                                    <th>EPOD</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @foreach ($order_shippings as $shipping)
                                                                                                    <tr>
                                                                                                        <td>{{ $shipping->date ? \Carbon\Carbon::parse($shipping->date)->format('d M Y, h:i A') : '-' }}
                                                                                                        </td>
                                                                                                        <td>{{ $shipping->process ?? '-' }}
                                                                                                        </td>
                                                                                                        <td>{{ $shipping->type ?? '-' }}
                                                                                                        </td>
                                                                                                        <td>{{ $shipping->office ?? '-' }}
                                                                                                        </td>
                                                                                                        <td>{{ $shipping->source ?? '-' }}
                                                                                                        </td>
                                                                                                        <td>{{ $shipping->event_type ?? '-' }}
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            @if ($shipping->error_details)
                                                                                                                <span
                                                                                                                    class="text-danger">{{ $shipping->error_details }}</span>
                                                                                                            @else
                                                                                                                -
                                                                                                            @endif
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            @if ($shipping->failure_reason)
                                                                                                                <span
                                                                                                                    class="text-warning">{{ $shipping->failure_reason }}</span>
                                                                                                            @else
                                                                                                                -
                                                                                                            @endif
                                                                                                        </td>
                                                                                                        <td>{{ $shipping->epod ?? '-' }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="mt-3">
                                                                                    <p class="text-muted">No tracking
                                                                                        history available.</p>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function copyToClipboard(button, code) {
            navigator.clipboard.writeText(code).then(function() {
                const originalText = button.innerText;
                button.innerText = "Copied!";
                button.disabled = true;

                setTimeout(function() {
                    button.innerText = originalText;
                    button.disabled = false;
                }, 2000); // 2 seconds
            }).catch(function(err) {
                console.error('Failed to copy text: ', err);
            });
        }
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
