<!-- resources/views/emails/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #052349;
            padding: 20px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content h2 {
            color: #052349;
            font-size: 22px;
            margin-top: 0;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
        }
        .content a {
            color: #052349;
            text-decoration: none;
        }
        .content ul, .content ol {
            margin-left: 20px;
            padding-left: 0;
        }
        .highlight {
            background-color: #e7f3ff;
            padding: 5px 10px;
            border-radius: 5px;
            color: #052349;
        }
        .user-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .user-info p {
            margin: 0 0 10px;
            font-size: 14px;
            color: #555;
        }
        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #ddd;
        }
        .footer p {
            margin: 0;
        }
        .footer a {
            color: #052349;
            text-decoration: none;
        }
        .footer .social-icons {
            margin: 10px 0;
        }
        .footer .social-icons a {
            display: inline-block;
            margin: 0 10px;
            color: #052349;
        }
        .footer .social-icons img {
            width: 24px;
            height: 24px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="email-container">
        @include('emails.partials.header')
        <div class="content">
            @yield('content')
        </div>
        @include('emails.partials.footer')
    </div>
</body>
</html>
