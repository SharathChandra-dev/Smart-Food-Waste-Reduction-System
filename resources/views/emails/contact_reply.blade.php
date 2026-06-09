<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SFWR Admin Response</title>
</head>
<body>
    <h1>Response from SFWR Admin</h1>

    <p>Hi {{ $contact->name_sfwr }},</p>

    <p>Thank you for reaching out. Here is our response to your message:</p>

    <blockquote style="padding: 12px; border-left: 4px solid #007bff; background: #f4f7ff;">
        {{ $contact->admin_response_sfwr }}
    </blockquote>

    <p><strong>Your original message:</strong></p>
    <p>{{ $contact->message_sfwr }}</p>

    <hr>
    <p>If you need further help, feel free to reply to this email.</p>
    <p>Best regards,<br>SFWR Admin Team</p>
</body>
</html>
