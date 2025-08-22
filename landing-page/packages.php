<style>
    .packages-section {
        padding: 5rem 0;
        background: linear-gradient(135deg, #dadadae8 0%, #fffffffe 100%);
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
        gap: 2.5rem;
        max-width: 80rem;
        margin: 0 auto;
    }
    
    @media (min-width: 1024px) {
        .packages-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (min-width: 1280px) {
        .packages-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    .package-card {
        background: transparent;
        border-radius: 1.5rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        width: 100%;
        height: 580px; /* Increased height to fit content */
        perspective: 1000px;
        position: relative;
    }

    .package-content {
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
        transition: transform 0.6s;
        box-shadow: 0px 0px 20px 5px rgba(0, 0, 0, 0.1);
        border-radius: 1.5rem;
        position: relative;
        background: white; /* Added background for the content */
    }

    /* New animated border effect */
    .package-card::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        z-index: -1;
        border-radius: 1.6rem;
        background: linear-gradient(45deg, 
            #ff0000, #ff7300, #fffb00, #48ff00, 
            #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
        background-size: 400% 400%;
        animation: glowing-border 3s linear infinite;
        opacity: 1;
        transition: opacity 0.3s ease;
    }

    /* Different gradient for each package type */
    .essential.package-card::before {
        background: linear-gradient(45deg, 
            #3b82f6, #06b6d4, #3b82f6, #06b6d4,
            #3b82f6, #06b6d4, #3b82f6, #06b6d4);
        background-size: 400% 400%;
    }

    .standard.package-card::before {
        background: linear-gradient(45deg, 
            #f59e0b, #d97706, #f59e0b, #d97706,
            #f59e0b, #d97706, #f59e0b, #d97706);
        background-size: 400% 400%;
    }

    .premium.package-card::before {
        background: linear-gradient(45deg, 
            #ec4899, #f43f5e, #ec4899, #f43f5e,
            #ec4899, #f43f5e, #ec4899, #f43f5e);
        background-size: 400% 400%;
    }

    /* Hide the animated border when flipped */
    .package-card:hover .package-content {
        transform: rotateY(180deg);
    }
    
    .package-card:hover::before {
        opacity: 0;
    }

    @keyframes glowing-border {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    .package-front, .package-back {
        background-color: white;
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
        border-radius: 1.5rem;
        overflow: hidden;
    }
    
    .package-back {
        transform: rotateY(180deg);
        position: relative;
    }
    
    /* Front side styling (icon only) */
    .package-front {
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ed 100%);
    }
    
    .package-front-content {
        text-align: center;
        padding: 2rem;
        width: 100%;
    }
    
    .package-front-icon {
        width: 6rem;
        height: 6rem;
        margin: 0 auto 1.5rem;
        filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
    }
    
    .essential .package-front {
        background: linear-gradient(135deg, #f0f7ff 0%, #e0f2fe 100%);
    }
    
    .standard .package-front {
        background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
    }
    
    .premium .package-front {
        background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);
    }
    
    .essential .package-front-icon {
        color: #3b82f6;
    }
    
    .standard .package-front-icon {
        color: #f59e0b;
    }
    
    .premium .package-front-icon {
        color: #ec4899;
    }
    
    .package-front-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #111827;
    }
    
    .package-front-subtitle {
        font-size: 1rem;
        color: #4b5563;
        margin-bottom: 1.5rem;
    }
    
    .package-front-price {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 1.5rem;
    }
    
    .essential .package-front-price {
        color: #3b82f6;
    }
    
    .standard .package-front-price {
        color: #f59e0b;
    }
    
    .premium .package-front-price {
        color: #ec4899;
    }
    
    /* Back side styling */
    .package-header {
        padding: 1.5rem;
        color: white;
        background: linear-gradient(to right, #3b82f6, #06b6d4);
        position: relative;
        overflow: hidden;
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
        position: relative;
        z-index: 2;
    }
    
    .package-name {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .package-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
    }
    
    .package-icon {
        width: 3rem;
        height: 3rem;
        color: rgba(255, 255, 255, 0.9);
    }
    
    .package-body {
        padding: 1.5rem; /* Reduced padding */
        height: calc(100% - 88px);
        display: flex;
        flex-direction: column;
    }

    .features-list {
        margin-bottom: 1rem; /* Reduced margin */
        flex-grow: 1;
        overflow-y: auto;
        padding-right: 0.5rem;
        max-height: 280px; /* Added max-height to prevent overflow */
    }

    .feature-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem; /* Reduced margin */
        color: #4b5563;
        font-size: 0.95rem; /* Slightly smaller font */
    }

    .price-container {
        text-align: center;
        margin-bottom: 1rem; /* Reduced margin */
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
        border: none;
        cursor: pointer;
        font-size: 1rem;
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
        z-index: 10;
    }
</style>

<section id="packages" class="packages-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Choose Your <span>Adventure</span></h2>
            <p class="section-description">Select from our carefully curated travel packages designed to match every traveler's dream.</p>
        </div>

        <div class="packages-grid">
            <!-- Essential Package -->
            <div class="package-card essential">
                <div class="package-content">
                    <div class="package-front">
                        <div class="package-front-content">
                            <svg class="package-front-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
                            </svg>
                            <h3 class="package-front-title">Essential Travel</h3>
                            <p class="package-front-subtitle">Perfect for straightforward journeys</p>
                            <div class="package-front-price">From R8000</div>
                        </div>
                    </div>
                    
                    <div class="package-back">
                        <div class="package-header">
                            <div class="package-header-content">
                                <div>
                                    <h3 class="package-name">Essential Travel</h3>
                                    <p class="package-subtitle">Perfect for straightforward journeys</p>
                                </div>
                                <svg class="package-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="package-body">
                            <div class="features-list">
                                <div class="feature-item">
                                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                    <span class="feature-text">Flight seat selection</span>
                                </div>
                                <div class="feature-item">
                                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                    <span class="feature-text">Destination selection</span>
                                </div>
                                <div class="feature-item">
                                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                    <span class="feature-text">Travel date planning</span>
                                </div>
                                <div class="feature-item">
                                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                    <span class="feature-text">24/7 customer support</span>
                                </div>
                            </div>
                            
                            <div class="price-container">
                                <div class="price-text">Starting from <span class="price-amount">R8000</span></div>
                            </div>
                            <?php if (isset($_SESSION['user'])): ?>
                                <a href="/e-comm/essential_travel.php" class="book-button">Book Essential Package</a>
                            <?php else: ?>
                                <a href="login.php" class="book-button">Login to Book</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Standard Package -->
            <div class="package-card standard">
                <div class="package-content">
                    <div class="package-front">
                        <div class="package-front-content">
                            <svg class="package-front-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 22h18M5 9v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9M5 9h14M5 9l3-6h8l3 6"/>
                            </svg>
                            <h3 class="package-front-title">Standard Travel</h3>
                            <p class="package-front-subtitle">Comfortable flights with luxury stays</p>
                            <div class="package-front-price">From R12000</div>
                        </div>
                    </div>
                    
                    <div class="package-back">
                        <div class="package-header">
                            <div class="package-header-content">
                                <div>
                                    <h3 class="package-name">Standard Travel</h3>
                                    <p class="package-subtitle">Comfortable flights with luxury stays</p>
                                </div>
                                <svg class="package-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 22h18M5 9v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9M5 9h14M5 9l3-6h8l3 6"/>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="package-body">
                            <div class="features-list">
                                <div class="feature-item">
                                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                    <span class="feature-text">Everything in Essential Package</span>
                                </div>
                                <div class="feature-item">
                                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                    <span class="feature-text">Luxury accommodations</span>
                                </div>
                                <div class="feature-item">
                                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                    <span class="feature-text">Basic amenities</span>
                                </div>
                                <div class="feature-item">
                                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                    <span class="feature-text">Airport transfers</span>
                                </div>
                            </div>
                            
                            <div class="price-container">
                                <div class="price-text">Starting from <span class="price-amount">R12000</span></div>
                            </div>
                            <?php if (isset($_SESSION['user'])): ?>
                                <a href="/e-comm/standard_travel.php" class="book-button">Book Standard Package</a>
                            <?php else: ?>
                                <a href="login.php" class="book-button">Login to Book</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Premium Package -->
            <div class="package-card premium">
                <div class="popular-badge">POPULAR</div>
                <div class="package-content">
                    <div class="package-front">
                        <div class="package-front-content">
                            <svg class="package-front-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m2 4 3 12h14l3-12-6 7-4-7-4 7-6-7zm3 16h14"/>
                            </svg>
                            <h3 class="package-front-title">Premium Experience</h3>
                            <p class="package-front-subtitle">Complete luxury travel solution</p>
                            <div class="package-front-price">From R17000</div>
                        </div>
                    </div>
                    
                    <div class="package-back">
                        <div class="package-header">
                            <div class="package-header-content">
                                <div>
                                    <h3 class="package-name">Premium Experience</h3>
                                    <p class="package-subtitle">Complete luxury travel solution</p>
                                </div>
                                <svg class="package-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m2 4 3 12h14l3-12-6 7-4-7-4 7-6-7zm3 16h14"/>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="package-body">
                            <div class="features-list">
                                <div class="feature-item">
                                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                    <span class="feature-text">Everything in Standard Package</span>
                                </div>
                                <div class="feature-item">
                                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                    <span class="feature-text">Luxury accommodations</span>
                                </div>
                                <div class="feature-item">
                                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                    <span class="feature-text">12+ Adventure activities selection</span>
                                </div>
                                <div class="feature-item">
                                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                    <span class="feature-text">Vehicle rental</span>
                                </div>
                                <div class="feature-item">
                                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                    <span class="feature-text">Premium amenities</span>
                                </div>
                                <div class="feature-item">
                                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                    <span class="feature-text">Concierge service</span>
                                </div>
                            </div>
                            
                            <div class="price-container">
                                <div class="price-text">Starting from <span class="price-amount">R17000</span></div>
                            </div>
                            <?php if (isset($_SESSION['user'])): ?>
                                <a href="/e-comm/premium_travel.php" class="book-button">Book Premium Package</a>
                            <?php else: ?>
                                <a href="login.php" class="book-button">Login to Book</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>