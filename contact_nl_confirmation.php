<?php
session_start();

// Optional: You can clear the contact data from the session after displaying it
$contact = $_SESSION['contact_no_login'] ?? null;

// If no contact data, redirect to the form
if (!$contact) {
    header("Location: landingpage.php");
    exit;
}

// Clear the contact from session so refreshing won't re-show it
unset($_SESSION['contact_no_login']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Submitted</title>
    <style>
        body {
            background: linear-gradient(135deg, #f9fafb 0%, #f1f5f9 100%);
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            color: #22223b;
            margin: 0;
            padding: 0;
        }
        .booking-section {
            padding: 5rem 0;
            background: linear-gradient(135deg, #dadadae8 0%, #fffffffe 100%);
        }
        .contact-summary {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            padding: 2rem;
            max-width: 600px;
            margin: 2rem auto;
        }
        h1 {
            text-align: center;
            margin-top: 3rem;
            font-size: 2.25rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 1rem;
        }
        span {
            color: #ec4899;
        }
        .btn-main {
            display: block;
            width: 100%;
            max-width: 300px;
            margin: 2rem auto;
            padding: 1rem;
            border-radius: 1rem;
            font-weight: 600;
            color: white;
            text-align: center;
            background: linear-gradient(to right, #ec4899, #f43f5e);
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            text-decoration: none;
        }
        .btn-main:hover {
            background: linear-gradient(to right, #db2777, #e11d48);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
        }
        .contact-summary p {
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        .contact-summary strong {
            color: #111827;
        }
    </style>
</head>
<body>
    <section class="booking-section">
        <h1>✅ Thank you for submitting your issue, <span><?= htmlspecialchars($contact['name']) ?></span>!</h1>
        <div class="contact-summary">
            <p><strong>Issue:</strong> <?= htmlspecialchars($contact['title']) ?></p>
            <p><strong>Description of your issue:</strong> <?= htmlspecialchars($contact['message']) ?></p>
            <p>We will contact you via <?= htmlspecialchars($contact['email']) ?>, and get back to you as soon as the issue is resolved. Have a nice day.</p>
        </div>
        <p style="text-align:center;">Your feedback helps us improve our service. 🙌</p>
        <a href="landingpage.php" class="btn-main">Back to Home Page</a>
    </section>
</body>
</html>