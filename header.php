<?php 
    session_start(); // Start the session
    include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Favicons -->
    <link href="./img/icons.png" rel="icon">
    <title>Monkey Apes | Header</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="./index.php">Home</a></li>
                            <li><a href="./shop.php">Shop</a></li>
                            <li><a href="./blog.php">Blog</a></li>
                            <li><a href="#">About</a>
                                <ul class="dropdown">
                                    <li><a href="./about.php">About</a></li>
                                    <li><a href="./reviewform.php">Review</a></li>
                                </ul>
                            </li>
                            <li><a href="./contact.php">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="./wishlist.php"><img src="img/icon/heart.png" alt=""></a>
                        <a href="./shopping-cart.php"><img src="img/icon/cart.png" alt=""></a>

                        <?php
                            if (isset($_SESSION['cust_id'])) {
                                // User is logged in
                                $cust_id = $_SESSION['cust_id'];

                                 // You should replace 'your_user_table' with your actual user table name and adjust the SQL query as needed.
                                $query = "SELECT username FROM user WHERE cust_id = $cust_id";
                                $result = mysqli_query($db, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $username = $row['username'];
                                    echo '<a href="./userprofile.php"><img src="img/icon/user.png" alt="">' . $username . '</a>
                                    <a href="./payment_history.php"><img src="img/icon/paymenthistory.png" alt=""></a>
                                        <form action="index.php" method="post">
                                            <input class="dropdown-item" type="submit" value="Logout">
                                            <input type="hidden" name="logout" value="true">
                                        </form>';
                                }else{
                                    echo '<a href="./userprofile.php"><img src="img/icon/user.png" alt=""></a>
                                    <a href="./payment_history.php"><img src="img/icon/paymenthistory.png" alt=""></a>
                                        <form action="index.php" method="post">
                                            <input class="dropdown-item" type="submit" value="Logout">
                                            <input type="hidden" name="logout" value="true">
                                        </form>';
                                }
                            } else { 
                                // User is not logged in
                                echo '<a href="./loginregister.php"><img src="img/icon/user.png" alt=""></a>'; 
                            }

                            if (isset($_POST['logout'])) {
                                // If the user clicked the Logout button
                                session_destroy();
                                ?>
                                <script>
                                    window.location.href = 'loginregister.php'; // Redirect to the login page
                                </script>
                                <?php
                            }
                        ?>

                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>