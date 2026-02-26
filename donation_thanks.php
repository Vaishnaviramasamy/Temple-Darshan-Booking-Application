<?php
include("connection.php");
session_start();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request.");
}

$donation_id = intval($_GET['id']);

// Fetch donation details
$query = mysqli_query($conn, "SELECT * FROM donations WHERE id = $donation_id");
if (mysqli_num_rows($query) == 0) {
    die("Donation not found.");
}

$donation = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Your Donation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f6f2;
            padding: 30px;
            text-align: center;
        }
        .thanks-box {
            background: white;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
        }
        h1 {
            color: #3c3b6e;
        }
        p {
            font-size: 18px;
            margin: 10px 0;
        }
        button {
            background: #3c3b6e;
            color: white;
            border: none;
            padding: 12px 25px;
            margin: 15px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #2c2a5e;
        }
    </style>
</head>
<body>

<div class="thanks-box">
    <h1>Thank You for Your Generous Donation!</h1>
    <p><strong>Name:</strong> <?= htmlspecialchars($donation['name']) ?></p>
    <p><strong>Amount:</strong> ₹<?= number_format($donation['amount'], 2) ?></p>
    <p><strong>Donation Type:</strong> <?= htmlspecialchars($donation['type']) ?></p>
    <?php if ($donation['type'] === 'Adopt a Day'): ?>
        <p><strong>Adopted Date:</strong> <?= htmlspecialchars($donation['adopt_date']) ?></p>
    <?php endif; ?>
    <?php if (!empty($donation['occasion'])): ?>
        <p><strong>Occasion / Reason:</strong> <?= htmlspecialchars($donation['occasion']) ?></p>
    <?php endif; ?>

    <button onclick="window.location.href='dashboard.php'">Back to Dashboard</button>
    <button onclick="window.location.href='download_receipt.php?id=<?= $donation_id ?>'">Download Receipt</button>
</div>

</body>
</html>
