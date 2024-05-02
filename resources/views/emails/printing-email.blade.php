<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your File is Being Printed</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <div class="max-w-xl mx-auto p-8 bg-white rounded shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Your File is Being Printed</h1>
        <p class="mb-4">Dear {{ $studentName }},</p>
        <p class="mb-4">We are currently processing your request to print the file titled "{{ $file_name }}". Our team is working diligently to ensure your document is printed with the utmost care and quality.</p>
        <p class="mb-4">We appreciate your patience as we complete this process. Rest assured, we will notify you as soon as your print job is ready for pickup or delivery.</p>
        <p class="mb-8">If you have any questions or concerns, please don't hesitate to contact our support team at [Support Email] or call us at [Support Phone Number].</p>
        <p>Thank you for choosing us for your printing needs.</p>
        <p>Sincerely,<br> TechLibrary</p>
    </div>
</body>
</html>
