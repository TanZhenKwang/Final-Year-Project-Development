<?php
    include 'header.php';
    include 'connect.php';

    // Check if the user is logged in and get their user_id from the session
    if (!isset($_SESSION['cust_id'])) {
        echo '<script>
            alert("Please login to continue");
            window.location.href = "./loginregister.php"; 
        </script>';
        exit();
    }

    $cust_id = $_SESSION['cust_id'];

    // Fetch cart data for the user from the database
    $sql = "SELECT c.cart_id, p.product_id, p.product_title, p.product_price, p.product_image, c.quantity
            FROM cart c
            JOIN products p ON c.product_id = p.product_id
            WHERE c.cust_id = ?";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $cust_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $totalPrice = 0; // Initialize the total price

    if (isset($_POST['place_order'])) {
        // Get the selected payment method
        $paymentMethod = $_POST['payment-method'];

        // Initialize an array to store the product IDs and quantities from the cart
        $productsToUpdate = [];

        // Calculate the total price based on the cart items
        while ($row = $result->fetch_assoc()) {
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];

            // Retrieve product information from the cart table
            $product_info = $row['product_title'] . " - Quantity: " . $quantity;

            // Add product information to the array
            $productInfoArray[] = $product_info;

            // Add the product and quantity to the array for updating
            $productsToUpdate[] = ['product_id' => $product_id, 'quantity' => $quantity];

            // Update the total price
            $product_price = $row['product_price'];
            $totalProductPrice = $product_price * $quantity;
            $totalPrice += $totalProductPrice;
        }

        // Start a database transaction to ensure consistency
        $db->begin_transaction();

        // Flag to track whether all updates were successful
        $allUpdatesSuccessful = true;

        // Attempt to update product quantities in the products_info table
        foreach ($productsToUpdate as $productData) {
            $product_id = $productData['product_id'];
            $quantity = $productData['quantity'];

            // Update the quantity in the products_info table
            $update_stock = "UPDATE products_info SET quantity = quantity - ? WHERE product = ?";
            $update_stock_stmt = $db->prepare($update_stock);
            $update_stock_stmt->bind_param("ii", $quantity, $product_id);

            if (!$update_stock_stmt->execute()) {
                // Update for one product failed, set the flag to false
                $allUpdatesSuccessful = false;
                break; // Exit the loop early
            }
        }

        foreach ($productsToUpdate as $productData) {
            $product_id = $productData['product_id'];
            $quantity = $productData['quantity'];
    
            // Insert the data into the payment_cart table
            $insertPaymentCart = "INSERT INTO payment_cart (cust_id, product_id, quantity) VALUES (?, ?, ?)";
            $stmtInsertPaymentCart = $db->prepare($insertPaymentCart);
            $stmtInsertPaymentCart->bind_param("iii", $cust_id, $product_id, $quantity);
    
            if (!$stmtInsertPaymentCart->execute()) {
                // Insert for one product failed, set the flag to false
                $allInsertsSuccessful = false;
                break; // Exit the loop early
            }
        }
    
        if ($allUpdatesSuccessful) {
            // Commit the transaction if all updates were successful
            $db->commit();
    
            // Get the current date and time
            $orderDate = date('Y-m-d H:i:s');
    
            // Insert the order into the "checkout" table with the current date and time
            $insertQuery = "INSERT INTO checkout (user, payment_cart, total_price, payment_method, date) VALUES (?, ?, ?, ?, NOW())";
    
            // Prepare and execute the query
            $stmt = $db->prepare($insertQuery);
    
            // Fetch the paymentcart_id from the payment_cart table
            $fetchPaymentCartIdQuery = "SELECT paymentcart_id FROM payment_cart WHERE cust_id = ?";
            $stmtFetchPaymentCartId = $db->prepare($fetchPaymentCartIdQuery);
            $stmtFetchPaymentCartId->bind_param("i", $cust_id);
            $stmtFetchPaymentCartId->execute();
            $stmtFetchPaymentCartId->store_result();
    
            if ($stmtFetchPaymentCartId->num_rows > 0) {
                $stmtFetchPaymentCartId->bind_result($paymentcart_id);
                $stmtFetchPaymentCartId->fetch();
    
                // Close the statement
                $stmtFetchPaymentCartId->close();
    
                // Now, bind the values and execute the query
                $stmt->bind_param("iiis", $cust_id, $paymentcart_id, $totalPrice, $paymentMethod);
    
                if ($stmt->execute()) {
                    // The order has been placed successfully.
                    // Retrieve the newly inserted checkout_id.
                    $checkout_id = $stmt->insert_id;
    
                    // Delete items from the cart table for this user
                    $deleteCartItemsQuery = "DELETE FROM cart WHERE cust_id = ?";
                    $stmtDeleteCartItems = $db->prepare($deleteCartItemsQuery);
                    $stmtDeleteCartItems->bind_param("i", $cust_id);
                    $stmtDeleteCartItems->execute();
    
                    // Redirect to the index page or perform further actions
                    echo '<script>window.location.href = "index.php";</script>';
                } else {
                    // Handle the case where the order couldn't be placed.
                    echo '<script>alert("Error placing the order.");</script>';
                    echo "<script>
                        window.location.href='404.php';
                    </script>";
                }
            } else {
                // Handle the case where the paymentcart_id is not found.
                echo '<script>alert("Error: Payment Cart ID not found.");</script>';
                echo "<script>
                    window.location.href='404.php';
                </script>";
            }
        } else {
            // Roll back the transaction if any update failed
            $db->rollback();
            // Handle the case where an update failed
            echo '<script>alert("Error decrementing stock for product.");</script>';
            echo "<script>
                window.location.href='404.php';
            </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Favicons -->
    <link href="./img/icons.png" rel="icon">
    <title>Monkey Apes | Checkout</title>

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
        .add-cart-link {
            text-decoration: none;
            background-color: transparent;
            border: none;
            color: red;
            cursor: pointer;
            padding: 0;
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
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form method="post" action="checkout.php">
                    <div class="col-lg-18 col-md-10 center-content">
                        <h6 class="checkout__title">Billing Details</h6>

                        <div class="checkout__order">
                            <h4 class="order__title">Your order</h4>
                            <div class="checkout__order__products">Product <span>Total</span></div>

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

                                    $imagePath = './admin/products_images/' . $row["product_image"];
                            ?>
                                <ul class="checkout__total__products">
                                    <li><?php echo $product_title; ?> <span>RM <?php echo $totalProductPrice; ?></span></li>
                                </ul>
                            <?php
                                }
                            }
                            ?>

                            <ul class="checkout__total__all">
                                <li>Total <span>RM <?php echo number_format($totalPrice, 2); ?></span></li>
                            </ul>

                            <?php 
                                $cust_id = $_SESSION['cust_id'];

                                // Fetch credit card data for the user from the database
                                $sql = "SELECT cc.card_id, cc.card_number, cc.card_holder, cc.expiration_month, cc.expiration_year, cc.cvv
                                        FROM creditcards cc
                                        JOIN user u ON cc.user = u.cust_id
                                        WHERE u.cust_id = ?";
                            
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("i", $cust_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $creditCardsExist = false;
                            ?>

                            <!-- Add Credit Card Button (Initially Hidden) -->
                            <a href="creditcard.php" class="add-cart-link" id="add-credit-card-btn" style="display: none">+ Add Credit Card</a>
                            <br />

                            <div id="credit-card-details" style="display: none">
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    $creditCardsExist = true;
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div>';
                                        echo $row['card_holder'] . '' . $row['card_number'];
                                        echo '</div>';
                                    }
                                }
                                ?>
                            </div>

                            <br />
                            <div class="checkout__input__checkbox">
                                <label for="credit-card">
                                    Credit Card
                                    <input type="radio" id="credit-card" name="payment-method" value="credit-card">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="cash-on-delivery">
                                    Cash on Delivery
                                    <input type="radio" id="cash-on-delivery" name="payment-method" value="cash-on-delivery">
                                    <span class="checkmark"></span>
                                </label>
                            </div>


                            <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
                            <button type="submit" class="site-btn" name="place_order" <?php if (!$creditCardsExist) echo 'disabled'; ?>>PLACE ORDER</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <?php include 'footer.php' ?>

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

    <!-- Add Credit Card Button (Initially Hidden) -->
    <a href="creditcard.php" class="add-cart-link"id="add-credit-card-btn" style="display: none">+ Add Credit Card</a>

    <script>
        // Function to handle payment method selection
        function handlePaymentMethodSelection() {
            const creditCardRadio = document.getElementById('credit-card');
            const addCreditCardBtn = document.getElementById('add-credit-card-btn');
            const creditCardDetails = document.getElementById('credit-card-details');

            if (creditCardRadio.checked) {
                addCreditCardBtn.style.display = 'block';
                creditCardDetails.style.display = 'block';
            } else {
                addCreditCardBtn.style.display = 'none';
                creditCardDetails.style.display = 'none';
            }
        }

        // Add an event listener to the payment method radios
        const paymentMethodRadios = document.querySelectorAll('input[name="payment-method"]');
        paymentMethodRadios.forEach(radio => {
            radio.addEventListener('change', handlePaymentMethodSelection);
        });
    </script>

</body>

</html>