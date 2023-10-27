<?php
include 'header.php';
include 'connect.php';

// Check if the user is logged in and get their user_id from session
if (!isset($_SESSION['cust_id'])) {
    echo '<script>
        alert("Please login to continue");
        window.location.href = "./loginregister.php"; 
    </script>';
    exit();
}

$cust_id = $_SESSION['cust_id'];

// Fetch cart data for the user from the database
$sql = "SELECT w.wishlist_id, p.product_id, p.product_title, p.product_price, p.product_image
        FROM wishlist w
        JOIN products p ON w.product_id = p.product_id
        WHERE w.cust_id = ?";

$stmt = $db->prepare($sql);
$stmt->bind_param("i", $cust_id);
$stmt->execute();
$result = $stmt->get_result();

$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monkey Apes | Wishlist</title>

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

    <style>
        .empty-cart {
            margin-left: 300px;
        }

        /* CSS for centering the wishlist content */
        .centered-content {
            display: flex;
            flex-direction: column;
            justify-content: center; /* Vertically center */
            align-items: center; /* Horizontally center */
        }



        </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Wishlist</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.php">Home</a>
                            <span>Wishlist</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shopping-cart spad centered-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ">
                    <div class="shopping__cart__table">
                        <table>
                        <thead>
                                <tr>
                                    <th>Product</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        // Extract data from the row
                                        $wishlist_id = $row['wishlist_id'];
                                        $product_id = $row['product_id'];
                                        $product_title = $row['product_title'];
                                        $product_image = $row['product_image'];
                                        $product_price = $row['product_price'];

                                        $imagePath = './admin/products_images/' . $row["product_image"];
                                ?>
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="<?php echo $imagePath; ?>" width="80px" height="80px" alt="">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6><?php echo $product_title; ?></h6>
                                                    <h5>RM<?php echo $product_price; ?></h5>
                                                </div>
                                            </td>
                                            <td class="cart__close">
                                                <a href="wishlist.php?delete=true&wishlist_id=<?php echo $wishlist_id; ?>" onclick="return confirmDelete();">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                else {
                                    echo '<section class="wishlist-cart spad empty-cart">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="text-center">
                                                        <h3>Your wishlist cart is empty!</h3>
                                                        <br />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="./shop.php">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="./wishlist.php"><i class="fa fa-spinner"></i> Update wishlist</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if (isset($_GET['delete']) && isset($_GET['wishlist_id'])) {

        $wishlist_id = $_GET['wishlist_id'];

        $sql = "DELETE FROM wishlist WHERE wishlist_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $wishlist_id);

        if ($stmt->execute()) {
            echo '<script>
			window.location = "wishlist.php";
			</script>';
            exit();
        } else {
            echo "Error deleting from wishlist";
        }
        $stmt->close();
        $db->close();
    }
    ?>

    <script>
        function confirmDelete() {
            if (confirm("Are you sure you want to delete this item?")) {
                return true;
            } else {
                return false;
            }
        }
    </script>

    <?php include 'footer.php';?>

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
