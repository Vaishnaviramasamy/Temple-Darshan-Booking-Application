<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['user_name'];
  $festival = $_POST['festival_name'];
  $date = $_POST['festival_date'];
  $amount = $_POST['amount'];

  // Save to DB or proceed to payment gateway here...

  echo "<h2>🙏 Thank you, $name!</h2>";
  echo "<p>You have successfully booked <strong>$festival</strong> on <strong>$date</strong>.</p>";
  echo "<p>Total paid: ₹$amount</p>";
  echo "<a href='festivals.php'>← Back to Festivals</a>";
}
?>
