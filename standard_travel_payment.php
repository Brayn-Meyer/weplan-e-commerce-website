<?php
session_start();
include "includes/header.php";
include "includes/db.php";
include "includes/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flightPrice = $_POST['flightPrice'];
    $accommodationPrice = $_POST['accommodationPrice'];;
    $adventurePrice = $_POST['adventurePrice'];;
    $transportPrice = $_POST['transportPrice'];;
    $totalPrice = $_POST['totalPrice'];;
    $bookingReference = $_POST['bookingReference'];;
    
    try {
        $pdo->beginTransaction();
        $customerId = $_SESSION['customer_id'];
        
        // Insert booking
        $stmt = $pdo->prepare("INSERT INTO bookings (customer_id, booking_reference, total_price, package) VALUES (?, ?, ?, ?)");
        $stmt->execute([$customerId, $bookingReference, $totalPrice, "Standard Travel"]);
        $bookingId = $pdo->lastInsertId();
        
        // Insert flight if available
        if (isset($_SESSION['flight'])) {
            $f = $_SESSION['flight'];
            $stmt = $pdo->prepare("INSERT INTO flights (booking_id, seat_type, departure_location, arrival_location, departure_date, return_date, tickets, flight_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $bookingId,
                $f['seatType'] ?? null,
                $f['departureLocation'] ?? null,
                $f['arrivalLocation'] ?? null,
                $f['departureDate'] ?? null,
                $f['returnDate'] ?? null,
                $f['tickets'] ?? null,
                $flightPrice ?? null
            ]);
        }

        // Insert accommodation if available
        if (isset($_SESSION['accommodation'])) {
            $a = $_SESSION['accommodation'];
            $stmt = $pdo->prepare("INSERT INTO accommodations (
                booking_id, type, bedrooms, guests, has_wifi, has_kitchen, has_pool, 
                has_living_room, has_parking, has_gym, has_spa, has_balcony, 
                check_in, check_out, preferences, price
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $bookingId,
                $a['type'] ?? null,
                $a['bedrooms'] ?? null,
                $a['guests'] ?? null,
                $a['hasWifi'] ?? 0,
                $a['hasKitchen'] ?? 0,
                $a['hasPool'] ?? 0,
                $a['hasLivingRoom'] ?? 0,
                $a['hasParking'] ?? 0,
                $a['hasGym'] ?? 0,
                $a['hasSpa'] ?? 0,
                $a['hasBalcony'] ?? 0,
                $a['checkIn'] ?? null,
                $a['checkOut'] ?? null,
                $a['preferences'] ?? null,
                $a['accommodationPrice'] ?? 0,
            ]);
        }

        $stmt = $pdo->prepare("INSERT INTO card_details (
            booking_id, payment_type, card_holder, card_number, expiry_date, cvv
        ) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $bookingId,
            $_POST['cardType'],
            $_POST['cardholder'],
            $_POST['cardnumber'],
            $_POST['expiry'],
            $_POST['cvv']
        ]);
        
        $pdo->commit();
        
    } catch (Exception $e) {
        $pdo->rollBack();
        die("Error saving booking: " . $e->getMessage());
    }
}
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
        .thanks {
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
        <h1 class="thanks">✅ Thank you for booking a trip with us! </h1>
        <div class="review-summary">
            <p><strong>Package:</strong> Standard Travel</p>
            <p><strong>Booking Reference:</strong> <?= htmlspecialchars($bookingReference) ?></p>
        </div>
        <p style="text-align:center;">You can find a reference to your trip on the bookings page. 🙌</p>
        <a href="bookings.php" class="btn-main">Bookings</a>
        <a href="landingpage.php" class="btn-main">Back to Home Page</a>
    </section>
</body>
<?php include "includes/footer.php"; ?>
</html>
