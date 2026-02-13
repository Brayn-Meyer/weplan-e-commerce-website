<?php
session_start();
include "includes/header.php";
include "includes/db.php";
include "includes/functions.php";

// Your existing PHP code remains unchanged
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
        $stmt->execute([$customerId, $bookingReference, $totalPrice, "Essential Travel"]);
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
            <p><strong>Package:</strong> Essential Travel</p>
            <p><strong>Booking Reference:</strong> <?= htmlspecialchars($bookingReference) ?></p>
        </div>
        <p style="text-align:center;">You can find a reference to your trip on the bookings page. 🙌</p>
        <a href="bookings.php" class="btn-main">Bookings</a>
        <a href="landingpage.php" class="btn-main">Back to Home Page</a>
    </section>
</body>
<?php include "includes/footer.php"; ?>
</html>
