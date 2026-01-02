<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Curlec by Razorpay Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Processing Curlec Payment</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <p>Please wait while we process your payment...</p>

        <script>
            // Ensure CSRF token is available
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            var options = {
                "key": "{{ $key }}",
                "amount": {{ $amount }},
                "currency": "MYR",
                "name": "{{ config('app.name') }}",
                "description": "Order #{{ $merchant_ord_id }}",
                "order_id": "{{ $order_id }}",
                "handler": function(response) {
                    // Create a form to send payment details to the success route
                    var form = document.createElement("form");
                    form.setAttribute("method", "POST");
                    form.setAttribute("action", "{{ route('payment.success') }}");

                    // Add CSRF token
                    var csrf = document.createElement("input");
                    csrf.setAttribute("type", "hidden");
                    csrf.setAttribute("name", "_token");
                    csrf.setAttribute("value", csrfToken);
                    form.appendChild(csrf);

                    // Add Razorpay payment details
                    var payment_id = document.createElement("input");
                    payment_id.setAttribute("type", "hidden");
                    payment_id.setAttribute("name", "razorpay_payment_id");
                    payment_id.setAttribute("value", response.razorpay_payment_id);
                    form.appendChild(payment_id);

                    var order_id = document.createElement("input");
                    order_id.setAttribute("type", "hidden");
                    order_id.setAttribute("name", "razorpay_order_id");
                    order_id.setAttribute("value", response.razorpay_order_id);
                    form.appendChild(order_id);

                    var signature = document.createElement("input");
                    signature.setAttribute("type", "hidden");
                    signature.setAttribute("name", "razorpay_signature");
                    signature.setAttribute("value", response.razorpay_signature);
                    form.appendChild(signature);

                    var merchant_ord_id = document.createElement("input");
                    merchant_ord_id.setAttribute("type", "hidden");
                    merchant_ord_id.setAttribute("name", "merchant_ord_id");
                    merchant_ord_id.setAttribute("value", "{{ $merchant_ord_id }}");
                    form.appendChild(merchant_ord_id);

                    document.body.appendChild(form);
                    form.submit();
                },
                "prefill": {
                    "name": "{{ $name }}",
                    "email": "{{ $email }}",
                    "contact": "{{ $phone }}"
                },
                "notes": {
                    "merchant_order_id": "{{ $merchant_ord_id }}"
                },
                "theme": {
                    "color": "#3399cc"
                },
                "method": {
                    "fpx": true // Enable FPX for Malaysian payments
                },
                "redirect": true,
                "callback_url": "{{ route('curlec.payment.success') }}"
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function(response) {
                console.error('Payment Failed:', response.error);
                window.location.href = "{{ route('checkout') }}?error=Payment failed: " + encodeURIComponent(response
                    .error.description || 'Payment was cancelled.');
            });
            rzp1.open();
        </script>
    </div>
</body>

</html>
