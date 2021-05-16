<?php
  
  require('config.inc.php');
  require('personaggio.class.inc.php');
  require('nominativo.class.inc.php');
  require('stat.class.inc.php');
  session_start();

  if( isset($_SESSION['utenteLoggato']) ){
    $personaggio = new Personaggio();
    salvaDatiAnagrafici($personaggio, $conn);
    // echo "----------------------<br>".$personaggio->toString();
    salvaDatiNumerici($personaggio, $conn);
    // echo $personaggio->toString();
    $_SESSION['personaggio'] = $personaggio;
    header('Location: ../index.php?flag=profilo');
    exit();
  }else{
    header('Location: ../index.php');
    exit();
  }


  function salvaDatiAnagrafici( $personaggio, $conn ){
    $sql = "SELECT * FROM personaggio WHERE codUtente = '".$_SESSION['utenteLoggato']."';";
    //echo $sql."<br>";
    $result = mysqli_query($conn, $sql);
    if( mysqli_num_rows($result) === 1 ){
      $row = mysqli_fetch_array($result);
      $personaggio->setNominativo( $row['nome'], $row['cognome'] );
      $personaggio->setClasse( $row['classe'] );
      $personaggio->setRazza( $row['razza'] );
      $personaggio->setLivello( $row['livello'] );
      $personaggio->setAllineamento( $row['allineamento'] );
      // echo $personaggio->toString();
    }else{
      //header('Location: ../index.php?flag=profilo');
      // exit();
    }
  }

  function salvaDatiNumerici($personaggio, $conn){
    $codStat = "stat_".$personaggio->getNominativo()->getNome()."_".$personaggio->getNominativo()->getCognome();
    $sql = "SELECT * FROM stat WHERE codStat = '$codStat'";
    // echo "sql  = ".$sql."<br>"; 
    $result = mysqli_query($conn, $sql);
    if( mysqli_num_rows($result) === 1 ){
      $row = $result->fetch_array();
      $personaggio->setCA($row['ca']);
      $personaggio->setPercezionePassiva($row['percezione_passiva']);
      $personaggio->setBonusCompetenza($row['bonus_competenza']);
      $personaggio->setVita($row['vita']);
      $personaggio->setVelocita($row['velocita']);
      $personaggio->setStat("forza", $row['forza'], 0);
      $personaggio->setStat("costituzione", $row['costituzione'], 0);
      $personaggio->setStat("carisma", $row['carisma'], 0);
      $personaggio->setStat("saggezza", $row['saggezza'], 0);
      $personaggio->setStat("destrezza", $row['destrezza'], 0);
      $personaggio->setStat("intelligenza", $row['intelligenza'], 0);
      // echo $personaggio->toString();
      // mi salvo dati di ogni stat, e vado a calcolarmi poi i moddificatori in un altra funzione
      calcolaModificatori( $personaggio, $conn );
      // echo $personaggio->toString(); 
    }else{
      // devo pensare ai possibili errori...
    }
    // echo "<br>Cod stat = ".$codStat;
  }

  function calcolaModificatori( $personaggio, $conn ){
    $array = $personaggio->getStatArray();
    $arrayName = array( "forza", "costituzione", "destrezza", "carisma", "intelligenza", "saggezza");
    $index = 0;
    foreach( $array as $valueObj ){
      $value = $valueObj->getValue();
      $sql = "SELECT mod_value FROM modificatori WHERE min_value <= $value AND max_value >= $value";
      $result = mysqli_query($conn, $sql);
      if( mysqli_num_rows($result) > 0 ){
        $row = $result->fetch_array();
        $personaggio->setStat( $arrayName[$index], $value, $row['mod_value'] );
      }else{
        $personaggio->setStat( $arrayName[$index], $value, 0);
      }
      $index++;
    }
    // echo $personaggio->toString();
  }
?>


