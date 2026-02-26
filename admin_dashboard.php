<?php
session_start();
$adminName = 'Admin';
date_default_timezone_set("Asia/Kolkata");
$time = date("h:i:s A");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Kalam&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #f3e7e9, #e3eeff);
            overflow-x: hidden;
        }

        .sidebar {
            position: fixed;
            width: 240px;
            height: 100%;
            background: linear-gradient(#2b1055, #7597de);
            color: white;
            padding-top: 30px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            text-align: center;
            font-family: 'Kalam', cursive;
            font-size: 24px;
            margin-bottom: 40px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: white;
            font-size: 16px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .main {
            margin-left: 240px;
            padding: 30px;
        }

        .header {
            background: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .header .welcome {
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        .header .time {
            color: #d10000;
            font-weight: bold;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #333;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card i {
            font-size: 30px;
            margin-bottom: 10px;
            color: #2b1055;
        }

        .card h3 {
            margin: 10px 0 5px;
            font-size: 20px;
        }

        .card p {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>🛕 Admin Panel</h2>
    <a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="new_darshan.php"><i class="fas fa-calendar-plus"></i> New Darshan Booking</a>
    <a href="vehicle_parking.php"><i class="fas fa-car"></i> Vehicle Parking</a>
    <a href="archanai_token.php"><i class="fas fa-ticket-alt"></i> Archanai Token</a>
    <a href="festival_a.php"><i class="fas fa-fire"></i> Festivals</a>
    <a href="donations.php"><i class="fas fa-donate"></i> Donations</a>
    <a href="devotees.php"><i class="fas fa-users"></i> Devotees</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="main">
    <div class="header">
        <div class="welcome">Welcome, <?php echo htmlspecialchars($adminName); ?>!</div>
        <div class="time">Time: <?php echo $time; ?></div>
    </div>

    <div class="cards">
        <a href="new_darshan.php" class="card">
            <i class="fas fa-calendar-check"></i>
            <h3>New Darshan Booking</h3>
            <p>View and manage booking requests.</p>
        </a>
        
        
        <a href="vehicle_parking.php" class="card">
            <i class="fas fa-car-side"></i>
            <h3>Vehicle Parking</h3>
            <p>Manage parking slots and bookings.</p>
        </a>

        <a href="archanai_token.php" class="card">
            <i class="fas fa-ticket-alt"></i>
            <h3>Archanai Token</h3>
            <p>Handle token requests and scheduling.</p>
        </a>

        
        <a href="festival_a.php" class="card">
            <i class="fas fa-fire"></i>
            <h3>Festivals</h3>
            <p>Manage festival events.</p>
        </a>

        <a href="donations.php" class="card">
            <i class="fas fa-hand-holding-heart"></i>
            <h3>Donations</h3>
            <p>View donation records.</p>
        </a>

        <a href="devotees.php" class="card">
            <i class="fas fa-users"></i>
            <h3>Devotees</h3>
            <p>Manage devotee registrations.</p>
        </a>
    </div>
</div>

</body>
</html>
