<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions - WePlan Travel Agency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(to right, #ec4899, #e11d48);
            --primary-color: #ec4899;
            --dark-color: #111827;
            --light-color: #f8f9fa;
            --gray-color: #4b5563;
            --light-bg: #f5f7fa;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--dark-color);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        
        .main-content {
            flex: 1;
            position: relative;
            z-index: 1;
        }
        
        .navbar {
            background: var(--primary-gradient);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: white !important;
            transform: translateY(-1px);
        }
        
        .terms-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        
        .terms-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #e5e7eb;
            position: relative;
        }
        
        .terms-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--primary-gradient);
            border-radius: 3px;
        }
        
        .terms-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .terms-title span {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .last-updated {
            color: var(--gray-color);
            font-size: 0.9rem;
        }
        
        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .terms-content {
            color: var(--gray-color);
            font-size: 0.95rem;
        }
        
        .terms-content p {
            margin-bottom: 1rem;
        }
        
        .terms-content ul {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .terms-content li {
            margin-bottom: 0.5rem;
            position: relative;
        }
        
        .terms-content li::before {
            content: '•';
            color: var(--primary-color);
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
        
        .highlight {
            background: linear-gradient(120deg, rgba(236, 72, 153, 0.1) 0%, rgba(225, 29, 72, 0.1) 100%);
            padding: 1.25rem;
            border-left: 4px solid var(--primary-color);
            border-radius: 0 8px 8px 0;
            margin: 1.5rem 0;
            font-size: 0.9rem;
            position: relative;
            overflow: hidden;
        }
        
        .highlight::before {
            content: '\f06a';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 1.5rem;
            color: rgba(236, 72, 153, 0.2);
            z-index: 0;
        }
        
        .highlight p {
            position: relative;
            z-index: 1;
            margin: 0;
        }
        
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--primary-gradient);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            z-index: 1000;
            opacity: 0.9;
        }
        
        .back-to-top:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            color: white;
            opacity: 1;
        }
        
        .toc-container {
            background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            border: 1px solid rgba(236, 72, 153, 0.2);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .toc-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .toc-list {
            list-style-type: none;
            padding-left: 0;
        }
        
        .toc-list li {
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(236, 72, 153, 0.1);
            transition: all 0.2s ease;
        }
        
        .toc-list li:hover {
            border-color: var(--primary-color);
        }
        
        .toc-list li:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .toc-list a {
            color: var(--dark-color);
            text-decoration: none;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            padding: 0.25rem 0;
        }
        
        .toc-list a:hover {
            color: var(--primary-color);
            transform: translateX(5px);
        }
        
        .toc-list a i {
            font-size: 0.8rem;
            color: var(--primary-color);
            transition: transform 0.3s ease;
        }
        
        .toc-list a:hover i {
            transform: rotate(90deg);
        }
        
        .contact-box {
            background: linear-gradient(135deg, #fdf2f8 0%, #fff1f2 100%);
            padding: 1.5rem;
            border-radius: 12px;
            margin-top: 2.5rem;
            border: 1px solid rgba(236, 72, 153, 0.2);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }
        
        .contact-box::before {
            content: '\f0e0';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 3rem;
            color: rgba(236, 72, 153, 0.1);
            z-index: 0;
        }
        
        .contact-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            z-index: 1;
        }
        
        .contact-info {
            position: relative;
            z-index: 1;
        }
        
        .contact-info ul {
            list-style: none;
            padding-left: 0;
        }
        
        .contact-info li {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .contact-info i {
            width: 20px;
            color: var(--primary-color);
        }
        
        .icon-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            background: var(--primary-gradient);
            color: white;
            border-radius: 50%;
            margin-right: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .terms-title {
                font-size: 2rem;
            }
            
            .terms-container {
                padding: 1.5rem;
            }
            
            .toc-container {
                padding: 1.25rem;
            }
            
            .section-title {
                font-size: 1.25rem;
            }
        }
        
        /* Animation for section titles */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        section {
            animation: fadeIn 0.5s ease forwards;
        }
        
        /* Stagger the animations */
        section:nth-child(1) { animation-delay: 0.1s; }
        section:nth-child(2) { animation-delay: 0.2s; }
        section:nth-child(3) { animation-delay: 0.3s; }
        section:nth-child(4) { animation-delay: 0.4s; }
        section:nth-child(5) { animation-delay: 0.5s; }
        section:nth-child(6) { animation-delay: 0.6s; }
        section:nth-child(7) { animation-delay: 0.7s; }
        section:nth-child(8) { animation-delay: 0.8s; }
    </style>
</head>
<body>
    <!-- Background Image -->
    <img src="aero.jpg" 
         alt="Background" 
         class="background-image">

    <!-- Header -->
    <?php include 'includes/header.php'; ?>

    <div class="main-content">
        <!-- Terms and Conditions Content -->
        <div class="container py-5">
            <div class="terms-container">
                <div class="terms-header">
                    <h1 class="terms-title">Terms and <span>Conditions</span></h1>
                    <p class="last-updated">Last updated: January 2024</p>
                </div>
                
                <div class="toc-container">
                    <h3 class="toc-title"><i class="fas fa-list"></i> Table of Contents</h3>
                    <ul class="toc-list">
                        <li><a href="#section1"><i class="fas fa-chevron-right"></i> Introduction</a></li>
                        <li><a href="#section2"><i class="fas fa-chevron-right"></i> Booking Process</a></li>
                        <li><a href="#section3"><i class="fas fa-chevron-right"></i> Payments & Cancellations</a></li>
                        <li><a href="#section4"><i class="fas fa-chevron-right"></i> Travel Documents</a></li>
                        <li><a href="#section5"><i class="fas fa-chevron-right"></i> Changes & Refunds</a></li>
                        <li><a href="#section6"><i class="fas fa-chevron-right"></i> Liability</a></li>
                        <li><a href="#section7"><i class="fas fa-chevron-right"></i> Privacy Policy</a></li>
                        <li><a href="#section8"><i class="fas fa-chevron-right"></i> Governing Law</a></li>
                    </ul>
                </div>
                
                <div class="terms-content">
                    <section id="section1">
                        <h3 class="section-title"><span class="icon-badge"><i class="fas fa-info"></i></span> Introduction</h3>
                        <p>Welcome to WePlan Travel Agency. These Terms and Conditions govern your use of our services and website. By accessing or using our services, you agree to be bound by these Terms and Conditions.</p>
                        <p>WePlan Travel Agency acts as an intermediary between you and various travel service providers including airlines, hotels, car rental companies, and tour operators. We are not responsible for the actions or omissions of these third-party providers.</p>
                    </section>
                    
                    <section id="section2">
                        <h3 class="section-title"><span class="icon-badge"><i class="fas fa-calendar-check"></i></span> Booking Process</h3>
                        <p>All bookings are subject to availability and acceptance by the service provider. When you make a booking, you guarantee that you have the legal authority to accept and do accept on behalf of your party the terms of these booking conditions.</p>
                        <p>To secure your booking, a deposit may be required. The amount will vary depending on the arrangements you wish to book. Full payment is required at the time of booking for certain arrangements or within a specified period before departure.</p>
                        <div class="highlight">
                            <p><strong><i class="fas fa-exclamation-circle"></i> Important:</strong> It is your responsibility to check all travel documents, including dates, times, and destinations, immediately upon receipt. Please contact us immediately if any details are incorrect.</p>
                        </div>
                    </section>
                    
                    <section id="section3">
                        <h3 class="section-title"><span class="icon-badge"><i class="fas fa-credit-card"></i></span> Payments & Cancellations</h3>
                        <p>Payment for your travel arrangements can be made by credit card, debit card, or bank transfer. All payments are processed securely.</p>
                        <p>Cancellation policies vary by service provider. Generally, cancellation fees will apply, and these increase as the departure date approaches. Some service providers may have strict cancellation policies allowing no refunds under any circumstances.</p>
                        <p>We strongly recommend purchasing comprehensive travel insurance that includes cancellation coverage to protect yourself against unforeseen circumstances.</p>
                    </section>
                    
                    <section id="section4">
                        <h3 class="section-title"><span class="icon-badge"><i class="fas fa-passport"></i></span> Travel Documents</h3>
                        <p>It is your responsibility to ensure that you have all necessary travel documents, including passports, visas, and health certificates, that meet the requirements of the countries you are visiting.</p>
                        <p>WePlan Travel Agency can provide general information about passport and visa requirements, but we are not responsible for providing specific guidance. You should verify requirements with the relevant embassies or consulates.</p>
                    </section>
                    
                    <section id="section5">
                        <h3 class="section-title"><span class="icon-badge"><i class="fas fa-exchange-alt"></i></span> Changes & Refunds</h3>
                        <p>If you wish to change any aspect of your booking after our confirmation invoice has been issued, we will do our best to make the change, but it may not always be possible. Any changes requested may be subject to additional charges.</p>
                        <p>Refunds for unused services are not made unless agreed upon in writing by the service provider. No refunds will be made for lost travel time or substitution of facilities.</p>
                    </section>
                    
                    <section id="section6">
                        <h3 class="section-title"><span class="icon-badge"><i class="fas fa-balance-scale"></i></span> Liability</h3>
                        <p>WePlan Travel Agency acts as a booking agent only and does not own or operate any transportation vehicle, hotel, restaurant, or other service provider. We are not responsible for any injury, loss, or damage to person or property resulting from acts of God, weather, strikes, or any other cause beyond our direct control.</p>
                        <p>Our maximum liability to you for any successful claim against us arising from our negligence (but not for personal injury or death) is limited to twice the cost of the relevant booking.</p>
                    </section>
                    
                    <section id="section7">
                        <h3 class="section-title"><span class="icon-badge"><i class="fas fa-shield-alt"></i></span> Privacy Policy</h3>
                        <p>We are committed to protecting your privacy. We collect personal information to process your bookings and to provide you with the best possible service. Your information may be shared with relevant third-party providers to fulfill your travel arrangements.</p>
                        <p>We will not sell or rent your personal information to third parties for marketing purposes without your explicit consent. For more details, please see our full Privacy Policy.</p>
                    </section>
                    
                    <section id="section8">
                        <h3 class="section-title"><span class="icon-badge"><i class="fas fa-gavel"></i></span> Governing Law</h3>
                        <p>These Terms and Conditions and any agreements we enter into with you are governed by and construed in accordance with the laws of the country in which our company is registered.</p>
                        <p>Any dispute arising from these Terms and Conditions or your use of our services shall be subject to the exclusive jurisdiction of the courts of that country.</p>
                    </section>
                    
                    <div class="contact-box">
                        <h4 class="contact-title"><i class="fas fa-question-circle"></i> Contact Us</h4>
                        <div class="contact-info">
                            <p>If you have any questions about these Terms and Conditions, please contact us:</p>
                            <ul>
                                <li><i class="fas fa-envelope"></i> legal@weplan.com</li>
                                <li><i class="fas fa-phone"></i> +1 (123) 456-7890</li>
                                <li><i class="fas fa-map-marker-alt"></i> 123 Travel Street, Adventure City, 10001</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <a href="#" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script>
        // Back to top button functionality
        document.querySelector('.back-to-top').addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({top: 0, behavior: 'smooth'});
        });
        
        // Show/hide back to top button based on scroll position
        window.addEventListener('scroll', function() {
            const backToTop = document.querySelector('.back-to-top');
            if (window.pageYOffset > 300) {
                backToTop.style.display = 'flex';
            } else {
                backToTop.style.display = 'none';
            }
        });
        
        // Smooth scrolling for table of contents links
        document.querySelectorAll('.toc-list a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });
                
                // Update URL hash without jumping
                history.pushState(null, null, targetId);
            });
        });
        
        // Add animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('section');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            sections.forEach(section => {
                section.style.animationPlayState = 'paused';
                observer.observe(section);
            });
        });
    </script>
</body>
</html>