<?php
session_start();
include "includes/db.php";

$contact = $_SESSION['contact'] ?? null;
$user = $_SESSION['current_user'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save contact data from POST to session
    $_SESSION['contact'] = [
        'title' => $_POST['title'] ?? null,
        'message' => $_POST['message'] ?? null
    ];

    // Refresh $contact so it has the new values
    $contact = $_SESSION['contact'];

    if (!empty($contact['title']) && !empty($contact['message']) && !empty($user)) {
        // Insert contact into database
        $stmt = $pdo->prepare(
            "INSERT INTO contacts (user_id, title, message) 
                VALUES (?, ?, ?)"
        );
        $stmt->execute([
            $user['user_id'],
            $contact['title'],
            $contact['message']
        ]);
    }

    // After processing, redirect to confirmation page
    header("Location: contact_confirmation.php");
    exit;
} else {
    // If accessed directly, redirect back to booking form
    header("Location: landingpage.php");
    exit;
}