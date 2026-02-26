<?php
session_start();
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Devotee';
date_default_timezone_set("Asia/Kolkata");
$time = date("h:i:s A");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Darshan360 – Devotee Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('temple2.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #333;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    body.dark-mode {
      background-color: #121212;
      color: #f1f1f1;
    }

    .sidebar {
      position: fixed;
      width: 240px;
      height: 100vh;
      background: rgba(0,0,0,0.8);
      color: #fff;
      padding-top: 25px;
      transition: all 0.3s ease;
      backdrop-filter: blur(5px);
    }

    .sidebar h2 {
      text-align: center;
      font-size: 24px;
      margin-bottom: 25px;
    }

    .sidebar a {
      display: block;
      padding: 15px 30px;
      color: #fff;
      text-decoration: none;
      font-size: 16px;
      transition: background 0.2s;
    }

    .sidebar a:hover {
      background: rgba(255,255,255,0.1);
    }

    .main {
      margin-left: 240px;
      padding: 30px;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: rgba(255,255,255,0.9);
      padding: 20px;
      border-radius: 12px;
      margin-bottom: 30px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .header.dark-mode {
      background: rgba(30,30,30,0.9);
    }

    .welcome {
      font-size: 22px;
      font-weight: 600;
    }

    .time {
      font-size: 16px;
      color: #d6336c;
    }

    .toggle-mode {
      cursor: pointer;
      padding: 6px 14px;
      border-radius: 20px;
      background: #4e54c8;
      color: #fff;
      font-size: 14px;
      border: none;
    }

    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
      gap: 20px;
    }

    .card {
      background: rgba(255,255,255,0.95);
      padding: 25px;
      border-radius: 15px;
      text-decoration: none;
      color: #333;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      transition: transform 0.2s ease;
      position: relative;
    }

    .card.dark-mode {
      background: rgba(40,40,40,0.9);
      color: #f1f1f1;
    }

    .card:hover {
      transform: scale(1.03);
    }

    .card h3 {
      font-size: 20px;
      margin-bottom: 8px;
    }

    .card p {
      font-size: 14px;
    }

    .card i {
      position: absolute;
      top: 20px;
      right: 20px;
      font-size: 24px;
      color: #4e54c8;
    }

    @media screen and (max-width: 768px) {
      .sidebar {
        width: 100px;
      }

      .sidebar h2 {
        font-size: 16px;
      }

      .sidebar a {
        font-size: 14px;
        padding: 12px 10px;
        text-align: center;
      }

      .main {
        margin-left: 100px;
        padding: 20px;
      }

      .welcome {
        font-size: 18px;
      }
    }
  </style>
</head>
<body>

<div class="sidebar">
  <h2><i class="fa-solid fa-person-praying"></i> Devotee</h2>
  <a href="new_booking.php"><i class="fa fa-plus-circle"></i> New Booking</a>
  <a href="donation.php"><i class="fa fa-hand-holding-heart"></i> Donation</a>
  <a href="festival.php"><i class="fa fa-fan"></i> Festival</a>
  <a href="reports.php"><i class="fa fa-chart-line"></i> Reports</a>
  <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
</div>

<div class="main">
  <div class="header" id="header">
    <div class="welcome">🙏 Welcome, <?php echo htmlspecialchars($userName); ?></div>
    <div>
      <span class="time">⏰ <?php echo $time; ?></span>
      <button class="toggle-mode" onclick="toggleMode()">🌗 Toggle Mode</button>
    </div>
  </div>

  <div class="cards">
    <a href="new_booking.php" class="card" id="card1">
      <i class="fa fa-praying-hands"></i>
      <h3>New Darshan</h3>
      <p>Book your next temple darshan</p>
    </a>
    
    <a href="donation.php" class="card" id="card3">
      <i class="fa fa-donate"></i>
      <h3>Offer Donation</h3>
      <p>Support your temple</p>
    </a>
    <a href="festival.php" class="card" id="card4">
      <i class="fa fa-calendar-day"></i>
      <h3>Festivals</h3>
      <p>Upcoming temple events</p>
    </a>
    <a href="reports.php" class="card" id="card6">
      <i class="fa fa-chart-pie"></i>
      <h3>Reports</h3>
      <p>View your devotional activity</p>
    </a>
  </div>
</div>

<script>
  function toggleMode() {
    document.body.classList.toggle("dark-mode");
    document.getElementById("header").classList.toggle("dark-mode");
    for (let i = 1; i <= 6; i++) {
      document.getElementById("card" + i).classList.toggle("dark-mode");
    }
  }
</script>

</body>
</html>
