<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome Email</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:0; margin:0;">
    <div style="max-width:600px; margin:40px auto; background:white; border-radius:10px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.1);">

        <div style="background: #424E9B; color:white; padding:20px; text-align:center;">
            <h1 style="margin:0;">🎉 Welcome {{ $user->first_name }}!</h1>
        </div>

        <div style="padding:30px;">
            <p style="font-size:16px; color:#555;">
                Dear {{ $user->first_name }} {{ $user->last_name }},
            </p>

            <p style="font-size:16px; color:#555;">
                Thank you for registering on our website!
                Your account has been successfully created.
            </p>

            <p style="font-size:16px; color:#555;">
                You can now login using your email:
                <strong>{{ $user->email }}</strong>
            </p>

            <div style="text-align:center; margin-top:30px;">
                <a href="{{ url('/login') }}"
                   style="background:#424E9B; padding:12px 25px; color:white; text-decoration:none; font-weight:bold; border-radius:5px;">
                    Login Now
                </a>
            </div>

            <p style="margin-top:40px; font-size:14px; color:#888;">
                If you did not create this account, please ignore this email.
            </p>
        </div>

        <div style="background:#eee; padding:15px; text-align:center; font-size:12px; color:#777;">
            &copy; {{ date('Y') }} Tapo. All rights reserved.
        </div>

    </div>
</body>
</html>
