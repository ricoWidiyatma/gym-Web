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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpass = $_POST['cpass'];

    // Validasi password
    $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%_*?&])[A-Za-z\d_@$!%*?&]{8,}$/";
    
    if (preg_match($passwordRegex, $password) && $password === $cpass) {
        // Hash password dan update di database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hashedPassword, $email);
        
        if ($stmt->execute()) {
            // Menampilkan notifikasi berhasil mengupdate password
            echo "<script>
                    alert('Password updated successfully!');
                    window.location.href = 'login.php';
                  </script>";
            exit();
        } else {
            echo "An error occurred while updating the password";
        }
    } else {
        echo "<script>alert('Password at least 8 characters long and include uppercase, lowercase, number, and a special character. or the password confirmation does not match.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(rgba(0, 0, 50, 0.7), rgba(0, 0, 50, 0.7)), url('../images/background.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        form {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 8px;
            color: #333;
        }

        p {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .input-container {
            margin-bottom: 20px;
            position: relative;
        }

        .input-field {
            width: 100%;
            padding: 12px;
            padding-right: 40px; /* Tambahkan ruang untuk ikon */
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #aaa;
            cursor: pointer;
        }

        .icon:hover {
            color: #555;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff; /* Warna biru seperti di gambar */
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-bottom: 20px;
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
        <h1>Create New Password</h1>
        <p>Your new password must be different from any of your previous passwords.</p>
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
        <div class="input-container">
            <input class="input-field password" type="password" placeholder="Enter Password" name="password" required id="password">
            <i class="fas fa-eye icon" id="togglePassword"></i>
        </div>
        <div class="input-container">
            <input class="input-field" type="password" placeholder="Re-enter Password" name="cpass" required id="cpass">
            <i class="fas fa-eye icon" id="toggleCpass"></i>
        </div>
        <button type="submit">Reset Password</button>
    </form>
    <script>
        // Menangani toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        const toggleCpass = document.getElementById('toggleCpass');
        const cpassInput = document.getElementById('cpass');

        toggleCpass.addEventListener('click', function () {
            const type = cpassInput.getAttribute('type') === 'password' ? 'text' : 'password';
            cpassInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>