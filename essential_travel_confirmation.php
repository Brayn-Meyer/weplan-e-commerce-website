
<?php
session_start();
include "includes/header.php";
include "includes/db.php";
include "includes/functions.php";


$flightPrice = 0;
if (isset($_SESSION['flight']) && isset($_SESSION['flight']['flight_price'], $_SESSION['flight']['tickets'])) {
    $flightPrice = $_SESSION['flight']['flight_price'] * $_SESSION['flight']['tickets'];
}
$accommodationPrice = 0;
$adventurePrice = 0;
$transportPrice = 0;
$totalPrice = calculateTotalPrice($flightPrice, $accommodationPrice, $adventurePrice, $transportPrice);
$bookingReference = generateBookingReference();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation | Essential Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        :root {
            --primary: #3a86ff;
            --primary-dark: #2563eb;
            --secondary: #ff006e;
            --light: #f8fafc;
            --dark: #1e293b;
            --success: #10b981;
            --border: #e2e8f0;
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        body {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        main {
            flex: 1;
            padding-top: 5rem; /* Added padding to account for fixed header */
        }
        
        .booking-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
  
        .success-alert {
            background: linear-gradient(135deg, var(--success) 0%, #0ca678 100%);
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: center;
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
        }
        
        .success-alert::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
        }
        
        .success-icon {
            font-size: 2.5rem;
            margin-bottom: 0.75rem;
            display: block;
        }
        
        .booking-card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }
        
        .booking-card:hover {
            transform: translateY(-3px);
        }
        
        .card-title {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--border);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .card-title i {
            color: var(--secondary);
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 0.6rem 0;
            border-bottom: 1px solid var(--border);
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            color: #64748b;
            font-weight: 500;
        }
        
        .detail-value {
            color: var(--dark);
            font-weight: 600;
        }
        
        .price-highlight {
            color: var(--secondary);
            font-weight: 700;
        }
        
        .payment-section {
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .payment-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .payment-header h2 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }
        
        .payment-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
        
        .payment-option {
            border: 2px solid var(--border);
            border-radius: 10px;
            padding: 0.75rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .payment-option:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        
        .payment-option input[type="radio"] {
            display: none;
        }
        
        .payment-option input[type="radio"]:checked + .option-content {
            border-color: var(--primary);
            background-color: rgba(58, 134, 255, 0.05);
        }
        
        .option-content {
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .option-icon {
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }
        
        .option-label {
            font-weight: 600;
            color: var(--dark);
            font-size: 0.9rem;
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.25rem 0;
            color: #94a3b8;
            font-weight: 500;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--border);
        }
        
        .divider::before {
            margin-right: 1rem;
        }
        
        .divider::after {
            margin-left: 1rem;
        }
        
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(58, 134, 255, 0.2);
            outline: none;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }
        
        .pay-button {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            font-size: 1rem;
            font-weight: 700;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 8px 15px -3px rgba(58, 134, 255, 0.4);
        }
        
        .pay-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px -3px rgba(58, 134, 255, 0.5);
        }
        
        .pay-button:active {
            transform: translateY(0);
        }
        
        .home-button {
            display: block;
            text-align: center;
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            width: 100%;
            max-width: 280px;
            margin: 0 auto;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .home-button:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px -3px rgba(58, 134, 255, 0.4);
        }
        
        .reference-badge {
            background: var(--primary);
            color: white;
            padding: 0.4rem 0.9rem;
            border-radius: 100px;
            font-weight: 700;
            font-size: 1rem;
            display: inline-block;
            margin: 0.4rem 0;
        }
        
        /* Logo text styling to match header */
        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(to right, #DB2777, #E11D48);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin: 0;
        }
        
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .payment-options {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .header h1 {
                font-size: 1.875rem;
            }
            
            .booking-container {
                padding: 1.5rem 1rem;
            }
        }
        
        @media (max-width: 480px) {
            .payment-options {
                grid-template-columns: 1fr;
            }
            
            .booking-card, .payment-section {
                padding: 1.25rem;
            }
            
            .success-alert {
                padding: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <?php include "includes/header.php"; ?>
    
    <main>
        <div class="booking-container">
           
            
            <div class="success-alert">
                <i class="success-icon fas fa-check-circle"></i>
                <h3>Thank you, <?= htmlspecialchars($_SESSION['user']['firstname'] ?? 'Guest'); ?>!</h3>
                <p>We've sent a confirmation email to <?= htmlspecialchars($_SESSION['user']['email'] ?? 'your email'); ?>.</p>
                <p>Your booking reference is:</p>
                <div class="reference-badge"><?= $bookingReference; ?></div>
            </div>

            <?php if (isset($_SESSION['flight'])): 
                $f = $_SESSION['flight'];
            ?>
            <div class="booking-card">
                <h3 class="card-title"><i class="fas fa-plane"></i> Flight Details</h3>
                <div class="detail-row">
                    <span class="detail-label">Route</span>
                    <span class="detail-value"><?= htmlspecialchars($f['departureLocation'] ?? ''); ?> to <?= htmlspecialchars($f['arrivalLocation'] ?? ''); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Departure</span>
                    <span class="detail-value"><?= isset($f['departureDate']) ? date('M j, Y', strtotime($f['departureDate'])) : ''; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Return</span>
                    <span class="detail-value"><?= isset($f['returnDate']) ? date('M j, Y', strtotime($f['returnDate'])) : ''; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Passengers</span>
                    <span class="detail-value"><?= $f['tickets'] ?? ''; ?> ticket(s)</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Flight Cost</span>
                    <span class="detail-value price-highlight">R<?= number_format($flightPrice, 2); ?></span>
                </div>
            </div>
            <?php endif; ?>

            <div class="payment-section">
                <div class="payment-header">
                    <h2>Complete Payment</h2>
                    <p>Secure your booking with a payment</p>
                </div>

                <form action="essential_travel_payment.php" method="post">
                    <?php
                        echo "
                            <input type='hidden' name='flightPrice' value='$flightPrice'>
                            <input type='hidden' name='accommodationPrice' value='$accommodationPrice'>
                            <input type='hidden' name='adventurePrice' value='$adventurePrice'>
                            <input type='hidden' name='transportPrice' value='$transportPrice'>
                            <input type='hidden' name='totalPrice' value='$totalPrice'>
                            <input type='hidden' name='bookingReference' value='$bookingReference'>
                        "
                    ?>
                    
                    <div class="payment-options">
                        <label class="payment-option">
                            <input type="radio" name="cardType" value="VISA" checked>
                            <div class="option-content">
                                <i class="option-icon fab fa-cc-visa"></i>
                                <div class="option-label">VISA</div>
                            </div>
                        </label>
                        
                        <label class="payment-option">
                            <input type="radio" name="cardType" value="American Express">
                            <div class="option-content">
                                <i class="option-icon fab fa-cc-amex"></i>
                                <div class="option-label">Amex</div>
                            </div>
                        </label>
                        
                        <label class="payment-option">
                            <input type="radio" name="cardType" value="Master Card">
                            <div class="option-content">
                                <i class="option-icon fab fa-cc-mastercard"></i>
                                <div class="option-label">Mastercard</div>
                            </div>
                        </label>
                        
                        <label class="payment-option">
                            <input type="radio" name="cardType" value="Debit Card">
                            <div class="option-content">
                                <i class="option-icon fas fa-credit-card"></i>
                                <div class="option-label">Debit Card</div>
                            </div>
                        </label>
                    </div>

                    <div class="divider">Or enter card details manually</div>

                    <div class="form-group">
                        <label class="form-label" for="cardholder">Cardholder Full Name</label>
                        <input class="form-control" id="cardholder" name="cardholder" type="text" placeholder="Enter your full name" autocomplete="cc-name" inputmode="text" pattern="[A-Za-z\s]+" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="cardnumber">Card Number</label>
                        <input class="form-control" id="cardnumber" name="cardnumber" type="text" placeholder="0000 0000 0000 0000" autocomplete="cc-number" inputmode="numeric" maxlength="19" oninput="formatCardNumber(this)" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="expiry">Expiry Date</label>
                            <input class="form-control" id="expiry" name="expiry" type="text" placeholder="MM/YY" autocomplete="cc-exp" inputmode="numeric" maxlength="5" oninput="formatExpiry(this)" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="cvv">CVV</label>
                            <input class="form-control" id="cvv" name="cvv" type="text" placeholder="CVV" autocomplete="cc-csc" inputmode="numeric" maxlength="4" oninput="digitsOnly(this)" required>
                        </div>
                    </div>

                    <button type="submit" class="pay-button">
                        <i class="fas fa-lock"></i>
                        Pay Securely R<?= number_format($totalPrice, 2) ?>
                    </button>
                </form>
            </div>

            <a href="landingpage.php" class="home-button">
                <i class="fas fa-home"></i> Return to Homepage
            </a>
        </div>
    </main>

<script>
// Allow only digits
function digitsOnly(el) {
    el.value = el.value.replace(/\D+/g, '');
}

// Format card number as '#### #### #### ####' and keep only digits
function formatCardNumber(el) {
    let digits = el.value.replace(/\D+/g, '').slice(0,19);
    // group every 4
    el.value = digits.replace(/(.{4})/g, '$1 ').trim();
}

// Format expiry as MM/YY
function formatExpiry(el) {
    let digits = el.value.replace(/\D+/g, '').slice(0,4);
    if (digits.length >= 3) {
        el.value = digits.slice(0,2) + '/' + digits.slice(2);
    } else {
        el.value = digits;
    }
}

// Add visual feedback for selected payment method
document.querySelectorAll('.payment-option input').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.option-content').forEach(content => {
            content.style.borderColor = 'transparent';
            content.style.backgroundColor = 'transparent';
        });
        
        if (this.checked) {
            this.parentElement.querySelector('.option-content').style.borderColor = '#3a86ff';
            this.parentElement.querySelector('.option-content').style.backgroundColor = 'rgba(58, 134, 255, 0.05)';
        }
    });
});

// Initialize selected payment method on load
window.addEventListener('DOMContentLoaded', function() {
    const selectedRadio = document.querySelector('.payment-option input:checked');
    if (selectedRadio) {
        selectedRadio.parentElement.querySelector('.option-content').style.borderColor = '#3a86ff';
        selectedRadio.parentElement.querySelector('.option-content').style.backgroundColor = 'rgba(58, 134, 255, 0.05)';
    }
});
</script>

</body>
<?php include "includes/footer.php"; ?>
</html>
