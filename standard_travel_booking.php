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
        'flight_price' => (int)($_POST['flight_price'] ?? 0),
    ];

    // Save accommodation data from POST to session
    $selectedAmenities = $_POST['amenities'] ?? [];
    $amenitiesFlags = [
        'hasWifi'       => in_array('wifi', $selectedAmenities) ? 1 : 0,
        'hasKitchen'    => in_array('kitchen', $selectedAmenities) ? 1 : 0,
        'hasPool'       => in_array('pool', $selectedAmenities) ? 1 : 0,
        'hasLivingRoom' => in_array('livingroom', $selectedAmenities) ? 1 : 0,
        'hasParking'    => in_array('parking', $selectedAmenities) ? 1 : 0,
        'hasGym'        => in_array('gym', $selectedAmenities) ? 1 : 0,
        'hasSpa'        => in_array('spa', $selectedAmenities) ? 1 : 0,
        'hasBalcony'    => in_array('balcony', $selectedAmenities) ? 1 : 0,
    ];
    
    $_SESSION['accommodation'] = [
        'type'              => $_POST['type'] ?? null,
        'bedrooms'          => $_POST['bedrooms'] ?? null,
        'guests'            => $_POST['guests'] ?? null,
    ] + $amenitiesFlags + [
        'hasWifi'           => $hasWifi,
        'hasKitchen'        => $hasKitchen,
        'hasPool'           => $hasPool,
        'hasLivingRoom'     => $hasLivingRoom,
        'hasParking'        => $hasParking,
        'hasGym'            => $hasGym,
        'hasSpa'            => $hasSpa,
        'hasBalcony'        => $hasBalcony,
        'checkIn'           => $_POST['checkIn'] ?? null,
        'checkOut'          => $_POST['checkOut'] ?? null,
        'accommodationPrice'=> $_POST['accommodationPrice'] ?? null,
        'preferences'       => $_POST['preferences'] ?? null,
    ];

    // After processing, redirect to confirmation page
    header("Location: standard_travel_confirmation.php");
    exit;
} else {
    // If accessed directly, redirect back to booking form
    header("Location: essential_travel.php");
    exit;
}
?>