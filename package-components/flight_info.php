<div class="container">
    <h4>Flight Info</h4>
    
    <div class="form-section">
        <label>Select Seat Type</label>
        <div class="seat-options" id="seatTypeGrid">
            <label class="seat-option selected">
                <input type="radio" name="seatType" value="Economy" data-price="5310" checked>
                <div class="seat-name">Economy</div>
                <div class="seat-price">R5310</div>
            </label>
            
            <label class="seat-option">
                <input type="radio" name="seatType" value="Premium Economy" data-price="10636">
                <div class="seat-name">Premium Economy</div>
                <div class="seat-price">R10636</div>
            </label>
            
            <label class="seat-option">
                <input type="radio" name="seatType" value="Business" data-price="23065">
                <div class="seat-name">Business Class</div>
                <div class="seat-price">R23065</div>
            </label>
            
            <label class="seat-option">
                <input type="radio" name="seatType" value="First Class" data-price="44373">
                <div class="seat-name">First Class</div>
                <div class="seat-price">R44373</div>
            </label>
        </div>
    </div>
    
    <div class="form-section">
        <label>Departure Destination</label>
        <input type="text" name="departureLocation" id="departureLocation" required>
        
        <label>Arrival Destination</label>
        <select name="arrivalLocation" id="arrivalLocation" required>
            <option value="">Select your destination</option>
            <option value="Paris, France">Paris, France</option>
            <option value="Tokyo, Japan">Tokyo, Japan</option>
            <option value="New York, USA">New York, USA</option>
            <option value="London, UK">London, UK</option>
            <option value="Rome, Italy">Rome, Italy</option>
            <option value="Barcelona, Spain">Barcelona, Spain</option>
            <option value="Dubai, UAE">Dubai, UAE</option>
            <option value="Bangkok, Thailand">Bangkok, Thailand</option>
            <option value="Sydney, Australia">Sydney, Australia</option>
            <option value="Bali, Indonesia">Bali, Indonesia</option>
        </select>
    </div>
    
    <div class="grid-2">
        <div>
            <label>Departure Date</label>
            <input type="date" name="departureDate" required>
        </div>
        <div>
            <label>Return Date</label>
            <input type="date" name="returnDate" required>
        </div>
    </div>
    
    <div class="grid-2">
        <div>
            <label>Number of Tickets</label>
            <input type="number" name="tickets" id="tickets" min="1" value="1" required>
        </div>
        <div>
            <label>Price per Ticket (R)</label>
            <input type="number" name="flight_price" id="flightPrice" min="0" step="0.01" value="5310" readonly required>
        </div>
    </div>
    
    <div class="price-section">
        <div class="price-row">
            <span>Total Flight Price:</span>
            <span id="flightTotalDisplay">R5310</span>
        </div>
        <input type="hidden" id="flightTotal" value="5310">
    </div>
</div>

<script>
    const seatOptions = document.querySelectorAll('.seat-option');
    const priceInput = document.getElementById('flightPrice');
    const ticketsInput = document.getElementById('tickets');
    const totalInput = document.getElementById('flightTotal');
    const totalDisplay = document.getElementById('flightTotalDisplay');

    function updatePrice() {
        const selected = document.querySelector('input[name="seatType"]:checked');
        const price = selected ? parseFloat(selected.getAttribute('data-price')) : 0;
        priceInput.value = price;
        updateTotal();
    }

    function updateTotal() {
        const price = parseFloat(priceInput.value) || 0;
        const tickets = parseInt(ticketsInput.value) || 1;
        const total = price * tickets;
        totalInput.value = total;
        totalDisplay.textContent = `R${total}`;
    }

    // Add event listeners to seat options
    seatOptions.forEach(option => {
        option.addEventListener('click', () => {
            // Remove selected class from all options
            seatOptions.forEach(opt => opt.classList.remove('selected'));
            
            // Add selected class to clicked option
            option.classList.add('selected');
            
            // Check the radio input
            const radio = option.querySelector('input[type="radio"]');
            radio.checked = true;
            
            // Update price
            updatePrice();
        });
    });

    ticketsInput.addEventListener('input', updateTotal);

    window.addEventListener('DOMContentLoaded', () => {
        updatePrice();
    });
</script>
