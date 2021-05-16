<?php
  session_start();
  if( isset($_SESSION['utenteLoggato']) ){
    unset($_SESSION['utenteLoggato']);
    unset($_SESSION['personaggio']);
    unset($_SESSION['firstLog']);
    $_SESSION['page'] = "home.php";
  }
  $_SESSION['link'] = "home";
  header('Location: ../index.php');
  exit();
?>