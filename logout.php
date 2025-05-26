<?php
  include './config/db_connect.php';
  session_destroy();
  header('Location: ./login.php');
  die();


?>