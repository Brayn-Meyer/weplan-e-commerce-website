<?php
  session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
    body {
      background: #f8fafc;
      font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
      color: #22223b;
      margin: 0;
      padding: 0;
    }
    h2, h4, label {
      color: #22223b;
    }
    form {
      background: #fff;
      border-radius: 1.2rem;
      box-shadow: 0 4px 24px 0 rgba(0,0,0,0.07);
      padding: 2.5rem 2rem;
      max-width: 700px;
      margin: 2rem auto;
    }
    .form-section {
      margin-bottom: 2.5rem;
    }
    label {
      display: block;
      font-weight: 600;
      margin-bottom: 0.5rem;
      font-size: 1rem;
    }
    input[type="text"],
    input[type="email"],
    input[type="date"],
    input[type="number"],
    textarea,
    select {
      width: 100%;
      padding: 1rem;
      border: 2px solid #e9ecef;
      border-radius: 1rem;
      font-size: 1rem;
      margin-bottom: 1.2rem;
      background: #f8fafc;
      transition: border 0.2s, box-shadow 0.2s;
      outline: none;
    }
    input:focus,
    textarea:focus,
    select:focus {
      border-color: #ec4899;
      box-shadow: 0 0 0 2px #fbcfe8;
    }
    textarea {
      min-height: 90px;
      resize: vertical;
    }
    /* Checkbox styling */
    .checkbox-group {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      margin-bottom: 1.2rem;
    }
    .checkbox-group label {
      display: flex;
      align-items: center;
      background: #f8fafc;
      border: 2px solid #e9ecef;
      border-radius: 0.8rem;
      padding: 0.5rem 1rem;
      cursor: pointer;
      transition: border 0.2s, background 0.2s;
      font-weight: 500;
    }
    .checkbox-group input[type="checkbox"] {
      accent-color: #ec4899;
      margin-right: 0.5rem;
    }
    .checkbox-group input[type="checkbox"]:checked + span {
      color: #ec4899;
    }
    input[type="checkbox"]:checked + span,
    input[type="radio"]:checked + span {
      color: #ec4899;
    }
    /* Seat option styling for flight_info */
    .seat-options {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
      margin-bottom: 1.5rem;
    }
    .seat-option {
      border: 2px solid #e9ecef;
      border-radius: 1rem;
      padding: 1rem;
      cursor: pointer;
      transition: all 0.2s;
      background: #f8fafc;
    }
    .seat-option:hover {
      border-color: #ec4899;
    }
    .seat-option.selected {
      border-color: #ec4899;
      background-color: #fdf2f8;
    }
    .seat-option input[type="radio"] {
      display: none;
    }
    .seat-name {
      font-weight: 600;
      margin-bottom: 0.5rem;
    }
    .seat-price {
      color: #ec4899;
      font-weight: bold;
    }
    .button-group {
      display: flex;
      justify-content: flex-end;
      gap: 1rem;
      margin-top: 2rem;
    }
    button, .btn {
      background: linear-gradient(90deg, #ec4899 0%, #f472b6 100%);
      color: #fff;
      border: none;
      border-radius: 1rem;
      padding: 0.9rem 2.2rem;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 2px 8px 0 rgba(236,72,153,0.08);
      transition: background 0.2s, box-shadow 0.2s;
    }
    button:hover, .btn:hover {
      background: linear-gradient(90deg, #f472b6 0%, #ec4899 100%);
      box-shadow: 0 4px 16px 0 rgba(236,72,153,0.13);
    }
    .grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
    }
    @media (max-width: 700px) {
      form {
        padding: 1.2rem 0.5rem;
      }
      .grid-2 {
        grid-template-columns: 1fr;
        gap: 1rem;
      }
      .seat-options {
        grid-template-columns: 1fr;
      }
    }
    .adventure-block {
      background: #f8fafc;
      border: 2px solid #e9ecef;
      border-radius: 1rem;
      padding: 1.2rem;
      margin-bottom: 1.2rem;
      box-shadow: 0 2px 8px 0 rgba(236,72,153,0.04);
    }
    
    /* NEW CLEANER PROGRESS INDICATOR */
    .progress-tracker {
      display: flex;
      justify-content: space-between;
      position: relative;
      margin-bottom: 3rem;
      counter-reset: step;
    }
    
    .progress-tracker::before {
      content: '';
      position: absolute;
      top: 20px;
      left: 0;
      width: 100%;
      height: 6px;
      background: #e9ecef;
      z-index: 1;
      border-radius: 3px;
    }
    
    .progress-bar {
      position: absolute;
      top: 20px;
      left: 0;
      height: 6px;
      background: linear-gradient(90deg, #ec4899 0%, #f472b6 100%);
      z-index: 2;
      border-radius: 3px;
      transition: width 0.5s ease;
    }
    
    .progress-step {
      position: relative;
      z-index: 3;
      text-align: center;
      width: 80px;
    }
    
    .progress-step::before {
      counter-increment: step;
      content: counter(step);
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: #fff;
      border: 3px solid #e9ecef;
      border-radius: 50%;
      margin: 0 auto 10px;
      font-weight: bold;
      color: #495057;
      transition: all 0.3s ease;
    }
    
    .progress-step.active::before {
      background: #ec4899;
      border-color: #ec4899;
      color: #fff;
      box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.2);
    }
    
    .progress-step.completed::before {
      content: '✓';
      background: #ec4899;
      border-color: #ec4899;
      color: #fff;
    }
    
    .progress-label {
      font-size: 0.85rem;
      font-weight: 600;
      color: #6c757d;
      transition: color 0.3s ease;
    }
    
    .progress-step.active .progress-label,
    .progress-step.completed .progress-label {
      color: #ec4899;
    }
    
    .price-section {
      margin-top: 1.5rem;
      padding-top: 1rem;
      border-top: 2px solid #e9ecef;
    }
    .price-row {
      display: flex;
      justify-content: space-between;
      font-weight: bold;
      font-size: 1.1rem;
    }
    
    /* UPDATED STYLING FOR ACCOMMODATION SECTION TO MATCH FLIGHT SEATS */
    #accommodationTypeGrid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }
    
    #accommodationTypeGrid label {
      border: 2px solid #e9ecef;
      border-radius: 1rem;
      padding: 1rem;
      cursor: pointer;
      transition: all 0.2s;
      background: #f8fafc;
      text-align: center;
      margin-bottom: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    
    #accommodationTypeGrid label:hover {
      border-color: #ec4899;
    }
    
    #accommodationTypeGrid input[type="radio"] {
      display: none;
    }
    
    #accommodationTypeGrid input[type="radio"]:checked + span {
      color: #ec4899;
      font-weight: bold;
    }
    
    #accommodationTypeGrid input[type="radio"]:checked ~ label {
      border-color: #ec4899;
      background-color: #fdf2f8;
    }
    
    /* Apply selected class to the label when radio is checked */
    #accommodationTypeGrid label.selected {
      border-color: #ec4899;
      background-color: #fdf2f8;
    }
    
    #accommodationTypeGrid span {
      display: block;
      font-size: 1rem;
    }
    
    .amenities-section {
      margin-top: 1.5rem;
    }
    
    .amenities-section h5 {
      margin-bottom: 1rem;
      color: #22223b;
      font-weight: 600;
    }
    
    /* UPDATED AMENITIES CHECKBOX STYLING */
    #amenitiesGroup {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }
    
    #amenitiesGroup label {
      border: 2px solid #e9ecef;
      border-radius: 1rem;
      padding: 1rem;
      cursor: pointer;
      transition: all 0.2s;
      background: #f8fafc;
      text-align: center;
      margin-bottom: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    
    #amenitiesGroup label:hover {
      border-color: #ec4899;
    }
    
    #amenitiesGroup input[type="checkbox"] {
      display: none;
    }
    
    #amenitiesGroup input[type="checkbox"]:checked + span {
      color: #ec4899;
      font-weight: bold;
    }
    #vehicleTypeGrid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

#vehicleTypeGrid label {
  border: 2px solid #e9ecef;
  border-radius: 1rem;
  padding: 1rem;
  cursor: pointer;
  transition: all 0.2s;
  background: #f8fafc;
  text-align: center;
  margin-bottom: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

#vehicleTypeGrid label:hover {
  border-color: #ec4899;
}

#vehicleTypeGrid input[type="radio"] {
  display: none;
}

#vehicleTypeGrid input[type="radio"]:checked + span {
  color: #ec4899;
  font-weight: bold;
}

#vehicleTypeGrid input[type="radio"]:checked ~ label {
  border-color: #ec4899;
  background-color: #fdf2f8;
}

/* Apply selected class to the label when radio is checked */
#vehicleTypeGrid label.selected {
  border-color: #ec4899;
  background-color: #fdf2f8;
}

#vehicleTypeGrid span {
  display: block;
  font-size: 1rem;
}

/* Media query for responsiveness */
@media (max-width: 700px) {
  #vehicleTypeGrid {
    grid-template-columns: 1fr;
  }
  .progress-tracker {
    margin-bottom: 2rem;
  }
  .progress-step {
    width: 60px;
  }
  .progress-step::before {
    width: 32px;
    height: 32px;
    font-size: 0.9rem;
  }
  .progress-label {
    font-size: 0.75rem;
  }
}
    
    /* Apply selected style when checkbox is checked */
    #amenitiesGroup input[type="checkbox"]:checked ~ label,
    #amenitiesGroup label.selected {
      border-color: #ec4899;
      background-color: #fdf2f8;
    }
    
    .divider {
      height: 1px;
      background-color: #e9ecef;
      margin: 1.5rem 0;
    }
    
    /* Media query for responsiveness */
    @media (max-width: 700px) {
      #amenitiesGroup,
      #accommodationTypeGrid {
        grid-template-columns: 1fr;
      }
    }
    </style>
</head>
<?php
  include "includes/header.php";
?>

<form id="bookingForm" action="essential_travel_booking.php" method="post" autocomplete="off">
  <!-- NEW PROGRESS INDICATOR -->
  <div class="progress-tracker">
    <div class="progress-bar" style="width: 0%;"></div>
    
    <div class="progress-step" id="step-indicator-0">
      <div class="progress-label">Flight Info</div>
    </div>
  </div>

  <div id="step-0" class="form-step">
    <?php include "package-components/flight_info.php"; ?>
  </div>

  <div class="button-group">
    <button type="button" id="prevBtn" style="display:none;">Previous</button>
    <button type="button" id="nextBtn">Next</button>
    <button type="submit" id="submitBtn" style="display:none;">Book Now</button>
  </div>
</form>

<script>
const steps = Array.from(document.querySelectorAll('.form-step'));
const indicators = [
  document.getElementById('step-indicator-0')
];
const progressBar = document.querySelector('.progress-bar');
let currentStep = 0;

function showStep(n) {
  steps.forEach((step, idx) => {
    step.style.display = idx === n ? '' : 'none';
    indicators[idx].classList.remove('active', 'completed');
    if (idx < n) indicators[idx].classList.add('completed');
    if (idx === n) indicators[idx].classList.add('active');
  });
  
  // Update progress bar
  const progressPercent = (n / (steps.length - 1)) * 100;
  progressBar.style.width = `${progressPercent}%`;
  
  document.getElementById('prevBtn').style.display = n === 0 ? 'none' : '';
  document.getElementById('nextBtn').style.display = n === steps.length - 1 ? 'none' : '';
  document.getElementById('submitBtn').style.display = n === steps.length - 1 ? '' : 'none';
}
showStep(currentStep);

document.getElementById('nextBtn').onclick = function() {
  if (currentStep < steps.length - 1) {
    currentStep++;
    showStep(currentStep);
  }
};
document.getElementById('prevBtn').onclick = function() {
  if (currentStep > 0) {
    currentStep--;
    showStep(currentStep);
  }
};

// Dynamic adventure activities
document.addEventListener('DOMContentLoaded', function() {
  const numActivitiesInput = document.getElementById('numActivities');
  if (numActivitiesInput) {
    numActivitiesInput.addEventListener('change', function() {
      const container = document.getElementById('activitiesContainer');
      container.innerHTML = '';
      const num = parseInt(this.value);
      for (let i = 0; i < num; i++) {
        container.innerHTML += `
        <div class="adventure-block">
            <h5>Adventure ${i+1}</h5>
            <label>Activity</label>
            <input type="text" name="activities[${i}][name]" required>
            <label>Date</label>
            <input type="date" name="activities[${i}][date]" required>
            <label>Participants</label>
            <input type="number" name="activities[${i}][participants]" min="1" required>
            <label>Price per Person ($)</label>
            <input type="number" name="activities[${i}][price]" min="0" step="0.01" required>
            <label>Interests</label><br>
            <div class="checkbox-group">
              <label><input type="checkbox" name="activities[${i}][interests][]" value="Nature"><span>Nature</span></label>
              <label><input type="checkbox" name="activities[${i}][interests][]" value="Adventure"><span>Adventure</span></label>
              <label><input type="checkbox" name="activities[${i}][interests][]" value="Culture"><span>Culture</span></label>
              <label><input type="checkbox" name="activities[${i}][interests][]" value="Relaxation"><span>Relaxation</span></label>
            </div>
        </div>`;
      }
    });
  }
});
</script>

<?php include "includes/footer.php"; ?>