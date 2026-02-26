<?php
include("connection.php");

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

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="DonationReceipt_' . $donation_id . '.txt"');

echo "Temple Donation Receipt\n";
echo "-----------------------\n";
echo "Donation ID: " . $donation_id . "\n";
echo "Name: " . $donation['name'] . "\n";
echo "Amount: ₹" . number_format($donation['amount'], 2) . "\n";
echo "Donation Type: " . $donation['type'] . "\n";
if ($donation['type'] === 'Adopt a Day' && !empty($donation['adopt_date'])) {
    echo "Adopted Date: " . $donation['adopt_date'] . "\n";
}
if (!empty($donation['occasion'])) {
    echo "Occasion / Reason: " . $donation['occasion'] . "\n";
}
echo "Donated At: " . $donation['donated_at'] . "\n";

echo "\nThank you for your generous contribution!\n";
?>
