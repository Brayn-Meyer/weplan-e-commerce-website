<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save flight data from POST to session
    $_SESSION['flight'] = [
        'seatType' => $_POST['seatType'] ?? null,
        'departureLocation' => $_POST['departureLocation'] ?? null,
        'arrivalLocation' => $_POST['arrivalLocation'] ?? null,
        'departureDate' => $_POST['departureDate'] ?? null,
        'returnDate' => $_POST['returnDate'] ?? null,
        'tickets' => (int)($_POST['tickets'] ?? 1),
        'flightPrice' => (float)($_POST['flightPrice'] ?? 0),
    ];

    // After processing, redirect to confirmation page
    header("Location: confirmation.php");
    exit;
} else {
    // If accessed directly, redirect back to booking form
    header("Location: essential_travel.php");
    exit;
}
?>