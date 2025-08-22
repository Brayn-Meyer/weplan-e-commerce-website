<?php
session_start();

// Optional: You can clear the review data from the session after displaying it
$review = $_SESSION['review'] ?? null;
$user = $_SESSION['current_user'] ?? null;

// If no review data, redirect to the form
if (!$review || !$user) {
    header("Location: review.php");
    exit;
}

// Clear the review from session so refreshing won't re-show it
unset($_SESSION['review']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Submitted</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Paste the style block from bookings.php here */
        body {
            background: linear-gradient(135deg, #f9fafb 0%, #f1f5f9 100%);
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            color: #22223b;
            margin: 0;
            padding: 0;
        }
        .booking-section {
            padding: 5rem 0;
            background: linear-gradient(135deg, #f9fafb 0%, #f1f5f9 100%);
        }
        .review-summary {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            max-width: 600px;
            margin: 2rem auto;
        }
        h1 {
            text-align: center;
            margin-top: 3rem;
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
        }
    </style>
</head>
<body>
    <section class="booking-section">
        <h1>✅ Thank you for your review, <span><?= htmlspecialchars($user['first_name']) ?></span>!</h1>
        <div class="review-summary">
            <p><strong>Package:</strong> <?= htmlspecialchars($review['package']) ?></p>
            <p><strong>Rating:</strong> <?= str_repeat('⭐', $review['rating']) ?></p>
            <p><strong>Title:</strong> <?= htmlspecialchars($review['title']) ?></p>
            <p><strong>Review:</strong><br><?= nl2br(htmlspecialchars($review['review'])) ?></p>
        </div>
        <p style="text-align:center;">Your feedback helps us improve our service. 🙌</p>
        <a href="review.php" class="btn-main">Back to Reviews</a>
    </section>
</body>
</html>
