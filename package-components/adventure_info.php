<h4>Adventures</h4>
<div class="form-section">
  <label>Select Your Adventures</label>
  <div class="grid-2" id="adventureGrid" style="display: flex; flex-wrap: wrap; gap: 1rem;">
    <!-- Adventure options will be rendered here -->
  </div>
</div>
<div id="adventureScheduleContainer"></div>

<script>
const adventures = [
  { id: 'Cycling', name: 'Cycling', icon: '🚴', basePrice: 50 },
  { id: 'Hiking', name: 'Hiking', icon: '🥾', basePrice: 40 },
  { id: 'Scuba Diving', name: 'Scuba Diving', icon: '🤿', basePrice: 120 },
  { id: 'Surfing', name: 'Surfing', icon: '🏄', basePrice: 80 },
  { id: 'Kayaking', name: 'Kayaking', icon: '🛶', basePrice: 60 },
  { id: 'Rock Climbing', name: 'Rock Climbing', icon: '🧗', basePrice: 100 },
  { id: 'Safari', name: 'Safari', icon: '🦁', basePrice: 200 },
  { id: 'Skydiving', name: 'Skydiving', icon: '🪂', basePrice: 300 },
  { id: 'Bungee Jumping', name: 'Bungee Jumping', icon: '🤸', basePrice: 150 },
  { id: 'Cooking Class', name: 'Cooking Class', icon: '👨‍🍳', basePrice: 70 },
  { id: 'Photography Tour', name: 'Photography Tour', icon: '📸', basePrice: 90 },
  { id: 'Wine Tasting', name: 'Wine Tasting', icon: '🍷', basePrice: 110 },
  { id: 'Spa Day', name: 'Spa Day', icon: '🧘', basePrice: 130 },
  { id: 'Boat Trip', name: 'Boat Trip', icon: '⛵', basePrice: 160 }
];

// You should set these from PHP using your flight info
const flightStart = window.flightStartDate || ''; // e.g. '2025-08-10'
const flightEnd = window.flightEndDate || '';     // e.g. '2025-08-20'

function getAvailableDates() {
  if (!flightStart || !flightEnd) return [];
  const start = new Date(flightStart);
  const end = new Date(flightEnd);
  const dates = [];
  const current = new Date(start);
  current.setDate(current.getDate() + 1);
  while (current < end) {
    dates.push(current.toISOString().split('T')[0]);
    current.setDate(current.getDate() + 1);
  }
  return dates;
}

const availableDates = getAvailableDates();

function renderAdventureGrid(selected) {
  const grid = document.getElementById('adventureGrid');
  grid.innerHTML = '';
  adventures.forEach(adventure => {
    const checked = selected.includes(adventure.id) ? 'checked' : '';
    grid.innerHTML += `
      <label style="display:inline-block;cursor:pointer;padding:1rem;border:2px solid ${checked ? '#ec4899' : '#e9ecef'};border-radius:1rem;text-align:center;min-width:110px;background:${checked ? '#fce7f3' : '#fff'};">
        <input type="checkbox" name="selectedAdventures[]" value="${adventure.id}" style="display:none;" ${checked}>
        <div style="font-size:2rem;">${adventure.icon}</div>
        <div style="font-size:1rem;font-weight:500;">${adventure.name}</div>
      </label>
    `;
  });
}

function renderAdventureSchedule(selected, schedule) {
  const container = document.getElementById('adventureScheduleContainer');
  if (selected.length === 0) {
    container.innerHTML = '<div class="p-4 bg-yellow-50 border border-yellow-200 rounded-2xl" style="background:#fef9c3;border:1px solid #fde68a;border-radius:1rem;margin-top:1rem;"><p style="color:#b45309;">Please select at least one adventure.</p></div>';
    return;
  }
  let html = '<div class="form-section"><label>Schedule Your Adventures</label>';
  selected.forEach(adventureId => {
    const adv = adventures.find(a => a.id === adventureId);
    html += `
      <div class="adventure-block" style="align-items:center;justify-content:space-between;margin-bottom:1rem;background:#fce7f3;border-radius:1rem;padding:1rem;">
        <div style="display:flex;align-items:center;gap:0.7rem;">
          <span style="font-size:1.5rem;">${adv.icon}</span>
          <span style="font-weight:600;">${adv.name}</span>
        </div>
        <br>
        <label>Date</label>
        <input type="date" name="adventureSchedule[${adventureId}]" id="adventureSchedule_${adventureId}" required style="padding:0.5rem 1rem;border-radius:0.7rem;">
        <br>
        <label>Number of Participants</label>
        <input type="number" name="participants[${adventureId}]" id="participants_${adventureId}" value="1" min="1" required style="padding:0.5rem 1rem;border-radius:0.7rem;" data-baseprice="${adv.basePrice}">
        <br>
        <label>Total Price</label>
        <input type="number" name="price[${adventureId}]" id="price_${adventureId}" value="${adv.basePrice}" readonly required style="padding:0.5rem 1rem;border-radius:0.7rem;">
      </div>
    `;
  });
  html += '</div>';
  container.innerHTML = html;

  // Add event listeners for participant inputs to update price
  selected.forEach(adventureId => {
    const participantsInput = document.getElementById(`participants_${adventureId}`);
    const priceInput = document.getElementById(`price_${adventureId}`);
    if (participantsInput && priceInput) {
      function updatePrice() {
        const base = parseFloat(participantsInput.getAttribute('data-baseprice')) || 0;
        const qty = parseInt(participantsInput.value) || 1;
        priceInput.value = base * qty;
      }
      participantsInput.addEventListener('input', updatePrice);
      updatePrice();
    }
  });
}

let selectedAdventures = [];
let adventureSchedule = {};

function updateAdventures() {
  // Get checked adventures
  selectedAdventures = Array.from(document.querySelectorAll('#adventureGrid input[type="checkbox"]:checked')).map(cb => cb.value);
  renderAdventureGrid(selectedAdventures);
  renderAdventureSchedule(selectedAdventures, adventureSchedule);
}

document.addEventListener('DOMContentLoaded', function() {
  renderAdventureGrid([]);
  renderAdventureSchedule([], {});
  document.getElementById('adventureGrid').addEventListener('change', updateAdventures);
});
</script>