<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Add any custom styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            font-family: Arial, sans-serif;
            color: #333;
            padding: 20px;
            max-width: 600px;
            margin: 30px auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .email-logo {
            display: block;
            max-width: 180px;
            margin: 0 auto 20px;
        }
        .email-content {
            margin: 20px 0;
            line-height: 1.6;
        }
        .email-content p {
            margin: 0 0 15px;
        }
        .button-container {
            text-align: center; /* Center align the button container */
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            color: #fff !important;
            background-color: #1C4980;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
        }
        .button:hover {
            background-color: #3854A5;
        }
        .email-footer {
            font-size: 14px;
            color: #777;
            text-align: center;
            margin-top: 20px;
        }
        .email-footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <img src="https://opportunitiessharing.com/opcn/images/opportunity/paterner/place-10.png" alt="Logo" class="email-logo">
        <div class="email-content">
            <p>Hello,</p>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <div class="button-container">
                <a href="{{ $frontendUrl }}" class="button">Reset Password</a>
            </div>
            <p>If you did not request a password reset, no further action is required.</p>
            <p>Thank you for using </p>
        </div>
        <div class="email-footer">
            <p>Regards,</p>
            <p>OpSh Team</p>
        </div>
    </div>
</body>
</html>
