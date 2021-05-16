<?php
  session_start();
  if( isset($_GET['flag']) && $_GET['flag'] == "ok" ){
    if( isset($_GET['link']) ){
      $_SESSION['link'] = $_GET['link'];
      $_SESSION['page'] = $_GET['link'].".php";
    }
  }
  header('Location: ../index.php');
  exit();
?>