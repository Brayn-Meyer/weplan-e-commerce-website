<h4>Transport</h4>
<div class="form-section">
  <label>Select Vehicle Type</label>
  <div class="grid-2" id="vehicleTypeGrid">
    <label>
      <input type="radio" name="vehicleType" value="car" data-price="45" checked>
      <span>🚗 Car ($45/day)</span>
    </label>
    <label>
      <input type="radio" name="vehicleType" value="bike" data-price="25">
      <span>🏍️ Motorcycle ($25/day)</span>
    </label>
    <label>
      <input type="radio" name="vehicleType" value="van" data-price="75">
      <span>🚐 Van ($75/day)</span>
    </label>
    <label>
      <input type="radio" name="vehicleType" value="luxury" data-price="120">
      <span>🚙 Luxury Car ($120/day)</span>
    </label>
  </div>
</div>
<div class="grid-2">
  <div>
    <label>Daily Rate ($)</label>
    <input type="number" name="transportPrice" id="transportPrice" min="0" step="0.01" value="45" readonly required>
  </div>
  <div></div>
</div>
<div class="grid-2">
  <div>
    <label>Pickup Date</label>
    <input type="date" name="pickupDate" required>
  </div>
  <div>
    <label>Drop-off Date</label>
    <input type="date" name="dropoffDate" required>
  </div>
</div>
<div class="form-section" style="background:#f0f6ff;border:1px solid #b6d4fe;border-radius:1rem;padding:1rem;">
  <h5 style="color:#1e40af;margin-bottom:0.5rem;">Important Information</h5>
  <ul style="color:#2563eb;font-size:0.98rem;list-style:disc;padding-left:1.5rem;">
    <li>Valid driver's license required</li>
    <li>Minimum age: 21 years</li>
    <li>Insurance included in the price</li>
    <li>Free cancellation up to 24 hours before pickup</li>
  </ul>
</div>

<script>
const vehicleRadios = document.querySelectorAll('input[name="vehicleType"]');
const priceInput = document.getElementById('transportPrice');
function updateTransportPrice() {
  const selected = document.querySelector('input[name="vehicleType"]:checked');
  priceInput.value = selected ? selected.getAttribute('data-price') : '';
}
vehicleRadios.forEach(radio => radio.addEventListener('change', updateTransportPrice));
window.addEventListener('DOMContentLoaded', updateTransportPrice);
</script>