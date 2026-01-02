@extends('admin.master.layouts.app')
@section('page-title')
    Order Details
@endsection

@section('page-content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-header">
                            {{-- <div class="d-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">Order #{{ $order->order_number }}</h5>
                                <div class="flex-shrink-0">
                                    <h4><span class="{{ $badgeClass }}">{{ ucfirst($status) }}</span></h4>
                                </div>
                            </div> --}}
                            <div class="d-flex align-items-center">
                                <!-- <h5 class="card-title flex-grow-1 mb-0">Order #{{ $order->order_number }}</h5> -->
                                <h5 class="card-title flex-grow-1 mb-0">Order #{{ $order->id }}</h5>

                                <div class="flex-shrink-0 d-flex align-items-center gap-2">
                                    <h4><span class="{{ $badgeClass }}">{{ ucfirst($status) }}</span></h4>
                                    <!-- <a href="{{ route('admin.order.invoice', $order->unique_id) }}" -->
                                    <a href="{{ route('admin.order.invoice', $order->id) }}"

                                        class="btn btn-primary btn-sm">Generate Invoice</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-nowrap align-middle table-borderless mb-0">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th scope="col">Product Details</th>
                                            <th scope="col">Item Price</th>
                                            <th scope="col">Quantity</th>
                                            {{-- <th scope="col">Rating</th> --}}
                                            <th scope="col">Status</th>
                                            <th scope="col">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $mystery_status = 'N/A';
                                            $gift_worth = 0;
                                        @endphp
                                        @foreach ($order_items as $order_item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 avatar-md bg-light rounded p-1">

                                                            <img src="{{ $order_item->product->media->first() ? asset($order_item->product->media->first()->image_path) : ($order_item->product->featured_image ? asset($order_item->product->featured_image) : asset('assets/img/cart/03.jpg')) }}"
                                                                alt="{{ $order_item->product->name }}"
                                                                class="img-fluid d-block">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h5 class="fs-15"><a
                                                                    href="{{ route('product.detail', $order_item->product->slug) }}"
                                                                    class="link-primary"
                                                                    target="_blank">{{ $order_item->product->name }}</a>
                                                            </h5>
                                                            @if (!empty($order_item->attributes))
                                                                @php
                                                                    $data = json_decode($order_item->attributes, true);
                                                                @endphp
                                                                @foreach ($data as $attribute)
                                                                    <p class="mb-0" style="display:inline;"><span class="text-dark">{{ $attribute['name'] }}: </span><span
                                                                            class="fw-medium text-muted">{{ ucfirst($attribute['value']) }}</span>
                                                                    </p>{{ ($loop->last ? '' : '|') }}
                                                                @endforeach
                                                            @endif
                                                            {{-- <p class="mb-0"><span class="text-dark">Variant: </span><span
                                                                    class="fw-medium text-muted">{{ $order_item->variant->name }}</span>
                                                            </p> --}}

                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ config('app.currency') }}
                                                    {{ number_format($order_item->price, 2) }}
                                                </td>
                                                <td>{{ $order_item->quantity }}</td>
                                                <td>
                                                    @if ($order_item->product->type == 'gift_card')
                                                        @if ($order_item->delivery_status == 'code_assigned')
                                                            <h5><span class="badge bg-success-subtle text-success">Code
                                                                    Assigned</span></h5>
                                                        @elseif($order_item->delivery_status == 'pending_code')
                                                            <h5><span class="badge bg-warning-subtle text-warning">Pending
                                                                    Code</span></h5>
                                                        @endif
                                                    @else
                                                        <h5><span
                                                                class="badge {{ getBadgeClasses($order_item->status) }}">{{ ucfirst(strtolower($order_item->status)) }}</span>
                                                        </h5>
                                                    @endif
                                                </td>

                                                {{-- <td>
                                                    <div class="text-warning fs-15">
                                                        <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i
                                                            class="ri-star-fill"></i><i class="ri-star-fill"></i><i
                                                            class="ri-star-half-fill"></i>
                                                    </div>
                                                </td> --}}
                                                <td class="fw-medium">
                                                    {{ config('app.currency') }}
                                                    {{ number_format($order_item->price * $order_item->quantity, 2) }}
                                                </td>
                                            </tr>
                                            @php
                                                $mystery_status = $order_item->delivery_status;
                                            @endphp
                                        @endforeach
                                        @if ($order->type == 1)
                                            @php
                                                $gift_worth = 30;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                            <img src="{{ asset('front/assets') }}/img/gift.jpg"
                                                                alt="gift" class="img-fluid d-block">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h5 class="fs-15">
                                                                <a href="javascipt:void(0)" class="link-primary">Mystery
                                                                    Gift</a>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ config('app.currency') }}
                                                    {{ number_format(30, 2) }}
                                                </td>
                                                <td>1</td>
                                                <td>
                                                    <h5>
                                                        <span
                                                            class="badge {{ getBadgeClasses($mystery_status) }}">{{ ucfirst(strtolower($mystery_status)) }}</span>
                                                    </h5>
                                                </td>
                                                <td class="fw-medium">
                                                    {{ config('app.currency') }}
                                                    {{ number_format(30 * 1, 2) }}
                                                </td>
                                            </tr>
                                        @endif
                                        <tr class="border-top border-top-dashed">
                                            <td colspan="4"></td>
                                            <td colspan="4" class="fw-medium p-0">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                        <tr>
                                                            @if ($order->type == 1)
                                                                <td>Total Value of Products :</td>
                                                            @else
                                                                <td>Sub Total :</td>
                                                            @endif
                                                            <td class="text-end">{{ config('app.currency') }}
                                                                {{ number_format($order->total_amount + $gift_worth, 2) }}
                                                            </td>
                                                        </tr>
                                                        @if ($order->shipping_cost)
                                                            <tr>
                                                                <td>Shipping :</td>
                                                                <td class="text-end">
                                                                    {{ config('app.currency') }}
                                                                    {{ number_format($order->shipping_cost, 2) }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        @if ($order->discount_applied > 0)
                                                            <tr>
                                                                <td>Discount :</td>
                                                                <td class="text-end">{{ config('app.currency') }}
                                                                    {{ number_format($order->discount_applied, 2) }}</td>
                                                            </tr>
                                                        @endif
                                                        @if ($order->points_discount > 0)
                                                            <tr>
                                                                <td>Points Discount :</td>
                                                                <td class="text-end">
                                                                    {{ moneyFormat($order->points_discount) }}
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
                                                                    <td>Plan ({{ $order->bundle_plan_name }}) :</td>
                                                                    <td class="text-center">
                                                                        {{ moneyFormat($order->bundle_plan_price) }}
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row">Total :</th>
                                                            <th class="text-end">{{ config('app.currency') }}
                                                                @if ($order->type == 1)
                                                                    {{ number_format($order->subscription_total, 2) }}
                                                                @else
                                                                    {{ number_format(($grand_total + ($order->shipping_cost ? $order->shipping_cost : 0)), 2) }}
                                                                @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        @if ($order->notes)
                                            <tr class="border-top border-top-dashed">
                                                {{-- <td colspan="1"></td> --}}
                                                <td colspan="5" class="fw-medium p-0">
                                                    <table class="table table-borderless mb-0">
                                                        <tbody>
                                                            <tr class="border-top border-top-dashed">
                                                                <th scope="row">Notes :</th>
                                                                <th class="text-left">
                                                                    <span style="white-space: normal;">
                                                                        {{ $order->notes }}</span>
                                                                </th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($order->type == 1)
                            @if (count($order->items) < 4)
                                <div class="card-footer">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#addonProductModal">
                                        Add Product
                                    </button>
                                </div>
                            @endif
                        @endif
                    </div>
                    <!--end card-->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">Order History</h5>
                                {{-- <div class="flex-shrink-0 mt-2 mt-sm-0">
                                    <a href="javascript:void(0);"
                                        class="btn btn-soft-info material-shadow-none btn-sm mt-2 mt-sm-0"><i
                                            class="ri-map-pin-line align-middle me-1"></i> Change Address</a>
                                    <a href="javascript:void(0);"
                                        class="btn btn-soft-danger material-shadow-none btn-sm mt-2 mt-sm-0"><i
                                            class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel
                                        Order</a>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="profile-timeline">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item border-0">
                                        <div class="accordion-header" id="headingOne">
                                            <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                                href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-xs">
                                                        <div class="avatar-title bg-danger rounded-circle material-shadow">
                                                            <i class="bx bx-category-alt"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fs-15 mb-0 fw-semibold">Order Placed - <span
                                                                class="fw-normal">{{ $order->created_at->format('D, d M Y') }}</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            @foreach ($order->history as $history)
                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                    <h6 class="mb-1">{{ $history->notes }}</h6>
                                                    <p class="text-muted">
                                                        {{ \Carbon\Carbon::parse($history->created_at)->format('D, d M Y - h:ia') }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!--end accordion-->
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <div class="col-xl-3">
                    <!--end col-->


                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <h5 class="card-title flex-grow-1 mb-0">Customer Details</h5>
                                <div class="flex-shrink-0">
                                    @if ($order->user)
                                        <a href="{{ route('admin.customer.view', $order->user->id) }}"
                                            class="link-secondary">
                                            View Profile
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 vstack gap-3">
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            @if ($order->user)
                                                <img src="{{ $order->user->avatar ? asset($order->user->avatar) : asset('admin/assets/images/users/avatar-1.jpg') }}"
                                                    class="avatar-sm rounded material-shadow" />
                                            @else
                                                <img src="{{ asset('admin/assets/images/users/avatar-1.jpg') }}"
                                                    class="avatar-sm rounded material-shadow" />
                                            @endif

                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-14 mb-1">
                                                {{ $order->user ? $order->user->name . ' ' . $order->user->last_name : $order->order_detail->name . ' ' . $order->order_detail->last_name }}
                                            </h6>
                                            <p class="text-muted mb-0">Customer</p>
                                        </div>
                                    </div>
                                </li>
                                @php
                                    $email = $order->user ? $order->user->email : $order->order_detail->email;
                                @endphp
                                @if ($email)
                                    <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>
                                        {{ $order->user ? $order->user->email : $order->order_detail->email }}
                                    </li>
                                @endif
                                @php
                                    $phone = $order->user ? $order->user->phone : $order->order_detail->phone;
                                @endphp
                                @if ($phone)
                                    <li>
                                        <i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>
                                        {{ $phone }}
                                    </li>
                                @endif
                                @php
                                    $address = $order->user ? $order->user->address : $order->order_detail->address;
                                @endphp
                                @if ($address)
                                    <li>
                                        <i class="ri-map-pin-fill me-2 align-middle text-muted fs-16"></i>
                                        {{ $address }}
                                    </li>
                                @endif
                                @php
                                    $post_code = $order->user ? $order->user->postal_code : 'N/A';
                                @endphp
                                @if ($post_code)
                                    <li>
                                        <i class="ri-mail-send-line me-2 align-middle text-muted fs-16"></i>
                                        {{ $post_code }}
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    {{-- <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <h5 class="card-title flex-grow-1 mb-0">Shipping Details</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 vstack gap-3">
                                <li>
                                    <i class="ri-map-pin-fill me-2 align-middle text-muted fs-16"></i>
                                    {{ $order->order_detail->shipping_address }}
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                    @if ($order->coupon)
                        <div class="alert border-dashed alert-success" role="alert">
                            <div class="d-flex align-items-center">
                                <div class="ms-2">
                                    <h5 class="fs-14 text-success fw-semibold mb-1"> Discount Applied</h5>
                                    <p class="text-body mb-0">
                                        You’ve successfully applied the coupon
                                        <span class="fw-semibold text-uppercase">{{ $order->coupon->code }}</span> and
                                        received
                                        @if ($order->coupon->type === 'percentage')
                                            <strong>{{ $order->coupon->value }}% OFF</strong>
                                        @elseif($order->coupon->type === 'fixed')
                                            <strong>{{ config('app.currency') }}{{ number_format($order->coupon->value, 2) }}
                                                OFF</strong>
                                        @endif
                                        on your order.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($order->points_discount > 0)
                        <div class="alert border-dashed alert-info" role="alert">
                            <div class="d-flex align-items-center">
                                <div class="ms-2">
                                    <h5 class="fs-14 text-info fw-semibold mb-1">Reward Points Discount</h5>
                                    <p class="text-body mb-0">
                                        You redeemed <strong>{{ $order->redeemed->points_earned }} reward points</strong>
                                        to receive a
                                        <strong>{{ moneyFormat($order->points_discount) }} discount</strong> on this order.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($order->type == 1)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0"><i
                                        class="ri-money-dollar-box-line align-bottom me-1 text-muted"></i>
                                    Subscription Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Plan:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">{{ $order->bundle_plan_name }}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Price:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">{{ $order->bundle_plan_price }} / month</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Type:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">{{ $order->plan?->type === 1 ? 'Monthly' : 'Yearly' }}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Renewal Date:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">
                                            {{ $order->user?->subscription_detail?->renewal_date
                                                ? \Carbon\Carbon::parse($order->user->subscription_detail->renewal_date)->format('d F Y')
                                                : 'N/A' }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($order->type == 0)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0"><i
                                        class="ri-secure-payment-line align-bottom me-1 text-muted"></i>
                                    Payment
                                    Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Transactions:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">#{{ $order->order_number }}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Payment Method:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">{{ ucfirst($order->payment_method) }}</h6>
                                    </div>
                                </div>
                                {{-- <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Card Holder Name:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">Joseph Parker</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Card Number:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">xxxx xxxx xxxx 2456</h6>
                                    </div>
                                </div> --}}
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Sub Total:</p>
                                    </div>

                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">
                                            {{ config('app.currency') }} {{ number_format($order->total_amount, 2) }}
                                        </h6>
                                    </div>
                                </div>
                                @if ($order->shipping_id)
                                    <div class="d-flex justify-content-start mb-2 gap-2">
                                        <div>
                                            <p class="text-muted mb-0">Shipping:</p>
                                        </div>
                                        <div class="d-flex gap-1 flex-column">
                                            <div>
                                                {{ $order->shipping->type }}
                                            </div>
                                            <div>
                                                {{ config('app.currency') }}
                                                {{ number_format($order->shipping->price, 2) }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($order->points_discount > 0)
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-shrink-0">
                                            <p class="text-muted mb-0">Points Discount:</p>
                                        </div>

                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-0">
                                                {{ moneyFormat($order->points_discount) }}
                                            </h6>
                                        </div>
                                    </div>
                                @endif

                                @if ($order->discount_applied > 0)
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-shrink-0">
                                            <p class="text-muted mb-0">Discount:</p>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-0">
                                                {{ config('app.currency') }}
                                                {{ number_format($order->discount_applied, 2) }}
                                            </h6>
                                        </div>
                                    </div>
                                @endif

                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Grand Total:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">
                                            {{ config('app.currency') }} {{ number_format($grand_total, 2) }}
                                        </h6>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif
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
                                        <p class="text-muted mb-0">Address:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">{{ $order->order_detail->shipping_address }}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Tracking No:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0"><a href="{{ $order->tracking_url }}" target="_blank">
                                                {{ $order->tracking_no }}</a></h6>
                                    </div>
                                </div>
                                {{-- <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Tracking URL:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                </div> --}}
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Invoice:</p>
                                    </div>

                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0"><a href="{{ $order->consignment_pdf }}" target="_blank"
                                                class="btn btn-link material-shadow-none">View <i
                                                    class="ri-arrow-right-line align-bottom"></i></a></h6>
                                    </div>
                                </div>



                                <div class="d-flex align-items-start flex-column mb-2">
                                    <div class="flex-grow-1 ms-2">
                                        <img src="{{ $order->consignment_jpeg }}" alt="{{ $order->tracking_no }}"
                                            width="200">
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif
                    <!--end card-->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="ri-shield-flash-line align-bottom me-1 text-muted"></i>
                                Status</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.order.status', $order->id) }}" method="post">
                                @csrf
                                <div class="mb-2">
                                    <div class="flex-shrink-0">
                                        <select name="status" class="form-select mb-3">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="processing"
                                                {{ $order->status === 'processing' ? 'selected' : '' }}>
                                                Processing</option>
                                            <option value="completed"
                                                {{ $order->status === 'completed' ? 'selected' : '' }}>
                                                Completed</option>
                                            <option value="failed" {{ $order->status === 'failed' ? 'selected' : '' }}>
                                                Failed
                                            </option>
                                            <option value="cancelled"
                                                {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                                                Cancelled</option>
                                        </select>

                                    </div>
                                </div>
                                @if ($status != 'completed')
                                    <div class="d-flex align-items-center justify-content-end mb-2">
                                        <div class="flex-shrink-0">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                    <!--end card-->

                </div>

            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div><!-- container-fluid -->

    <div class="modal fade" id="addonProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product to Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="addProductForm" action="{{ route('admin.order.extra.product') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <input type="hidden" name="order_user_id" value="{{ $order->user_id }}">
                        <input type="hidden" id="new_product_id" name="new_product_id">
                    </form>
                    <ul class="list-group">
                        @foreach ($products as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="one_more_product"
                                        value="{{ $product->id }}" id="product_{{ $product->id }}"
                                        @if ($product->qty == 0) disabled @endif>
                                    <label class="form-check-label" for="product_{{ $product->id }}">
                                        {{ $product->name }}
                                        <br>
                                        @if ($product->qty == 0)
                                            <span class="text-danger">(Out of stock)</span>
                                        @else
                                            <span class="text-info">(Stock: {{ $product->qty }})</span>
                                        @endif
                                    </label>
                                </div>
                                <span>{{ $product->price }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="addProductBtn" class="btn btn-danger">Add Selected Products</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!--datatable js-->
    <script>
        $(document).ready(function() {
            var table = $('#orders-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('admin.orders.get') }}",
                    type: "GET",
                    error: function(xhr, error, code) {
                        console.error(xhr.responseText);
                    }
                },
                dom: "<'d-flex align-items-center justify-content-start'<'search-container me-1'><'dropdown-container ms-1 position-relative'>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                order: [],
                columns: [{
                        data: 'order_id',
                        name: 'order_id'
                    },
                    {
                        data: 'customer',
                        name: 'customer'
                    },
                    {
                        data: 'order_date',
                        name: 'order_date'
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount'
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    },
                    search: ""
                },
                fnInitComplete: function() {
                    $('#SaleTable').removeClass('d-none').fadeIn();

                    // Custom Search Input
                    let searchWrapper = $('<div class="search-wrapper position-relative"></div>');
                    searchWrapper.append(`
                         <svg class="search-icon position-absolute" width="13" height="13" viewBox="0 0 18 18" fill="none">
                            <path d="M17 17L15.4 15.4M8.6 16.2C9.6 16.2 10.6 16 11.5 15.6C12.4 15.2 13.2 14.6 13.9 13.9C14.6 13.2 15.2 12.4 15.6 11.5C16 10.6 16.2 9.6 16.2 8.6C16.2 7.6 16 6.6 15.6 5.7C15.2 4.7 14.6 3.9 13.9 3.2C13.2 2.5 12.4 2 11.5 1.6C10.6 1.2 9.6 1 8.6 1C6.6 1 4.7 1.8 3.2 3.2C1.8 4.6 1 6.6 1 8.6C1 10.6 1.8 12.5 3.2 13.9C4.6 15.4 6.6 16.2 8.6 16.2Z" stroke="#26303B" stroke-opacity="0.5" stroke-width="1.5"></path>
                        </svg>
                     `);
                    let searchInput = $(
                        '<input type="text" class="form-control custom-search-input" placeholder="Search...">'
                    );
                    searchInput.on('keyup', function() {
                        table.search(this.value).draw();
                    });
                    searchWrapper.append(searchInput);
                    $('.search-container').html(searchWrapper);
                    // Custom Dropdown
                    let dropdownWrapper = $('<div class="dropdown-wrapper position-relative"></div>');
                    dropdownWrapper.append(`
                    <svg class="dropdown-icon position-absolute" width="9" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.149 1.47725e-06L0.531852 2.318e-06C0.434483 0.000307502 0.339041 0.0271625 0.2558 0.0776758C0.172557 0.128189 0.104668 0.200448 0.059439 0.286674C0.0142091 0.372902 -0.00664777 0.469832 -0.00088566 0.567031C0.0048755 0.66423 0.0370363 0.758017 0.0921348 0.838297L4.90071 7.78402C5.1 8.072 5.57979 8.072 5.77961 7.78402L10.5882 0.838296C10.6438 0.758183 10.6765 0.664349 10.6826 0.566988C10.6886 0.469627 10.6679 0.372464 10.6226 0.286054C10.5774 0.199645 10.5093 0.127293 10.4258 0.0768614C10.3423 0.0264302 10.2466 -0.00015255 10.149 1.47725e-06Z" fill="#26303B" fill-opacity="0.7"/>
                    </svg>
                `);
                    let dropdown = $('<select class="form-select"></select>');
                    dropdown.append('<option value="10">10</option>');
                    dropdown.append('<option value="25">25</option>');
                    dropdown.append('<option value="50">50</option>');
                    dropdown.append('<option value="100">100</option>');
                    dropdown.val(table.page.len());
                    dropdown.on('change', function() {
                        table.page.len(this.value).draw();
                    });
                    dropdownWrapper.append(dropdown);
                    $('.dropdown-container').html(dropdownWrapper);

                }
            });
            $(document).on('change', '.status', function() {

                var id = $(this).attr('data-id');
                var url = "{{ route('admin.category.status', ':id') }}";
                url = url.replace(':id', id);

                if ($(this).is(':checked')) {
                    var status = 1;
                    var isActive = 'activated';
                } else {
                    var status = 0;
                    var isActive = 'deactivated';
                }

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        toastr.success('Category ' + isActive);

                    }
                });
            });
        });
    </script>
    <script>
        $(function() {
            let selectedProduct = null;

            $("input[name='one_more_product']").on("change", function() {
                selectedProduct = $(this).val();
                $("#new_product_id").val(selectedProduct);
            });

            $("#addProductBtn").on("click", function() {
                if (!selectedProduct) {
                    swal("Oops!", "Please select a product before adding.", "warning");
                    return;
                }

                $.ajax({
                    url: $("#addProductForm").attr("action"),
                    method: "POST",
                    data: $("#addProductForm").serialize(),
                    success: function(response) {
                        $("#addonProductModal").modal("hide");

                        if (response.success) {
                            swal("Success!", "Product added successfully.", "success")
                                .then(() => {
                                    location.reload(); // reload after swal confirmation
                                });
                        } else {
                            swal("Error", response.message || "Something went wrong.", "error");
                        }
                    },
                    error: function(xhr) {
                        swal("Error", xhr.responseJSON?.message ||
                            "An unexpected error occurred.", "error");
                    }
                });
            })
        });
    </script>
@endsection
