<?php
    $db = mysqli_connect('localhost','root','','monkeyapes');

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    
    return $db;
?>