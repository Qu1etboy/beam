<!DOCTYPE html>
<html>
<head>
    <style>
        /* CSS Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #333333;
        }

        .content {
            margin-bottom: 20px;
        }

        .content p {
            line-height: 1.6;
            color: #666666;
        }

        .content ul {
            list-style-type: disc;
            padding-left: 20px;
            margin-top: 10px;
            color: #666666;
        }

        .content ul li {
            margin-bottom: 10px
        }

        .cta-button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
        }

        .footer {
            text-align: center;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $subject }}</h1>
        </div>
        <div class="content">
            {!! $body !!}
        </div>
        <div class="footer">
            <p>Follow us on Instagram to stay updated on the latest event trends, tips, and community happenings!</p>
        </div>
    </div>
</body>
</html>
