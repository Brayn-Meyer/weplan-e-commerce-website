<?php
// Process customer info if coming from previous page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $_SESSION['customer'] = [
        'firstName' => $_POST['firstName'],
        'lastName' => $_POST['lastName'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone']
    ];
}
?>

<!-- <div class="booking-steps">
    <div class="step completed">
        <span>1</span>
        <p>Customer Info</p>
    </div>
    <div class="step active">
        <span>2</span>
        <p>Flights</p>
    </div>
    <div class="step">
        <span>3</span>
        <p>Accommodation</p>
    </div>
    <div class="step">
        <span>4</span>
        <p>Adventures</p>
    </div>
    <div class="step">
        <span>5</span>
        <p>Transport</p>
    </div>
</div> -->

<h2 class="mb-4">Flight Booking</h2>
<form action="accommodations.php" method="post">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="departureLocation" class="form-label">Departure Location</label>
            <input type="text" class="form-control" id="departureLocation" name="departureLocation" required>
        </div>
        <div class="col-md-6">
            <label for="arrivalLocation" class="form-label">Arrival Location</label>
            <input type="text" class="form-control" id="arrivalLocation" name="arrivalLocation" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="departureDate" class="form-label">Departure Date</label>
            <input type="date" class="form-control" id="departureDate" name="departureDate" required>
        </div>
        <div class="col-md-6">
            <label for="returnDate" class="form-label">Return Date</label>
            <input type="date" class="form-control" id="returnDate" name="returnDate" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="tickets" class="form-label">Number of Tickets</label>
            <input type="number" class="form-control" id="tickets" name="tickets" min="1" required>
        </div>
        <div class="col-md-6">
            <label for="flightPrice" class="form-label">Price per Ticket ($)</label>
            <input type="number" class="form-control" id="flightPrice" name="flightPrice" min="0" step="0.01" required>
        </div>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-between">
        <a href="booking-process.php" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Next: Accommodation</button>
    </div>
</form>

<?php
// Process flight info if coming from previous page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $_SESSION['flight'] = [
        'departureLocation' => $_POST['departureLocation'],
        'arrivalLocation' => $_POST['arrivalLocation'],
        'departureDate' => $_POST['departureDate'],
        'returnDate' => $_POST['returnDate'],
        'tickets' => $_POST['tickets'],
        'flightPrice' => $_POST['flightPrice']
    ];
}
?>