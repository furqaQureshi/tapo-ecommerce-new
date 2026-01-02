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
           var options = {
                "key": "{{$key}}",
                "order_id": "{{$order_id}}",                                        
                "customer_id": "{{$customer_id}}",
                "recurring": "1",
                "handler": function (response) {  
                    location.href = "{{$url}}";      
                },
                "modal": {
                    "ondismiss": function(){
                        location.href = "{{route('bundle-checkout')}}"
                    }
                },
                "notes": {
                    "note_key_1": "{{$p->title}}",
                    "note_key_2": "{{$p->description}}"
                },
                "theme": {
                    "color": "#F37254"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        </script>
    </div>
</body>

</html>
