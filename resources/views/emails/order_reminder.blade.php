<!DOCTYPE html>
<html>
<head>
    <title>Order Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #ffffff;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .reminder {
            background-color: #f9f9f9;
            padding: 20px;
            border-left: 4px solid #3490dc;
            margin-top: 20px;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #888;
            text-align: center;
        }
        a {
            color: #3490dc;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello {{ $user->name }},</h2>

        <p>This is a friendly reminder about your order placed on <strong>{{ $order->created_at->format('F j, Y') }}</strong>.</p>

        <div class="reminder">
            <p>🎁 <strong>Psst, time to pick next month’s goodies!</strong></p>
            <p>We’ll auto-pick for you if you don’t choose by <strong>{{ $selectionDeadline ?? 'September 5, 2025' }}</strong>.</p>
            <p><a href="{{ route('choose-products') }}">Click here to make your selection</a></p>
        </div>

        <p>We appreciate your business!</p>

        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
