<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Order #{{ $order->order_number }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .invoice-box {
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
        }
        .invoice-header {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .invoice-header img {
            max-width: 150px;
            margin-bottom: 15px;
        }
        .invoice-box h1 {
            font-size: 2.5rem;
            color: #1a1a1a;
            margin-bottom: 20px;
        }
        .invoice-box table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-box th, .invoice-box td {
            padding: 12px;
            vertical-align: top;
        }
        .invoice-box th {
            background-color: #e9ecef;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            color: #495057;
        }
        .invoice-box td {
            border-bottom: 1px solid #dee2e6;
        }
        .invoice-box .total td {
            font-weight: bold;
            font-size: 1.1rem;
        }
        .invoice-box .info-section {
            background-color: #f1f3f5;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .download-btn {
            margin-top: 20px;
            text-align: right;
        }
        @media (max-width: 600px) {
            .invoice-box {
                padding: 15px;
            }
            .invoice-box th, .invoice-box td {
                display: block;
                width: 100%;
                text-align: center;
            }
            .download-btn {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="invoice-header">
            <div class="text-center mb-3">
                <img src="{{ asset('assets/images/home/logo/logo.svg') }}" alt="Company Logo" class="img-fluid" style="max-width: 150px;">
            </div>
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div class="text-start">
                    <h1 class="mb-2">Invoice</h1>
                    <p class="mb-0">
                        Order #: {{ $order->id ?? '' }}
                    </p>
                </div>
                <div class="text-end">
                    <p class="mb-0">
                        Order #: {{ $order->id ?? '' }}<br>
                        Date: {{ $order->created_at->format('D, d M Y') }}<br>
                        Status: <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="info-section">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="fw-bold">Customer Details</h5>
                    <p>
                        {{ $order->user ? $order->user->first_name . ' ' . $order->user->last_name : $order->order_detail->name . ' ' . $order->order_detail->last_name }}<br>
                        {{ $order->user ? $order->user->email : $order->order_detail->email }}<br>
                        {{ $order->user ? $order->user->phone : $order->order_detail->phone }}<br>
                        {{ $order->user ? $order->user->address : $order->order_detail->address }}<br>
                        <strong>Postal Code:</strong> {{ $order->user ? $order->user->postal_code ? $order->user->postal_code : 'N/A' : 'N/A' }}
                    </p>
                </div>

                <div class="col-md-6 text-md-end">
                    <h5 class="fw-bold">Shipping Details</h5>
                    <p>
                        {{ $order->user->address ? $order->user->address : '' }}
                    </p>

                    @if($order->type == 1)
                        <h5 class="fw-bold mt-3">Subscription Details</h5>
                        <p>
                            <strong>Plan:</strong> {{ $order->bundle_plan_name }}<br>
                            <strong>Price:</strong> {{ config('app.currency') }} {{ number_format($order->bundle_plan_price, 2) }} / month<br>
                            <strong>Type:</strong> {{ $order->plan?->type === 1 ? 'Monthly' : 'Yearly' }}<br>
                            <strong>Renewal Date:</strong> {{ $order->user?->subscription_detail?->renewal_date ? \Carbon\Carbon::parse($order->user->subscription_detail->renewal_date)->format('d F Y') : 'N/A' }}
                        </p>
                    @else
                        <h5 class="fw-bold mt-3">Payment Details</h5>
                        <p>
                            <strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}<br>
                            <strong>Transaction:</strong> #{{ $order->unique_id }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="text-end">Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $mystery_status = 'N/A';
                    $gift_worth = 0;
                    $total_value = 0;
                @endphp
                @foreach($order->items as $orderItem)
                    <tr>
                        <td>
                            {{ $orderItem->product->name }}
                            <br>
                            <!--Attributes -->
                                    <!-- <p class="mb-0" style="display:inline;">
                                        <small>
                                            <span class="text-dark">RED: </span>
                                            <span class="fw-medium text-muted">4</span>
                                        </small>
                                    </p> -->
                             <!--Attributes -->
                            <br>
                            <small><strong>Quantity:</strong> {{ $orderItem->quantity }}</small>
                        </td>
                        <td class="text-end">
                            RM {{ number_format($orderItem->product->price*$orderItem->quantity,2) }}
                        </td>
                    </tr>
                    @endforeach
                @if($order->type == 1)
                    @php
                        $gift_worth = 30;
                    @endphp
                    <tr>
                        <td>
                            Mystery Gift<br>
                            <small><strong>Quantity:</strong> 1</small>
                        </td>
                        <td class="text-end">
                            USD 564
                        </td>
                    </tr>
                @endif
                <tr class="total">
                    <td></td>
                    <td class="text-end">
                      
                            <strong>Sub Total:</strong>RM {{ number_format($order->total_amount, 2) }}<br>
                            <strong>Total:</strong> {{ config('app.currency') }} {{ number_format($grand_total, 2) }}
                    </td>
                </tr>
            </tbody>
        </table>

        @if ($order->notes)
            <div class="mt-3">
                <h5 class="fw-bold">Notes</h5>
                <p>{{ $order->notes }}</p>
            </div>
        @endif

        @if ($order->coupon)
            <div class="mt-3">
                <h5 class="fw-bold">Discount Applied</h5>
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

        @if ($order->points_discount > 0)
            <div class="mt-3">
                <h5 class="fw-bold">Reward Points Discount</h5>
                <p>
                    <strong>Redeemed:</strong> {{ $order->redeemed->points_earned }} points<br>
                    <strong>Discount:</strong> {{ config('app.currency') }} {{ number_format($order->points_discount, 2) }}
                </p>
            </div>
        @endif

        <div class="download-btn">
            <a href="{{ auth()->user()->role_id === 'admin' ? route('admin.order.invoice.download', $order->unique_id) : route('user.order.invoice.download', $order->unique_id) }}" class="btn btn-success">Download PDF</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
