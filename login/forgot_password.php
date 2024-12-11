<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "login"; // Nama database

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$message = ""; // Variabel untuk pesan

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Cek apakah email ada di database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika email terdaftar, arahkan ke reset_password.php
        header("Location: reset_password.php?email=" . urlencode($email));
        exit();
    } else {
        $message = "Email not registered."; // Simpan pesan
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 50, 0.7), rgba(0, 0, 50, 0.7)), url('../images/background.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            position: relative;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .message {
            margin-bottom: 10px; /* Posisikan di atas formulir */
            color: #d9534f; /* Warna merah */
            background-color: #f8d7da; /* Warna latar belakang merah muda */
            border: 1px solid #f5c6cb; /* Border merah muda */
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <?php if (!empty($message)): ?>
            <div class="message"><?= $message ?></div>
        <?php endif; ?>
        <input type="email" name="email" placeholder="Input Your Email" required>
        <button type="submit">Send</button>
    </form>
</body>
</html>
