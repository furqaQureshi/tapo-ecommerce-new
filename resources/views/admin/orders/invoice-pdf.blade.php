<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - Order #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; margin: 0; padding: 0; }
        .invoice-box { width: 100%; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header img { max-width: 120px; margin-bottom: 10px; }
        h1 { margin: 10px 0; font-size: 22px; }
        h5 { margin: 8px 0; font-size: 14px; }
        p { margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; vertical-align: top; }
        th { background: #f4f4f4; font-weight: bold; font-size: 12px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .section { background: #f9f9f9; padding: 10px; margin: 15px 0; }
        .badge { padding: 3px 6px; font-size: 10px; background: #ddd; border-radius: 3px; }
        .total td { font-weight: bold; }
    </style>
</head>
<body>
    <div class="invoice-box">
        {{-- Header --}}
        <div class="header">
            <img src="{{ public_path('assets/images/home/logo/logo.svg') }}" alt="Company Logo">
            <h1>Invoice</h1>
            <p>Order #: {{ $order->id }} | Date: {{ $order->created_at->format('d M Y') }}</p>
            <p>Status: <span class="badge">{{ ucfirst($status) }}</span></p>
        </div>

        {{-- Customer + Payment Info --}}
        <div class="section">
            <table width="100%">
                <tr>
                    <td width="50%">
                        <h5>Customer Details</h5>
                        <p>
                            {{ $order->user ? $order->user->first_name . ' ' . $order->user->last_name : $order->order_detail->name . ' ' . $order->order_detail->last_name }}<br>
                            {{ $order->user ? $order->user->email : $order->order_detail->email }}<br>
                            {{ $order->user ? $order->user->phone : $order->order_detail->phone }}<br>
                            {{ $order->user ? $order->user->address : $order->order_detail->address }}<br>
                            <strong>Postal Code:</strong> {{ $order->user ? $order->user->postal_code : 'N/A' }}
                        </p>
                    </td>
                    <td width="50%">
                        <h5 class="fw-bold">Shipping Details</h5>
                        <p>
                            {{ $order->user->address }}
                        </p>
                        @if($order->type == 1)
                            <h5>Subscription Details</h5>
                            <p>
                                <strong>Plan:</strong> {{ $order->bundle_plan_name }}<br>
                                <strong>Price:</strong> {{ config('app.currency') }} {{ number_format($order->bundle_plan_price, 2) }} / month<br>
                                <strong>Type:</strong> {{ $order->plan?->type === 1 ? 'Monthly' : 'Yearly' }}<br>
                                <strong>Renewal Date:</strong> {{ $order->user?->subscription_detail?->renewal_date ? \Carbon\Carbon::parse($order->user->subscription_detail->renewal_date)->format('d F Y') : 'N/A' }}
                            </p>
                        @else
                            <h5>Payment Details</h5>
                            <p>
                                <strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}<br>
                                <strong>Transaction:</strong> #{{ $order->unique_id }}
                            </p>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        {{-- Order Items --}}
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $mystery_status = 'N/A';
                    $gift_worth = 0;
                    $total_value = 0;
                @endphp
                @foreach ($order_items as $order_item)
                    <tr>
                        <td>
                            {{ $order_item->product->name }}<br>
                            @if (!empty($order_item->attributes))
                                @php
                                    $data = json_decode($order_item->attributes, true);
                                @endphp
                                @foreach ($data as $attribute)
                                    <p class="mb-0" style="display:inline;">
                                        <small>
                                            <span class="text-dark">{{ $attribute['name'] }}: </span><span
                                            class="fw-medium text-muted">{{ ucfirst($attribute['value']) }}</span>
                                        </small>{{ ($loop->last ? '' : '|') }}
                                    </p>
                                @endforeach
                            @endif<br>
                            <small><strong>Quantity:</strong> {{ $order_item->quantity }}</small><br>
                            <small>
                                @if ($order_item->product->type == 'gift_card')
                                    <strong>Status:</strong> {{ $order_item->delivery_status == 'code_assigned' ? 'Code Assigned' : 'Pending Code' }}
                                @else
                                    <strong>Status:</strong> {{ ucfirst(strtolower($order_item->status)) }}
                                @endif
                            </small>
                        </td>
                        <td class="text-right">
                            {{ config('app.currency') }} {{ number_format($order_item->price * $order_item->quantity, 2) }}
                        </td>
                    </tr>
                    @php 
                        $mystery_status = $order_item->delivery_status;
                        $total_value += $order_item->price * $order_item->quantity;
                    @endphp
                @endforeach

                {{-- Mystery Gift --}}
                @if($order->type == 1)
                    @php $gift_worth = 30; @endphp
                    <tr>
                        <td>
                            Mystery Gift<br>
                            <small><strong>Quantity:</strong> 1</small><br>
                            <small><strong>Status:</strong> {{ ucfirst(strtolower($mystery_status)) }}</small>
                        </td>
                        <td class="text-right">
                            {{ config('app.currency') }} {{ number_format(30, 2) }}
                        </td>
                    </tr>
                @endif

                {{-- Totals --}}
                <tr class="total">
                    <td></td>
                    <td class="text-right">
                        @if ($order->type == 1)
                            <strong>Total Value of Products:</strong> {{ config('app.currency') }} {{ number_format(($total_value + $gift_worth), 2) }}<br>
                            @if ($order->total_addon_price > 0)
                                <strong>Add-on Price:</strong> {{ config('app.currency') }} {{ number_format($order->total_addon_price, 2) }}<br>
                            @endif
                            @if ($order->bundle_plan_price != null && $order->bundle_plan_price > 0)
                                <strong>Plan ({{ $order->bundle_plan_name }}):</strong> {{ config('app.currency') }} {{ number_format($order->bundle_plan_price, 2) }}<br>
                            @endif
                            <strong>Total:</strong> {{ config('app.currency') }} {{ number_format($order->subscription_total, 2) }}
                        @else
                            <strong>Sub Total:</strong> {{ config('app.currency') }} {{ number_format($order->total_amount, 2) }}<br>
                            @if ($order->shipping_id)
                                <strong>Shipping ({{ $order->shipping->type }}):</strong> {{ config('app.currency') }} {{ number_format($order->shipping->price, 2) }}<br>
                            @endif
                            @if ($order->discount_applied > 0)
                                <strong>Discount:</strong> {{ config('app.currency') }} {{ number_format($order->discount_applied, 2) }}<br>
                            @endif
                            @if ($order->points_discount > 0)
                                <strong>Points Discount:</strong> {{ config('app.currency') }} {{ number_format($order->points_discount, 2) }}<br>
                            @endif
                            <strong>Total:</strong> {{ config('app.currency') }} {{ number_format($grand_total, 2) }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Notes --}}
        @if ($order->notes)
            <div class="section">
                <h5>Notes</h5>
                <p>{{ $order->notes }}</p>
            </div>
        @endif

        {{-- Coupon --}}
        @if ($order->coupon)
            <div class="section">
                <h5>Discount Applied</h5>
                <p>
                    <strong>Coupon:</strong> {{ $order->coupon->code }}<br>
                    @if ($order->coupon->type === 'percentage')
                        <strong>Discount:</strong> {{ $order->coupon->value }}% OFF
                    @elseif($order->coupon->type === 'fixed')
                        <strong>Discount:</strong> {{ config('app.currency') }} {{ number_format($order->coupon->value, 2) }} OFF
                    @endif
                </p>
            </div>
        @endif

        {{-- Reward Points --}}
        @if ($order->points_discount > 0)
            <div class="section">
                <h5>Reward Points Discount</h5>
                <p>
                    <strong>Redeemed:</strong> {{ $order->redeemed->points_earned }} points<br>
                    <strong>Discount:</strong> {{ config('app.currency') }} {{ number_format($order->points_discount, 2) }}
                </p>
            </div>
        @endif
    </div>
</body>
</html>
