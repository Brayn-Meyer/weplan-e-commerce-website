<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WePlan - Travel Agency Footer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
        }
        
        .content {
            flex: 1;
            padding: 2rem 0;
        }
        
        .footer-container {
            position: relative;
            overflow: hidden;
            margin-top: 2rem;
        }
        
        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            opacity: 0.7;
        }
        
        .footer-overlay {
            position: relative;
            background: linear-gradient(135deg, rgba(255, 56, 92, 0.85) 0%, rgba(255, 90, 140, 0.85) 100%);
            color: #fff;
            padding: 2.5rem 0 1.5rem;
            z-index: 1;
        }
        
        .footer-brand {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .footer-tagline {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            margin-bottom: 1.2rem;
        }
        
        .footer-heading {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            position: relative;
        }
        
        .footer-heading:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 30px;
            height: 2px;
            background: rgba(255, 255, 255, 0.7);
        }
        
        .footer-link {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .footer-link:hover {
            color: #fff;
            transform: translateX(3px);
        }
        
        .footer-address {
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.6;
            font-size: 0.95rem;
        }
        
        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        
        .social-icon:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px);
        }
        
        .footer-divider {
            background: rgba(255, 255, 255, 0.2);
            margin: 1.5rem 0 1rem;
        }
        
        .footer-copyright {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin: 0;
        }
        
        .video-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #ff385c 0%, #ff5a8c 100%);
            color: white;
            font-size: 1.2rem;
            z-index: 0;
        }
        
        @media (max-width: 768px) {
            .footer-heading:after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .footer-content {
                text-align: center;
                margin-bottom: 1.5rem;
            }
            
            .social-links {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
   

    <div class="footer-container">
        <!-- Animated video background -->
        <video autoplay loop muted playsinline class="video-background">
            <source src="https://assets.mixkit.co/videos/preview/mixkit-traveling-by-car-on-a-tree-lined-road-38700-large.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        
        <!-- Fallback in case video doesn't load -->
        <div class="video-placeholder">
            <div class="text-center">
                <i class="fas fa-plane-departure fa-3x mb-3"></i>
                <p>Travel the world with WePlan</p>
            </div>
        </div>
        
        <div class="footer-overlay">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                        <h5 class="footer-brand">WePlan</h5>
                        <p class="footer-tagline">Your one-stop solution for all travel needs.</p>
                        <div class="social-links">
                            <a href="https://www.instagram.com/weplan_travels?igsh=aXV0aHFqZGljMWRn&utm_source=qr" class="social-icon" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="mailto:info@weplan.com" class="social-icon">
                                <i class="far fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3 mb-4 mb-md-0">
                        <h5 class="footer-heading">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="landingpage.php" class="footer-link">Home</a></li>
                            <li><a href="bookings.php" class="footer-link">Your Bookings</a></li>
                            <li><a href="contact.php" class="footer-link">Contact Us</a></li>
                            <li><a href="terms.php" class="footer-link">Terms & Conditions</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-3">
                        <h5 class="footer-heading">Contact</h5>
                        <address class="footer-address">
                            <i class="far fa-envelope me-2"></i> info@weplan.com<br>
                            <i class="fas fa-phone me-2"></i> +1 (123) 456-7890
                        </address>
                    </div>
                </div>
                <hr class="footer-divider">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="footer-copyright">&copy; 2025 WePlan. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>