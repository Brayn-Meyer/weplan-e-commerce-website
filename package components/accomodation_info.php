<h4>Accommodation</h4>
<div class="form-section">
  <label>Accommodation Type</label>
  <div class="grid-2" id="accommodationTypeGrid">
    <label>
      <input type="radio" name="type" value="apartment" checked>
      <span>🏢 Apartment</span>
    </label>
    <label>
      <input type="radio" name="type" value="house">
      <span>🏠 House</span>
    </label>
    <label>
      <input type="radio" name="type" value="villa">
      <span>🏖️ Villa</span>
    </label>
    <label>
      <input type="radio" name="type" value="hotel">
      <span>🏨 Hotel Suite</span>
    </label>
  </div>
</div>
<div class="grid-2">
  <div>
    <label>Number of Bedrooms</label>
    <select name="bedrooms" id="bedrooms">
      <?php for ($i=1; $i<=5; $i++): ?>
        <option value="<?= $i ?>"><?= $i ?> Bedroom<?= $i > 1 ? 's' : '' ?></option>
      <?php endfor; ?>
    </select>
  </div>
  <div>
    <label>Number of Guests</label>
    <select name="guests" id="guests">
      <?php for ($i=1; $i<=8; $i++): ?>
        <option value="<?= $i ?>"><?= $i ?> Guest<?= $i > 1 ? 's' : '' ?></option>
      <?php endfor; ?>
    </select>
  </div>
</div>
<div class="form-section">
  <label>Select Amenities</label>
  <div class="checkbox-group" id="amenitiesGroup">
    <label><input type="checkbox" name="amenities[]" value="wifi"><span>📶 WiFi</span></label>
    <label><input type="checkbox" name="amenities[]" value="kitchen"><span>🍳 Kitchen</span></label>
    <label><input type="checkbox" name="amenities[]" value="pool"><span>🏊 Pool</span></label>
    <label><input type="checkbox" name="amenities[]" value="livingroom"><span>🛋️ Living Room</span></label>
    <label><input type="checkbox" name="amenities[]" value="parking"><span>🚗 Parking</span></label>
    <label><input type="checkbox" name="amenities[]" value="gym"><span>💪 Gym</span></label>
    <label><input type="checkbox" name="amenities[]" value="spa"><span>🧘 Spa</span></label>
    <label><input type="checkbox" name="amenities[]" value="balcony"><span>🌅 Balcony</span></label>
  </div>
</div>
<div class="grid-2">
  <div>
    <label>Check-in</label>
    <input type="date" name="checkIn" required>
  </div>
  <div>
    <label>Check-out</label>
    <input type="date" name="checkOut" required>
  </div>
</div>
<div class="grid-2">
  <div>
    <label>Price per Night ($)</label>
    <input type="number" name="accommodationPrice" min="0" step="0.01" required>
  </div>
  <div>
    <label>Special Preferences</label>
    <textarea name="preferences"></textarea>
  </div>
</div>