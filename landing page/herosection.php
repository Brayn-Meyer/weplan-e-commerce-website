<style>
    .hero-section {
        position: relative;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        overflow: hidden;
    }
    
    .hero-background {
        position: absolute;
        inset: 0;
    }
    
    .hero-background img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.5; /* Changed from 0.2 to 0.5 for more visibility */
    }
    
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(253, 242, 248, 0.3) 0%, rgba(239, 246, 255, 0.3) 100%);
    }
    
    .hero-content {
        position: relative;
        max-width: 80rem;
        margin-left: auto;
        margin-right: auto;
        padding: 6rem 1rem;
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
    }
    
    .hero-description {
        font-size: 1.25rem;
        color: #4b5563;
        margin-bottom: 2rem;
        max-width: 72rem;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.75;
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
        <img src="pexels.jpg" alt="Airplane in the sky">
        <div class="hero-overlay"></div>
    </div>
    
    <div class="hero-content">
        <div class="hero-text">
            <h1 class="hero-title">
                Your Journey
                <span class="hero-gradient-text">Starts Here</span>
            </h1>
            <p class="hero-description">
                Experience the world with WePlan. We create unforgettable travel experiences 
                tailored to your dreams, from luxury flights to premium accommodations and 
                exciting adventures.
            </p>
            <a href="#packages" class="hero-button">
                Explore Packages
                <svg class="hero-button-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/>
                    <path d="m12 5 7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>