<?php
session_start();
include_once "config.php";

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conn, "SELECT * FROM chatusers WHERE email = '{$email}'");

    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $enc_pass = $row['password']; // Retrieve the hashed password from the database

        if (password_verify($password, $enc_pass)) { // Use password_verify to compare the password
            $status = "Active";
            $sql2 = mysqli_query($conn, "UPDATE chatusers SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");

            if ($sql2) {
                $_SESSION['unique_id'] = $row['unique_id'];

                echo "success";
            } else {
                echo "Something went wrong. Please try again!";
            }
        } else {
            echo "Email or Password is Incorrect!";
        }
    } else {
        echo "$email - This email does not Exist!";
    }
} else {
    echo "Please enter all the fields!";
}
?>
