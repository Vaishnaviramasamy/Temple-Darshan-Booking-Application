<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $temple = $_POST["temple"];
    $time = $_POST["time"];
    $persons = $_POST["persons"];
    $date = $_POST["date"];
    $parking = $_POST["parking"];
    $archanai = $_POST["archanai"];
    $total = $_POST["total"];
} else {
    header("Location: booking_form.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f7;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .payment-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            width: 500px;
        }
        .amount {
            font-size: 20px;
            font-weight: bold;
            color: green;
            margin-top: 10px;
        }
        button {
            margin-top: 20px;
            padding: 12px 30px;
            font-size: 16px;
            background: #2ecc71;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="payment-box">
    <h2>Confirm and Pay</h2>
    <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
    <p><strong>Temple:</strong> <?= htmlspecialchars($temple) ?></p>
    <p><strong>Time:</strong> <?= htmlspecialchars($time) ?></p>
    <p><strong>Persons:</strong> <?= htmlspecialchars($persons) ?></p>
    <p><strong>Date:</strong> <?= htmlspecialchars($date) ?></p>
    <p><strong>Vehicle Parking:</strong> <?= $parking ? "Yes (+₹50)" : "No" ?></p>
    <p><strong>Archanai Token:</strong> <?= $archanai ? "Yes (+₹70)" : "No" ?></p>
    <p class="amount">Total: ₹<?= htmlspecialchars($total) ?></p>

    <form action="process_payment.php" method="POST">
        <?php foreach ($_POST as $key => $value): ?>
            <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
        <?php endforeach; ?>
        <button type="submit">✅ Proceed to payment </button>
    </form>
</div>
</body>
</html>
