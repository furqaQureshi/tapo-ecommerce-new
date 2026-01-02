<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Subscription Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Subscription Payment</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <p>Click the button below to authorize your subscription payment.</p>
        <button id="rzp-button1" class="btn btn-primary">Pay Now</button>

        <script>
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            var options = {
                "key": "{{ $key }}",
                "subscription_id": "{{ $subscription_id }}",
                "amount": {{ $amount }},
                "currency": "MYR", // Changed to MYR for testing
                "name": "{{ config('app.name') }}",
                "description": "Subscription Order #{{ $merchant_ord_id }}",
                "handler": function(response) {
                    console.log('Razorpay Payment Success:', response);

                    var form = document.createElement("form");
                    form.setAttribute("method", "POST");
                    form.setAttribute("action", "{{ route('curlec_success.success') }}");

                    var csrf = document.createElement("input");
                    csrf.setAttribute("type", "hidden");
                    csrf.setAttribute("name", "_token");
                    csrf.setAttribute("value", csrfToken);
                    form.appendChild(csrf);

                    var payment_id = document.createElement("input");
                    payment_id.setAttribute("type", "hidden");
                    payment_id.setAttribute("name", "razorpay_payment_id");
                    payment_id.setAttribute("value", response.razorpay_payment_id);
                    form.appendChild(payment_id);

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

                    var subscription_id = document.createElement("input");
                    subscription_id.setAttribute("type", "hidden");
                    subscription_id.setAttribute("name", "razorpay_subscription_id");
                    subscription_id.setAttribute("value", response.razorpay_subscription_id);
                    form.appendChild(subscription_id);

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
                    "color": "#F37254"
                }
            };

            // Log network requests
            (function(open) {
                XMLHttpRequest.prototype.open = function(method, url) {
                    console.log('Network Request:', method, url);
                    this.addEventListener('load', function() {
                        console.log('Network Response:', {
                            url: url,
                            status: this.status,
                            response: this.responseText
                        });
                    });
                    this.addEventListener('error', function() {
                        console.error('Network Error:', {
                            url: url,
                            status: this.status,
                            response: this.responseText
                        });
                    });
                    open.apply(this, arguments);
                };
            })(XMLHttpRequest.prototype.open);

            var rzp1 = new Razorpay(options);
            document.getElementById('rzp-button1').onclick = function(e) {
                console.log('Pay Now button clicked, opening Razorpay Checkout with options:', options);
                rzp1.open();
                e.preventDefault();
            };

            rzp1.on('payment.failed', function(response) {
                console.error('Payment Failed:', response.error);
                var errorDetails = encodeURIComponent(JSON.stringify({
                    code: response.error.code,
                    description: response.error.description,
                    source: response.error.source,
                    step: response.error.step,
                    reason: response.error.reason,
                    metadata: response.error.metadata
                }));
                window.location.href = "{{ route('bundle-checkout') }}?error=Payment failed: " + errorDetails;
            });
        </script>
    </div>
</body>

</html>
