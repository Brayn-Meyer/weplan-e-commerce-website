<?php
session_start();

include "includes/header.php";
include "includes/db.php";
include "includes/functions.php";

// Use null coalescing and checks to prevent undefined index errors
$flightPrice = 0;
if (isset($_SESSION['flight']) && isset($_SESSION['flight']['flightPrice'], $_SESSION['flight']['tickets'])) {
    $flightPrice = $_SESSION['flight']['flightPrice'] * $_SESSION['flight']['tickets'];
}

$accommodationPrice = 0;
if (isset($_SESSION['accommodation'])) {
    $accom = $_SESSION['accommodation'];
    if (isset($accom['checkOut'], $accom['checkIn'], $accom['accommodationPrice'], $accom['rooms'])) {
        $accommodationNights = (strtotime($accom['checkOut']) - strtotime($accom['checkIn'])) / (60 * 60 * 24);
        $accommodationPrice = $accom['accommodationPrice'] * $accommodationNights * $accom['rooms'];
    }
}

$adventurePrice = 0;

$transportPrice = 0;

$totalPrice = calculateTotalPrice($flightPrice, $accommodationPrice, $adventurePrice, $transportPrice);
$bookingReference = generateBookingReference();

try {
    $pdo->beginTransaction();

    $customerId = $_SESSION['customer_id'];

    // Insert booking
    $stmt = $pdo->prepare("INSERT INTO bookings (customer_id, booking_reference, total_price) VALUES (?, ?, ?)");
    $stmt->execute([$customerId, $bookingReference, $totalPrice]);
    $bookingId = $pdo->lastInsertId();

    // Insert flight if available
    if (isset($_SESSION['flight'])) {
        $f = $_SESSION['flight'];
        $stmt = $pdo->prepare("INSERT INTO flights (booking_id, seat_type, departure_location, arrival_location, departure_date, return_date, tickets) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $bookingId,
            $f['seatType'] ?? null,
            $f['departureLocation'] ?? null,
            $f['arrivalLocation'] ?? null,
            $f['departureDate'] ?? null,
            $f['returnDate'] ?? null,
            $f['tickets'] ?? null
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

    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
    die("Error saving booking: " . $e->getMessage());
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 class="mb-4">Booking Confirmation</h2>
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Booking Successful!</h4>
        </div>
        <div class="card-body">
            <p class="lead">Thank you for your booking, <?php echo htmlspecialchars($_SESSION['customer']['firstName'] ?? 'Guest'); ?>!</p>
            <p>Your booking reference is: <strong><?php echo $bookingReference; ?></strong></p>
            <p>We've sent a confirmation email to <?php echo htmlspecialchars($_SESSION['customer']['email'] ?? 'your email'); ?>.</p>
        </div>
    </div>

    <div class="row">
        <?php if (isset($_SESSION['flight'])): 
            $f = $_SESSION['flight'];
        ?>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white"><h5>Flight Details</h5></div>
                <div class="card-body">
                    <p><strong>From:</strong> <?php echo htmlspecialchars($f['departureLocation'] ?? ''); ?></p>
                    <p><strong>To:</strong> <?php echo htmlspecialchars($f['arrivalLocation'] ?? ''); ?></p>
                    <p><strong>Departure:</strong> <?php echo isset($f['departureDate']) ? date('M j, Y', strtotime($f['departureDate'])) : ''; ?></p>
                    <p><strong>Return:</strong> <?php echo isset($f['returnDate']) ? date('M j, Y', strtotime($f['returnDate'])) : ''; ?></p>
                    <p><strong>Tickets:</strong> <?php echo $f['tickets'] ?? ''; ?></p>
                    <p><strong>Flight Cost:</strong> $<?php echo number_format($flightPrice, 2); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['accommodation'])): 
            $a = $_SESSION['accommodation'];
        ?>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white"><h5>Accommodation Details</h5></div>
                <div class="card-body">
                    <!-- <p><strong>Location:</strong> <?php // echo htmlspecialchars($a['location'] ?? ''); ?></p> -->
                    <p><strong>Check-in:</strong> <?php echo isset($a['checkIn']) ? date('M j, Y', strtotime($a['checkIn'])) : ''; ?></p>
                    <p><strong>Check-out:</strong> <?php echo isset($a['checkOut']) ? date('M j, Y', strtotime($a['checkOut'])) : ''; ?></p>
                    <p><strong>Guests:</strong> <?php echo $a['guests'] ?? ''; ?></p>
                    <p><strong>Amenities:</strong>
                        <?php
                            $amenities = [];
                            if (!empty($a['hasWifi']))       $amenities[] = 'WiFi';
                            if (!empty($a['hasKitchen']))    $amenities[] = 'Kitchen';
                            if (!empty($a['hasPool']))       $amenities[] = 'Pool';
                            if (!empty($a['hasLivingRoom'])) $amenities[] = 'Living Room';
                            if (!empty($a['hasParking']))    $amenities[] = 'Parking';
                            if (!empty($a['hasGym']))        $amenities[] = 'Gym';
                            if (!empty($a['hasSpa']))        $amenities[] = 'Spa';
                            if (!empty($a['hasBalcony']))    $amenities[] = 'Balcony';

                            echo implode(', ', $amenities);
                        ?>
                    </p>
                    <p><strong>Accommodation Cost:</strong> $<?php echo number_format($accommodationPrice, 2); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-info text-white"><h5>Payment Summary</h5></div>
                <div class="card-body">
                    <table class="table">
                        <tr><td>Flights:</td><td class="text-end">$<?php echo number_format($flightPrice, 2); ?></td></tr>
                        <tr><td>Accommodation:</td><td class="text-end">$<?php echo number_format($accommodationPrice, 2); ?></td></tr>
                        <tr class="table-active"><th>Total:</th><th class="text-end">$<?php echo number_format($totalPrice, 2); ?></th></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="d-grid gap-2">
        <a href="index.php" class="btn btn-success">Return to Homepage</a>
    </div>
</body>
<?php
    include "includes/footer.php"
?>
<?php
// Clean up session after confirmation
session_unset();
session_destroy();
?>
