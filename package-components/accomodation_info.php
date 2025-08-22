<h4>Accommodation</h4>
<div class="form-section">
  <label>Accommodation Type</label>
  <div class="grid-2" id="accommodationTypeGrid">
    <label class="selected">
      <input type="radio" name="type" value="Apartment" checked>
      <span>🏢 Apartment</span>
    </label>
    <label>
      <input type="radio" name="type" value="House">
      <span>🏠 House</span>
    </label>
    <label>
      <input type="radio" name="type" value="Villa">
      <span>🏖️ Villa</span>
    </label>
    <label>
      <input type="radio" name="type" value="Hotel">
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

<div class="divider"></div>

<div class="amenities-section">
  <h5>Select Amenities</h5>
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
    <label>Price per Night (R)</label>
    <input type="number" name="accommodationPrice" min="0" step="0.01" readonly required>
  </div>
  <div>
    <label>Special Preferences</label>
    <textarea name="preferences"></textarea>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
      const typeRadios = document.querySelectorAll('input[name="type"]');
      const bedroomsSelect = document.getElementById("bedrooms");
      const guestsSelect = document.getElementById("guests");
      const amenitiesCheckboxes = document.querySelectorAll('#amenitiesGroup input[type="checkbox"]');
      const priceInput = document.querySelector('input[name="accommodationPrice"]');
      const checkInInput = document.querySelector('input[name="checkIn"]');
      const checkOutInput = document.querySelector('input[name="checkOut"]');
      const roomsSelect = document.querySelector('select[name="rooms"]'); // optional, if rooms dropdown exists

      // Add event listeners for accommodation type selection styling
      const accommodationLabels = document.querySelectorAll('#accommodationTypeGrid label');
      accommodationLabels.forEach(label => {
        label.addEventListener('click', () => {
          // Remove selected class from all labels
          accommodationLabels.forEach(l => l.classList.remove('selected'));
          // Add selected class to clicked label
          label.classList.add('selected');
        });
      });
      
      // Add event listeners for amenities selection styling
      const amenityLabels = document.querySelectorAll('#amenitiesGroup label');
      amenityLabels.forEach(label => {
        const checkbox = label.querySelector('input[type="checkbox"]');
        label.addEventListener('click', () => {
          label.classList.toggle('selected');
          // Toggle the checkbox
          checkbox.checked = !checkbox.checked;
          calculatePrice();
        });
      });

      function calculatePrice() {
          let basePrice = 0;

          // Base price from accommodation type
          const type = document.querySelector('input[name="type"]:checked').value;
          switch (type) {
              case "apartment": basePrice = 800; break;
              case "house": basePrice = 1200; break;
              case "villa": basePrice = 2000; break;
              case "hotel": basePrice = 1500; break;
          }

          // Bedrooms adjustment
          const bedrooms = parseInt(bedroomsSelect.value, 10);
          basePrice += (bedrooms - 1) * 200; // R200 per extra bedroom

          // Guest adjustment
          const guests = parseInt(guestsSelect.value, 10);
          if (guests > 2) {
              basePrice += (guests - 2) * 150; // R150 per extra guest
          }

          // Amenities adjustment
          amenitiesCheckboxes.forEach(checkbox => {
              if (checkbox.checked) {
                  switch (checkbox.value) {
                      case "wifi": basePrice += 50; break;
                      case "kitchen": basePrice += 100; break;
                      case "pool": basePrice += 300; break;
                      case "livingroom": basePrice += 80; break;
                      case "parking": basePrice += 70; break;
                      case "gym": basePrice += 200; break;
                      case "spa": basePrice += 500; break;
                      case "balcony": basePrice += 150; break;
                  }
              }
          });

          // ---- New: Nights calculation ----
          let nights = 1;
          if (checkInInput.value && checkOutInput.value) {
              const checkInDate = new Date(checkInInput.value);
              const checkOutDate = new Date(checkOutInput.value);
              const diffTime = checkOutDate - checkInDate;
              nights = diffTime / (1000 * 60 * 60 * 24);
              if (nights < 1) nights = 1; // Minimum 1 night
          }

          // ---- New: Rooms calculation ----
          let rooms = 1;
          if (roomsSelect) {
              rooms = parseInt(roomsSelect.value, 10) || 1;
          }

          // Total price per night * nights * rooms
          const totalPrice = basePrice * nights * rooms;

          // Update the Price per Night input
          priceInput.value = totalPrice.toFixed(2);
      }

      // Event listeners
      [...typeRadios, bedroomsSelect, guestsSelect, checkInInput, checkOutInput].forEach(el => {
          el.addEventListener("change", calculatePrice);
      });
      amenitiesCheckboxes.forEach(c => c.addEventListener("change", calculatePrice));
      if (roomsSelect) roomsSelect.addEventListener("change", calculatePrice);

      // Initial calculation
      calculatePrice();
  });
</script>