<?php
  session_start();
  if( isset($_GET['cap']) ){
    $_SESSION['caricaPost'] = $_GET['cap'];
  }
  if( isset($_GET['post']) ){
    $_SESSION['postSingolo'] = $_GET['post'];
  }
  header('Location: ../index.php');
  exit();
?>