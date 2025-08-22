<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WePlan Travel - Contacts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Pasted styles from review-section, but adapted to contact.php */
        .header {
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid #f3f4f6;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .contact-section {
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

        .contact-card {
            background: white;
            width: 50%;
            border-radius: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 3rem;
            margin-left: 3rem;
        }

        .contact-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 60vh;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .feature-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .feature-input, textarea.feature-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        .feature-input:focus {
            outline: none;
            border-color: #3b82f6;
        }
        textarea.feature-input {
            min-height: 150px;
            resize: vertical;
        }

        .submitBtn {
            display: block;
            width: 100%;
            padding: 1rem;
            border-radius: 1rem;
            font-weight: 600;
            color: white;
            background: linear-gradient(to right, #ec4899, #f43f5e);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            font-size: 1rem;
        }
        .submitBtn:hover {
            background: linear-gradient(to right, #db2777, #e11d48);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <?php
        include "includes/header.php";
        include "includes/db.php";
    ?>
    <section id="contact" class="contact-section">
        <div class="section-header">
            <h2 class="section-title">Contact <span>WePlan</span></h2>
            <p class="section-description">
                We're passionate about creating extraordinary travel experiences that go beyond expectations. 
                Our expert team crafts personalized journeys that capture the essence of adventure.
            </p>
        </div>
        
        <div class="contact-container">
            <div class="contact-card">
                <h3 class="form-title">Contact Information</h3>
                <?php if (isset($_SESSION['current_user'])): ?>
                    <?php
                        $u = $_SESSION['current_user'];
                        echo "<p class='feature-description'>You are currently sending a message as " . 
                            htmlspecialchars($u['first_name'] . " " . $u['last_name']) . 
                            ", and your current email is " . $u['email'] . ".</p>";
                    ?>
                    <form action="contact_booking.php" method="post">
                        <label for="title" class="feature-label">Your current issue:</label>
                        <input required name="title" type="text" class="feature-input">
                        
                        <label for="message" class="feature-label">Detailed description of your issue:</label>
                        <textarea required name="message" class="feature-input"></textarea>
                        
                        <button type="submit" class="submitBtn">Send Review</button>
                    </form>
                <?php else: ?>
                    <form action="contact_nl_booking.php" method="post">
                        <p class="feature-description">Please enter all required information.</p>
                        
                        <label for="name" class="feature-label">Your Name:</label>
                        <input required name="name" type="text" class="feature-input">
                        
                        <label for="email" class="feature-label">Your Email:</label>
                        <input required name="email" type="email" class="feature-input">
                        
                        <label for="title" class="feature-label">Your current issue:</label>
                        <input required name="title" type="text" class="feature-input">
                        
                        <label for="message" class="feature-label">Detailed description of your issue:</label>
                        <textarea required name="message" class="feature-input"></textarea>
                        
                        <button type="submit" class="submitBtn">Send Review</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php include "includes/footer.php"; ?>
</body>
</html>
