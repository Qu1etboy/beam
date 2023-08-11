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
            <h1>Welcome to Beam!</h1>
        </div>
        <div class="content">
            <p>Dear {{ $userName }},</p>
            <p>We're thrilled to have you join the Beam community! Welcome aboard to an exciting world of event organization and seamless event experiences. We're here to make sure your event journey is nothing short of amazing.</p>
            <p>At Beam, our mission is to provide you with the tools and resources to effortlessly plan, organize, and join events that leave lasting memories. Whether you're hosting a corporate conference, a birthday bash, a community meetup, or anything in between, we've got you covered.</p>
            <p>Here's what you can look forward to as a valued member of our community:</p>
            <ul>
                <li>Event Planning Made Effortless</li>
                <li>Discover Exciting Events</li>
                <li>Expert Resources</li>
                <li>Interactive Community</li>
                <li>Personalized Experience</li>
            </ul>
            <p>To get started, simply log in to your account at <a href="{{ route('index')}}">Beam</a> and explore all the exciting features that await you. If you have any questions along the way, our support team is here to assist you.</p>
            <p>Thank you for choosing Beam as your partner in event organization. We're excited to embark on this journey together and create unforgettable experiences. Here's to a future filled with successful events and wonderful memories!</p>
        </div>
        <div class="footer">
            <p>Follow us on Instagram to stay updated on the latest event trends, tips, and community happenings!</p>
        </div>
    </div>
</body>
</html>
