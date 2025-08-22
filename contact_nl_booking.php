<?php
session_start();
include "includes/db.php";

$contact = $_SESSION['contact_no_login'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save flight data from POST to session
    $_SESSION['contact_no_login'] = [
        'name' => $_POST['name'] ?? null,
        'email' => $_POST['email'] ?? null,
        'title' => $_POST['title'] ?? null,
        'message' => $_POST['message'] ?? null
    ];

    if (!empty($_SESSION['contact_no_login'])) {
        // Insert contact into database
        $stmt = $pdo->prepare(
            "INSERT INTO contacts_no_account (name, email, title, message) 
                VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([
            $_SESSION['contact_no_login']['name'],
            $_SESSION['contact_no_login']['email'],
            $_SESSION['contact_no_login']['title'],
            $_SESSION['contact_no_login']['message']
        ]);
    }

    // After processing, redirect to confirmation page
    header("Location: contact_nl_confirmation.php");
    exit;
} else {
    // If accessed directly, redirect back to booking form
    header("Location: landingpage.php");
    exit;
}
?>