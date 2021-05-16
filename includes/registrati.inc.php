<?php
  session_start();

  require('config.inc.php');

  if( isset($_GET['flag']) && $_GET['flag'] === "pagina_reg"){
    $_SESSION['page'] = "registrati.php";
    header('Location: ../index.php');
    exit();
  }else if( isset($_GET['flag']) && $_GET['flag'] === "registrazione" ){
    if( empty($_POST['username']) || empty($_POST['mail']) || empty($_POST['pwd']) || empty($_POST['pwd_rep'])){
      if( !isset($_SESSION['page']) ){
        $_SESSION['page'] = "registrati.php";
      }
      header('Location: ../index.php?flag=pagina_reg&errorR=emptyfields&username='.$_POST['username']."&mail=".$_POST['mail']);
      exit();
    }else if( $_POST['pwd'] !== $_POST['pwd_rep'] ){
      if( !isset($_SESSION['page']) ){
        $_SESSION['page'] = "registrati.php";
      }
      header('Location: ../index.php?flag=pagina_reg&errorR=pwdcnd&username='.$_POST['username']."&mail=".$_POST['mail']);
      exit();
    }else if( !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) ){
      if( !isset($_SESSION['page']) ){
        $_SESSION['page'] = "registrati.php";
      }
      header('Location: ../index.php?flag=pagina_reg&errorR=wrgmail&username='.$_POST['username']);
      exit();
    }else{
      $usr = $_POST['username'];
      $pwd = $_POST['pwd'];
      $mail = $_POST['mail'];
      $pwd = password_hash($pwd, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("SELECT username FROM utente WHERE username = ?;");
      $stmt->bind_param("s", $usr);
      $stmt->execute();
      $result = $stmt->get_result();
      if ( mysqli_num_rows($result) == 1 ) {
        if( !isset($_SESSION['page']) ){
          $_SESSION['page'] = "registrati.php";
        }
        header('Location: ../index.php?flag=pagina_reg&errorR=usrwrg');
        exit();
      }else{
        $stmt = $conn->prepare("INSERT INTO utente (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $usr, $mail, $pwd);

        $stmt->execute();

        $stmt->close();
        $conn->close();

        if( !isset($_SESSION['page']) ){
          $_SESSION['page'] = "registrati.php";
        }

        header('Location: ../index.php?flag=pagina_reg&signup=success&username');
        exit();
      }
    }
  }else{
    header('Location: ../index.php');
    exit();
  }
?>