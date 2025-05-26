<?php
  include '../config/db_connect.php';

  if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']){
    $_SESSION['error'] = "Invalid token";
    header('Location: ../user-edit.php');
    die();
  }else{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $user_id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
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
        $query = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', age = '$age', email = '$email' WHERE id = $user_id";
        $result = mysqli_query($connection, $query);

        if($result){
          $_SESSION['success'] = "User Edited Successfully";
          unset($_SESSION['csrf_token']);
          header('Location: ../index.php');
        }      
      }

    }else{
      header("Location: ../index.php");
      exit();
    }    
  }











?>