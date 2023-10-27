<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monkey Apes | Admin Login</title>
    <link rel="stylesheet" href="./loginstyle.css">
</head>
<body>
<?php
session_start(); // Start the session
include "connect.php"; // Include your database connection here

$signinemailErr = $signinpasswordErr = "";
$okay = true;

if (isset($_POST['signin'])) {
    $signinemail = $_POST['signinemail'];
    $signinpassword = $_POST['signinpassword'];

    // Perform validation and database queries here...
    
    // Example validation:
    if (empty($signinemail)) {
        $signinemailErr = "Email is required.";
        $okay = false;
    }

    if (empty($signinpassword)) {
        $signinpasswordErr = "Password is required.";
        $okay = false;
    }

    if ($okay) {
        // Perform database queries for login here...
        
        // Example:
        $query = "SELECT * FROM admin WHERE admin_email = '$signinemail' AND admin_password = '$signinpassword'";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) == 1) {
            // Login successful, set session variables or redirect as needed
            $_SESSION['admin_id'] = $row['admin_id'];

            // Redirect to the admin dashboard or another page
            header("Location: ./index.php");
            exit(); // Ensure script stops here to avoid further execution.
        } else {
            $signinpasswordErr = "Invalid email or password.";
        }
    }

    // Close the database connection
    mysqli_close($db);
}
?>
<div class="panda">
<div class="ear"></div>
    <div class="face">
      <div class="eye-shade"></div>
      <div class="eye-white">
        <div class="eye-ball"></div>
      </div>
      <div class="eye-shade rgt"></div>
      <div class="eye-white rgt">
        <div class="eye-ball"></div>
      </div>
      <div class="nose"></div>
      <div class="mouth"></div>
    </div>
    <div class="body"> </div>
    <div class="foot">
      <div class="finger"></div>
    </div>
    <div class="foot rgt">
      <div class="finger"></div>
    </div>
</div>
<form method="post" action="admin-login.php">
    <h1>Admin Login</h1>
    <div class="form-group">
        <input type="email" name="signinemail" required="required" class="form-control" placeholder="Email">
        <span class="error"><?php echo $signinemailErr; ?></span>
    </div>
    <div class="form-group">
        <input type="password" name="signinpassword" required="required" class="form-control" placeholder="Password">
        <span class="error"><?php echo $signinpasswordErr; ?></span>
    </div>
    <button class="btn" type="submit" name="signin">Login</button>
</form>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="./login/script.js"></script>
</body>
</html>
