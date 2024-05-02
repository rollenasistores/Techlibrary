<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Please Return the Book - Today is the Deadline</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table role="presentation" cellspacing="0" cellpadding="0" width="100%" style="margin: auto;">
        <tr>
            <td style="padding: 20px; text-align: center;">
                <h1 style="font-size: 24px; font-weight: bold; color: #333333; margin-bottom: 20px;">Please Return the Book - Today is the Deadline</h1>
                <p style="font-size: 16px; color: #333333; margin-bottom: 20px;">Dear {{ $studentName }},</p>
                <p style="font-size: 16px; color: #333333; margin-bottom: 20px;">We kindly remind you that today is the deadline to return the book titled "<strong>{{ $book_title }}</strong>". Please ensure that you return the book by the end of the day.</p>
                <p style="font-size: 16px; color: #333333; margin-bottom: 20px;">If you have already returned the book, please disregard this message.</p>
                <p style="font-size: 16px; color: #333333;">Thank you for your cooperation.</p>
                <p style="font-size: 16px; color: #333333; margin-top: 20px;">Sincerely,<br><strong>Library Management</strong></p>
            </td>
        </tr>
    </table>
</body>
</html>
