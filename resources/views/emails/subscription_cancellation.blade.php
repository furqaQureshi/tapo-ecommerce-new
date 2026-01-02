<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Cancellation Confirmation</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="font-size: 24px; color: #333333; margin: 0 0 20px;">Hello {{ $user->name ?? 'Valued Customer' }},</h2>
                            <p style="font-size: 16px; color: #333333; line-height: 1.5;">We’re sorry to see you go! Your subscription has been successfully cancelled. You will no longer be charged, and your subscription benefits have ended.</p>
                            <table width="100%" cellpadding="10" style="background-color: #f9f9f9; border-left: 4px solid #3490dc; margin: 20px 0;">
                                <tr>
                                    <td>
                                        <p style="font-size: 16px; color: #333333; line-height: 1.5; margin: 0;"><strong>Subscription Details</strong></p>
                                        <p style="font-size: 16px; color: #333333; line-height: 1.5; margin: 10px 0;">User ID: {{ $user->id }}</p>
                                        <p style="font-size: 16px; color: #333333; line-height: 1.5; margin: 10px 0;">Cancellation Date: {{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
                                    </td>
                                </tr>
                            </table>
                            <p style="font-size: 16px; color: #333333; line-height: 1.5;">If you’d like to reactivate your subscription or have any questions, please contact our support team at <a href="mailto:support@yourcompany.com" style="color: #3490dc; text-decoration: none;">support@yourcompany.com</a>.</p>
                            <p style="font-size: 16px; color: #333333; line-height: 1.5;">Thank you for being a valued customer!</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding: 20px;">
                            <a href="https://dev.zeramom.brainiaccreation.com/public/" style="background-color: #3490dc; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px;">Visit Our Website</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding: 15px; font-size: 12px; color: #888888; background-color: #f8f8f8; border-radius: 0 0 8px 8px;">
                            <p style="margin: 0;">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                            <p style="margin: 5px 0;">Contact us at <a href="mailto:support@yourcompany.com" style="color: #3490dc; text-decoration: none;">support@yourcompany.com</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>