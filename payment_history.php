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
    
    <?php include 'header.php';?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Payment History</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.php">Home</a>
                            <span>Payment History</span>
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
            
            echo '<br/><table class="table table-hover mx-auto" style="max-width:75%">
                <tr>
                    <th width="5%" class="text-center">Payment ID</th>
                    <th width="20%" class="text-center">Date & Time</th>
                    <th width="5%" class="text-center">Payment Amount</th>
                    <th width="5%" class="text-center"></th>
                </tr>';
        }
        
        $query = "SELECT * FROM checkout c, user u 
        WHERE c.user = u.cust_id
        AND c.user = $cust_id
        ORDER BY c.checkout_id DESC";
        
        if ($r = mysqli_query($db, $query)) {
            if (mysqli_num_rows($r) > 0 ) { 
                while ($row = mysqli_fetch_array($r)) {
                    $checkout_id= $row['checkout_id'];
                    $date= $row['date'];
                    $total_price= $row['total_price'];
                    
                    echo"<tr>
                    <td width=\"5%\" class=\"text-center\">{$row['checkout_id']}</td>
                        <td width=\"20%\" class=\"text-center\">{$row['date']}</td>
                        <td width=\"5%\" class=\"text-center\">RM {$row['total_price']}</td>
                        <td width=\"10%\" class=\"text-center\"><a href=\"payment_historydetails.php?checkout_id=$checkout_id\"><button class=\"btn btn-dark rounded-circle\" style=\"width:38px;height:38px\"><i class=\"fa fa-angle-right text-light\" style=\"font-size:14pt\"></i></button></a></td>
                </tr>";
                }
            }
            else {
                echo '<tr><td colspan="5" class="text-center"><br/><br/><br/><br/><br/>No result found.<br/><br/><br/><br/></td></tr>';
            }
            echo"</table><br/><br/><br/><br/>"; 
        }
        
        else {
            echo mysqli_error($db) . "The query was: " . $query;
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