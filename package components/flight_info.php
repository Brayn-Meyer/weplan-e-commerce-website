<h4>Flight Info</h4>
<div class="form-section">
  <label>Select Seat Type</label>
  <div class="grid-2" id="seatTypeGrid">
    <label>
      <input type="radio" name="seatType" value="economy" data-price="5310" checked>
      <span>Economy (R5310)</span>
    </label>
    <label>
      <input type="radio" name="seatType" value="premium-economy" data-price="10636">
      <span>Premium Economy (R10636)</span>
    </label>
    <label>
      <input type="radio" name="seatType" value="business" data-price="23065">
      <span>Business Class (R23065)</span>
    </label>
    <label>
      <input type="radio" name="seatType" value="first" data-price="44373">
      <span>First Class (R44373)</span>
    </label>
  </div>
</div>
<div class="form-section">
  <Label>Departure Destination</Label>
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
    <label>Price per Ticket ($)</label>
    <input type="number" name="flightPrice" id="flightPrice" min="0" step="0.01" value="299" readonly required>
  </div>
</div>
<div>
  <label>Total Flight Price ($)</label>
  <input type="number" id="flightTotal" value="299" readonly>
</div>

<script>
const seatRadios = document.querySelectorAll('input[name="seatType"]');
const priceInput = document.getElementById('flightPrice');
const ticketsInput = document.getElementById('tickets');
const totalInput = document.getElementById('flightTotal');

function updatePrice() {
  const selected = document.querySelector('input[name="seatType"]:checked');
  const price = selected ? parseFloat(selected.getAttribute('data-price')) : 0;
  priceInput.value = price;
  updateTotal();
}
function updateTotal() {
  const price = parseFloat(priceInput.value) || 0;
  const tickets = parseInt(ticketsInput.value) || 1;
  totalInput.value = price * tickets;
}
seatRadios.forEach(radio => radio.addEventListener('change', updatePrice));
ticketsInput.addEventListener('input', updateTotal);
window.addEventListener('DOMContentLoaded', () => {
  updatePrice();
});
</script>