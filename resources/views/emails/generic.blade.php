<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #dddddd;
            display: flex;
            justify-items: center;
        }
        .email-body {
            padding: 20px 0;
        }
        .email-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #dddddd;
            font-size: 12px;
            color: #888888;
        }
        .logo {
            height: 80px;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img class="logo" src="https://res.cloudinary.com/boxity-id/image/upload/c_scale,q_63,w_200/v1720974567/2_copy_z3a91z.png" alt="">
            <h1>{{ $nameApp }}</h1>
        </div>
        <div class="email-body">
            <p>{{$subject}}</p>
            <br>
            {!! $body !!}
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} PatunganYuk-CRM by PT Boxity Central Indonesia Group. All rights reserved by BoxityID.
        </div>
    </div>
</body>
</html>
