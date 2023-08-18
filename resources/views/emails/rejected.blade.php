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
            <h1>Your application's result for {{ $event->event_name }}</h1>
        </div>
        <div class="content">
            <p>Dear {{ $userName }},</p>
            <p>
                I trust this email finds you well. Thank you for taking the time to apply for participation in {{ $event->event_name }}. We appreciate your interest in being a part of this event.
            </p>
            <p>
                After careful consideration and a thorough review of all applications, we regret to inform you that your application for participation has not been selected on this occasion. We understand the dedication and effort you put into your application, and we want to assure you that this decision was not made lightly.
            </p>
            
            <p>
                Our selection process was highly competitive, and unfortunately, we had a limited number of spots available. Please know that your application stood out, and we were impressed by your abilities.
            </p>

            <p>
                We genuinely appreciate your interest in {{ $event->event_name }} and the enthusiasm you expressed in your application. We encourage you to continue pursuing your passion and goals, and we hope that you'll consider applying for future events organized by us.
            </p>

            <p>
                Thank you once again for considering {{ $event->event_name }}. We wish you all the best in your future endeavors and hope to cross paths in the future.
            </p>
            
            <p>Best regards,</p>
            <p>{{ $event->organizer->organizer_name }}</p>
        </div>
        <div class="footer">
            <p>Follow us on Instagram to stay updated on the latest event trends, tips, and community happenings!</p>
        </div>
    </div>
</body>
</html>
