<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>
<body>
    <table style="width: 100%; max-width: 600px; margin: 0 auto; padding: 20px;">
        <tr>
            <td style="text-align: center; padding-bottom: 20px;">
                <h1>Welcome to Our Website</h1>
            </td>
        </tr>
        <tr>
            <td>
                <p>Hello <?php echo $user->name; ?>,</p>
                <p>Thank you for joining us!</p>
                <p>We're excited to have you as a member of our community.</p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; padding-top: 20px;">
                <p>If you have any questions, feel free to contact us.</p>
            </td>
        </tr>
    </table>
</body>