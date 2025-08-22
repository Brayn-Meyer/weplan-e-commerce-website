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

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-info text-white"><h5>Payment Summary</h5></div>
                <div class="card-body">
                    <table class="table">
                        <tr><td>Flights:</td><td class="text-end">$<?php echo number_format($flightPrice, 2); ?></td></tr>
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
