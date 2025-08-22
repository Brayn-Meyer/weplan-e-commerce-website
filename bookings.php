<?php
    session_start();
    $pageTitle = "WePlan Travel - Bookings";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Reuse header styles from header.php */
        .header {
            background-color: white;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid #f3f4f6;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        
        /* Reuse packages section styling */
        .booking-section {
            padding: 5rem 0;
            background: linear-gradient(135deg, #f9fafb 0%, #f1f5f9 100%);
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }
        
        .section-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 1rem;
        }
        
        .section-title span {
            color: #ec4899;
        }
        
        .section-description {
            font-size: 1.125rem;
            color: #4b5563;
            max-width: 42rem;
            margin: 0 auto;
        }
        
        .bookings-container {
            max-width: 72rem;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        /* booking form styling */
        .booking-form {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            padding: 2rem;
            margin-bottom: 3rem;
        }
        
        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
        }
        
        .form-textarea {
            min-height: 150px;
            resize: vertical;
        }
        
        /* Star rating styling */
        .rating-container {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .rating-label {
            margin-right: 1rem;
            font-weight: 500;
            color: #374151;
        }
        
        .star-rating {
            display: flex;
            direction: rtl; /* Right to left for better hover effect */
        }
        
        .star-rating input {
            display: none;
        }
        
        .star-rating label {
            color: #d1d5db;
            font-size: 2rem;
            padding: 0 0.2rem;
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f59e0b;
        }
        
        .star-rating input:checked + label {
            color: #f59e0b;
        }

        /* Existing bookings styling */
        .booking-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }
        
        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .bookinger-name {
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.25rem;
        }
        
        .booking-date {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .booking-stars {
            color: #f59e0b;
            font-size: 1.25rem;
        }
        
        .booking-content {
            background: white;
            color: #4b5563;
            line-height: 1.6;
            border-radius: 0 0 1rem 1rem; /* top-left, top-right, bottom-right, bottom-left */
        }
        
        /* Responsive adjustments */
        @media (min-width: 768px) {
            .booking-form {
                padding: 2.5rem;
            }
            
            .bookings-list {
                grid-template-columns: 1fr 1fr;
            }
        }
        .packages-section {
        padding: 5rem 0;
        background: linear-gradient(135deg, #dadadae8 0%, #f6f6f6fe 100%);
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 4rem;
    }
    
    .section-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1rem;
    }
    
    .section-title span {
        color: #ec4899;
    }
    
    .section-description {
        font-size: 1.125rem;
        color: #4b5563;
        max-width: 42rem;
        margin: 0 auto;
    }
    
    .packages-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        max-width: 72rem;
        margin: 0 auto;
    }
    
    @media (min-width: 1024px) {
        .packages-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    .package-card {
        background: white;
        border-radius: 1.5rem 1.5rem 0px 0px;
        /* box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); */
        overflow: hidden;
        transition: all 0.3s ease;
        transform: translateY(0);
    }
    
    .package-header {
        padding: 1.5rem;
        color: white;
        background: linear-gradient(to right, #3b82f6, #06b6d4);
    }
    
    .standard .package-header {
        background: linear-gradient(to right, #f59e0b, #d97706);
    }
    
    .premium .package-header {
        background: linear-gradient(to right, #ec4899, #f43f5e);
    }
    
    .package-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .package-name {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .package-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1rem;
    }
    
    .package-icon {
        width: 3rem;
        height: 3rem;
        color: rgba(255, 255, 255, 0.7);
    }
    
    .package-body {
        padding: 2rem;
    }
    
    .features-list {
        margin-bottom: 2rem;
    }
    
    .feature-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        color: #4b5563;
    }
    
    .feature-icon {
        width: 1.25rem;
        height: 1.25rem;
        margin-right: 0.75rem;
        color: #3b82f6;
    }
    
    .essential .feature-icon {
        color: #3b82f6;
    }

    .standard .feature-icon {
        color: #f59e0b;
    }
    
    .premium .feature-icon {
        color: #ec4899;
    }
    
    .feature-text {
        font-weight: 400;
    }
    
    .premium .feature-item:first-child .feature-text {
        font-weight: 500;
    }
    
    .price-container {
        text-align: center;
        margin-bottom: 1.5rem;
    }
    
    .price-text {
        font-size: 1.875rem;
        font-weight: 700;
        color: #111827;
    }
    
    .price-amount {
        color: #3b82f6;
    }
    
    .standard .price-amount {
        color: #f59e0b;
    }
    
    .premium .price-amount {
        color: #ec4899;
    }
    
    .book-button {
        display: block;
        width: 100%;
        padding: 1rem;
        border-radius: 1rem;
        font-weight: 600;
        color: white;
        text-align: center;
        background: linear-gradient(to right, #3b82f6, #06b6d4);
        transition: all 0.3s ease;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .book-button:hover {
        background: linear-gradient(to right, #1d4ed8, #0891b2);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        transform: translateY(-2px);
    }
    
    .standard .book-button {
        background: linear-gradient(to right, #f59e0b, #d97706);
    }
    
    .standard .book-button:hover {
        background: linear-gradient(to right, #d97706, #b45309);
    }
    
    .premium .book-button {
        background: linear-gradient(to right, #ec4899, #f43f5e);
    }
    
    .premium .book-button:hover {
        background: linear-gradient(to right, #db2777, #e11d48);
    }
    
    .popular-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: linear-gradient(to right, #ec4899, #f43f5e);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    
    </style>
</head>
<body>
    <?php 
        include "includes/header.php"; 
        include "includes/db.php";
    ?>
    
    <section class="booking-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">View Your <span>Bookings</span></h2>
                <p class="section-description">We value your feedback! Let us know how we did and help other travelers make their decision.</p>
            </div>

            <div class="bookings-container">
                <h2>Premium Packages</h2>
                <div class="bookings-list">
                    <?php
                    $customer_id = $_SESSION['customer_id'];

                    $premiumBookings = $pdo->prepare("
                        SELECT
                            b.booking_reference,
                            b.package,
                            b.total_price,
                            b.status,
                            b.created_at,

                            f.seat_type,
                            f.departure_location,
                            f.arrival_location,
                            f.departure_date,
                            f.return_date,
                            f.tickets,
                            f.flight_price,

                            a.type AS accommodation_type,
                            a.bedrooms,
                            a.guests,
                            a.has_wifi,
                            a.has_kitchen,
                            a.has_pool,
                            a.has_living_room,
                            a.has_parking,
                            a.has_gym,
                            a.has_spa,
                            a.has_balcony,
                            a.check_in,
                            a.check_out,
                            a.preferences,
                            a.price AS accommodation_price,

                            adv.type AS adventure_type,
                            adv.date AS adventure_date,
                            adv.price AS adventure_price,
                            adv.participants,

                            t.vehicle_type,
                            t.pickup_date,
                            t.dropoff_date,
                            t.price AS transport_price

                        FROM bookings AS b
                        INNER JOIN customers AS c 
                            ON b.customer_id = c.id
                        INNER JOIN flights AS f 
                            ON b.id = f.booking_id
                        INNER JOIN accommodations AS a 
                            ON b.id = a.booking_id
                        INNER JOIN adventures AS adv 
                            ON b.id = adv.booking_id
                        INNER JOIN transport AS t 
                            ON b.id = t.booking_id
                        WHERE b.customer_id = ? AND b.package = ?
                    ");

                    $premiumBookings->execute([$customer_id, "Premium Experience"]);
                    $allPremiumBookings = $premiumBookings->fetchAll(PDO::FETCH_ASSOC);

                    if (!empty($allPremiumBookings)) {
                        foreach ($allPremiumBookings as $booking) {
                            $formattedDate = date("F j, Y", strtotime($booking['created_at']));

                            echo "<div>
                                <div class='package-card premium'>
                                    <div class='package-header'>
                                        <div class='package-header-content'>
                                            <div>
                                                <h3 class='package-name'>Booking Reference: " . htmlspecialchars($booking['booking_reference']) . "</h3>
                                                <p class='package-subtitle'>Booked on: $formattedDate <br>
                                                </p>
                                            </div>
                                            <svg class='package-icon' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                                                <path d='m2 4 3 12h14l3-12-6 7-4-7-4 7-6-7zm3 16h14'/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class='booking-content package-body'>
                                    <h5>Flight Details</h5>
                                    <p>" . htmlspecialchars($booking['departure_location']) . " → " . htmlspecialchars($booking['arrival_location']) . "<br>
                                    Departure: " . htmlspecialchars($booking['departure_date']) . "<br>
                                    Return: " . htmlspecialchars($booking['return_date']) . "<br>
                                    Seat Type: " . htmlspecialchars($booking['seat_type']) . " | Tickets: " . htmlspecialchars($booking['tickets']) . "<br>
                                    Total Price: R" . htmlspecialchars($booking['flight_price']) . "</p>

                                    <h5>Accommodation</h5>
                                    <p>Type: " . htmlspecialchars($booking['accommodation_type']) . "<br>
                                    Bedrooms: " . htmlspecialchars($booking['bedrooms']) . " | Guests: " . htmlspecialchars($booking['guests']) . "<br>
                                    Check-in: " . htmlspecialchars($booking['check_in']) . "<br>
                                    Check-out: " . htmlspecialchars($booking['check_out']) . "<br>
                                    Price: R" . htmlspecialchars($booking['accommodation_price']) . "</p>

                                    <h5>Adventure</h5>
                                    <p>Type: " . htmlspecialchars($booking['adventure_type']) . "<br>
                                    Date: " . htmlspecialchars($booking['adventure_date']) . "<br>
                                    Participants: " . htmlspecialchars($booking['participants']) . "<br>
                                    Price: R" . htmlspecialchars($booking['adventure_price']) . "</p>

                                    <h5>Transport</h5>
                                    <p>Vehicle: " . htmlspecialchars($booking['vehicle_type']) . "<br>
                                    Pickup: " . htmlspecialchars($booking['pickup_date']) . "<br>
                                    Dropoff: " . htmlspecialchars($booking['dropoff_date']) . "<br>
                                    Price: R" . htmlspecialchars($booking['transport_price']) . "</p>

                                    <h5>Total Package Price</h5>
                                    <p><strong>R" . htmlspecialchars($booking['total_price']) . "</strong></p>
                                </div>
                            </div>
                            <br><br>";
                        }
                    } else {
                        echo "<p>No packages found. :C</p>";
                    }
                    ?>
                </div>
            </div>

            <div class="bookings-container">
                <h2>Standard Packages</h2>
                <div class="bookings-list">
                    <?php
                    $customer_id = $_SESSION['customer_id'];

                    $standardBookings = $pdo->prepare("
                        SELECT
                            b.booking_reference,
                            b.package,
                            b.total_price,
                            b.status,
                            b.created_at,

                            f.seat_type,
                            f.departure_location,
                            f.arrival_location,
                            f.departure_date,
                            f.return_date,
                            f.tickets,
                            f.flight_price,

                            a.type AS accommodation_type,
                            a.bedrooms,
                            a.guests,
                            a.has_wifi,
                            a.has_kitchen,
                            a.has_pool,
                            a.has_living_room,
                            a.has_parking,
                            a.has_gym,
                            a.has_spa,
                            a.has_balcony,
                            a.check_in,
                            a.check_out,
                            a.preferences,
                            a.price AS accommodation_price

                        FROM bookings AS b
                        INNER JOIN customers AS c 
                            ON b.customer_id = c.id
                        INNER JOIN flights AS f 
                            ON b.id = f.booking_id
                        INNER JOIN accommodations AS a 
                            ON b.id = a.booking_id
                        WHERE b.customer_id = ? AND b.package = ?
                    ");

                    $standardBookings->execute([$customer_id, "Standard Travel"]);
                    $allStandardBookings = $standardBookings->fetchAll(PDO::FETCH_ASSOC);

                    if (!empty($allStandardBookings)) {
                        foreach ($allStandardBookings as $booking) {
                            $formattedDate = date("F j, Y", strtotime($booking['created_at']));

                            echo "<div>
                                <div class='package-card standard'>
                                    <div class='package-header'>
                                        <div class='package-header-content'>
                                            <div>
                                                <h3 class='package-name'>Booking Reference: " . htmlspecialchars($booking['booking_reference']) . "</h3>
                                                <p class='package-subtitle'>Booked on: $formattedDate <br>
                                                </p>
                                            </div>
                                            <svg class='package-icon' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                                                <path d='M3 22h18M5 9v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9M5 9h14M5 9l3-6h8l3 6'/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class='booking-content package-body'>
                                    <h5>Flight Details</h5>
                                    <p>" . htmlspecialchars($booking['departure_location']) . " → " . htmlspecialchars($booking['arrival_location']) . "<br>
                                    Departure: " . htmlspecialchars($booking['departure_date']) . "<br>
                                    Return: " . htmlspecialchars($booking['return_date']) . "<br>
                                    Seat Type: " . htmlspecialchars($booking['seat_type']) . " | Tickets: " . htmlspecialchars($booking['tickets']) . "<br>
                                    Total Price: R" . htmlspecialchars($booking['flight_price']) . "</p>

                                    <h5>Accommodation</h5>
                                    <p>Type: " . htmlspecialchars($booking['accommodation_type']) . "<br>
                                    Bedrooms: " . htmlspecialchars($booking['bedrooms']) . " | Guests: " . htmlspecialchars($booking['guests']) . "<br>
                                    Check-in: " . htmlspecialchars($booking['check_in']) . "<br>
                                    Check-out: " . htmlspecialchars($booking['check_out']) . "<br>
                                    Price: R" . htmlspecialchars($booking['accommodation_price']) . "</p>

                                    <h5>Total Package Price</h5>
                                    <p><strong>R" . htmlspecialchars($booking['total_price']) . "</strong></p>
                                </div>
                            </div>
                            <br><br>";
                        }
                    } else {
                        echo "<p>No packages found. :C</p>";
                    }
                    ?>
                </div>
            </div>

            <div class="bookings-container">
                <h2>Essential Packages</h2>
                <div class="bookings-list">
                    <?php
                    $customer_id = $_SESSION['customer_id'];

                    $essentialBookings = $pdo->prepare("
                        SELECT
                            b.booking_reference,
                            b.package,
                            b.total_price,
                            b.status,
                            b.created_at,

                            f.seat_type,
                            f.departure_location,
                            f.arrival_location,
                            f.departure_date,
                            f.return_date,
                            f.tickets,
                            f.flight_price

                        FROM bookings AS b
                        INNER JOIN customers AS c 
                            ON b.customer_id = c.id
                        INNER JOIN flights AS f 
                            ON b.id = f.booking_id
                        WHERE b.customer_id = ? AND b.package = ?
                    ");

                    $essentialBookings->execute([$customer_id, "Essential Travel"]);
                    $allEssentialBookings = $essentialBookings->fetchAll(PDO::FETCH_ASSOC);

                    if (!empty($allEssentialBookings)) {
                        foreach ($allEssentialBookings as $booking) {
                            $formattedDate = date("F j, Y", strtotime($booking['created_at']));

                            echo "<div>
                                <div class='package-card essential'>
                                    <div class='package-header'>
                                        <div class='package-header-content'>
                                            <div>
                                                <h3 class='package-name'>Booking Reference: " . htmlspecialchars($booking['booking_reference']) . "</h3>
                                                <p class='package-subtitle'>Booked on: $formattedDate <br>
                                                </p>
                                            </div>
                                            <svg class='package-icon' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                                                <path d='M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z'/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class='booking-content package-body'>
                                    <h5>Flight Details</h5>
                                    <p>" . htmlspecialchars($booking['departure_location']) . " → " . htmlspecialchars($booking['arrival_location']) . "<br>
                                    Departure: " . htmlspecialchars($booking['departure_date']) . "<br>
                                    Return: " . htmlspecialchars($booking['return_date']) . "<br>
                                    Seat Type: " . htmlspecialchars($booking['seat_type']) . " | Tickets: " . htmlspecialchars($booking['tickets']) . "<br>
                                    Total Price: R" . htmlspecialchars($booking['flight_price']) . "</p>

                                    <h5>Total Package Price</h5>
                                    <p><strong>$" . htmlspecialchars($booking['total_price']) . "</strong></p>
                                </div>
                            </div>
                            <br><br>";
                        }
                    } else {
                        echo "<p>No packages found. :C</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php include "includes/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>