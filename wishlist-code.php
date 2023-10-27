<?php
session_start();
include 'connect.php';

$successMessage = "";
$errorMessage = "";

if (isset($_SESSION['cust_id']) && isset($_POST['product_id'])) {
    $cust_id = $_SESSION['cust_id'];
    $product_id = $_POST['product_id'];

    // Check if the same product is already in the cart
    $sql = "SELECT wishlist_id FROM wishlist WHERE cust_id = ? AND product_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ii", $cust_id, $product_id); // Changed 'iii' to 'ii' to match the number of parameters
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $wishlist_id = $row['wishlist_id'];

    } else {
        $insert = "INSERT INTO wishlist (cust_id, product_id) VALUES (?, ?)";
        $insert_stmt = $db->prepare($insert);
        $insert_stmt->bind_param("ii", $cust_id, $product_id); // Changed 'iii' to 'ii' to match the number of parameters
        if ($insert_stmt->execute()) {
            $successMessage = "Product added to the cart.";
        } else {
            $errorMessage = "Error adding product to the cart: " . $db->error;
            echo "<script>
                window.location.href='404.php';
            </script>";
        }
        $insert_stmt->close();
    }
} else {
    // If the user is not logged in
    $errorMessage = "Please log in to add products to the wishlist.";
}

header('Location: shop.php?success=' . urlencode($successMessage) . '&error=' . urlencode($errorMessage));
exit();
?>