<?php
// Connect to DB
$conn = new mysqli("localhost", "root", "", "temple");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get posted data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['user_name'] ?? '';
  $phone = $_POST['phone_number'] ?? '';
  $temple = $_POST['temple_name'] ?? '';
  $festival = $_POST['festival_name'] ?? '';
  $date = $_POST['festival_date'] ?? '';
  $amount = $_POST['amount'] ?? 200;

  // Save to DB
  $stmt = $conn->prepare("INSERT INTO festival_bookings (user_name, phone_number, temple_name, festival_name, festival_date, amount_paid)
                          VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssi", $name, $phone, $temple, $festival, $date, $amount);
  $stmt->execute();
  $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Booking Confirmation</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #fbe9e7, #f3e5f5);
      padding: 40px;
      text-align: center;
    }

    .card {
      max-width: 500px;
      margin: auto;
      background: white;
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      padding: 30px;
    }

    .card h2 {
      color: #4a148c;
      margin-bottom: 20px;
    }

    .card p {
      font-size: 16px;
      margin: 10px 0;
      color: #333;
    }

    .highlight {
      color: #6a1b9a;
      font-weight: bold;
    }

    .back-button {
      margin-top: 25px;
      display: inline-block;
      padding: 10px 20px;
      background: #8e24aa;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 500;
    }

    .back-button:hover {
      background: #6a1b9a;
    }
  </style>
</head>
<body>

<div class="card">
  <h2>✅ Booking Confirmed!</h2>
  <p><strong>Name:</strong> <span class="highlight"><?= htmlspecialchars($name) ?></span></p>
  <p><strong>Phone:</strong> <span class="highlight"><?= htmlspecialchars($phone) ?></span></p>
  <p><strong>Temple:</strong> <span class="highlight"><?= htmlspecialchars($temple) ?></span></p>
  <p><strong>Festival:</strong> <span class="highlight"><?= htmlspecialchars($festival) ?></span></p>
  <p><strong>Date:</strong> <span class="highlight"><?= htmlspecialchars($date) ?></span></p>
  <p><strong>Amount Paid:</strong> <span class="highlight">₹<?= htmlspecialchars($amount) ?></span></p>

  <a class="back-button" href="festivals.php">← Book Another Festival</a>


<form action="generate_pdf.php" method="POST" target="_blank">
  <input type="hidden" name="user_name" value="<?= htmlspecialchars($name) ?>">
  <input type="hidden" name="phone_number" value="<?= htmlspecialchars($phone) ?>">
  <input type="hidden" name="temple_name" value="<?= htmlspecialchars($temple) ?>">
  <input type="hidden" name="festival_name" value="<?= htmlspecialchars($festival) ?>">
  <input type="hidden" name="festival_date" value="<?= htmlspecialchars($date) ?>">
  <input type="hidden" name="amount" value="<?= htmlspecialchars($amount) ?>">
  <button class="back-button" type="submit">🧾 Download PDF Receipt</button>
</form>
</div>
</body>
</html>
