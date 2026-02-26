<?php
include 'db.php';

header('Content-Type: application/json');

$date = $_GET['date'] ?? '';
$time = $_GET['time'] ?? '';

if (!$date || !$time) {
    echo json_encode(['error' => 'Missing date or time']);
    exit;
}

try {
    // Prepare and execute query to sum persons for given date and time
    $stmt = $conn->prepare("SELECT IFNULL(SUM(persons), 0) as total FROM booking_details WHERE date = ? AND time = ?");
    $stmt->bind_param("ss", $date, $time);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    $booked = $row['total'] ?? 0;

    echo json_encode(['booked' => $booked]);

} catch (Exception $e) {
    echo json_encode(['error' => 'Database error']);
}
?>
