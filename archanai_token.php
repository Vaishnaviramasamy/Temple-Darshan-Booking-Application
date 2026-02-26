<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temple";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query bookings where archanai_token = 1
$sql = "SELECT * FROM new_booking WHERE archanai_token = 1 ORDER BY booked_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Archanai Token Bookings</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap');

  * {
    margin: 0; padding: 0; box-sizing: border-box;
  }
  body {
    font-family: 'Nunito', sans-serif;
    background: #f0f4f8;
    padding: 40px 20px;
    color: #333;
  }
  h2 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 700;
    font-size: 2.5rem;
    color: #00695c;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }

  .container {
    max-width: 1000px;
    margin: 0 auto;
    background: #fff;
    border-radius: 12px;
    padding: 30px 40px;
    box-shadow: 0 12px 25px rgba(0,105,92,0.15);
  }

  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 15px;
    font-size: 1rem;
    color: #444;
  }

  thead tr {
    background: #00695c;
    color: #fff;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    box-shadow: 0 4px 15px rgba(0,105,92,0.2);
  }
  thead th {
    padding: 15px 20px;
    border: none;
  }

  tbody tr {
    background: #f9fffc;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,105,92,0.1);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
  }
  tbody tr:hover {
    transform: translateY(-5px);
    box-shadow: 0 14px 28px rgba(0,105,92,0.25);
  }

  tbody td {
    padding: 14px 20px;
    text-align: center;
    border-top: 1px solid #d3ede7;
  }

  @media (max-width: 768px) {
    .container {
      padding: 20px 15px;
    }
    table, thead, tbody, th, td, tr {
      display: block;
    }
    thead tr {
      display: none;
    }
    tbody tr {
      margin-bottom: 20px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 10px 20px rgba(0,105,92,0.1);
      transform: none !important;
    }
    tbody td {
      text-align: right;
      padding: 12px 50px 12px 20px;
      border: none;
      border-bottom: 1px solid #eee;
      position: relative;
    }
    tbody td::before {
      content: attr(data-label);
      position: absolute;
      left: 20px;
      top: 12px;
      font-weight: 700;
      color: #00695c;
      text-transform: uppercase;
      font-size: 0.9rem;
    }
    tbody td:last-child {
      border-bottom: none;
    }
  }
</style>
</head>
<body>
  <div class="container">
    <h2>🙏 Bookings with Archanai Token</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Temple</th>
          <th>Date</th>
          <th>Time</th>
          <th>Persons</th>
          <th>Total Amount</th>
          <th>Booked At</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
              <td data-label='ID'>{$row['id']}</td>
              <td data-label='Name'>" . htmlspecialchars($row['user_name']) . "</td>
              <td data-label='Temple'>" . htmlspecialchars($row['temple_name']) . "</td>
              <td data-label='Date'>" . htmlspecialchars($row['darshan_date']) . "</td>
              <td data-label='Time'>" . htmlspecialchars($row['darshan_time']) . "</td>
              <td data-label='Persons'>{$row['number_of_persons']}</td>
              <td data-label='Total Amount'>₹" . number_format($row['total_amount'], 2) . "</td>
              <td data-label='Booked At'>" . htmlspecialchars($row['booked_at']) . "</td>
            </tr>";
          }
        } else {
          echo "<tr><td colspan='8' style='padding: 20px; text-align:center; font-weight: 600;'>No bookings found with Archanai Token.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
