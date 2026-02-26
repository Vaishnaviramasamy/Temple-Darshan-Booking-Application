<?php
session_start();
include 'db_connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rejected Darshan Bookings</title>
</head>
<body>
    <h2>❌ Rejected Darshan Bookings</h2>
    <table border="1" cellpadding="10" cellspacing="0">
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
                <th>Total ₹</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM bookings WHERE status='Rejected' ORDER BY id DESC");
            while ($row = mysqli_fetch_assoc($result)) {
                $amount = 150;
                if ($row['vehicle_parking'] === 'Yes') $amount += 50;
                if ($row['archanai_token'] === 'Yes') $amount += 50;

                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['temple_id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['temple_time']}</td>
                    <td>{$row['vehicle_parking']}</td>
                    <td>{$row['archanai_token']}</td>
                    <td>{$row['darshan_date']}</td>
                    <td style='color:red;font-weight:bold;'>Rejected</td>
                    <td>₹{$amount}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
