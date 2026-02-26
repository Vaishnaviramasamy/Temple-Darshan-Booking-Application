<?php
session_start();
include 'db_connection.php';

// Make sure the user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['user_email'];

// Get user's bookings
$query = "SELECT * FROM bookings WHERE email = '$user_email' ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Booking Status</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            border: 1px solid #444;
            padding: 10px;
            text-align: center;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>Your Darshan Booking Status</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Temple ID</th>
            <th>Name</th>
            <th>Time</th>
            <th>Parking</th>
            <th>Archanai</th>
            <th>Date</th>
            <th>Status</th>
            <th>Total Payment</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $total = 150;
            if ($row['vehicle_parking'] == 'Yes') $total += 50;
            if ($row['archanai_token'] == 'Yes') $total += 50;

            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['temple_id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['temple_time']}</td>
                    <td>{$row['vehicle_parking']}</td>
                    <td>{$row['archanai_token']}</td>
                    <td>{$row['darshan_date']}</td>
                    <td>{$row['status']}</td>
                    <td>₹$total</td>
                </tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
