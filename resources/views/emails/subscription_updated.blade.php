<!DOCTYPE html>
<html>

<head>
    <title>Subscription Updated</title>
</head>

<body>
    <h1>Hello {{ $order->name }} {{ $order->last_name }},</h1>
    <p>Your subscription has been successfully updated!</p>
    <p>Subscription ID: {{ $order->razorpay_subscription_id }}</p>
    <p>Order ID: {{ $order->merchant_order_id }}</p>
    <p>Latest Payment Amount: {{ $order->subscription_total }} {{ $order->currency }}</p>
    <p>Remaining Cycles: {{ $order->remaining_count }}</p>
    <p>Next Charge At: {{ $order->next_charge_at }}</p>
    <p>Thank you for your continued subscription.</p>
    <p>Best regards,<br>Your Company Name</p>
</body>

</html>
