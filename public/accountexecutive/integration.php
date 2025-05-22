<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #34495e;
      color: #fff;
      padding: 1rem;
      text-align: center;
    }
    .container {
      max-width: 1200px;
      margin: auto;
      padding: 2rem;
    }
    .section {
      background: #fff;
      border-radius: 8px;
      padding: 1.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .section h2 {
      margin-top: 0;
      color: #2c3e50;
    }
    label {
      display: block;
      margin-top: 1rem;
    }
    input, select, textarea {
      width: 100%;
      padding: 0.5rem;
      margin-top: 0.5rem;
    }
    button {
      margin-top: 1rem;
      padding: 0.6rem 1.2rem;
      background-color: #27ae60;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: #2ecc71;
    }
    .summary {
      background: #ecf0f1;
      padding: 1rem;
      margin-top: 1rem;
      border-radius: 6px;
    }
  </style>
</head>
<body>

<div class="container">
  <!-- Start Inquiry Process -->
  <div class="section">
    <h2>1. Receive and Check Inquiry</h2>
    <label>Client Name:</label>
    <input type="text" id="clientName" />

    <label>Requested Tour:</label>
    <select id="tourSelect">
      <option value="Bali Experience">Bali Experience</option>
      <option value="Paris Getaway">Paris Getaway</option>
      <option value="Tokyo Explorer">Tokyo Explorer</option>
    </select>

    <label>Travel Dates:</label>
    <input type="text" id="travelDates" placeholder="e.g. July 1 - July 5" />

    <button onclick="checkInquiry()">Check Inquiry</button>
  </div>

  <!-- Prepare Proposal -->
  <div class="section" id="proposalSection" style="display:none;">
    <h2>2. Prepare Proposal</h2>
    <label>Choose Hotel:</label>
    <select id="hotelOption">
      <option value="Hotel Lux">Hotel Lux</option>
      <option value="Sunrise Resort">Sunrise Resort</option>
    </select>

    <label>Choose Transport:</label>
    <select id="transportOption">
      <option value="Private Van">Private Van</option>
      <option value="Shuttle Bus">Shuttle Bus</option>
    </select>

    <label>Price Estimate:</label>
    <input type="text" id="priceEstimate" placeholder="$1000" />

    <button onclick="reviewProposal()">Review Proposal</button>
  </div>

  <!-- Review & Approve -->
  <div class="section" id="reviewSection" style="display:none;">
    <h2>3. Review & Approve Proposal</h2>
    <p>The client has reviewed the proposal.</p>
    <button onclick="approveProposal()">Approve Proposal</button>
    <button onclick="rejectProposal()">Reject Proposal</button>
  </div>

  <!-- Booking Process -->
  <div class="section" id="bookingSection" style="display:none;">
    <h2>4. Booking Process (Core 1 Integration)</h2>
    <p>Book hotel and transport automatically.</p>
    <button onclick="processBooking()">Book Tour</button>
  </div>

  <!-- Visa / CRM -->
  <div class="section" id="postBookingSection" style="display:none;">
    <h2>5. Post-Booking: Visa Processing and CRM (Core 2 Integration)</h2>
    <label>Need Passport/Visa?</label>
    <select id="visaRequired">
      <option value="Yes">Yes</option>
      <option value="No">No</option>
    </select>

    <label>CRM Notes</label>
    <textarea id="crmNotes"></textarea>

    <button onclick="sendConfirmation()">Send Confirmation</button>
  </div>

  <!-- Summary -->
  <div class="section" id="summarySection" style="display:none;">
    <h2>Process Summary</h2>
    <div class="summary" id="summaryText"></div>
  </div>
</div>

<script>
  function checkInquiry() {
    document.getElementById('proposalSection').style.display = 'block';
  }

  function reviewProposal() {
    document.getElementById('reviewSection').style.display = 'block';
  }

  function approveProposal() {
    document.getElementById('bookingSection').style.display = 'block';
  }

  function rejectProposal() {
    alert('Proposal Rejected. Returning to Start.');
    location.reload();
  }

  function processBooking() {
    document.getElementById('postBookingSection').style.display = 'block';
  }

  function sendConfirmation() {
    const client = document.getElementById('clientName').value;
    const tour = document.getElementById('tourSelect').value;
    const hotel = document.getElementById('hotelOption').value;
    const transport = document.getElementById('transportOption').value;
    const price = document.getElementById('priceEstimate').value;
    const visa = document.getElementById('visaRequired').value;
    const notes = document.getElementById('crmNotes').value;

  } 