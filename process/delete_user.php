<?php
  include '../config/db_connect.php';

  if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']){
    $_SESSION['error'] = "Invalid token";
    header('Location: ../register.php');
    die();
  }else{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $user_id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
      $user_id = mysqli_real_escape_string($connection, $user_id);

      $query = "DELETE FROM users WHERE id = '$user_id'";
      $result = mysqli_query($connection, $query);
      if($result){

        $_SESSION['success'] = "User deleted successfully!";
        unset($_SESSION['csrf_token']);
        header('Location: ../index.php');
        exit();
      }
    }else{
      header('Location: ../index.php');
      exit();
    }    
  }






?>