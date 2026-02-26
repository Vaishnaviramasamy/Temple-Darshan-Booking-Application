<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temple";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM new_booking ORDER BY booked_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Temple Bookings Dashboard</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto&display=swap');

  body {
    margin: 0;
    background: linear-gradient(135deg, #89f7fe 0%, #66a6ff 100%);
    font-family: 'Poppins', sans-serif;
    color: #222;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 40px 20px;
  }

  .container {
    max-width: 1200px;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    padding: 40px 50px;
    width: 100%;
    overflow-x: auto;
  }

  h2 {
    font-weight: 600;
    font-size: 2.8rem;
    background: linear-gradient(90deg, #007CF0, #00DFD8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 30px;
    text-align: center;
  }

  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 12px;
    font-family: 'Roboto', sans-serif;
  }

  thead th {
    background: #007CF0;
    color: #fff;
    padding: 18px 20px;
    text-transform: uppercase;
    font-weight: 600;
    font-size: 0.85rem;
    letter-spacing: 1px;
    border-radius: 12px 12px 0 0;
  }

  tbody tr {
    background: #f9fbff;
    box-shadow: 0 3px 8px rgba(0,123,240,0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px;
  }
  tbody tr:hover {
    transform: scale(1.02);
    box-shadow: 0 10px 30px rgba(0,123,240,0.3);
    cursor: default;
  }

  tbody td {
    padding: 16px 18px;
    text-align: center;
    font-size: 1rem;
    vertical-align: middle;
    border-top: 1px solid #e6ecf8;
  }

  tbody tr:not(:last-child) td {
    border-bottom: none;
  }

  /* Badge styles */
  .badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 12px;
    font-weight: 600;
    font-size: 0.9rem;
    border-radius: 20px;
    user-select: none;
    gap: 6px;
  }

  .yes {
    background: #27ae60;
    color: white;
  }
  .no {
    background: #e74c3c;
    color: white;
  }

  .yes svg, .no svg {
    width: 16px;
    height: 16px;
  }

  /* Responsive */
  @media (max-width: 900px) {
    .container {
      padding: 30px 20px;
    }
    table {
      font-size: 0.9rem;
    }
  }

  @media (max-width: 600px) {
    table, thead, tbody, th, td, tr {
      display: block;
    }
    thead tr {
      display: none;
    }
    tbody tr {
      margin-bottom: 20px;
      box-shadow: none;
      border-radius: 0;
      background: transparent;
      transform: none !important;
    }
    tbody td {
      padding-left: 50%;
      position: relative;
      text-align: left;
      border: none;
      border-bottom: 1px solid #ddd;
    }
    tbody td::before {
      content: attr(data-label);
      position: absolute;
      left: 20px;
      top: 16px;
      font-weight: 600;
      color: #555;
    }
  }
</style>
</head>
<body>
<div class="container">
  <h2>📋 Temple Bookings Dashboard</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Temple</th>
        <th>Date</th>
        <th>Time</th>
        <th>Persons</th>
        <th>Vehicle Parking</th>
        <th>Archanai Token</th>
        <th>Total Amount</th>
        <th>Booked At</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              $parkingText = ($row['vehicle_parking'] == 1) 
                ? '<span class="badge yes" title="Vehicle parking included">✔️ Yes</span>' 
                : '<span class="badge no" title="No vehicle parking">✘ No</span>';
              $archanaiText = ($row['archanai_token'] == 1) 
                ? '<span class="badge yes" title="Archanai token included">✔️ Yes</span>' 
                : '<span class="badge no" title="No Archanai token">✘ No</span>';

              echo "<tr>
                  <td data-label='ID'>{$row['id']}</td>
                  <td data-label='Name'>" . htmlspecialchars($row['user_name']) . "</td>
                  <td data-label='Temple'>" . htmlspecialchars($row['temple_name']) . "</td>
                  <td data-label='Date'>" . htmlspecialchars($row['darshan_date']) . "</td>
                  <td data-label='Time'>" . htmlspecialchars($row['darshan_time']) . "</td>
                  <td data-label='Persons'>{$row['number_of_persons']}</td>
                  <td data-label='Vehicle Parking'>$parkingText</td>
                  <td data-label='Archanai Token'>$archanaiText</td>
                  <td data-label='Total Amount'>₹" . number_format($row['total_amount'], 2) . "</td>
                  <td data-label='Booked At'>" . htmlspecialchars($row['booked_at']) . "</td>
              </tr>";
          }
      } else {
          echo '<tr><td colspan="10" style="padding: 20px; text-align: center;">No bookings found.</td></tr>';
      }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
