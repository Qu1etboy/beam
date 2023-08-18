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
            <h1>You have been accepted!</h1>
        </div>
        <div class="content">
            <p>Dear {{ $userName }},</p>
            <p>We are excited to inform you that your application for the {{ $event->event_name }} has been accepted! Congratulations on this accomplishment.</p>
            <p>Event Details</p>
            <ul>
                <li>Event Name: {{ $event->event_name }}</li>
                <li>Date: from {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') }} to {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y, H:i') }}</li>
                <li>Location: {{ $event->location }}</li>
                <li>Link: <a href="{{ route('event-detail', ['event' => $event]) }}">{{ route('event-detail', ['event' => $event]) }}</a></li>
            </ul>
            <p>Your dedication and enthusiasm stood out to us during the selection process, and we believe that your participation will contribute greatly to the success of the event.</p>
            <p>Thank you for choosing Beam as your partner in event organization. We're excited to embark on this journey together and create unforgettable experiences. Here's to a future filled with successful events and wonderful memories!</p>
            <p>Best regards,</p>
            <p>{{ $userName }}</p>
        </div>
        <div class="footer">
            <p>Follow us on Instagram to stay updated on the latest event trends, tips, and community happenings!</p>
        </div>
    </div>
</body>
</html>
