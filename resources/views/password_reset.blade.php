<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Add any custom styles here */
        .email-container {
            font-family: Arial, sans-serif;
            color: #333;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .email-logo {
            max-width: 200px;
        }
        .email-content {
            margin: 20px 0;
        }
        .email-footer {
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <img src="{{ $logoUrl }}" alt="{{ $appName }} Logo" class="email-logo">
        <div class="email-content">
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <a href="{{ $frontendUrl }}" style="display: inline-block; padding: 10px 20px; color: #fff; background-color: #1C4980; text-decoration: none; border-radius: 4px;">Reset Password</a>
            <p>If you did not request a password reset, no further action is required.</p>
        </div>
        <div class="email-footer">
            <p>Regards,</p>
            <p>{{ $appName }}</p>
        </div>
    </div>
</body>
</html>
