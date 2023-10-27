<?php
    session_start();
    include 'connect.php';

    $successMessage = "";
    $errorMessage = "";

    if (isset($_SESSION['cust_id']) && isset($_POST['card-number']) && isset($_POST['card-holder']) && isset($_POST['card-expiration-month']) && isset($_POST['card-expiration-year']) && isset($_POST['card-cvv'])) {
        $cust_id = $_SESSION['cust_id'];
        $cardNumber = $_POST['card-number'];
        $cardHolder = $_POST['card-holder'];
        $expirationMonth = $_POST['card-expiration-month'];
        $expirationYear = $_POST['card-expiration-year'];
        $cvv = $_POST['card-cvv'];

        // Check if the same credit card already exists for the user
        $sql = "SELECT card_id FROM creditcards WHERE user = ? AND card_number = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("is", $cust_id, $cardNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // If the same credit card already exists, you can handle it as needed
            $errorMessage = "This credit card is already associated with your account.";
        } else {
            // Insert credit card data
            $insert = "INSERT INTO creditcards (user, card_number, card_holder, expiration_month, expiration_year, cvv) VALUES (?, ?, ?, ?, ?, ?)";
            $insert_stmt = $db->prepare($insert);
            $insert_stmt->bind_param("issiis", $cust_id, $cardNumber, $cardHolder, $expirationMonth, $expirationYear, $cvv);
            
            if ($insert_stmt->execute()) {
                $successMessage = "Credit card added successfully.";
                
                // Redirect to checkout.php after successful credit card submission
                header('Location: checkout.php');
                exit();
            } else {
                $errorMessage = "Error adding credit card: " . $db->error;
                echo "<script>
                    window.location.href='404.php';
                </script>";
            }
            $insert_stmt->close();
        }
    } else {
        // If user not logged in or missing credit card data
        $errorMessage = "Please login and provide valid credit card details.";
    }

    header('Location: creditcard.php?success=' . urlencode($successMessage) . '&error=' . urlencode($errorMessage));
    exit();
?>
