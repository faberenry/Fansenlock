<?php
  require('riassunto.class.inc.php');
  require('config.inc.php');
  // session_start();
  $riassuntiArray = array();
  $index = 0;
  $sql = "SELECT * 
          FROM riassunto RIGHT JOIN capitolo ON riassunto.codCapitolo = capitolo.codCapitolo
          ORDER BY riassunto.codCapitolo;";

  $result = mysqli_query($conn, $sql);
  if( $result ){
    if( mysqli_num_rows($result) > 0 ){
      while( $row = $result->fetch_array() ){
        $riassuntiArray[$index] = new Riassunto();
        $riassuntiArray[$index]->setCodRiassunto( $row['codRiassunto']);
        $riassuntiArray[$index]->setCapitolo( $row['titolo_capitolo'] );
        $riassuntiArray[$index]->setTitolo( $row['titolo']);
        $riassuntiArray[$index]->setData( $row['data']);
        $riassuntiArray[$index]->setTesto( $row['testo']);
        $index++;
      }
      $_SESSION['arrayRiassunti'] = $riassuntiArray;
    }else{
      $_SESSION['arrayRiassunti'] = null;
      $riassuntiArray = null;
    }
  }
  // header('Location : ../index.php');
?>