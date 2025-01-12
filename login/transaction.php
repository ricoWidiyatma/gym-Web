<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "gatot"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses form jika data dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $membership_duration = $_POST['membership-duration'];
    $agreement = isset($_POST['agreement']) ? 1 : 0;

    // Hitung harga berdasarkan durasi
    $price = 0;
    switch ($membership_duration) {
        case "1":
            $price = 100000;
            break;
        case "3":
            $price = 250000;
            break;
        case "6":
            $price = 450000;
            break;
        case "12":
            $price = 850000;
            break;
    }

    // Masukkan data ke tabel `memberships`
    $sql = "INSERT INTO memberships (first_name, last_name, dob, gender, phone, membership_duration, price, agreement)
            VALUES ('$first_name', '$last_name', '$dob', '$gender', '$phone', $membership_duration, $price, $agreement)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!'); window.location.href='home.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gym Membership Registration</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #1A1A1A;
      color: #E5E5E5;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    /* Form Container */
    .form-container {
      width: 100%;
      max-width: 600px;
      background-color: #262626;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.8);
    }

    h1 {
      color: #FF6A3D;
      font-size: 2rem;
      text-align: center;
      margin-bottom: 25px;
    }

    form {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      flex: 1 1 calc(50% - 10px);
    }

    .form-group.full-width {
      flex: 1 1 100%;
    }

    label {
      margin-bottom: 8px;
      font-weight: 500;
      color: #B3B3B3;
    }

    input, select {
      width: 100%;
      padding: 12px;
      border: 1px solid #444;
      border-radius: 8px;
      background-color: #333333;
      color: #E5E5E5;
      font-size: 1rem;
      transition: all 0.3s ease;
      box-sizing: border-box;
    }

    input:focus, select:focus {
      border-color: #FF6A3D;
      outline: none;
      box-shadow: 0px 0px 10px rgba(255, 106, 61, 0.7);
    }

    .error-message {
      color: red;
      font-size: 0.85rem;
      margin-top: 5px;
      display: none;
    }

    .price-display {
      font-size: 1.4rem;
      font-weight: bold;
      color: #FF6A3D;
      text-align: center;
      border: 1px solid #FF6A3D;
      border-radius: 8px;
      padding: 10px;
      background-color: #262626;
      margin-top: 10px;
    }

    .agreement {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      font-size: 0.9rem;
      color: #94A3B8;
      margin-top: 10px;
    }

    .agreement input[type="checkbox"] {
      margin: 0;
      width: 18px;
      height: 18px;
      border-radius: 4px;
      border: 1px solid #10B981;
      background-color: #1E293B;
      cursor: pointer;
    }

    .agreement input[type="checkbox"]:checked {
      background-color: #10B981;
      border-color: #10B981;
    }

    .agreement a {
      color: #38BDF8;
      text-decoration: none;
      font-weight: bold;
    }

    .agreement a:hover {
      text-decoration: underline;
    }

    button {
      width: 100%;
      padding: 12px;
      font-size: 1rem;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .submit-btn {
      background-color: #FF6A3D;
      color: #1A1A1A;
      border: none;
    }

    .submit-btn:hover {
      background-color: #E65C2C;
      transform: scale(1.05);
    }

    .submit-btn:active {
      background-color: #CC4D26;
      transform: scale(0.98);
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Gym Membership Registration</h1>
    <form method="POST">
      <div class="form-group">
        <label for="first-name">First Name *</label>
        <input type="text" id="first-name" name="first-name" required oninput="validateFirstName()">
        <div id="first-name-error" class="error-message">First Name must contain only letters.</div>
      </div>
      <div class="form-group">
        <label for="last-name">Last Name *</label>
        <input type="text" id="last-name" name="last-name" required oninput="validateLastName()">
        <div id="last-name-error" class="error-message">Last Name must contain only letters.</div>
      </div>
      <div class="form-group">
        <label for="dob">Date of Birth *</label>
        <input type="date" id="dob" name="dob" required>
      </div>
      <div class="form-group">
        <label for="gender">Gender *</label>
        <select id="gender" name="gender" required>
          <option value="" disabled selected>Select your gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number *</label>
        <input type="text" id="phone" name="phone" required oninput="validatePhone()">
        <div id="phone-error" class="error-message">Phone Number must contain only numbers.</div>
      </div>
      <div class="form-group full-width">
        <label for="membership-duration">Membership Duration *</label>
        <select id="membership-duration" name="membership-duration" required onchange="calculatePrice()">
          <option value="" disabled selected>Select duration</option>
          <option value="1">1 Month</option>
          <option value="3">3 Months</option>
          <option value="6">6 Months</option>
          <option value="12">1 Year</option>
        </select>
      </div>
      <div id="price-display" class="price-display">Total Price: Rp. 0</div>

      <div class="form-group full-width agreement">
        <input type="checkbox" id="agreement" name="agreement" required>
        <label for="agreement">I agree to the <a href="#">Terms & Conditions</a></label>
      </div>
      <button type="submit" class="submit-btn">Order Now</button>
    </form>
  </div>

  <script>
    function calculatePrice() {
      const duration = document.getElementById("membership-duration").value;
      const priceDisplay = document.getElementById("price-display");
      let price = 0;

      switch (duration) {
        case "1":
          price = 100000;
          break;
        case "3":
          price = 250000;
          break;
        case "6":
          price = 450000;
          break;
        case "12":
          price = 850000;
          break;
        default:
          price = 0;
      }

      priceDisplay.innerText = `Total Price: Rp. ${price.toLocaleString()}`;
    }

    function validateFirstName() {
      const firstName = document.getElementById("first-name").value;
      const firstNameError = document.getElementById("first-name-error");
      const namePattern = /^[a-zA-Z]*$/;

      if (!namePattern.test(firstName)) {
        firstNameError.style.display = "block";
        document.getElementById("first-name").value = firstName.replace(/[^a-zA-Z]/g, "");
      } else {
        firstNameError.style.display = "none";
      }
    }

    function validateLastName() {
      const lastName = document.getElementById("last-name").value;
      const lastNameError = document.getElementById("last-name-error");
      const namePattern = /^[a-zA-Z]*$/;

      if (!namePattern.test(lastName)) {
        lastNameError.style.display = "block";
        document.getElementById("last-name").value = lastName.replace(/[^a-zA-Z]/g, "");
      } else {
        lastNameError.style.display = "none";
      }
    }

    function validatePhone() {
      const phone = document.getElementById("phone").value;
      const phoneError = document.getElementById("phone-error");
      const phonePattern = /^[0-9]*$/;

      if (!phonePattern.test(phone)) {
        phoneError.style.display = "block";
        document.getElementById("phone").value = phone.replace(/\D/g, "");
      } else {
        phoneError.style.display = "none";
      }
    }

    calculatePrice();
  </script>
</body>
</html>
