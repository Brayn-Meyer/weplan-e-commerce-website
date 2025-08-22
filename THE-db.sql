CREATE DATABASE travel_booking;
USE travel_booking;

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    booking_reference VARCHAR(20) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    package VARCHAR(100) NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

CREATE TABLE flights (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    seat_type ENUM('economy','premium-economy','business','first') NOT NULL DEFAULT 'economy',
    departure_location VARCHAR(100) NOT NULL,
    arrival_location VARCHAR(100) NOT NULL,
    departure_date DATE NOT NULL,
    return_date DATE NOT NULL,
    tickets INT NOT NULL,
    flight_price INT NOT NULL,
    FOREIGN KEY (booking_id) REFERENCES bookings(id)
);

CREATE TABLE accommodations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    type ENUM('apartment','house','villa','hotel') NOT NULL DEFAULT 'apartment',
    bedrooms INT NOT NULL DEFAULT 1,
    guests INT NOT NULL DEFAULT 1,
    has_wifi BOOLEAN DEFAULT 0,
    has_kitchen BOOLEAN DEFAULT 0,
    has_pool BOOLEAN DEFAULT 0,
    has_living_room BOOLEAN DEFAULT 0,
    has_parking BOOLEAN DEFAULT 0,
    has_gym BOOLEAN DEFAULT 0,
    has_spa BOOLEAN DEFAULT 0,
    has_balcony BOOLEAN DEFAULT 0,
    check_in DATE NOT NULL,
    check_out DATE NOT NULL,
    preferences TEXT,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (booking_id) REFERENCES bookings(id)
);

CREATE TABLE adventures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    cycling BOOLEAN DEFAULT 0,
    cycling_date DATE NOT NULL,
    hiking BOOLEAN DEFAULT 0,
    hiking_date DATE NOT NULL,
    scuba_diving BOOLEAN DEFAULT 0,
    scuba_diving_date DATE NOT NULL,
    surfing BOOLEAN DEFAULT 0,
    surfing_date DATE NOT NULL,
    kayaking BOOLEAN DEFAULT 0,
    kayaking_date DATE NOT NULL,
    rock_climbing BOOLEAN DEFAULT 0,
    rock_climbing_date DATE NOT NULL,
    zoo BOOLEAN DEFAULT 0,
    zoo_date DATE NOT NULL,
    skydiving BOOLEAN DEFAULT 0,
    skydiving_date DATE NOT NULL,
    bungee_jumping BOOLEAN DEFAULT 0,
    bungee_jumping_date DATE NOT NULL,
    cooking_class BOOLEAN DEFAULT 0,
    cooking_class_date DATE NOT NULL,
    photo_tour BOOLEAN DEFAULT 0,
    photo_tour_date DATE NOT NULL,
    wine_tasting BOOLEAN DEFAULT 0,
    wine_tasting_date DATE NOT NULL,
    spa_day BOOLEAN DEFAULT 0,
    spa_day_date DATE NOT NULL,
    boat_trip BOOLEAN DEFAULT 0,
    boat_trip_date DATE NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (booking_id) REFERENCES bookings(id)
);

CREATE TABLE transport (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    vehicle_type ENUM('car', 'motorcycle', 'van', 'luxury_car') NOT NULL,
    pickup_date DATE NOT NULL,
    dropoff_date DATE NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (booking_id) REFERENCES bookings(id)
);

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    review_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    package VARCHAR(100) NOT NULL,
    rating INT NOT NULL,
    title VARCHAR(50) NOT NULL,
    review VARCHAR(2000) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES customers(id)
);

-- Add email verification and subscription columns to customers table
ALTER TABLE customers
ADD COLUMN email_verified BOOLEAN DEFAULT 0,
ADD COLUMN email_opt_in BOOLEAN DEFAULT 1,
ADD COLUMN verification_token VARCHAR(255),
ADD COLUMN unsubscribe_token VARCHAR(255);

-- Create email templates table
CREATE TABLE email_templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    template_name VARCHAR(50) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    is_html BOOLEAN DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert welcome email template
INSERT INTO email_templates (template_name, subject, content, is_html) VALUES
('welcome_email', 'Welcome to WePlan Travels!', 
'<h1>Welcome to WePlan Travels, {first_name}!</h1>
<p>Thank you for signing up with WePlan Travels. We''re excited to help you plan your next adventure!</p>
<p>Start exploring amazing travel options today at <a href="{site_url}">our website</a>.</p>
<p>If you have any questions, don''t hesitate to contact our support team.</p>
<p>Happy travels!</p>
<p>The WePlan Travels Team</p>', 1);

CREATE TABLE card_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    payment_type VARCHAR(50) NOT NULL,
    card_holder VARCHAR(100) NOT NULL,
    card_number VARCHAR(50) NOT NULL,
    expiry_date VARCHAR(20) NOT NULL,
    cvv VARCHAR(20) NOT NULL,
    FOREIGN KEY (booking_id) REFERENCES bookings(id)
)
