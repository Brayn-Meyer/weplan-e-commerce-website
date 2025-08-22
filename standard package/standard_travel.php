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
    }
    .adventure-block {
      background: #f8fafc;
      border: 2px solid #e9ecef;
      border-radius: 1rem;
      padding: 1.2rem;
      margin-bottom: 1.2rem;
      box-shadow: 0 2px 8px 0 rgba(236,72,153,0.04);
    }
    .booking-steps {
      display: flex;
      justify-content: space-between;
      margin-bottom: 2rem;
      gap: 10px;
    }
    .booking-steps .step {
      flex: 1;
      text-align: center;
      position: relative;
      padding-bottom: 10px;
    }
    .booking-steps .step span {
      display: inline-block;
      width: 32px;
      height: 32px;
      line-height: 32px;
      border-radius: 50%;
      background: #e9ecef;
      color: #495057;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .booking-steps .step.completed span,
    .booking-steps .step.active span {
      background: #ec4899;
      color: #fff;
    }
    .booking-steps .step.completed p,
    .booking-steps .step.active p {
      color: #ec4899;
      font-weight: bold;
    }
    .booking-steps .step:not(:last-child)::after {
      content: '';
      position: absolute;
      top: 16px;
      right: -50%;
      width: 100%;
      height: 4px;
      background: #e9ecef;
      z-index: 0;
    }
    .booking-steps .step.completed:not(:last-child)::after,
    .booking-steps .step.active:not(:last-child)::after {
      background: #ec4899;
    }
    .booking-steps .step p {
      margin: 0;
      font-size: 0.95rem;
    }
    </style>
</head>

<?php
include "includes/header.php";
?>

<form id="bookingForm" action="standard package/standard_travel_booking.php" method="post" autocomplete="off">
  <div class="booking-steps">
    <div class="step" id="step-indicator-0"><span>1</span><p>Flight Info</p></div>
    <div class="step" id="step-indicator-1"><span>2</span><p>Accommodation</p></div>
  </div>

  <div id="step-0" class="form-step">
    <?php include "package components/flight_info.php"; ?>
  </div>
  <div id="step-1" class="form-step" style="display:none;">
    <?php include "package components/accomodation_info.php"; ?>
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
  document.getElementById('step-indicator-0'),
  document.getElementById('step-indicator-1')
];
let currentStep = 0;

function showStep(n) {
  steps.forEach((step, idx) => {
    step.style.display = idx === n ? '' : 'none';
    indicators[idx].classList.remove('active', 'completed');
    if (idx < n) indicators[idx].classList.add('completed');
    if (idx === n) indicators[idx].classList.add('active');
  });
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