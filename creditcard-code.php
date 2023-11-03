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

        // Validate that the card number does not contain alphabetic characters
        if (!preg_match('/[a-zA-Z]/', $cardNumber)) {
            // Validate that the card holder name contains only alphabetic characters
            if (preg_match('/^[a-zA-Z]+$/', $cardHolder)) {
                // Validate that the CVV contains only numeric digits
                if (ctype_digit($cvv)) {
                    // Check if the same credit card already exists for the user
                    $sql = "SELECT card_id, cvv FROM creditcards WHERE user = ? AND card_number = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("is", $cust_id, $cardNumber);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $cvvHashFromDB = $row['cvv_hash'];

                        if (password_verify($cvv, $cvvHashFromDB)) {
                            // If the same credit card and CVV already exist, you can handle it as needed
                            $_SESSION['status'] = "This credit card is already associated with your account.";
                        } else {
                            $_SESSION['status'] = "Invalid CVV for the existing credit card.";
                        }
                    } else {
                        // Insert credit card data with bcrypt-hashed CVV
                        $cvvHash = password_hash($cvv, PASSWORD_BCRYPT);

                        $insert = "INSERT INTO creditcards (user, card_number, card_holder, expiration_month, expiration_year, cvv) VALUES (?, ?, ?, ?, ?, ?)";
                        $insert_stmt = $db->prepare($insert);
                        $insert_stmt->bind_param("issiis", $cust_id, $cardNumber, $cardHolder, $expirationMonth, $expirationYear, $cvvHash);

                        if ($insert_stmt->execute()) {
                            $successMessage = "Credit card added successfully";

                            // Redirect to checkout.php after successful credit card submission
                            header('Location: checkout.php');
                            exit();
                        } else {
                            $_SESSION['status'] = "Error adding credit card: " . $db->error;
                            echo "<script>
                                window.location.href='404.php';
                            </script>";
                        }
                        $insert_stmt->close();
                    }
                } else {
                    $_SESSION['status'] = "Invalid CVV format (should contain only numeric digits).";
                }
            } else {
                $_SESSION['status'] = "Invalid card holder name format (should contain only alphabetic characters).";
            }
        } else {
            $_SESSION['status'] = "Invalid card number format (should not contain alphabetic characters).";
        }
    } else {
        // If the user is not logged in or missing credit card data
        $_SESSION['status'] = "Please login and provide valid credit card details.";
    }

    header('Location: creditcard.php?success=' . urlencode($successMessage) . '&error=' . urlencode($errorMessage));
    exit();
?>
