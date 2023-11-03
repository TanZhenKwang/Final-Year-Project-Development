<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <!-- Favicons -->
    <link href="./img/icons.png" rel="icon">
    <title>Monkey Apes | Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Center-align the content */
        .text-center {
            text-align: center;
        }

        /* Center-align the headings */
        .cu-center-h1,
        .cu-center-h3 {
            text-align: center;
        }

        /* Center-align the horizontal lines */
        .cu-hr-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 15px 0;
        }

        /* Adjust the width of the horizontal lines */
        .cu-custom-hr {
            width: 5%;
            /* Adjust the width as needed */
            border-color: black;
            /* Customize the color of the horizontal line */
            border-width: 2px;
            /* Add this line to make the line thicker (you can adjust the width as needed) */
        }

        /* Add spacing to the sections */
        .cu-section {
            background-color: #f6f3ef;
            padding: 20px;
            width: 100%;
        }

        /* Center-align the <h5> and <p> elements */
        .cu-section h5,
        .cu-section p {
            text-align: center;
        }

        /* Add CSS to style the underlined form fields */
        .contact-underlined-input {
            border: none;
            border-bottom: 2px solid brown; /* Set the border color to brown */
            background-color: transparent;
            border-radius: 0;
            padding: 5px;
        }

        /* Custom CSS for the button */
        .btn.btn-outline-primary.btn-block {
            border-color: brown;
            color: brown; /* Change the text color to transparent */
            background-color: transparent; /* Change the background color to transparent */
            width: 500px; 
            height: 50px;    
        }

        .btn.btn-outline-primary.btn-block:hover {
            background-color: brown; /* Change the background color to brown on hover */
            color: white; /* Change the text color to white on hover */
            width: 500px;
            height: 50px;     
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <br /><br />
        <h1 class="fw-bolder cu-center-h1">M O N K E Y &nbsp; A P E S</h1>
        <br /><br />

        <div class="cu-section">
            <h5>Rest Password</h5>
            <p>Enter a new password for login <b>Monkey Apes</b></p>

                <?php
                    session_start();
                    if(isset($_SESSION['status']))
                    {
                        ?>
                        <div class="alert alert-success">
                            <h5>
                                <?= $_SESSION['status']; ?>
                            </h5>
                        </div>
                        <?php
                        unset($_SESSION['status']);
                    }        
                ?>
            
                <section class="mb-4">
                <div class="row justify-content-center align-items-center">
                    <!--Grid column-->
                    <div class="col-md-9 mb-md-0 mb-5">
                        <form action="reset-password-code.php" method="POST">
                            <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">

                            <!--Grid row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form mb-0">
                                        <label>Email Address</label>
                                        <input type="text" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" class="form-control" placeholder="Enter Email Address">                                   
                                    </div>
                                </div>
                            </div>
                            <!--Grid row-->

                            <br />

                            <!--Grid row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form mb-0">
                                        <label>New Password</label>
                                        <input type="text" name="new_password" class="form-control" placeholder="Enter New Password">                                   
                                    </div>
                                </div>
                            </div>
                            <!--Grid row-->

                            <br />

                            <!--Grid row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form mb-0">
                                        <label>Confirm Password</label>
                                        <input type="text" name="confirm_password" class="form-control" placeholder="Enter Confirm Password">                                   
                                    </div>
                                </div>
                            </div>
                            <!--Grid row-->

                            
                            <br /><br />

                            <div class="text-center text-md-left">
                                <button type="submit" name="password_update" class="btn btn-outline-primary btn-block">Send</button>
                            </div>
                            <div class="status"></div>
                        <!--Grid column-->
                        </form>
                    </div>
                </div>
            </section>

        </div>
        <br /><br />
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

</html>