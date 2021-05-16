<?php
  session_start();
  require('config.inc.php');
  if( isset($_SESSION['username']) ){
    header('Location: ../index.php');
    exit();
  }else{
    if( isset($_POST['btnLogin']) ){
      if( isset($_POST['username_email']) && isset($_POST['password']) ){
        if( empty($_POST['username_email']) || empty($_POST['password']) ){
          header('Location: ../index.php?error=emptyfields&username_email='.$_POST['username_email']);
          exit();
        }else{
          $usr = $_POST['username_email'];
          $pwd = $_POST['password'];
          // $pwdCrypted = password_hash($pwd, PASSWORD_DEFAULT);
          $stmt = $conn->prepare("SELECT * FROM utente WHERE username = ? OR email = ?;");
          $stmt->bind_param("ss", $usr, $usr );

          $stmt->execute();
          $result = $stmt->get_result();
          if( mysqli_num_rows($result) == 1 ){
            $row = $result->fetch_array();
            if( password_verify( $pwd, $row['password']) ){
              if( !isset($_SESSION['utenteLoggato']) ){  
                $_SESSION['utenteLoggato'] = $row['username'];
                if( strcasecmp($row['username'], "master") == 0 || strcasecmp($row['username'], "admin") == 0 ){
                  $_SESSION['page'] = "admin.php";
                  $_SESSION['link'] = "admin";
                }else if( is_null($row['firstLog']) ){
                  $_SESSION['page'] = "statPage.php";
                  $_SESSION['link'] = "statPage";
                  $_SESSION['firstLog'] = true;
                }else if( $row['firstLog'] === "n"){
                  $_SESSION['page'] = "profilo.php";
                  $_SESSION['link'] = "profilo";
                }
                // echo $_SESSION['utenteLoggato'];
                header('Location: ../includes/getDataPersonaggio.inc.php');
                exit();
              }else{
                header('Location: ../index.php');
                exit();
              }
            }else{
              header('Location: ../index.php?error=wrgpwd');
              exit();
            }
          }else{
            header('Location: ../index.php?error=wrgusr');
            exit();
          }
        }
      }else{
        header('Location: ../index.php');
        exit();
      }
    }else{
      header('Location: ../index.php');
      exit();
    }
  }
?>