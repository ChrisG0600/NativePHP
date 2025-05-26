<?php
  require '../config/db_connect.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstName = filter_var($_POST['firstName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastName = filter_var($_POST['lastName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $firstName = mysqli_real_escape_string($connection, $firstName);
    $lastName = mysqli_real_escape_string($connection, $lastName);
    $age = mysqli_real_escape_string($connection, $age);
    $email = mysqli_real_escape_string($connection, $email);

    if(empty($firstName) || empty($lastName) || empty($age) || empty($email)){
      $_SESSION['error'] = "All fields are required";
      header('Location: ../index.php');
      exit();
    }else{
      $query = "INSERT INTO users (firstName, lastName, age, email) VALUES ('$firstName', '$lastName', '$age', '$email')";
      $result = mysqli_query($connection, $query);

      if($result){
        $_SESSION['success'] = "User Added Successfully";
        header('Location: ../index.php');
      }      
    }

  }else{
    header('Location: ../index.php');
    exit();
  }