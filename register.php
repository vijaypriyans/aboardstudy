<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="sytlesheet" href="register.css">
</head>
<body>
    <div class="container-fluid">
        <video autoplay muted loop>
            <source src="signup vlideo.mp4" type="video/mp4">
        </video>
    </div>
    <br><br>
    
     <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
   <div class="row d-flex justify-content-center align-items-center h-100">
   <div class="col-12 col-md-9 col-lg-7 col-xl-6">
   <div class="card" style="border-radius: 15px;">
   <div class="card-body p-5">
   <h2 class="text-uppercase text-center mb-5">Register</h2>
   <form action="#" method="POST">
          <div class="form-outline mb-4">
    <label class="form-label" for="name">Name: </label>
  <input type="text" id="names" name="names" class="form-control form-control-lg" required>
           </div>
           <div class="form-outline mb-4">
    <label class="form-label" for="username">Email: </label>
  <input type="email" id="email" name="email" class="form-control form-control-lg" required>


      <div class="form-outline mb-4">
       <label class="form-label" for="password">Country:</label>
        <input type="text" id="password" name="country" class="form-control form-control-lg" required>
      </div>
      <div class="form-outline mb-4">
       <label class="form-label" for="password">College:</label>
        <input type="text" id="password" name="college" class="form-control form-control-lg" required>
      </div>
      <div class="form-outline mb-4">
    <label class="form-label" for="password">Password:</label>
    <input type="password" id="password" name="pass" class="form-control form-control-lg" required>
</div>
<div class="form-outline mb-4">
    <label class="form-label" for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_pass" class="form-control form-control-lg" required>
    <small id="passwordError" class="form-text text-danger"></small>
</div>

<div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" name="register" onclick="return validatePassword()">Register</button>
</div>

<script>
function validatePassword() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;
    const passwordError = document.getElementById("passwordError");

    if (password !== confirmPassword) {
        passwordError.textContent = "Passwords do not match.";
        return false; 
    } else {
        passwordError.textContent = ""; 
        return true; 
    }
}
</script>

        
   <div class="form-link text-center"><br>
      <h5><span class="text-secondary">Already have an account? <a href="login.php" class="link login-link">Login</a></span></h5>
   </div>
    </form>
     </div>
    </div>
     </div>
    </div>
    </div>
      </div>
      <?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'abroadstudies';

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $names = $_POST['names'];
    $mail = $_POST['email'];
    $pass = $_POST['pass'];
    $confirm_pass = $_POST['confirm_pass'];
    $country = $_POST['country'];
    $college = $_POST['college'];

    

    
    if (!preg_match('/[A-Z]/', $pass)) {
        echo "<script>alert('Password must contain at least one uppercase letter.');</script>";
    } elseif (!preg_match('/[a-z]/', $pass)) {
        echo "<script>alert('Password must contain at least one lowercase letter.');</script>";
    } elseif (!preg_match('/[^a-zA-Z0-9]/', $pass)) {
        echo "<script>alert('Password must contain at least one special character.');</script>";
    } else {
        // Check if the user already exists
        $check_user_sql = "SELECT * FROM studies WHERE email='$mail' OR pass='$pass'";
        $check_user_result = $conn->query($check_user_sql);

        if ($check_user_result->num_rows > 0) {
            echo "<script>alert('Email or Password already exists');</script>";
        } else {
            // Insert the new user
            $sql = "INSERT INTO studies (names, email, pass, country, college) VALUES ('$names', '$mail', '$pass', '$country', '$college')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Registered successfully');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
}
?>

</body>
</html>