<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <div class="container">
    <div class="form-box box">

      <header>Sign Up</header>
      <hr>

      <form action="#" method="POST">

        <div class="form-box">

          <?php
          session_start();
          include "connection.php";

          if (isset($_POST['register'])) {
            $name = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $cpass = $_POST['cpass'];

            $check = "SELECT * FROM users WHERE email='{$email}'";
            $res = mysqli_query($conn, $check);
            $passwd = password_hash($pass, PASSWORD_DEFAULT);

            if (mysqli_num_rows($res) > 0) {
              echo "<div class='message'>
                      <p>This email is used, Try another One Please!</p>
                    </div><br>";
              echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
            } else {
              if ($pass === $cpass) {
                $sql = "INSERT INTO users(username,email,password) VALUES('$name','$email','$passwd')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                  $_SESSION['success_message'] = "Anda berhasil mendaftar!";
                  // echo "<div class='message'><p>You are registered successfully!</p></div><br>";
                  header("Location: login.php");
                  exit;
              } else {
                  echo "<div class='message'>
                          <p>Failed to register. Please try again.</p>
                        </div><br>";
                  echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
              }
              } else {
                echo "<div class='message'>
                        <p>Password does not match.</p>
                      </div><br>";
                echo "<a href='signup.php'><button class='btn'>Go Back</button></a>";
              }
            }
          } else {
          ?>

            <div class="input-container">
              <i class="fa fa-user icon"></i>
              <input class="input-field" type="text" placeholder="Username" name="username" required>
            </div>

            <div class="input-container">
              <i class="fa fa-envelope icon"></i>
              <input class="input-field" type="email" placeholder="Email Address" name="email" required>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field password" type="password" placeholder="Password" name="password" required id="password">
              <i class="fas fa-eye icon" id="togglePassword"></i>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field password" type="password" placeholder="Confirm Password" name="cpass" required id="cpass">
              <i class="fas fa-eye icon" id="toggleCpass"></i>
            </div>

          </div>

          <center><input type="submit" name="register" id="submit" value="Signup" class="btn"></center>

          <div class="links">
            Already have an account? <a href="login.php">Signin Now</a>
          </div>

        </form>
      </div>
      <?php
          }
          ?>
  </div>

  <script>
    const form = document.querySelector("form");
    form.addEventListener("submit", (e) => {
      const email = document.querySelector('input[name="email"]').value;
      const password = document.querySelector('input[name="password"]').value;
      const confirmPassword = document.querySelector('input[name="cpass"]').value;

      // Email validation regex
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

           // Password validation regex: 8–10 characters, must include uppercase, lowercase, number, and special character
           const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%_*?&])[A-Za-z\d_@$!%*?&]{8,}$/;

// Validate email
if (!emailRegex.test(email)) {
  alert("Invalid email format. Please enter a valid email address.");
  e.preventDefault();
  return;
}

// Validate password
if (!passwordRegex.test(password)) {
  alert("Password at least 8 characters long and include uppercase, lowercase, number, and a special character.");
  e.preventDefault();
  return;
}

// Confirm password
if (password !== confirmPassword) {
  alert("Passwords do not match.");
  e.preventDefault();
}
});

// Toggle password visibility
const togglePassword = document.getElementById("togglePassword");
const toggleCpass = document.getElementById("toggleCpass");
const passwordInput = document.getElementById("password");
const cpassInput = document.getElementById("cpass");

togglePassword.addEventListener("click", () => {
const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
passwordInput.setAttribute("type", type);
togglePassword.classList.toggle("fa-eye-slash");
});

toggleCpass.addEventListener("click", () => {
const type = cpassInput.getAttribute("type") === "password" ? "text" : "password";
cpassInput.setAttribute("type", type);
toggleCpass.classList.toggle("fa-eye-slash");
});
</script>

</body>

</html>