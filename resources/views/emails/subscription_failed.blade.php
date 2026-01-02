<!DOCTYPE html>
<html>

<head>
    <title>Subscription Update Failed</title>
</head>

<body>
    <h1>Hello {{ $order->name }} {{ $order->last_name }},</h1>
    <p>We regret to inform you that there was an issue updating your subscription.</p>
    <p>Subscription ID: {{ $order->razorpay_subscription_id }}</p>
    <p>Order ID: {{ $order->merchant_order_id }}</p>
    <p>Status: {{ $order->subscription_status }}</p>
    <p>Please contact support to resolve this issue.</p>
    <p>Best regards,<br>Your Company Name</p>
</body>

</html>
