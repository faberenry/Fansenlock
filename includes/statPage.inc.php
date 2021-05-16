<?php
session_start();
  if( !isset($_POST['salva']) ){
    header('Location : ../index.php');
    exit();
  }elseif ( isset($_POST['salva']) ){
    if( isset($_SESSION['utenteLoggato']) ){
      if( controlData() ){
        require('config.inc.php');

        $nome = $_POST['nomePersonaggio'];
        $cognome = $_POST['cognomePersonaggio'];
        $bc = 2;
        $codStat = "stat_".$nome."_".$cognome;
        $percezionePassiva = calcolaPercezionePassiva($conn);
        $forza = $_POST['forzaPersonaggio'];
        $destrezza = $_POST['destrezzaPersonaggio'];
        $carisma = $_POST['carismaPersonaggio'];
        $costituzione = $_POST['costituzionePersonaggio'];
        $intelligenza = $_POST['intelligenzaPersonaggio'];
        $saggezza = $_POST['saggezzaPersonaggio'];
        $ca = $_POST['caPersonaggio'];
        $velocita = $_POST['velocitaPersonaggio'];
        $vita = $_POST['vitaPersonaggio'];
        $stmt = $conn->prepare("SELECT * FROM personaggio WHERE nome=? AND cognome=?;");
        $stmt->bind_param("ss", $nome, $cognome);
        $stmt->execute();
        $result = $stmt->get_result();
        if( mysqli_num_rows($result) == 0 ){
          // $conn->close();
          // $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  
          // if ($conn->connect_errno) {
          //   printf("Connect failed: %s\n", $conn->connect_error);
          //   exit();
          // }        
          $sql = "INSERT INTO stat(codStat, forza, destrezza, carisma,costituzione,
                 intelligenza, saggezza, ca, velocita, vita, percezione_passiva, bonus_competenza)
                  VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
          $stmt_generale = mysqli_stmt_init($conn);
          if( mysqli_stmt_prepare($stmt_generale, $sql)){
            mysqli_stmt_bind_param($stmt_generale,"siiiiiiiiiii", $codStat, $forza, $destrezza, $carisma, $costituzione,
                                    $intelligenza, $saggezza, $ca, $velocita, $vita, $percezionePassiva, $bc);
            if( $percezionePassiva != -10 ){
              mysqli_stmt_execute($stmt_generale);
              $razza = $_POST['razzaPersonaggio'];
              $allineamento = $_POST['allineamentoPersonaggio'];
              $classe = $_POST['classePersonaggio'];
              $livello = $_POST['livelloPersonaggio'];
              $utente = $_SESSION['utenteLoggato'];
              $sqlPersonaggio = "INSERT INTO personaggio(nome, cognome, classe, razza, allineamento, livello, codStat_fk,
                                 codUtente) VALUES (?,?,?,?,?,?,?,?);";
              $stmtPersonaggio = mysqli_stmt_init($conn);
              //echo $sqlPersonaggio."<br>";
              if( mysqli_stmt_prepare($stmtPersonaggio, $sqlPersonaggio)){
                mysqli_stmt_bind_param($stmtPersonaggio, "sssssiss",$nome, $cognome, $classe, $razza, $allineamento, 
                                        $livello, $codStat, $utente);
                mysqli_stmt_execute($stmtPersonaggio);
                $stmt_utente = mysqli_stmt_init($conn);
                $n = "n";
                $sqlUtente = "UPDATE utente SET firstLog = ? WHERE username = '".$utente."';";
                if( mysqli_stmt_prepare($stmt_utente, $sqlUtente) ){
                  mysqli_stmt_bind_param($stmt_utente, "s", $n );
                  if( mysqli_stmt_execute($stmt_utente) ){
                    $_SESSION['page'] = "profilo.php";
                    $_SESSION['link'] = "profilo";
                    mysqli_close($conn);
                    header('Location: ./getDataPersonaggio.inc.php');
                    exit();
                  }else{

                  }                     
                }
              }else{
                mysqli_close($conn);
                header('Location: ../index.php?flag=statPage&error=wrgPorcaMadonna');
                exit();
              }
            }else{
              mysqli_close($conn);
              header('Location: ../index.php?flag=statPage&error=wrgDataPP&nomePersonaggio='.$_POST['nomePersonaggio'].
                  '&cognomePersonaggio='.$_POST['cognomePersonaggio'].'&classePersonaggio='.$_POST['classePersonaggio'].
                  '&allineamentoPersonaggio'.$_POST['allineamentoPersonaggio'].'&razzaPersonaggio='.$_POST['razzaPersonaggio'].
                  '&forzaPersonaggio='.$_POST['forzaPersonaggio'].'&costituzionePersonaggio='.$_POST['costituzionePersonaggio'].
                  '&intelligenzaPersonaggio'.$_POST['intelligenzaPersonaggio'].'&destrezzaPersonaggio='.$_POST['destrezzaPersonaggio'].
                  '&carismaPersonaggio='.$_POST['carismaPersonaggio'].'&caPersonaggio='.$_POST['caPersonaggio'].
                  '&velocitaPersonaggio='.$_POST['velocitaPersonaggio'].'&vitaPersonaggio='.$_POST['vitaPersonaggio']);
              exit();
            }
          }else{
            echo "something wrong i can feel it. <br> dio boia, chiamate enrico!";
          }
        }else{
          mysqli_close($conn);
          header('Location: ../index.php?flag=statPage&error=personaggioEsistente');
          exit();
        }
        
      }else{
        header('Location: ../index.php?flag=statPage&error=wrgData&nomePersonaggio='.$_POST['nomePersonaggio'].
                '&cognomePersonaggio='.$_POST['cognomePersonaggio'].'&classePersonaggio='.$_POST['classePersonaggio'].
                '&allineamentoPersonaggio'.$_POST['allineamentoPersonaggio'].'&razzaPersonaggio='.$_POST['razzaPersonaggio'].
                '&forzaPersonaggio='.$_POST['forzaPersonaggio'].'&costituzionePersonaggio='.$_POST['costituzionePersonaggio'].
                '&intelligenzaPersonaggio'.$_POST['intelligenzaPersonaggio'].'&saggezzaPersonaggio='.$_POST['saggezzaPersonaggio'].
                '&destrezzaPersonaggio='.$_POST['destrezzaPersonaggio'].'&carismaPersonaggio='.$_POST['carismaPersonaggio'].
                '&caPersonaggio='.$_POST['caPersonaggio'].'&velocitaPersonaggio='.$_POST['velocitaPersonaggio'].
                '&vitaPersonaggio='.$_POST['vitaPersonaggio']);
        exit();
      }
    }else{
      header('Location: ../index.php');
      exit();
    }
  }else{
    header('Location: ../index.php');
    exit();
  }

  function controlData() : bool{
    $ret = false;
    if( $_POST['forzaPersonaggio'] >= 1 && $_POST['forzaPersonaggio'] <= 20 )
      if( $_POST['destrezzaPersonaggio'] >= 1 && $_POST['destrezzaPersonaggio'] <= 20 )
        if( $_POST['costituzionePersonaggio'] >= 1 && $_POST['costituzionePersonaggio'] <= 20 )
          if( $_POST['intelligenzaPersonaggio'] >= 1 && $_POST['intelligenzaPersonaggio'] <= 20 )
            if( $_POST['saggezzaPersonaggio'] >= 1 && $_POST['saggezzaPersonaggio'] <= 20 )
              if( $_POST['carismaPersonaggio'] >= 1 && $_POST['carismaPersonaggio'] <= 20 )
                if( $_POST['caPersonaggio'] >= 10 && $_POST['caPersonaggio'] <= 20 )
                  $ret = true;
    return $ret;
  }

  function calcolaPercezionePassiva( $conn ) : int{
    $pp = 0;
    $stmt = $conn->prepare("SELECT mod_value FROM modificatori WHERE min_value <= ? AND  ? <= max_value;" );
    $stmt->bind_param("ii", $_POST['saggezzaPersonaggio'], $_POST['saggezzaPersonaggio']);
    $stmt->execute();
    $result = $stmt->get_result();
    if( mysqli_num_rows($result) == 1){
      $row = $result->fetch_array();
      $pp = 10 + $row['mod_value'];
    }else{
      $pp = -10;
    }
    return $pp;
  }
?>