<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monkey Apes | Payment History</title>

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

</head>

    <body>
    <?php 
        $page = "payment";
        include 'header.php'; 
        include 'connect.php'; 
    ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Payment History Details</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>Payment History details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <?php
        if (!$db) {
            die("Error: " . mysqli_connect_error($db));
        }

        if (isset($_SESSION['cust_id'])) {
            $cust_id = $_SESSION['cust_id'];
        }

        if (isset($_GET['checkout_id'])) {
            $checkout_id = $_GET['checkout_id'];
        
            // Construct the SQL query to retrieve payment information along with the username
            $query = "SELECT u.username, c.date, c.payment_method, p.product_title, c.total_price
                    FROM checkout c
                    INNER JOIN user u ON c.user = u.cust_id
                    INNER JOIN payment_cart pc ON c.payment_cart = pc.paymentcart_id
                    INNER JOIN products p ON pc.product_id = p.product_id
                    WHERE c.checkout_id = $checkout_id";
        
            // Initialize variables to store receipt details
            $payment_id = $checkout_id;
            $product_details = array();
            $username = "";
            $date = "";
            $payment_method = "";
            $total_price = 0;
        
            if ($r = mysqli_query($db, $query)) {
                while ($row = mysqli_fetch_array($r)) {
                    // Populate the product details array
                    $product_details[] = $row;
                    $date = $row['date'];
                    $total_price = $row['total_price'];
                    $username = $row['username'];
                    $payment_method = $row['payment_method'];
                }

            } 
            
            else {
                echo mysqli_error($db) . "The query was: " . $query;
            }
        
            // Display the payment receipt
            echo '<div class="col-sm-6 col-lg-6 mx-auto">
                <br/>
                <div class="print_title d-flex justify-content-center align-items-center flex-column">
                    <h4>Monkey Apes</h4>
                    <br /><br />
                </div>';
        
                echo '<div class="receipt border rounded p-5">
                    <h4>Receipt</h4>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <tr>
                                <td>Payment ID</td>
                                <br /><br /><br />
                                <td>Date & Time</td>
                                <br /><br /><br />
                                <td>Username</td>
                                <br /><br /><br />
                                <td>Payment Methods</td>
                                <br /><br /><br />
                                <td>Item Name</td>
                                <br /><br /><br />
                                <td>Amount</td>
                            </tr>
                        </div>';
        
                        echo '<div class="col text-end">
                            <tr>';
                                echo "<td>{$payment_id}</td>
                                <br /><br /><br />
                                <td>{$date}</td>
                                <br /><br /><br />
                                <td>{$username}</td>
                                <br /><br /><br />
                                <td>{$payment_method}</td>
                                <br /><br /><br />";
        
                    // Display product details
                    foreach ($product_details as $product) {
                        echo "<td>{$product['product_title']}</td><br/><br/><br/>";
                        echo "<td>RM{$product['total_price']}</td><br/><br/><br/>";
                    }
        
                            echo '</tr>
                        </div>
                    </div>

                    <br/><br/>';
        
                    echo '<div class="row">
                        <div class="col-7 text-end">
                            <a href="payment_history.php"><button type="button" class="btn btn-dark text-light">Back to Payment History</button></a>
                        </div>  

                        <div class="col-5">            
                            <a href="#"><button type="button" class="btn btn-dark text-light" button onclick="window.print();">Print Receipt</button></a>
                        </div>
                    </div>
                </div>
            </div>';
        }
        
    ?>

    <br /><br /><br /><br />

    <?php include 'footer.php';?>

    <div id="customer-service-chatbox" style="position: fixed; bottom: 20px; right: 20px; z-index: 100;">
        <div id="chat-button">
            <a href="./chat/login.php"><img src="img/customer-service.png" alt="Chat" width="50" height="50" style="cursor: pointer;"></a>
        </div>
    </div>

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