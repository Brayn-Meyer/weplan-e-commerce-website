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
  { id: 'cycling', name: 'Cycling', icon: '🚴' },
  { id: 'hiking', name: 'Hiking', icon: '🥾' },
  { id: 'diving', name: 'Scuba Diving', icon: '🤿' },
  { id: 'surfing', name: 'Surfing', icon: '🏄' },
  { id: 'kayaking', name: 'Kayaking', icon: '🛶' },
  { id: 'climbing', name: 'Rock Climbing', icon: '🧗' },
  { id: 'safari', name: 'Safari', icon: '🦁' },
  { id: 'skydiving', name: 'Skydiving', icon: '🪂' },
  { id: 'bungee', name: 'Bungee Jumping', icon: '🤸' },
  { id: 'cooking', name: 'Cooking Class', icon: '👨‍🍳' },
  { id: 'photography', name: 'Photography Tour', icon: '📸' },
  { id: 'wine', name: 'Wine Tasting', icon: '🍷' },
  { id: 'spa', name: 'Spa Day', icon: '🧘' },
  { id: 'boat', name: 'Boat Trip', icon: '⛵' }
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
      <div class="adventure-block" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;background:#fce7f3;border-radius:1rem;padding:1rem;">
        <div style="display:flex;align-items:center;gap:0.7rem;">
          <span style="font-size:1.5rem;">${adv.icon}</span>
          <span style="font-weight:600;">${adv.name}</span>
        </div>
        <input type="date" name="adventureSchedule[${adventureId}]" required style="padding:0.5rem 1rem;border-radius:0.7rem;">
      </div>
    `;
  });
  html += '</div>';
  container.innerHTML = html;
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