<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.6.2/dist/dotlottie-wc.js" type="module"></script>
    <style>
        /* PRELOADER STYLES (NOW MASSIVE) */
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #ffffff 0%, #f9f9f9 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            font-family: 'Arial', sans-serif;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.5s;
        }

        .loader-container.show {
            opacity: 1;
            pointer-events: all;
        }

        .lottie-container {
            width: 900px;
            height: 900px;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        .logo-loader {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
            height: auto;
        }

        .letter {
            font-size: 9rem;
            font-weight: 800;
            background: linear-gradient(to right, #db2777, #e11d48);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            opacity: 0;
            transform: translateY(120px);
            animation: letterPopUp 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            text-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Letter delays */
        .letter:nth-child(1) { animation-delay: 1.0s; }
        .letter:nth-child(2) { animation-delay: 1.6s; }
        .letter:nth-child(3) { animation-delay: 2.2s; }
        .letter:nth-child(4) { animation-delay: 2.8s; }
        .letter:nth-child(5) { animation-delay: 3.4s; }
        .letter:nth-child(6) { animation-delay: 4.0s; }

        @keyframes fadeIn {
            0% { opacity: 0; transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }

        @keyframes letterPopUp {
            0% { opacity: 0; transform: translateY(120px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Hide content until loader finishes */
        body > *:not(.loader-container) {
            opacity: 0;
            transition: opacity 0.5s;
        }
        body.loaded > *:not(.loader-container) {
            opacity: 1;
        }
    </style>
</head>
<body>
    <!-- Loader will be shown conditionally -->
    <div class="loader-container" id="loaderContainer">
        <div class="lottie-container">
            <dotlottie-wc 
                src="https://lottie.host/08156d16-c685-4501-aed9-c7ba76e42d22/AxuIlbOcEi.lottie" 
                style="width: 100%; height: 100%" 
                speed="1" 
                autoplay 
                loop>
            </dotlottie-wc>
        </div>
        <div class="logo-loader">
            <div class="letter">W</div>
            <div class="letter">e</div>
            <div class="letter">P</div>
            <div class="letter">l</div>
            <div class="letter">a</div>
            <div class="letter">n</div>
        </div>
    </div>

    <?php
        include "includes/header.php";
        include "landing-page/herosection.php";
        include "landing-page/packages.php";
        include "landing-page/aboutsection.php";
        include "includes/footer.php";
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check navigation type and first visit status
            const navigationEntries = performance.getEntriesByType("navigation");
            const isReload = navigationEntries.length > 0 && navigationEntries[0].type === "reload";
            const isFirstVisit = sessionStorage.getItem('visited') !== 'true';
            
            // Show loader if it's a reload or first visit
            if (isReload || isFirstVisit) {
                const loader = document.getElementById('loaderContainer');
                loader.classList.add('show');
                
                // Hide loader after 5s
                setTimeout(function() {
                    loader.style.opacity = '0';
                    loader.style.transform = 'scale(0.9)';
                    loader.style.transition = 'all 0.5s ease-out';
                    document.body.classList.add('loaded');
                    
                    setTimeout(function() {
                        loader.style.display = 'none';
                    }, 500);
                    
                    // Set flag so loader won't show again during this session
                    sessionStorage.setItem('visited', 'true');
                }, 5000);
            } else {
                // If not a refresh, show content immediately
                document.body.classList.add('loaded');
            }
            
            // Clear the flag when clicking external links
            document.querySelectorAll('a[href^="http"]:not([href*="'+window.location.hostname+'"])').forEach(link => {
                link.addEventListener('click', function() {
                    sessionStorage.removeItem('visited');
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>