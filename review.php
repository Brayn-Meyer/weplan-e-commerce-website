<?php
session_start();
$pageTitle = "WePlan Travel - Reviews";
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
        .review-section {
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
        
        .reviews-container {
            max-width: 72rem;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        /* Review form styling */
        .review-form {
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
        
        /* Submit button - matches package booking buttons */
        .submit-button {
            display: block;
            width: 100%;
            padding: 1rem;
            border-radius: 1rem;
            font-weight: 600;
            color: white;
            text-align: center;
            background: linear-gradient(to right, #ec4899, #f43f5e);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            font-size: 1rem;
        }
        
        .submit-button:hover {
            background: linear-gradient(to right, #db2777, #e11d48);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
        }
        
        /* Existing reviews styling */
        .reviews-list {
            display: grid;
            gap: 1.5rem;
        }
        
        .review-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }
        
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .reviewer-name {
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.25rem;
        }
        
        .review-date {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .review-stars {
            color: #f59e0b;
            font-size: 1.25rem;
        }
        
        .review-content {
            color: #4b5563;
            line-height: 1.6;
        }
        
        /* Responsive adjustments */
        @media (min-width: 768px) {
            .review-form {
                padding: 2.5rem;
            }
            
            .reviews-list {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body>
    <?php 
        include "includes/header.php"; 
        include "includes/db.php"
    ?>
    
    <section class="review-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Share Your <span>Experience</span></h2>
                <p class="section-description">We value your feedback! Let us know how we did and help other travelers make their decision.</p>
            </div>
            
            <div class="reviews-container">
                <!-- Review Form -->
                <form class="review-form" action="review_booking.php" id="reviewForm" method="post">
                    <h3 class="form-title">Write a Review</h3>
                    
                    <!-- <div class="form-group">
                        <label for="reviewerName" class="form-label">Your Name</label>
                        <input type="text" id="reviewerName" class="form-input" required>
                    </div> -->
                    
                    <div class="form-group">
                        <label for="packageSelect" class="form-label">Package You Booked</label>
                        <select name="package" id="packageSelect" class="form-input" required>
                            <option value="" disabled selected>Select a package</option>
                            <option value="Essential Travel">Essential Travel</option>
                            <option value="Standard Travel">Standard Travel</option>
                            <option value="Premium Experience">Premium Experience</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <div class="rating-container">
                            <span class="rating-label">Your Rating:</span>
                            <div class="star-rating">
                                <input type="radio" id="star5" name="rating" value="5" required>
                                <label for="star5" title="5 stars">★</label>
                                <input type="radio" id="star4" name="rating" value="4">
                                <label for="star4" title="4 stars">★</label>
                                <input type="radio" id="star3" name="rating" value="3">
                                <label for="star3" title="3 stars">★</label>
                                <input type="radio" id="star2" name="rating" value="2">
                                <label for="star2" title="2 stars">★</label>
                                <input type="radio" id="star1" name="rating" value="1">
                                <label for="star1" title="1 star">★</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="reviewTitle" class="form-label">Review Title</label>
                        <input name="title" type="text" id="reviewTitle" class="form-input" required placeholder="Summarize your experience">
                    </div>
                    
                    <div class="form-group">
                        <label for="reviewContent" class="form-label">Your Review</label>
                        <textarea name="review" id="reviewContent" class="form-input form-textarea" required placeholder="Tell us about your experience... What did you like? What could we improve?"></textarea>
                    </div>
                    
                    <button type="submit" class="submit-button">Submit Review</button>
                </form>
                
                <!-- Existing Reviews -->
                <h3 class="section-title" style="text-align: left; margin-bottom: 1.5rem;">Customer Reviews</h3>
                
                <div class="reviews-list">
                    <!-- Review 1 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div>
                                <div class="reviewer-name">Sarah Johnson</div>
                                <div class="review-date">March 15, 2025</div>
                            </div>
                            <div class="review-stars">★★★★★</div>
                        </div>
                        <div class="review-content">
                            <strong>Amazing Premium Experience!</strong><br>
                            The premium package was worth every penny. The luxury accommodations were stunning, and the adventure activities were perfectly organized. The concierge service made everything so easy - they even got us last-minute reservations at a fully booked restaurant!
                        </div>
                    </div>
                    
                    <!-- Review 2 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div>
                                <div class="reviewer-name">Michael Brown</div>
                                <div class="review-date">February 28, 2025</div>
                            </div>
                            <div class="review-stars">★★★★☆</div>
                        </div>
                        <div class="review-content">
                            <strong>Great standard package</strong><br>
                            We had a wonderful time with the standard package. The hotels were comfortable and well-located. Airport transfers were punctual. Only reason for 4 stars instead of 5 is that one of our selected activities was canceled last minute without a good alternative.
                        </div>
                    </div>
                    
                    <!-- Review 3 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div>
                                <div class="reviewer-name">Emily Chen</div>
                                <div class="review-date">January 10, 2025</div>
                            </div>
                            <div class="review-stars">★★★★★</div>
                        </div>
                        <div class="review-content">
                            <strong>Perfect honeymoon</strong><br>
                            We booked the premium package for our honeymoon and it exceeded all expectations. Every detail was taken care of, from rose petals in our room to private tours. The vehicle rental was seamless. Will definitely use WePlan again for our next big trip!
                        </div>
                    </div>
                    
                    <!-- Review 4 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div>
                                <div class="reviewer-name">David Wilson</div>
                                <div class="review-date">December 5, 2024</div>
                            </div>
                            <div class="review-stars">★★★☆☆</div>
                        </div>
                        <div class="review-content">
                            <strong>Good but some hiccups</strong><br>
                            The essential package was good value for money. Flight seat selection worked well and customer support was responsive. However, our travel dates had to be changed last minute and there was some confusion with the new itinerary.
                        </div>
                    </div>

                    <?php
                        $reviews = $pdo->prepare("
                            SELECT 
                                customers.first_name, 
                                customers.last_name,  
                                reviews.review_date, 
                                reviews.rating AS review_rating, 
                                reviews.title, 
                                reviews.review 
                            FROM customers 
                            INNER JOIN reviews ON customers.id = reviews.user_id
                        ");

                        $reviews->execute();
                        $allReviews = $reviews->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($allReviews as $review) {
                            // Format the review date nicely
                            $formattedDate = date("F j, Y", strtotime($review['review_date']));
                            
                            // Generate stars (example: 5 stars max)
                            $stars = str_repeat("★", $review['review_rating']) . str_repeat("☆", 5 - $review['review_rating']);
                            
                            echo "<div class='review-card'>
                                    <div class='review-header'>
                                        <div>
                                            <div class='reviewer-name'>" . htmlspecialchars($review['first_name'] . " " . $review['last_name']) . "</div>
                                            <div class='review-date'>$formattedDate</div>
                                        </div>
                                        <div class='review-stars'>$stars</div>
                                    </div>
                                    <div class='review-content'>
                                        <strong>" . htmlspecialchars($review['title']) . "</strong><br>
                                        " . nl2br(htmlspecialchars($review['review'])) . "
                                    </div>
                                </div>";
                        }
                    ?>

                </div>
            </div>
        </div>
    </section>
    
    <?php include "includes/footer.php"; ?>
    
    <script>
        // // Form submission handling
        // document.getElementById('reviewForm').addEventListener('submit', function(e) {
        //     // e.preventDefault();
            
        //     // Get form values
        //     // const name = document.getElementById('reviewerName').value;
        //     const package = document.getElementById('packageSelect').value;
        //     const rating = document.querySelector('input[name="rating"]:checked').value;
        //     const title = document.getElementById('reviewTitle').value;
        //     const content = document.getElementById('reviewContent').value;
            
        //     // In a real application, you would send this data to your server
        //     console.log('Review submitted:', { package, rating, title, content });
            
        //     // Show success message
        //     alert('Thank you for your review! Your feedback is valuable to us.');
            
        //     // Reset form
        //     // this.reset();
        // });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>