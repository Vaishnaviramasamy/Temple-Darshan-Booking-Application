<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirmed"])) {
    $name = $_POST["name"] ?? '';
    $temple = $_POST["temple"] ?? '';
    $time = $_POST["time"] ?? '';
    $persons = $_POST["persons"] ?? '';
    $date = $_POST["date"] ?? '';
    // Convert parking and archanai to 1 or 0 properly
    $parking = isset($_POST["parking"]) && $_POST["parking"] == "1" ? 1 : 0;
    $archanai = isset($_POST["archanai"]) && $_POST["archanai"] == "1" ? 1 : 0;
    $total = $_POST["total"] ?? '';

    // Connect to database
    $conn = new mysqli("localhost", "root", "", "temple");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare insert statement
    $stmt = $conn->prepare("INSERT INTO new_booking (user_name, temple_name, darshan_time, darshan_date, number_of_persons, vehicle_parking, archanai_token, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiiis", $name, $temple, $time, $date, $persons, $parking, $archanai, $total);

    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Your existing success message output
    echo "<h2 style='text-align:center; margin-top:100px;'>🎉 Payment Successful!</h2>";
    echo "<h3 style='text-align:center;'>Please download your receipt by clicking below</h3>";
    echo "<p style='text-align:center;'>Thank you, " . htmlspecialchars($name) . ". Your darshan on " . htmlspecialchars($date) . " has been booked.</p>";
    echo "<p style='text-align:center;'>Total Paid: ₹" . htmlspecialchars($total) . "</p>";
    echo "<p style='text-align:center;'><a href='dashboard.php'><button>Back to Dashboard</button></a></p>";

    echo "<p style='text-align:center;'>
        <a href='generate_pdf.php?" .
        "name=" . urlencode($name) .
        "&temple=" . urlencode($temple) .
        "&time=" . urlencode($time) .
        "&date=" . urlencode($date) .
        "&persons=" . urlencode($persons) .
        "&parking=" . urlencode($parking) .
        "&archanai=" . urlencode($archanai) .
        "&total=" . urlencode($total) . "' target='_blank'>
        <button>📄 Download Receipt</button></a></p>";

    exit();
}

// Initial Payment Page
$name = $_POST["name"] ?? '';
$temple = $_POST["temple"] ?? '';
$time = $_POST["time"] ?? '';
$persons = $_POST["persons"] ?? '';
$date = $_POST["date"] ?? '';
$parking = $_POST["parking"] ?? '';
$archanai = $_POST["archanai"] ?? '';
$total = $_POST["total"] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Scan & Pay</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f7;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .qr-box {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            width: 480px;
        }
        .qr-box img {
            width: 220px;
            height: auto;
            margin-top: 15px;
        }
        .qr-box h2 {
            color: #111;
            margin-bottom: 20px;
        }
        .qr-box p {
            font-size: 15px;
            margin: 6px 0;
        }
        .amount {
            color: green;
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
        }
        button {
            margin-top: 25px;
            padding: 12px 30px;
            font-size: 16px;
            background: #2ecc71;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background: #27ae60;
        }
    </style>
</head>
<body>
<div class="qr-box">
    <h2>Scan to Pay via UPI</h2>
    <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
    <p><strong>Temple:</strong> <?= htmlspecialchars($temple) ?></p>
    <p><strong>Time:</strong> <?= htmlspecialchars($time) ?></p>
    <p><strong>Date:</strong> <?= htmlspecialchars($date) ?> | <strong>Persons:</strong> <?= htmlspecialchars($persons) ?></p>
    <p><strong>Vehicle Parking:</strong> <?= $parking ? "Yes (+₹50)" : "No" ?></p>
    <p><strong>Archanai Token:</strong> <?= $archanai ? "Yes (+₹70)" : "No" ?></p>
    <p class="amount">Total: ₹<?= htmlspecialchars($total) ?></p>
    <img src="your-qr-image.png" alt="UPI QR Code">

    <form method="POST">
        <?php foreach ($_POST as $key => $value): ?>
            <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
        <?php endforeach; ?>
        <input type="hidden" name="confirmed" value="1">
        <button type="submit">✅ I Have Paid</button>
    </form>
</div>
</body>
</html>
