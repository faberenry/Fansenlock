<?php
  session_start();
  if (isset($_SESSION['utenteLoggato']) && isset($_POST['btnImageLoader'])) {
    $utente = $_SESSION['utenteLoggato'];
    require('config.inc.php');
    $msg = ""; 
    $filename = $_FILES["imageLoader"]["name"]; 
    $tempname = $_FILES["imageLoader"]["tmp_name"];  
    if( $filename === "" ){
      // mysqli_close($conn);
      header('Location: ../index.php?error=nofileloaded');
      exit();
    }
    //echo "filename = $filename";
    $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
    $folder = "../img/".$filename; 
    $sqlControl = "SELECT * FROM immagini WHERE codUtente = '$utente';";
    $result = mysqli_query($conn, $sqlControl);
    if( mysqli_num_rows($result) === 0 ) 
      $sql = "INSERT INTO immagini (percorso, tipoFile, codUtente) VALUES ('$filename','$fileExtension','$utente')"; 
    else{
      $row = $result->fetch_array();
      if( file_exists( "../img/".$row['percorso']) ){
        unlink("../img/".$row['percorso']);
      }
      $sql = "UPDATE immagini 
              SET percorso = '$filename', tipoFile = '$fileExtension'
              WHERE codUtente = '$utente';";
    }
      

    $result = mysqli_query($conn, $sql); 
    if (move_uploaded_file($tempname, $folder))  { 
      mysqli_close($conn);
      header('Location: ../index.php?success=imgUploaded');
      exit(); 
    }else{ 
      mysqli_close($conn);
      header('Location: ../index.php?error=errUploadImg');
      exit();
    } 

  }else{
   // header('Location: ../index.php');
    //exit();
  }
?>