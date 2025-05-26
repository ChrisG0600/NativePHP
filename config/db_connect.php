<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }
  
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "crud_app";

  $connection = mysqli_connect($servername, $username, $password, $dbname);
  if(!$connection){
    die('Connection Failed: ' . mysqli_connect_error());
  }else{
    // echo "Connected successfully";
  }
?>