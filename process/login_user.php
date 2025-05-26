<?php
  include '../config/db_connect.php';

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = strtolower($email);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $email = mysqli_real_escape_string($connection, $email);

    if(empty($email) || empty($password)){
      $_SESSION['login-error'] = "Please fill in all fields";
      header('Location: ../login.php');
      die();
    }else{
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['login-error'] = "Please enter a valid email address.";
        header('Location: ../login.php');
        exit();
      }else{
        $check_query = "SELECT * FROM accounts  WHERE email = '$email'";
        $check_result = mysqli_query($connection, $check_query);

        if(mysqli_num_rows($check_result) > 0){
          // Veriy Passwors
          $user_record = mysqli_fetch_assoc($check_result);
          $user_password = $user_record['password'];

          if(password_verify($password, $user_password)){

            $_SESSION['user_id'] = $user_record['id'];
            $_SESSION['success'] = "Login successful";
            header('Location: ../index.php');
            die();
          }else{
            $_SESSION['login-error'] = "Incorrect password";
            header('Location: ../login.php');
            die();
          }

        }else{
          $_SESSION['login-error'] = "Email not found";
          header('Location: ../login.php');
          die();
        }
      }
    }
  }else{
    header('Location: ../login.php');
    die();
  }







?>