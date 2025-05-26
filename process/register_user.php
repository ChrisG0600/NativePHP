<?php
  include '../config/db_connect.php';

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = strtolower($email);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirm_password = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $confirm_password = mysqli_real_escape_string($connection, $confirm_password);


    if(empty($username) || empty($email) || empty($password) || empty($confirm_password)){
      $_SESSION['register-error'] = "Please fill in all fields";
      header('Location: ../register.php');
      die();
    }else{
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['register-error'] = "Please enter a valid email address.";
        header('Location: ../register.php');
        exit();
      }

      if($password !== $confirm_password){
        $_SESSION['register-error'] = "Passwords do not match";
        header('Location: ../register.php');
        die();
      }else{
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //Validate username or email
        $check_query = "SELECT username, email FROM accounts WHERE username =' $username' or email = '$email'";
        $check_result = mysqli_query($connection, $check_query);
        if(mysqli_num_rows($check_result) > 0){
          $_SESSION['register-error'] = "Username or email already exists";
          header('Location: ../register.php');
          die();
        }else{

          $query = "INSERT INTO accounts (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
          $result = mysqli_query($connection, $query);

          if($result){
            $_SESSION['success'] = "Registration successful. You can now login.";
            header('Location: ../login.php');
            die();
          }
        }

      }
    }
  }else{
    header('Location: ../register.php');
    die();
  }






?>