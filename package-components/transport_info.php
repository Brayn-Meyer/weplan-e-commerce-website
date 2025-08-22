<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport Information</title>
    <style>
      
        
        .info-box {
            background: #f0f6ff;
            border: 1px solid #b6d4fe;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-top: 20px;
        }
        
        .info-box h5 {
            color: #1e40af;
            margin-bottom: 0.8rem;
            font-size: 18px;
        }
        
        .info-box ul {
            color: #2563eb;
            font-size: 0.98rem;
            list-style: disc;
            padding-left: 1.5rem;
        }
        
        .info-box li {
            margin-bottom: 5px;
        }
        
        .summary-box {
            margin-top: 25px;
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 8px;
            border-left: 4px solid #ec26e2ff;
        }
        
        .summary-box h5 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .total-display {
            font-weight: bold;
            color: #2c3e50;
            font-size: 18px;
            margin-top: 5px;
            padding-top: 10px;
            border-top: 1px dashed #cbd5e0;
        }
        
        @media (max-width: 768px) {
            .grid-2, #vehicleTypeGrid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h4>Transport</h4>
        <div class="form-section">
            <label>Select Vehicle Type</label>
            <div class="grid-2" id="vehicleTypeGrid">
                <label>
                    <input type="radio" name="vehicleType" value="Car" data-price="800">
                    <span>🚗 Car (R800/day)</span>
                </label>
                <label>
                    <input type="radio" name="vehicleType" value="Bike" data-price="450">
                    <span>🏍️ Motorcycle (R450/day)</span>
                </label>
                <label>
                    <input type="radio" name="vehicleType" value="Van" data-price="1400">
                    <span>🚐 Van (R1400/day)</span>
                </label>
                <label>
                    <input type="radio" name="vehicleType" value="Luxury Car" data-price="2150">
                    <span>🚙 Luxury Car (R2150/day)</span>
                </label>
            </div>
            <div id="vehicleError" style="color: #dc3545; display: none; margin-top: 0.5rem;">
                Please select a vehicle type
            </div>
        </div>
        
        <div class="grid-2">
            <div>
                <label>Total Rate (R)</label>
                <input type="number" name="transportPrice" id="transportPrice" min="0" step="0.01" value="" readonly required>
            </div>
            <div></div>
        </div>
        
        <div class="grid-2">
            <div>
                <label>Pickup Date</label>
                <input type="date" name="pickupDate" id="pickupDate" required>
            </div>
            <div>
                <label>Drop-off Date</label>
                <input type="date" name="dropoffDate" id="dropoffDate" required>
            </div>
        </div>
        
        <div class="summary-box">
            <h5>Rental Summary</h5>
            <div class="summary-item">
                <span>Daily Rate:</span>
                <span id="dailyRateDisplay">R0.00</span>
            </div>
            <div class="summary-item">
                <span>Rental Days:</span>
                <span id="daysDisplay">0 days</span>
            </div>
            <div class="total-display">
                <span>Total Rate:</span>
                <span id="totalRateDisplay">R0.00</span>
            </div>
        </div>
        
        <div class="info-box">
            <h5>Important Information</h5>
            <ul>
                <li>Valid driver's license required</li>
                <li>Minimum age: 21 years</li>
                <li>Insurance included in the price</li>
                <li>Free cancellation up to 24 hours before pickup</li>
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const vehicleRadios = document.querySelectorAll('input[name="vehicleType"]');
            const priceInput = document.getElementById('transportPrice');
            const vehicleError = document.getElementById('vehicleError');
            const pickupDateInput = document.getElementById('pickupDate');
            const dropoffDateInput = document.getElementById('dropoffDate');
            const dailyRateDisplay = document.getElementById('dailyRateDisplay');
            const daysDisplay = document.getElementById('daysDisplay');
            const totalRateDisplay = document.getElementById('totalRateDisplay');
            
            // Set default dates (today and tomorrow)
            const today = new Date();
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            
            pickupDateInput.valueAsDate = today;
            dropoffDateInput.valueAsDate = tomorrow;
            
            // Add visual selection effect to vehicle type options
            const vehicleLabels = document.querySelectorAll('#vehicleTypeGrid label');
            vehicleLabels.forEach(label => {
                label.addEventListener('click', () => {
                    // Remove selected class from all labels
                    vehicleLabels.forEach(l => l.classList.remove('selected'));
                    // Add selected class to clicked label
                    label.classList.add('selected');
                    
                    // Find the radio input inside the label and check it
                    const radio = label.querySelector('input[type="radio"]');
                    if (radio) {
                        radio.checked = true;
                        updateTransportPrice();
                        // Hide error if shown
                        vehicleError.style.display = 'none';
                    }
                });
            });
            
            // Calculate days between two dates
            function calculateDays() {
                if (!pickupDateInput.value || !dropoffDateInput.value) return 0;
                
                const pickupDate = new Date(pickupDateInput.value);
                const dropoffDate = new Date(dropoffDateInput.value);
                
                // Ensure dropoff date is after pickup date
                if (dropoffDate <= pickupDate) return 0;
                
                const timeDiff = dropoffDate.getTime() - pickupDate.getTime();
                return Math.ceil(timeDiff / (1000 * 3600 * 24));
            }
            
            // Update transport price based on selection and dates
            function updateTransportPrice() {
                const selected = document.querySelector('input[name="vehicleType"]:checked');
                const days = calculateDays();
                
                if (selected && days > 0) {
                    const dailyRate = parseFloat(selected.getAttribute('data-price'));
                    const totalPrice = dailyRate * days;
                    
                    priceInput.value = totalPrice.toFixed(2);
                    dailyRateDisplay.textContent = `R${dailyRate.toFixed(2)}`;
                    daysDisplay.textContent = `${days} day${days !== 1 ? 's' : ''}`;
                    totalRateDisplay.textContent = `R${totalPrice.toFixed(2)}`;
                } else {
                    priceInput.value = '';
                    dailyRateDisplay.textContent = 'R0.00';
                    daysDisplay.textContent = '0 days';
                    totalRateDisplay.textContent = 'R0.00';
                }
            }
            
            // Event listeners for vehicle selection
            vehicleRadios.forEach(radio => {
                radio.addEventListener('change', () => {
                    updateTransportPrice();
                    
                    // Update visual selection when radio changes
                    const label = radio.closest('label');
                    vehicleLabels.forEach(l => l.classList.remove('selected'));
                    if (label) label.classList.add('selected');
                    
                    // Hide error if shown
                    vehicleError.style.display = 'none';
                });
            });
            
            // Event listeners for date changes
            pickupDateInput.addEventListener('change', updateTransportPrice);
            dropoffDateInput.addEventListener('change', updateTransportPrice);
            
            // Add validation for form submission
            document.getElementById('bookingForm')?.addEventListener('submit', function(e) {
                const selectedVehicle = document.querySelector('input[name="vehicleType"]:checked');
                if (!selectedVehicle) {
                    e.preventDefault();
                    vehicleError.style.display = 'block';
                    
                    // Scroll to error
                    vehicleError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
            
            // Initial calculation
            updateTransportPrice();
        });
    </script>
</body>
</html>