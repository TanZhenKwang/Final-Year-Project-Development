<?php
    session_start();
    include 'connect.php';

    $successMessage = "";
    $errorMessage = "";

    // Your database connection should be included at the beginning
    // Make sure 'connect.php' establishes a valid database connection

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['productsinfo'])) {
            // Assuming you've sanitized 'productsinfo' properly in 'connect.php'

            // Sanitize and validate other POST data (e.g., product_id)
            $product_id = $_POST['product_id'];
            $productsinfo = $_POST['productsinfo'];
            $quantity = $_POST['quantity']; // Default quantity

            // You should validate and sanitize $product_id, $productsinfo, and other input fields here.

            // Check if the user is logged in (you may need to adjust this condition)
            if (isset($_SESSION['cust_id'])) {
                $cust_id = $_SESSION['cust_id'];

                // Check if the same product with the same product_id is already in the cart
                $sql = "SELECT cart_id, quantity FROM cart WHERE cust_id = ? AND product_id = ? AND productsinfo = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("iis", $cust_id, $product_id, $productsinfo);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // If the product is already in the cart, update the quantity
                    $row = $result->fetch_assoc();
                    $cart_id = $row['cart_id'];
                    $current_quantity = $row['quantity'];
                    $new_quantity = $current_quantity + $quantity;

                    $update = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
                    $update_stmt = $db->prepare($update);
                    $update_stmt->bind_param("ii", $new_quantity, $cart_id);

                    if ($update_stmt->execute()) {
                        $successMessage = "Product quantity updated in the cart.";
                    } else {
                        $errorMessage = "Error updating product quantity: " . $db->error;
                    }
                } else {
                    // If the product is not in the cart, insert a new product
                    $insert = "INSERT INTO cart (cust_id, product_id, productsinfo, quantity) VALUES (?, ?, ?, ?)";
                    $insert_stmt = $db->prepare($insert);
                    $insert_stmt->bind_param("iiis", $cust_id, $product_id, $productsinfo, $quantity);

                    if ($insert_stmt->execute()) {
                        $successMessage = "Product added to the cart.";
                    } else {
                        $errorMessage = "Error adding product to the cart: " . $db->error;
                    }
                }
            } else {
                // Handle the case where the user is not logged in
                $errorMessage = "Please log in to add products to the cart.";
            }
        } else {
            // Handle the case where 'productsinfo' is not set in the form submission
            $errorMessage = "Please select a product information option.";
        }
    }

    // Redirect with success or error message
    header('Location: shop.php?success=' . urlencode($successMessage) . '&error=' . urlencode($errorMessage));
    exit();
?>