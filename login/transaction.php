<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ubah sesuai dengan username database Anda
$password = ""; // Ubah sesuai dengan password database Anda
$dbname = "gatot"; // Nama database Anda

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
    /* General Styling */
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #1A1A1A; /* Warna latar gelap */
      color: #E5E5E5; /* Warna teks abu terang */
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
      background-color: #262626; /* Warna abu gelap untuk container */
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.8); /* Efek bayangan dramatis */
    }

    /* Headings */
    h1 {
      color: #FF6A3D; /* Oranye terang untuk aksen */
      font-size: 2rem;
      text-align: center;
      margin-bottom: 25px;
    }

    /* Form Elements */
    form {
      display: flex;
      flex-wrap: wrap; /* Membungkus elemen form */
      gap: 15px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      flex: 1 1 calc(50% - 10px); /* Dua kolom dengan jarak antar elemen */
    }

    .form-group.full-width {
      flex: 1 1 100%; /* Kolom penuh untuk elemen tertentu */
    }

    label {
      margin-bottom: 8px;
      font-weight: 500;
      color: #B3B3B3; /* Warna teks abu-abu */
    }

    input, select {
      width: 100%;
      padding: 12px;
      border: 1px solid #444; /* Border halus */
      border-radius: 8px;
      background-color: #333333; /* Warna latar elemen */
      color: #E5E5E5; /* Warna teks */
      font-size: 1rem;
      transition: all 0.3s ease;
      box-sizing: border-box; /* Pastikan padding tidak memengaruhi ukuran */
    }

    input:focus, select:focus {
      border-color: #FF6A3D; /* Warna aksen oranye saat fokus */
      outline: none;
      box-shadow: 0px 0px 10px rgba(255, 106, 61, 0.7);
    }

    /* Price Display */
    .price-display {
      font-size: 1.4rem;
      font-weight: bold;
      color: #FF6A3D; /* Warna aksen untuk harga */
      text-align: center;
      border: 1px solid #FF6A3D;
      border-radius: 8px;
      padding: 10px;
      background-color: #262626; /* Warna latar */
      margin-top: 10px;
    }

    /* Agreement Section */
    .agreement {
      display: flex;
      align-items: flex-start; /* Posisi checkbox di bagian atas label */
      gap: 10px; /* Jarak antara checkbox dan teks */
      font-size: 0.9rem; /* Ukuran teks */
      color: #94A3B8; /* Warna teks abu-abu terang */
      margin-top: 10px; /* Tambahkan jarak di atas checkbox */
    }

    .agreement input[type="checkbox"] {
      margin: 0; /* Hilangkan margin default pada checkbox */
      width: 18px;
      height: 18px; /* Ukuran checkbox */
      border-radius: 4px; /* Membuat sudut checkbox agak membulat */
      border: 1px solid #10B981; /* Warna border checkbox */
      background-color: #1E293B; /* Warna latar checkbox */
      cursor: pointer;
    }

    .agreement input[type="checkbox"]:checked {
      background-color: #10B981; /* Warna hijau saat dicentang */
      border-color: #10B981;
    }

    .agreement label {
      cursor: pointer; /* Memastikan label dapat diklik */
      line-height: 1.5; /* Menyesuaikan tinggi teks agar sejajar dengan checkbox */
      margin: 0; /* Hilangkan margin default pada label */
    }

    .agreement a {
      color: #38BDF8; /* Warna biru untuk link */
      text-decoration: none;
      font-weight: bold;
    }

    .agreement a:hover {
      text-decoration: underline;
    }

    /* Buttons */
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
      color: #1A1A1A; /* Warna teks hitam */
      border: none;
    }

    .submit-btn:hover {
      background-color: #E65C2C; /* Oranye lebih gelap saat hover */
      transform: scale(1.05);
    }

    .submit-btn:active {
      background-color: #CC4D26; /* Oranye redup saat klik */
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
        <input type="text" id="first-name" name="first-name" required>
      </div>
      <div class="form-group">
        <label for="last-name">Last Name *</label>
        <input type="text" id="last-name" name="last-name" required>
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
        <input type="tel" id="phone" name="phone" required>
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
      <!-- Display Price -->
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

      // Hitung harga berdasarkan durasi keanggotaan
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

      // Perbarui elemen HTML untuk menampilkan harga
      priceDisplay.innerText = `Total Price: Rp. ${price.toLocaleString()}`;
    }

    // Jalankan calculatePrice() jika halaman dimuat ulang
    calculatePrice();
  </script>
</body>
</html>
