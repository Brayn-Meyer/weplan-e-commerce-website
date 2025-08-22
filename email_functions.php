<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class EmailSystem {
    private $pdo;
    private $mail;

    public function __construct($pdo) {
        $this->pdo = $pdo;

        $this->mail = new PHPMailer(true);

        try {
            //Server settings
            $this->mail->SMTPDebug = 0; // 0 = off, 2 = verbose debug output
            $this->mail->isSMTP();
            $this->mail->Host       = 'smtp.gmail.com';  // Use your SMTP server
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = 'zakariadavids7@gmail.com';      // Your Gmail
            $this->mail->Password   = 'saavxzlgzspbxepi';    // Gmail App Password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $this->mail->Port       = 465;

            $this->mail->setFrom('zakariadavids7@gmail.com', 'WePlan Travel');
        } catch (Exception $e) {
            error_log("Mailer setup error: " . $e->getMessage());
        }
    }

    public function sendWelcomeEmail($customer_id) {
        // Get customer info from DB
        $stmt = $this->pdo->prepare("SELECT first_name, email FROM customers WHERE id = ?");
        $stmt->execute([$customer_id]);
        $customer = $stmt->fetch();

        if (!$customer) {
            return false;
        }

        try {
            $this->mail->clearAddresses();
            $this->mail->clearAttachments();

            $this->mail->addAddress($customer['email'], $customer['first_name']);

            $this->mail->isHTML(true);
            $this->mail->Subject = 'Welcome to WePlan Travel!';
            
            // Enhanced HTML email template with Airbnb pink (#FF5A5F)
            $this->mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        line-height: 1.6;
                        color: #333;
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                    }
                    .header {
                        background-color: #FF5A5F;
                        color: white;
                        padding: 20px;
                        text-align: center;
                        border-radius: 5px 5px 0 0;
                    }
                    .content {
                        padding: 20px;
                        background-color: #f9f9f9;
                        border-radius: 0 0 5px 5px;
                    }
                    .footer {
                        margin-top: 20px;
                        padding-top: 20px;
                        border-top: 1px solid #eee;
                        font-size: 12px;
                        color: #777;
                    }
                    h1 {
                        color: #FF5A5F;
                        margin-top: 0;
                    }
                    .button {
                        display: inline-block;
                        padding: 10px 20px;
                        background-color: #FF5A5F;
                        color: white;
                        text-decoration: none;
                        border-radius: 4px;
                        margin: 15px 0;
                    }
                </style>
            </head>
            <body>
                <div class="header">
                    <h1>WePlan Travel</h1>
                </div>
                <div class="content">
                    <h2>Hi ' . htmlspecialchars($customer['first_name']) . ',</h2>
                    <p>Welcome to WePlan Travel! We\'re thrilled to have you join our community of travelers.</p>
                    <p>With WePlan Travel, you can discover amazing destinations, plan your perfect trip, and create unforgettable memories.</p>
                    <p>If you have any questions or need assistance, don\'t hesitate to reply to this email.</p>
                    <a href="#" class="button">Start Exploring</a>
                    <p>Happy travels,</p>
                    <p><strong>The WePlan Travel Team</strong></p>
                </div>
                <div class="footer">
                    <p>© ' . date('Y') . ' WePlan Travel. All rights reserved.</p>
                    <p>If you didn\'t sign up for this account, please ignore this email.</p>
                </div>
            </body>
            </html>';

            $this->mail->AltBody = "Hi " . $customer['first_name'] . ",\n\nWelcome to WePlan Travel! We're thrilled to have you join our community of travelers.\n\nWith WePlan Travel, you can discover amazing destinations, plan your perfect trip, and create unforgettable memories.\n\nIf you have any questions or need assistance, don't hesitate to reply to this email.\n\nHappy travels,\nThe WePlan Travel Team";

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log('Mailer Error: ' . $this->mail->ErrorInfo);
            return false;
        }
    }

public function sendBookingConfirmation($customer_id, $booking_details) {
    // Get customer info from DB
    $stmt = $this->pdo->prepare("SELECT first_name, email FROM customers WHERE id = ?");
    $stmt->execute([$customer_id]);
    $customer = $stmt->fetch();

    if (!$customer) {
        return false;
    }

    try {
        $this->mail->clearAddresses();
        $this->mail->clearAttachments();

        $this->mail->addAddress($customer['email'], $customer['first_name']);

        $this->mail->isHTML(true);
        $this->mail->Subject = 'Your WePlan Travel Booking Confirmation #' . $booking_details['booking_reference'];
        
        // Prepare flight details if available
        $flightDetails = '';
        if (!empty($booking_details['flight_details'])) {
            $f = $booking_details['flight_details'];
            $flightDetails = '
            <div style="margin: 20px 0; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                <h3 style="color: #FF5A5F; margin-top: 0;">Flight Details</h3>
                <p><strong>Route:</strong> ' . htmlspecialchars($f['departureLocation'] ?? '') . ' to ' . htmlspecialchars($f['arrivalLocation'] ?? '') . '</p>
                <p><strong>Departure:</strong> ' . (isset($f['departureDate']) ? date('M j, Y', strtotime($f['departureDate'])) : '') . '</p>
                <p><strong>Return:</strong> ' . (isset($f['returnDate']) ? date('M j, Y', strtotime($f['returnDate'])) : '') . '</p>
                <p><strong>Passengers:</strong> ' . ($f['tickets'] ?? '') . ' ticket(s)</p>
            </div>';
        }
        
        // Prepare accommodation details if available
        $accommodationDetails = '';
        if (!empty($booking_details['accommodation_details'])) {
            $a = $booking_details['accommodation_details'];
            $accommodationDetails = '
            <div style="margin: 20px 0; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                <h3 style="color: #FF5A5F; margin-top: 0;">Accommodation Details</h3>
                <p><strong>Type:</strong> ' . htmlspecialchars($a['type'] ?? '') . '</p>
                <p><strong>Bedrooms:</strong> ' . ($a['bedrooms'] ?? '') . '</p>
                <p><strong>Guests:</strong> ' . ($a['guests'] ?? '') . '</p>
                <p><strong>Check-in:</strong> ' . (isset($a['checkIn']) ? date('M j, Y', strtotime($a['checkIn'])) : '') . '</p>
                <p><strong>Check-out:</strong> ' . (isset($a['checkOut']) ? date('M j, Y', strtotime($a['checkOut'])) : '') . '</p>
            </div>';
        }
        
        // Prepare adventure details if available
        $adventureDetails = '';
        if (!empty($booking_details['adventure_details'])) {
            $adventureDetails = '
            <div style="margin: 20px 0; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                <h3 style="color: #FF5A5F; margin-top: 0;">Adventure Activities</h3>';
            
            foreach ($booking_details['adventure_details'] as $adv) {
                $adventureDetails .= '
                <p><strong>' . htmlspecialchars($adv['type'] ?? '') . ':</strong> ' . 
                (isset($adv['date']) ? date('M j, Y', strtotime($adv['date'])) : '') . 
                ' for ' . ($adv['participants'] ?? 1) . ' participant(s)</p>';
            }
            
            $adventureDetails .= '</div>';
        }
        
        // Prepare transport details if available
        $transportDetails = '';
        if (!empty($booking_details['transport_details'])) {
            $t = $booking_details['transport_details'];
            $transportDetails = '
            <div style="margin: 20px 0; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                <h3 style="color: #FF5A5F; margin-top: 0;">Transport Details</h3>
                <p><strong>Vehicle Type:</strong> ' . htmlspecialchars($t['vehicleType'] ?? '') . '</p>
                <p><strong>Pickup Date:</strong> ' . (isset($t['pickupDate']) ? date('M j, Y', strtotime($t['pickupDate'])) : '') . '</p>
                <p><strong>Drop-off Date:</strong> ' . (isset($t['dropoffDate']) ? date('M j, Y', strtotime($t['dropoffDate'])) : '') . '</p>
            </div>';
        }
        
        // Enhanced HTML email template for booking confirmation
        $this->mail->Body = '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    color: #333;
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                }
                .header {
                    background-color: #FF5A5F;
                    color: white;
                    padding: 20px;
                    text-align: center;
                    border-radius: 5px 5px 0 0;
                }
                .content {
                    padding: 20px;
                    background-color: #f9f9f9;
                    border-radius: 0 0 5px 5px;
                }
                .footer {
                    margin-top: 20px;
                    padding-top: 20px;
                    border-top: 1px solid #eee;
                    font-size: 12px;
                    color: #777;
                }
                h1 {
                    color: #FF5A5F;
                    margin-top: 0;
                }
                .button {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #FF5A5F;
                    color: white;
                    text-decoration: none;
                    border-radius: 4px;
                    margin: 15px 0;
                }
                .booking-ref {
                    font-size: 18px;
                    font-weight: bold;
                    color: #FF5A5F;
                    margin: 10px 0;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>WePlan Travel</h1>
            </div>
            <div class="content">
                <h2>Hi ' . htmlspecialchars($customer['first_name']) . ',</h2>
                <p>Thank you for booking with WePlan Travel! Your booking has been confirmed.</p>
                
                <div style="background: white; padding: 15px; border-radius: 8px; margin: 20px 0;">
                    <h3 style="color: #FF5A5F; margin-top: 0;">Booking Summary</h3>
                    <p><strong>Booking Reference:</strong></p>
                    <div class="booking-ref">' . htmlspecialchars($booking_details['booking_reference']) . '</div>
                    <p><strong>Package:</strong> ' . htmlspecialchars($booking_details['package']) . '</p>
                    <p><strong>Total Amount:</strong> R' . number_format($booking_details['total_price'], 2) . '</p>
                </div>
                
                ' . $flightDetails . '
                ' . $accommodationDetails . '
                ' . $adventureDetails . '
                ' . $transportDetails . '
                
                <p>You can view your booking details anytime by visiting your account.</p>
                <a href="#" class="button">View My Bookings</a>
                <p>If you have any questions, please reply to this email.</p>
                <p>Happy travels,</p>
                <p><strong>The WePlan Travel Team</strong></p>
            </div>
            <div class="footer">
                <p>© ' . date('Y') . ' WePlan Travel. All rights reserved.</p>
            </div>
        </body>
        </html>';

        $this->mail->AltBody = "Hi " . $customer['first_name'] . ",\n\nThank you for booking with WePlan Travel! Your booking has been confirmed.\n\nBooking Reference: " . $booking_details['booking_reference'] . "\nPackage: " . $booking_details['package'] . "\nTotal Amount: R" . number_format($booking_details['total_price'], 2) . "\n\nYou can view your booking details anytime by visiting your account.\n\nIf you have any questions, please reply to this email.\n\nHappy travels,\nThe WePlan Travel Team";

        $this->mail->send();
        return true;
    } catch (Exception $e) {
        error_log('Mailer Error: ' . $this->mail->ErrorInfo);
        return false;
    }
}
}