<?php
session_start();
include "includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save review data from POST to session
    $_SESSION['review'] = [
        'package' => $_POST['package'] ?? '',
        'rating'  => isset($_POST['rating']) ? (int)$_POST['rating'] : 0,
        'title'   => $_POST['title'] ?? '',
        'review'  => $_POST['review'] ?? ''
    ];

    if (!empty($_SESSION['review']) && !empty($_SESSION['current_user'])) {
        $r = $_SESSION['review'];
        $u = $_SESSION['current_user'];

        // Insert review into database
        $stmt = $pdo->prepare(
            "INSERT INTO reviews (user_id, package, rating, title, review) 
                VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $u['user_id'],
            $r['package'],
            $r['rating'],
            $r['title'],
            $r['review']
        ]);
    }

    // Redirect to confirmation page
    header("Location: review_confirmation.php");
    exit;
} else {
    // If accessed directly, redirect back to booking form
    header("Location: review.php");
    exit;
}
