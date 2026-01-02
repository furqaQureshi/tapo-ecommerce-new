<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #667eea 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .email-body {
            padding: 40px 30px;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-label {
            color: #6c757d;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .info-value {
            color: #212529;
            font-size: 16px;
            font-weight: 500;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .btn-custom {
            background: linear-gradient(135deg, #667eea 0%, #667eea 100%);
            border: none;
            padding: 12px 30px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1 class="mb-0">Welcome! 🎉</h1>
            <p class="mb-0 mt-2">Your account has been created successfully</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p class="h5 mb-3">Hello {{ $user->name ?? 'User' }},</p>

            <p>Thank you for registering with us! We're excited to have you on board. Your account has been successfully created.</p>

            <p class="mb-4">Here are your account details:</p>

            <!-- Account Details -->
            <div class="info-box">
                <div class="mb-3">
                    <div class="info-label">Full Name</div>
                    <div class="info-value">{{ !empty($user['name']) ? $user['name'] : $user['first_name']." ".$user['last_name'] }}</div>
                </div>
                <div class="mb-3">
                    <div class="info-label">Email Address</div>
                    <div class="info-value">{{ $user['email'] ?? '' }}</div>
                </div>
                <div class="mb-3">
                    <div class="info-label">Phone Number</div>
                    <div class="info-value">{{ $user['phone'] ?? 'N/A' }}</div>
                </div>
                <div>
                    <div class="info-label">Password</div>
                    <div class="info-value">{{ $user['password'] }}</div>
                    <small class="text-muted">Your password is securely encrypted</small>
                </div>
            </div>

            <div class="alert alert-info mt-4" role="alert">
                <strong>Security Tip:</strong> Please keep your login credentials safe and never share them with anyone.
            </div>

            <div class="text-center">
                <a href="{{ route('admin.login') }}" class="btn-custom">Get Started</a>
            </div>

            <p class="mt-4 mb-0">If you have any questions, feel free to reach out to our support team.</p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p class="mb-1">&copy; {{ date('Y') }} Tapo. All rights reserved.</p>
            <p class="mb-0">This is an automated email. Please do not reply.</p>
        </div>
    </div>
</body>
</html>
