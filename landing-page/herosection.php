<style>
    /* Add these base styles first */
    body, html {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }
    
    .hero-section {
        position: relative;
        background: #f1f5f9;
        overflow: hidden;
        height: 100vh;
        margin-bottom: 0;
        border-radius: 0;
    }
    
    .hero-background {
        position: absolute;
        inset: 0;
        z-index: 1;
    }
    
    .hero-background video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 1;
        transform-origin: center center;
        transition: transform 0.5s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: transform;
    }
    
    .hero-content {
        position: relative;
        max-width: 80rem;
        margin-left: auto;
        margin-right: auto;
        padding: 6rem 1rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        z-index: 3;
    }
    
    @media (min-width: 640px) {
        .hero-content {
            padding: 8rem 1.5rem;
        }
    }
    
    @media (min-width: 1024px) {
        .hero-content {
            padding: 8rem 2rem;
        }
    }
    
    .hero-text {
        text-align: center;
    }
    
    .hero-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1.5rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    @media (min-width: 640px) {
        .hero-title {
            font-size: 3.75rem;
        }
    }
    
    .hero-gradient-text {
        display: block;
        color: transparent;
        background-clip: text;
        background-image: linear-gradient(to right, #ec4899, #e11d48);
        text-shadow: none;
    }
    
    .hero-description {
        font-size: 1.25rem;
        color: #1f2937;
        margin-bottom: 2rem;
        max-width: 72rem;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.75;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        font-weight: 500;
    }
    
    .hero-buttons {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }
    
    .hero-button {
        display: inline-flex;
        align-items: center;
        padding: 1rem 2rem;
        background: linear-gradient(to right, #ec4899, #e11d48);
        color: white;
        font-weight: 600;
        border-radius: 9999px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        text-decoration: none;
    }
    
    .hero-button.review-button {
        padding: 0.75rem 1.5rem;
        font-size: 0.9rem;
    }
    
    .hero-button:hover {
        background: linear-gradient(to right, #db2777, #be185d);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        transform: translateY(-0.25rem);
    }
    
    .hero-button-icon {
        width: 1.25rem;
        height: 1.25rem;
        margin-left: 0.5rem;
    }
</style>

<section id="home" class="hero-section">
    <div class="hero-background">
        <video autoplay muted loop playsinline oncanplay="this.playbackRate=1.5">
            <source src="plane.mp4" type="video/mp4">
            <img src="fallback-image.jpg" alt="Travel background">
        </video>
    </div>
    
    <div class="hero-content">
        <div class="hero-text">
            <h1 class="hero-title">
                Your Journey
                <span class="hero-gradient-text">Starts Here</span>
            </h1>
            <p class="hero-description">
                YOU DREAM IT, WE BOOK IT
            </p>
            <div class="hero-buttons">
                <a href="#packages" class="hero-button">
                    Explore Packages
                    <svg class="hero-button-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"/>
                        <path d="m12 5 7 7-7 7"/>
                    </svg>
                </a>
                <a href="review.php" class="hero-button review-button">
                    Review Us
                    <svg class="hero-button-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"/>
                        <path d="m12 5 7 7-7 7"/>
                    </svg>
                </a>
                    <a href="bookings.php" class="hero-button review-button">
                    Past Flights
                    <svg class="hero-button-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"/>
                        <path d="m12 5 7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.querySelector('.hero-background video');
            const maxScale = 1.3; // Maximum zoom level (30% zoom in)
            const scrollIntensity = 0.0005; // Controls how fast the zoom happens
            
            function updateVideoScale() {
                const scrollY = window.scrollY;
                // Calculate scale - increases as you scroll down, but never goes below 1
                const scale = 1 + Math.min(scrollY * scrollIntensity, maxScale - 1);
                video.style.transform = `scale(${scale})`;
            }
            
            // Add scroll event listener
            window.addEventListener('scroll', updateVideoScale);
            
            // Initialize
            updateVideoScale();
        });
    </script>
</section>