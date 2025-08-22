<style>
    .contact-section {
        padding: 5rem 0;
        background: linear-gradient(135deg, #dadadae8 0%, #f6f6f6fe 100%);
    }
    
    .contact-container {
        max-width: 80rem;
        margin-left: auto;
        margin-right: auto;
        padding: 0 1rem;
    }
    
    .contact-header {
        text-align: center;
        margin-bottom: 4rem;
    }
    
    .contact-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1rem;
    }
    
    @media (min-width: 640px) {
        .contact-title {
            font-size: 2.5rem;
        }
    }
    
    .contact-title span {
        color: #ec4899;
    }
    
    .contact-description {
        font-size: 1.125rem;
        color: #4b5563;
        max-width: 72rem;
        margin: 0 auto;
    }
    
    .contacts-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    @media (min-width: 768px) {
        .contacts-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    .contact-card {
        text-align: left;
        padding: 1.5rem;
        border-radius: 1.5rem;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .contact-card:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        transform: translateY(-0.5rem);
    }
    
    .contact-card.pink {
        background: linear-gradient(135deg, #fdf2f8 0%, #fff1f2 100%);
    }
    
    .contact-card.blue {
        background: linear-gradient(135deg, #eff6ff 0%, #eef2ff 100%);
    }
    
    .contact-card.amber {
        background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
    }
    
    .contact-icon-container {
        width: 4rem;
        height: 4rem;
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }
    
    .contact-icon-container.pink {
        background: linear-gradient(to right, #ec4899, #e11d48);
    }
    
    .contact-icon-container.blue {
        background: linear-gradient(to right, #3b82f6, #4f46e5);
    }
    
    .contact-icon-container.amber {
        background: linear-gradient(to right, #f59e0b, #d97706);
    }
    
    .contact-icon {
        width: 2rem;
        height: 2rem;
        color: white;
    }
    
    .contact-name {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.5rem;
    }
    
    .feature-description {
        color: #4b5563;
        margin-bottom: 1rem;
    }
    
    input[type="text"], textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        margin-top: 0.5rem;
        font-family: inherit;
    }
    
    textarea {
        min-height: 120px;
        resize: vertical;
    }
    
    button[type="submit"] {
        display: block;
        width: 100%;
        padding: 1rem;
        border-radius: 1rem;
        font-weight: 600;
        color: white;
        text-align: center;
        background: linear-gradient(to right, #ec4899, #f43f5e);
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        cursor: pointer;
    }
    
    button[type="submit"]:hover {
        background: linear-gradient(to right, #db2777, #e11d48);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        transform: translateY(-2px);
    }
    
    label {
        font-weight: 500;
        color: #111827;
    }
</style>

<section id="contact" class="contact-section">
    <div class="contact-container">
        <div class="contact-header">
            <h2 class="contact-title">Contact <span>WePlan</span></h2>
            <p class="contact-description">
                We're passionate about creating extraordinary travel experiences that go beyond expectations. 
                Our expert team crafts personalized journeys that capture the essence of adventure.
            </p>
        </div>
        
        <div class="contacts-grid">
            <!-- Global Reach Card -->
            <div class="contact-card pink">
                <h3 class="contact-name">Contact Information</h3>
                <?php if (isset($_SESSION['user'])): ?>
                    <?php
                        $u = $_SESSION['current_user'];
                        echo "<p class='feature-description'>You are currently sending a message as " . htmlspecialchars($u['first_name'] . " " . $u['last_name']) . ", and your current email is " . $u['email'] . ".</p>"
                    ?>
                    <form action="contact_booking.php" method="post">
                        <label for="title">Your current issue:</label>
                        <input required name="title" type="text">
                        <label for="message">Detailed description of your issue:</label>
                        <textarea required name="message" type="text"></textarea>
                        <button type="submit">Send Message</button>
                    </form>
                <?php else: ?>
                    <form action="contact_nl_booking.php" method="post">
                        <p class="feature-description">Please enter all required information.</p>
                        <label for="name">Your Name:</label>
                        <input required name="name" type="text">
                        <label for="email">Your Email:</label>
                        <input required name="email" type="text">
                        <label for="title">Your current issue:</label>
                        <input required name="title" type="text">
                        <label for="message">Detailed description of your issue:</label>
                        <textarea required name="message" type="text"></textarea>
                        <button type="submit">Send Message</button>
                    </form>
                <?php endif; ?>
            </div>
            
            <!-- Personalized Care Card -->
            <div class="contact-card blue">
                <div class="contact-icon-container blue">
                    <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                    </svg>
                </div>
                <h3 class="contact-name">Personalized Care</h3>
                <p class="feature-description">
                    Every journey is crafted with attention to detail and personalized to your preferences.
                </p>
            </div>
        </div>
    </div>
</section>