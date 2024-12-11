<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <div class="container">
    <div class="form-box box">

      <?php
      include "connection.php";

      if (isset($_POST['login'])) {

        $email = trim($_POST['email']); // Menghapus spasi di awal dan akhir email
        $pass = trim($_POST['password']); // Menghapus spasi di awal dan akhir password
        $recaptchaResponse = $_POST['g-recaptcha-response'];
        $secretKey = "6LdEDIoqAAAAABOPP9yC0Vc306roM4bwOD_fbHEl"; // Ganti dengan secret key dari Google reCAPTCHA
        $verifyUrl = "https://www.google.com/recaptcha/api/siteverify";

        $response = file_get_contents($verifyUrl . "?secret=" . $secretKey . "&response=" . $recaptchaResponse);
        $responseKeys = json_decode($response, true);

        if (!$responseKeys['success']) {
            echo "<div class='message'>
                    <p>Please verify the reCAPTCHA.</p>
                  </div><br>";
            echo "<a href='login.php'><button class='btn'>Go Back</button></a>";
            exit; // Hentikan eksekusi lebih lanjut jika reCAPTCHA gagal
        }
        $sql = "select * from users where email='$email'";

        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {

          $row = mysqli_fetch_assoc($res);

          $password = $row['password'];

          $decrypt = password_verify($pass, $password);

          if ($decrypt) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("location: home.php");
          } else {
            echo "<div class='message'>
                    <p> Wrong Email or Password</p>
                    </div><br>";

            echo "<a href='login.php'><button class='btn'>Go Back</button></a>";
          }

        } else {
          echo "<div class='message'>
                    <p>Wrong Email or Password</p>
                    </div><br>";

          echo "<a href='login.php'><button class='btn'>Go Back</button></a>";
        }

      } else {
        ?>

        <header>Login</header>
        <hr>
        <form action="#" method="POST">

          <div class="form-box">

            <div class="input-container">
              <i class="fa fa-envelope icon"></i>
              <input class="input-field" type="email" placeholder="Email Address" name="email" required>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field password" type="password" placeholder="Password" name="password" required id="password">
              <i class="fas fa-eye icon" id="togglePassword"></i>
            </div>
           
            <div class="remember">
              <input type="checkbox" class="check" name="remember_me">
              <label for="remember">Remember me</label>
              <span><a href="forgot_password.php">Forgot password</a></span>
            </div>
            <div class="g-recaptcha" data-sitekey="6LdEDIoqAAAAACtfu-XYJZN9dgrZt2BceRIVYpmp"></div>

          </div>

          <input type="submit" name="login" id="submit" value="Login" class="button">

          <div class="links">
            Don't have an account? <a href="signup.php">Signup Now</a>
          </div>

        </form>
      </div>
      <?php
      }
      ?>
  </div>
  <script>
    // Menangani toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash'); // Mengubah ikon mata
    });
  </script>
</body>

</html>
