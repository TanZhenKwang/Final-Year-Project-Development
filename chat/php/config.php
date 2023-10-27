<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "monkeyapes";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Connection Error".mysqli_connect_error();
  }
?>
