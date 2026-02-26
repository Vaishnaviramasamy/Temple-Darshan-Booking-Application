<?php
session_start();
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Devotee';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Palamalai Murugan Temple Festival Booking</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 20px;
      background: linear-gradient(to right, #ffe6cc, #ffb366);
    }
    h2 {
      text-align: center;
      color: #cc3300;
      margin-bottom: 40px;
    }
    .festival-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 10px;
    }
    .card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      padding: 20px;
      position: relative;
      transition: 0.3s;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card h3 {
      color: #cc3300;
      margin: 0 0 10px;
    }
    .card p {
      font-size: 14px;
      color: #444;
    }
    .card .date {
      font-weight: bold;
      margin-top: 10px;
      color: #cc3300;
    }
    .card button {
      margin-top: 15px;
      background: #cc3300;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.2s;
    }
    .card button:hover {
      background: #992600;
    }
    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 10;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.5);
      align-items: center;
      justify-content: center;
    }
    .modal-content {
      background: white;
      padding: 25px;
      border-radius: 10px;
      width: 90%;
      max-width: 400px;
    }
    .modal-content h4 {
      margin-top: 0;
      color: #cc3300;
    }
    .modal-content input, .modal-content select {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    .modal-content button {
      width: 100%;
      padding: 10px;
      background: #cc3300;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }
    .close-btn {
      float: right;
      font-size: 18px;
      cursor: pointer;
      color: #992600;
    }
  </style>
</head>
<body>

<h2>🌺 Book Your Festival Participation at Palamalai Murugan Temple 🌺</h2>

<div class="festival-grid">
  <?php
  // Major Murugan Festivals
  $festivals = [
    ["Skanda Sashti", "November 8-14, 2025", "Six-day fasting & victory of Murugan over demon Surapadman"],
    ["Thaipusam", "January 26, 2025", "Devotees carry kavadis & offer prayers to Lord Murugan"],
    ["Panguni Uthiram", "April 6, 2025", "Divine wedding of Murugan and Deivanai"],
    ["Vaikasi Visakam", "June 3, 2025", "Birthday celebration of Lord Murugan"],
    ["Kanda Shasti Kavasam Day", "November 10, 2025", "Recitation of the protective hymn to Lord Murugan"],
    ["Aadi Kiruthigai", "July 22, 2025", "Special poojas for Murugan on the Kiruthigai star"]
  ];

  foreach ($festivals as $fest) {
    echo "
      <div class='card'>
        <h3>{$fest[0]}</h3>
        <p>{$fest[2]}</p>
        <div class='date'>📅 {$fest[1]}</div>
        <button onclick=\"openModal('{$fest[0]}', '{$fest[1]}')\">Book Now</button>
      </div>
    ";
  }
  ?>
</div>

<!-- Booking Modal -->
<div class="modal" id="bookingModal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">×</span>
    <h4>📿 Book Festival Participation</h4>
    <form action="book_festival.php" method="POST">
      <input type="hidden" name="festival_name" id="festivalName" />
      <input type="hidden" name="festival_date" id="festivalDate" />
      <label>Your Name:</label>
      <input type="text" name="user_name" placeholder="Enter Your Name" required />
      <label>Phone Number:</label>
      <input type="text" name="phone_number" placeholder="Enter Your Phone Number" required />
      <label>Select Temple:</label>
      <select name="temple" required>
        <option value="Palamalai Murugan Temple">Palamalai Murugan Temple</option>
      </select>
      <button type="submit">Confirm Booking</button>
    </form>
  </div>
</div>

<script>
  function openModal(festival, date) {
    document.getElementById("festivalName").value = festival;
    document.getElementById("festivalDate").value = date;
    document.getElementById("bookingModal").style.display = "flex";
  }
  function closeModal() {
    document.getElementById("bookingModal").style.display = "none";
  }
  window.onclick = function(event) {
    if (event.target == document.getElementById("bookingModal")) {
      closeModal();
    }
  }
</script>

</body>
</html>
