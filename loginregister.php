<?php ob_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">

    <!-- Favicons -->
    <link href="./img/icons.png" rel="icon">
    <title>Monkey Apes | Login Register</title>
    <script src="https://kit.fontawesome.com/a84d485a7a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }

        body {
            background: #f6f5f7;
            display: flex;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            margin: -20px 0 50px;
        }

        h1 {
            font-weight: bold;
            margin: 0;
        }

        h2 {
            text-align: center;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button {
            border-radius: 20px;
            border: 1px solid #e3c79f;
            background-color: #e3c79f;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }

        form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        .form-container.sign-in-container {
            left: 0;
            width: 50%;
            /* Set the width to 50% to match the email container */
            z-index: 2;
        }

        .form-container.sign-in-container input[type="email"],
        .form-container.sign-in-container input[type="password"] {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #eee;
            /* Add an underline effect */
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .form-container.sign-up-container input[type="text"],
        .form-container.sign-up-container input[type="email"],
        .form-container.sign-up-container input[type="password"],
        .form-container.sign-up-container input[type="date"],
        .form-container.sign-up-container input[type="text"] {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #eee;
            /* Add an underline effect */
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 1500px;
            max-width: 100%;
            min-height: 800px;
            padding: 18%;
        }

        .input-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-container .toggle-password {
            position: absolute;
            right: 10px;
            /* Adjust the right position as needed */
            cursor: pointer;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: #1b7f9b;
            background: -webkit-linear-gradient(to right, #e8d3b5, #f6f3ef);
            background: linear-gradient(to right, #e8d3b5, #f6f3ef);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .social-container {
            margin: 20px 0;
        }

        .social-container a {
            border: 1px solid #DDDDDD;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
        }

        .remember-forgot-row {
            display: flex;
            justify-content: space-between;
        }

        .remember-me {
            display: flex;
            align-items: center;
            white-space: nowrap
        }

        .remember-me label {
            margin-left: 5px; /* Add spacing between the checkbox and label if needed */
        }

        /* Adjust the gap between the checkbox and label */
        .remember-me input[type="checkbox"] {
            margin-right: 5px; /* Adjust the margin-right as needed */
        }

        .forgot-password {
            display: flex;
            align-items: center;
            white-space: nowrap
        }

        .remember-forgot-row .remember-me {
            flex: 1;
            text-align: left;
            margin-right: 380px;
        }

        .remember-forgot-row .forgot-password {
            flex: 1;
            text-align: right;
        }
    </style>
</head>

<body>

<?php
    $page = "";
    include "connect.php";

    $username = $email = $password = $gender = $dob = $address = "";
    $usernameErr = $emailErr = $passwordErr = $dobErr = $addressErr = $allErr = "";

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
        // Sanitize and validate input data
        $username = ucwords(strtolower($_POST['username']));
        $email = $_POST['email'];
        $rawPassword = $_POST['password'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];

        $okay = true;

        // Username validation
        if (!ctype_alpha(str_replace(' ', '', $username))) {
            $usernameErr = "* Only letters and spaces are allowed" . "<br>";
            $okay = false;
        }

        // Email validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "* Invalid E-mail address";
            $okay = false;
        } else {
            // Check if the email is already in use
            $query = "SELECT * FROM user WHERE email = '$email'";
            $result = mysqli_query($db, $query);

            if ($result && mysqli_num_rows($result) == 1) {
                $emailErr = "* Email address is already in use." . "<br>";
                $okay = false;
            } elseif (!$result) {
                echo 'Error: ' . mysqli_error($db);
            }
        }

        // Password validation
        if (strlen($rawPassword) < 8 || !preg_match('@[0-9]@', $rawPassword) || !preg_match('@[A-Z]@', $rawPassword) || !preg_match('@[a-z]@', $rawPassword) || !preg_match('@[^\w]@', $rawPassword)) {
            $passwordErr = "* Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter, and one special character." . "<br>";
            $okay = false;
        }

        if ($okay) {
            // Hash the password
            $password = password_hash($rawPassword, PASSWORD_BCRYPT);

            // Insert user data into the database
            $query = "INSERT INTO user (cust_id, username, email, password, gender, dob, address, registration_date)
                VALUES (0,'$username', '$email', '$password','$gender', '$dob', '$address', CURDATE())";

            if (mysqli_query($db, $query)) {
                // Retrieve user data for the session
                $query = "SELECT * FROM user WHERE email = '$email'";
                $result = mysqli_query($db, $query);

                if ($result) {
                    $row = mysqli_fetch_array($result);
                    $_SESSION['cust_id'] = $row['cust_id'];
                } else {
                    echo mysqli_error($db);
                }
            } else {
                echo 'Error: ' . mysqli_error($db);
            }
        }
    }

    $signinemailErr = $signinpasswordErr = "";
    $okay = true;

    if (isset($_POST['signin'])) {
        $signinemail = $_POST['signinemail'];
        $signinpassword = $_POST['signinpassword'];

        $rememberMe = isset($_POST['rememberMe']) ? true : false; // Check if "Remember Me" is checked

        if (!filter_var($signinemail, FILTER_VALIDATE_EMAIL)) {
            $signinemailErr = "* Invalid E-mail address" . "<br>";
            $okay = false;
        } else {
            // Retrieve the hashed password from the database based on the email
            $query = "SELECT * FROM user WHERE email = '$signinemail'";
            $result = mysqli_query($db, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $hashedPasswordFromDB = $row['password'];

                // Verify the entered password against the hashed password
                if (password_verify($signinpassword, $hashedPasswordFromDB)) {
                    // Password is correct, perform the login actions
                    $_SESSION['cust_id'] = $row['cust_id'];

                    if ($rememberMe) {
                        // Set cookies for email and password (you can customize the cookie names)
                        setcookie('emailcookie', $signinemail, time() + 3600 * 24 * 30); // Cookie will last for 30 days
                        setcookie('passwordcookie', $signinpassword, time() + 3600 * 24 * 30); // Cookie will last for 30 days
                    }

                    echo "<script>
                        window.setTimeout(function () {
                            window.location.href = 'index.php';
                        }, 100);
                    </script>";
                } else {
                    $signinpasswordErr = "The password that you've entered is incorrect. Please try again." . "<br>";
                }
            } else {
                // User with this email doesn't exist
                $signinemailErr = "* Couldn't find that E-mail address. Check the spelling and try again." . "<br>";
            }
        }

        mysqli_close($db);
    }
    ?>

    <br /><br /><br />
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="loginregister.php" method="post">
                <h1>Create Account</h1>
                <br />

                <?php
                    echo $usernameErr ;
                    echo $emailErr ;
                    echo $passwordErr;
                    echo $dobErr;
                    echo $addressErr;
                ?>

                <input type="text" name="username" placeholder="Username" require />
                <input type="email" name="email" placeholder="Email" require />
                <input type="text" name="password" placeholder="Password" require />
                <input type="date" name="dob" placeholder="Dob" require />
                <input type="text" name="address" placeholder="Address" require />
                <br />
                <div>
                    <input type="radio" class="btn-check" name="gender" id="option1" value="male" checked>
                    <label class="btn btn-secondary" for="option1">Male</label>
                    <input type="radio" class="btn-check" name="gender" id="option2" value="female">
                    <label class="btn btn-secondary" for="option2">Female</label>
                </div>
                <br />
                <button type="submit" name="register">Register</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="loginregister.php" method="post">
                <h1>Sign in</h1>
                <br />

                <?php
                    echo $signinemailErr ;
                    echo $signinpasswordErr ;
                ?>

                <input type="email" name="signinemail" placeholder="Email" value="<?php if(isset($_COOKIE['emailcookie'])) { echo $_COOKIE['emailcookie'];}?>" />
                <!-- Update the width of the password input container to match the email input -->
                <div class="input-container" style="width: 100%;">
                    <input type="password" name="signinpassword" id="password" placeholder="Password" value="<?php if(isset($_COOKIE['passwordcookie'])) { echo $_COOKIE['passwordcookie'];}?>" />
                    <span class="eye toggle-password"><i class="far fa-eye"></i></span>
                </div>
                
                <div class="remember-forgot-row">
                    <div class="remember-me">
                        <input type="checkbox" name="rememberMe" id="rememberMe" ><label for="rememberMe">Remember Me</label>
                    </div>
                    <div class="forgot-password">
                        <a href="forgot-password.php" id="forgotPasswordLink">Forgot Password?</a>
                    </div>
                </div>
                <br /><br />
                <button type="submit" name="signin">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, There!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <br /><br />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>

<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });

    // Add JavaScript to toggle password visibility
    const passwordInput = document.querySelector('#password');
    const togglePassword = document.querySelector('.toggle-password');

    togglePassword.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>

</html>