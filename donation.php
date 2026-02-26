<?php
include("connection.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Temple Donation</title>
    <style>
        body {
            background: #f7f6f2;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .donation-form {
            max-width: 500px;
            margin: auto;
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0px 0px 10px #ccc;
        }
        .donation-form h2 {
            text-align: center;
            color: #3c3b6e;
        }
        input, select, textarea {
            width: 100%;
            margin-top: 10px;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
        .qr-img {
            display: block;
            margin: 20px auto;
            width: 180px;
            border-radius: 10px;
        }
        button {
            background: #3c3b6e;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #2c2a5e;
        }
        .hidden {
            display: none;
        }
    </style>
    <script>
        function toggleAdoptDateField(value) {
            var dateField = document.getElementById("adopt-date");
            if (value === "Adopt a Day") {
                dateField.classList.remove("hidden");
            } else {
                dateField.classList.add("hidden");
            }
        }
    </script>
</head>
<body>

<div class="donation-form">
    <h2>Temple Donation</h2>
    <form method="POST" action="">
        <label>Your Name:</label>
        <input type="text" name="name" required>

        <label>Amount (₹):</label>
        <input type="number" name="amount" required>

        <label>Donation Type:</label>
        <select name="donation_type" onchange="toggleAdoptDateField(this.value)" required>
            <option value="Regular">Regular Donation</option>
            <option value="Adopt a Day">Adopt a Day</option>
        </select>

        <div id="adopt-date" class="hidden">
            <label>Select Date for Adoption:</label>
            <input type="date" name="adopt_date">
        </div>

        <label>Occasion / Reason (Optional):</label>
        <textarea name="occasion" rows="3"></textarea>

        <label>Scan and Pay:</label>
        <img src="your-qr-image.png" class="qr-img" alt="QR Code for Donation">

        <button type="submit" name="donate">Confirm Donation</button>
    </form>
</div>

</body>
</html>

<?php
if (isset($_POST['donate'])) {
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $type = $_POST['donation_type'];
    $occasion = $_POST['occasion'];
    $adopt_date = isset($_POST['adopt_date']) ? $_POST['adopt_date'] : null;

    $insert = mysqli_query($conn, "INSERT INTO donations (name, amount, type, occasion, adopt_date, donated_at) 
        VALUES ('$name', '$amount', '$type', '$occasion', '$adopt_date', NOW())");

    if ($insert) {
        echo "<script>alert('Thank you for your generous donation!');</script>";
    } else {
        echo "<script>alert('Error. Please try again.');</script>";
    }
}
?>
