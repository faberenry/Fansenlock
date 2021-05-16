<div class="home_container">
  <div class="home_menu">
    <?php
      require("./includes/getRiassunti.inc.php");
      // stampaRiassunti();
      if( is_null($riassuntiArray) ){
        echo "<p>Nessun riassunto presente</p>";
      }else{
        $capitoloPrecedente = "";
        for ($i=0; $i < sizeof($riassuntiArray); ) { 
          
          echo "<hr><ul class='home_list'>";
          echo "<a href='./includes/caricaPost.inc.php?cap=".$riassuntiArray[$i]->getCapitolo()."' 
                class='capitolo_list'><li>".$riassuntiArray[$i]->getCapitolo()."</li></a>";
          echo "<ul class='sottocapitolo_content_list'>";
          do{
            echo "<li class='sottocapitolo_list'>".$riassuntiArray[$i]->getTitolo()."</li>";
            $capitoloPrecedente = $riassuntiArray[$i]->getCapitolo();
            if( $i < sizeof($riassuntiArray) ) ++$i;
          }while( $i < (sizeof($riassuntiArray)) && strcmp($capitoloPrecedente, $riassuntiArray[$i]->getCapitolo()) == 0 );
          echo "</ul> </ul>";
        }
      }
    ?>
  </div>
  <div class="home_content">
    <?php
      if( isset($_SESSION['caricaPost']) ){
        echo "<h3 class='post_titolo'>".$_SESSION['caricaPost']."</h3>";
        echo "<div class='post_container'>"; 
        echo "<ul>";
        for ($i=0; $i < sizeof($riassuntiArray); $i++) { 
          if( strcmp($_SESSION['caricaPost'], $riassuntiArray[$i]->getCapitolo()) == 0 ){
            echo "<li>
                  <a href='./includes/caricaPost.inc.php?post=".$riassuntiArray[$i]->getCodRiassunto()."'>".
                     $riassuntiArray[$i]->getTitolo()."</a>
                  </li>";
          }
        }
        echo "</ul>";
        echo "</div>";
        unset($_SESSION['caricaPost']);
      }else if( isset($_SESSION['postSingolo']) ) {
        $trovato = false;
        for ($i=0; $i < sizeof($riassuntiArray) && $trovato == false; $i++) { 
          if( $riassuntiArray[$i]->getCodRiassunto() === $_SESSION['postSingolo'] ){
            echo "<div class='post_singolo_contenitore'>";
            echo "<h3 class='post_titolo'>".$riassuntiArray[$i]->getTitolo()."</h3>";
            echo "<p class='post_data'>".$riassuntiArray[$i]->getData()."</p>";
            echo "<div class='post_testo'>".$riassuntiArray[$i]->getTesto()."</div>";
            echo "</div>";
            $trovato = true;
          }
        }
        unset($_SESSION['postSingolo']);
      }else{
        echo "<div class='home_description'>
                <p>Questo è il sito della campagna Fansenlock.<br><br>
                   In questo sito potrai leggere i riassunti delle varie ruolate tramite il menu' sulla sinistra.<br><br>
                   Se fai parte della campagna potrai registrarti, per avere una mini scheda del personaggio virtuale.<br><br>
                   Potrai vedere le \"foto\" dei mitici protagonisti di questa campagna nella sezione GALLERY.<br><br>
                   Spero che questa mini spiegazione ti sia servita.<br> BUON VIAGGIO!</p>
              </div>";
    }
    ?>
  </div>
</div>
 