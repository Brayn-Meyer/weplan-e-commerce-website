
<style>
    .about-section {
        padding: 5rem 0;
        background-color: white;
    }
    
    .about-container {
        max-width: 80rem;
        margin-left: auto;
        margin-right: auto;
        padding: 0 1rem;
    }
    
    .about-header {
        text-align: center;
        margin-bottom: 4rem;
    }
    
    .about-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1rem;
    }
    
    @media (min-width: 640px) {
        .about-title {
            font-size: 2.5rem;
        }
    }
    
    .about-title span {
        color: #ec4899;
    }
    
    .about-description {
        font-size: 1.125rem;
        color: #4b5563;
        max-width: 72rem;
        margin: 0 auto;
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    @media (min-width: 768px) {
        .features-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    .feature-card {
        text-align: center;
        padding: 1.5rem;
        border-radius: 1rem;
        transition: all 0.3s ease;
    }
    
    .feature-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .feature-card.pink {
        background: linear-gradient(135deg, #fdf2f8 0%, #fff1f2 100%);
    }
    
    .feature-card.blue {
        background: linear-gradient(135deg, #eff6ff 0%, #eef2ff 100%);
    }
    
    .feature-card.amber {
        background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
    }
    
    .feature-icon-container {
        width: 4rem;
        height: 4rem;
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }
    
    .feature-icon-container.pink {
        background: linear-gradient(to right, #ec4899, #e11d48);
    }
    
    .feature-icon-container.blue {
        background: linear-gradient(to right, #3b82f6, #4f46e5);
    }
    
    .feature-icon-container.amber {
        background: linear-gradient(to right, #f59e0b, #d97706);
    }
    
    .feature-icon {
        width: 2rem;
        height: 2rem;
        color: white;
    }
    
    .feature-name {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.5rem;
    }
    
    .feature-description {
        color: #4b5563;
    }
</style>

<section id="about" class="about-section">
    <div class="about-container">
        <div class="about-header">
            <h2 class="about-title">About <span>WePlan</span></h2>
            <p class="about-description">
                We're passionate about creating extraordinary travel experiences that go beyond expectations. 
                Our expert team crafts personalized journeys that capture the essence of adventure.
            </p>
        </div>
        
        <div class="features-grid">
            <!-- Global Reach Card -->
            <div class="feature-card pink">
                <div class="feature-icon-container pink">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/>
                        <path d="M2 12h20"/>
                    </svg>
                </div>
                <h3 class="feature-name">Global Reach</h3>
                <p class="feature-description">
                    Access to over 200 destinations worldwide with local expertise and insider knowledge.
                </p>
            </div>
            
            <!-- Personalized Care Card -->
            <div class="feature-card blue">
                <div class="feature-icon-container blue">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                    </svg>
                </div>
                <h3 class="feature-name">Personalized Care</h3>
                <p class="feature-description">
                    Every journey is crafted with attention to detail and personalized to your preferences.
                </p>
            </div>
            
            <!-- Excellence Card -->
            <div class="feature-card amber">
                <div class="feature-icon-container amber">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="6"/>
                        <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/>
                    </svg>
                </div>
                <h3 class="feature-name">Excellence</h3>
                <p class="feature-description">
                    Award-winning service with 98% customer satisfaction and countless memorable experiences.
                </p>
            </div>
        </div>
    </div>
</section>

