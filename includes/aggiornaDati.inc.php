<?php
  require('config.inc.php');
  require('personaggio.class.inc.php');
  require('nominativo.class.inc.php');
  session_start();
  if( isset($_SESSION['utenteLoggato']) && isset($_SESSION['personaggio']) 
      && isset($_POST['btnAggiorna']) ){
    $personaggio = $_SESSION['personaggio'];
    $vita = $_POST['vita_personaggio'];
    $livello = $_POST['livello_personaggio'];
    $ca = $_POST['ca_personaggio'];
    $utente = $_SESSION['utenteLoggato'];
    $codStat = "stat_".$personaggio->getNominativo()->getNome().
                   "_".$personaggio->getNominativo()->getCognome();
    $modificato = controllaModifiche($personaggio);
    // echo "modificato = $modificato <br>";
    switch ($modificato) {
      case 0:
        header('Location: ../index.php?modify=nullo');
        exit();
        break;
      case 1:
        $sql = "UPDATE stat 
                SET ca = $ca
                WHERE codStat = '$codStat';";
        break;
      case 2:
        $sql = "UPDATE stat INNER JOIN personaggio 
                SET stat.ca = $ca, personaggio.livello = $livello 
                WHERE  stat.codStat = '$codStat';";
        break;
      case 3: 
        $sql = "UPDATE stat INNER JOIN personaggio
                SET stat.ca = $ca, personaggio.livello = $livello, stat.vita = $vita
                WHERE stat.codStat = '$codStat';";
        break;
      case 4:
        $sql = "UPDATE personaggio 
                SET livello = $livello
                WHERE codStat_fk = '$codStat';";
        break;
      case 5:
        $sql = "UPDATE stat INNER JOIN personaggio
                SET stat.vita = $ca, personaggio.livello = $livello, stat.vita = $vita
                WHERE stat.codStat = '$codStat';";
        break;
      case 6:
        $sql = "UPDATE stat 
                SET ca = $ca, vita = $vita 
                WHERE codStat = '$codStat';";
        break;
      case 7:
        $sql = "UPDATE stat 
                SET vita = $vita 
                WHERE codStat = '$codStat';";
        break;
      default:
        mysqli_close($conn);
        header('Location : ../index.php?modify=prob');
        exit();
        break;
    }
    $result = mysqli_query($conn, $sql);
    if( $result ) {
      $personaggio->setCA($ca);
      $personaggio->setLivello($livello);
      $personaggio->setVita($vita);
      if( $livello == 0 ) $bc = 2;
      elseif( $livello <= 20 ) $bc = ceil($livello / 4) + 1;
      else $bc = 6;
      $personaggio->setBonusCompetenza($bc);
      mysqli_close($conn);
      header('Location: ../index.php?modify=ok');
      exit();
    }else{
      mysqli_close($conn);
      header('Location: ../index.php?modify=prob');
      exit();
    }
  }else{
    header('Location: ../index.php');
    exit();
  }

  function controllaModifiche($personaggio) : int{
    $modificato = -1;
    /*
    A, B, C != allora 3
    A, C != allora 6
    */
    if ($personaggio->getCA() === $_POST['ca_personaggio'] 
        && $personaggio->getLivello() === $_POST['livello_personaggio']
        && $personaggio->getVita() === $_POST['vita_personaggio']) {
      $modificato = 0;
    }
    if ($personaggio->getCA() !== $_POST['ca_personaggio']) {
      $modificato = 1;
    }
    if ($personaggio->getLivello() !== $_POST['livello_personaggio']) {
      $modificato = 4;
    }
    if ($personaggio->getVita() !== $_POST['vita_personaggio']){
      $modificato = 7;
    }
    if ($personaggio->getCA() !== $_POST['ca_personaggio'] && 
        $personaggio->getLivello() !== $_POST['livello_personaggio']) {
      $modificato = 2;
    }
    if ($personaggio->getLivello() !== $_POST['livello_personaggio'] &&
        $personaggio->getVita() !== $_POST['vita_personaggio']) {
      $modificato = 5;
    }
    if ($personaggio->getVita() !== $_POST['vita_personaggio'] &&
        $personaggio->getCA() !== $_POST['ca_personaggio']) {
      $modificato = 6;
    }
    if ($personaggio->getCA() !== $_POST['ca_personaggio'] 
        && $personaggio->getLivello() !== $_POST['livello_personaggio']
        && $personaggio->getVita() !== $_POST['vita_personaggio']) {
      $modificato = 3;
    }
    return $modificato;
  }