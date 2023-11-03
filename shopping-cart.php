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
    $sql = "SELECT 
                c.cart_id,
                p.product_id,
                p.product_title,
                p.product_price,
                p.product_image,
                c.quantity,
                si.size_title,
                ci.color_title
                FROM cart c
                JOIN products p ON c.product_id = p.product_id
                JOIN products_info pi ON c.productsinfo = pi.productsinfo_id
                JOIN size si ON pi.size = si.size_id
                JOIN color ci ON pi.color = ci.color_id
                WHERE c.cust_id = ?
            ";

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Favicons -->
    <link href="./img/icons.png" rel="icon">
    <title>Monkey Apes | Shopping Cart</title>

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

        .low-stock-reminder {
            color: red;
            font-weight: bold;
            font-size: 14px;
            margin-top: 5px;
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
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.php">Home</a>
                            <a href="./shop.php">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                        <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        // Extract data from the row
                                        $cart_id = $row['cart_id'];
                                        $product_id = $row['product_id'];
                                        $product_title = $row['product_title'];
                                        $product_image = $row['product_image'];
                                        $product_price = $row['product_price'];
                                        $quantity = $row['quantity'];
                                        $totalProductPrice = $product_price * $quantity;
                                        $totalPrice += $totalProductPrice;

                                        $size = $row['color_title'];
                                        $color = $row['size_title'];

                                        $imagePath = './admin/products_images/' . $row["product_image"];
                                        
                                        $queryStock = "SELECT quantity FROM products_info WHERE product = ?";
                                        $stmtStock = $db->prepare($queryStock);
                                        $stmtStock->bind_param("i", $product_id);
                                        $stmtStock->execute();
                                        $stmtStock->store_result();
                                
                                        if ($stmtStock->num_rows > 0) {
                                            $stmtStock->bind_result($availableQuantity);
                                            $stmtStock->fetch();
                                        } else {
                                            $availableQuantity = 0; // Handle the case when the product is not found in the products_info table
                                        }
                                        
                                        $stmtStock->close();
                                
                                        if ($quantity > $availableQuantity) {
                                            echo '<p class="low-stock-reminder">Low Stock: Only ' . $availableQuantity . ' left in stock for ' . $product_title . '</p>';
                                        }
                                ?>
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="<?php echo $imagePath; ?>" width="80px" height="80px" alt="">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6><?php echo $product_title; ?></h6>
                                                    <h5>RM<?php echo $product_price; ?></h5>
                                                    <span><?php echo $size; ?>/<?php echo $color; ?></span>
                                                </div>
                                            </td>

                                           
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="input-group">
                                                        <button class="btn btn-outline-secondary" onclick="adjustQuantity(<?php echo $cart_id; ?>, -1, <?php echo $product_price; ?>)">-</button>
                                                        <span class="input-group-text" id="quantity-<?php echo $cart_id; ?>"><?php echo $quantity; ?></span>
                                                        <button class="btn btn-outline-secondary" onclick="adjustQuantity(<?php echo $cart_id; ?>, 1, <?php echo $product_price; ?>)">+</button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">RM<?php echo $totalProductPrice; ?></td>
                                            <td class="cart__close">
                                                <a href="shopping-cart.php?delete=true&cart_id=<?php echo $cart_id; ?>" onclick="return confirmDelete();">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                else {
                                    echo '<section class="shopping-cart spad empty-cart">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="text-center">
                                                        <h3>Your shopping cart is empty!</h3>
                                                        <br />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>';
                                }
                                ?>

                                <?php
                                    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cart_id']) && isset($_POST['new_quantity'])) {
                                        $cart_id = $_POST['cart_id'];
                                        $new_quantity = $_POST['new_quantity'];

                                        // Update the quantity in the cart table
                                        $sql = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
                                        $stmt = $db->prepare($sql);
                                        $stmt->bind_param("ii", $new_quantity, $cart_id);

                                        if ($stmt->execute()) {
                                            echo json_encode(['success' => true]);
                                        } 

                                        else {
                                            echo json_encode(['success' => false, 'message' => 'Error updating quantity']);
                                        }

                                        $stmt->close();
                                        $db->close();
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
                                <a href="./shopping-cart.php"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <br /><br />
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <?php if (empty($product_title)) { ?>
                            <p>Your shopping cart is empty.</p>
                        <?php } else { ?>
                            <ul>
                                <li><?php echo $product_title; ?> <span>RM <?php echo $totalProductPrice; ?></span></li>
                            </ul>
                            <hr />
                            <ul>
                                <li>Total <span>RM <?php echo number_format($totalPrice, 2); ?></span></li>
                            </ul>
                            <a href="./checkout.php" class="primary-btn">Proceed to checkout</a>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php
    if (isset($_GET['delete']) && isset($_GET['cart_id'])) {

        $cart_id = $_GET['cart_id'];

        $sql = "DELETE FROM cart WHERE cart_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $cart_id);

        if ($stmt->execute()) {
            echo '<script>
			window.location = "shopping-cart.php";
			</script>';
            exit();
        } else {
            echo "Error deleting from cart";
        }
        $stmt->close();
        $db->close();
    }
    ?>
    <!-- Adjust QUANTITY FUNCTION -->
    <script>
        function adjustQuantity(cartId, change, productPrice, callback) {
            const quantityElement = document.getElementById(`quantity-${cartId}`);

            if (quantityElement) {
                let quantity = parseInt(quantityElement.textContent);
                quantity += change;

                if (quantity >= 1) {
                    quantityElement.textContent = quantity;

                    // Send an AJAX request to update the quantity in the database
                    $.ajax({
                        url: 'shopping-cart.php',
                        type: 'POST',
                        data: {
                            cart_id: cartId,
                            new_quantity: quantity
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response); // Add this line for debugging
                            if (response.success) {
                                // Update the quantity on the page
                                const quantityElement = document.getElementById(`quantity-${cartId}`);
                                if (quantityElement) {
                                    quantityElement.textContent = quantity;
                                }

                                // Update the total price on the page
                                const totalProductPriceElement = document.querySelector(`[data-productid="${product_id}"]`);
                                if (totalProductPriceElement) {
                                    totalProductPriceElement.textContent = 'RM' + (productPrice * quantity);
                                }

                                // Reload the page after a short delay (e.g., 2 seconds)
                                setTimeout(function () {
                                    if (typeof callback === 'function') {
                                        callback();
                                    }
                                }, 2000); // 2000 milliseconds (2 seconds)
                            } else {
                                // Handle errors, e.g., display an error message to the user
                                console.error(response.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText); // Add this line for debugging
                        }
                    });
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn-outline');

            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const cartId = button.getAttribute('data-cartid');
                    const change = button.textContent === '-' ? -1 : 1;
                    const productPrice = parseFloat(button.getAttribute('data-productprice'));

                    // Pass a callback function to reload the page after updating the quantity
                    adjustQuantity(cartId, change, productPrice, function () {
                        // Reload the page
                        window.location.reload();
                    });
                });
            });
        });

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
