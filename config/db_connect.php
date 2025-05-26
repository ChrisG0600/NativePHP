<?php
  session_start();

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