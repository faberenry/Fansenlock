<?php
  if ( isset($_SESSION['utenteLoggato']) && isset($_SESSION['personaggio'])) {
    $personaggio = $_SESSION['personaggio']; 
?>
  <div class="profile_container">
    <div class="image_container">
      <?php 
        $percorso = percorsoImmagine();
        echo "<img class='foto_personaggio' src='./img/".$percorso."' />";
      ?>
      <form action="./includes/caricaImmagine.inc.php" method="POST" name="imageLoader_form" enctype="multipart/form-data">
        <input type="file" name="imageLoader">
        <button type="submit" name="btnImageLoader" class="btn_profilo_style" >Carica foto</button>
      </form>
    </div>
    <div class="dati_personaggio">
      <?php
        echo "<form name='form_profilo' method='POST' action='./includes/aggiornaDati.inc.php'>";
        echo "<div class='casellina_personaggio'>
                <p class='descrizioni_personaggio'>Nome</p>
                <p class='nome_personaggio'>".$personaggio->getNominativo()->getNome()." ".
                  $personaggio->getNominativo()->getCognome()."</p>
              </div>";
        echo "<div class='casellina_personaggio'>
                <p class='descrizioni_personaggio'>Razza</p>
                <p class='nome_personaggio'>".$personaggio->getRazza()."</p>
              </div>";
        echo "<div class='casellina_personaggio'>
                <p class='descrizioni_personaggio'>Allineamento</p>
                <p class='nome_personaggio'>".$personaggio->getAllineamento()."</p>
              </div>";
        echo "<div class='casellina_personaggio'>
                <p class='descrizioni_personaggio'>Classe</p>
                <p class='nome_personaggio'>".$personaggio->getClasse()."</p>
              </div>";
        echo "<div class='casellina_personaggio_3'>
                <p class='descrizioni_personaggio'>Livello</p>
                <input type='number' min='0' class='input_personaggio' value='".$personaggio->getLivello()."' 
                       name='livello_personaggio'/>
              </div>";
        echo "<div class='casellina_personaggio_3'>
                <p class='descrizioni_personaggio'>CA</p>
                <input type='number' min='0' class='input_personaggio' value='".$personaggio->getCA()."' 
                       name='ca_personaggio'/>
              </div>";
        echo "<div class='casellina_personaggio_3'>
                <p class='descrizioni_personaggio'>PF</p>
                <input type='number' min='0' class='input_personaggio' value='".$personaggio->getVita()."' 
                       name='vita_personaggio'/>
              </div>";
        echo "<div class='casellina_personaggio_3'>
                <p class='descrizioni_personaggio'>Percezione Passiva</p>
                <p class='numero_personaggio' >".$personaggio->getPercezionePassiva()."</p>
              </div>";
        echo "<div class='casellina_personaggio_3'>
                <p class='descrizioni_personaggio'>Velocità</p>
                <p class='numero_personaggio' >".$personaggio->getVelocita()." <i>m</i></p>
              </div>";
        echo "<div class='casellina_personaggio_3'>
                <p class='descrizioni_personaggio'>Bonus Competenza</p>
                <p class='numero_personaggio' > +".$personaggio->getBonusCompetenza()."</p>
              </div>";
        
        echo "<div class='casellina_personaggio_6'>
                <p class='descrizioni_personaggio'>Forza</p>
                <div class='numero_personaggio'>".$personaggio->getStat('forza')->getValue()."</div>
                <p class='mod_personaggio'>Mod: +".$personaggio->getStat('forza')->getMod()."</p>
              </div>";
        echo "<div class='casellina_personaggio_6'>
                <p class='descrizioni_personaggio'>Costituzione</p>
                <div class='numero_personaggio'>".$personaggio->getStat('costituzione')->getValue()."</div>
                <p class='mod_personaggio'>Mod: +".$personaggio->getStat('costituzione')->getMod()."</p>
              </div>";
        echo "<div class='casellina_personaggio_6'>
                <p class='descrizioni_personaggio'>Saggezza</p>
                <div class='numero_personaggio'>".$personaggio->getStat('saggezza')->getValue()."</div>
                <p class='mod_personaggio'>Mod: +".$personaggio->getStat('saggezza')->getMod()."</p>
              </div>";
        echo "<div class='casellina_personaggio_6'>
                <p class='descrizioni_personaggio'>Destrezza</p>
                <div class='numero_personaggio'>".$personaggio->getStat('destrezza')->getValue()."</div>
                <p class='mod_personaggio'>Mod: +".$personaggio->getStat('destrezza')->getMod()."</p>
              </div>";
        echo "<div class='casellina_personaggio_6'>
                <p class='descrizioni_personaggio'>Intelligenza</p>
                <div class='numero_personaggio'>".$personaggio->getStat('intelligenza')->getValue()."</div>
                <p class='mod_personaggio'>Mod: +".$personaggio->getStat('intelligenza')->getMod()."</p>
              </div>";
        echo "<div class='casellina_personaggio_6'>
                <p class='descrizioni_personaggio'>Carisma</p>
                <div class='numero_personaggio'>".$personaggio->getStat('carisma')->getValue()."</div>
                <p class='mod_personaggio'>Mod: +".$personaggio->getStat('carisma')->getMod()."</p>
              </div>";
        echo "<button class='btn_profilo' name='btnAggiorna'>Salva Modifiche</button>";
        echo "</form>"
      ?>
    </div>
  </div>
<?php 
  }else if( !isset($_SESSION['personaggio']) ){
    $_SESSION['page'] = "statPage.php";
    $_SESSION['link'] = "stat";
    header('Location: index.php');
    exit();
  }elseif ( !isset($_SESSION['utenteLoggato']) ) {
    $_SESSION['page'] = "home.php";
    $_SESSION['link'] = "home";
    header('Location: index.php');
    exit();
  }

  function percorsoImmagine() : string {
    require('./includes/config.inc.php');
    $utente = $_SESSION['utenteLoggato'];
    $sql = "SELECT * FROM immagini WHERE codUtente = '$utente';";

    $result = mysqli_query($conn, $sql);
    if( mysqli_num_rows($result) > 0 ){
      $row = $result->fetch_array();
      $src = $row['percorso'];
    }else{
      $src = "imageDefault.png";
    }
    mysqli_close($conn);
    return $src;
  }
?>

<?php
/**
 <style>
.row{
 	width:100%;
    background-color:yellow;
    float:left;
}
.half{
	float:left;
    width:50%;
    background-color:green;
    color:white;
}
.third{
	width:33.3%;
    background-color:blue;
    float:left;
}
.sixth{
	float:left;
	width:16.6%;
    background-color:red;
}
</style>
<div>
	<div class="row">
		asodk
    </div>
    <div class="row">
dsad
    </div>
    <div class="row">
dasd
    </div>
    <div class="row">
sdad
    </div>
    <div class="row">
    	<div class="third">
        	<p>third1.1</p><p>third1.2</p>
        </div>
        <div class="third"><p>third1.1</p><p>third1.2</p></div>
        <div class="third"><p>third1.1</p><p>third1.2</p></div>
    </div>
    <div class="row">
    	<div class="third"><p>third2.1</p><p>third2.2</p></div>
        <div class="third"><p>third2.1</p><p>third2.2</p></div>
        <div class="third"><p>third2.1</p><p>third2.2</p></div>
    </div>
    <div class="row">
    	<div class="sixth"><p>third2.1</p><p>third2.2</p>
        					<p>third2.2</p></div>
        <div class="sixth"><p>third2.1</p><p>third2.2</p>
        					<p>third2.2</p></div>
        <div class="sixth"><p>third2.1</p><p>third2.2</p>
        					<p>third2.2</p></div>
        <div class="sixth"><p>third2.1</p><p>third2.2</p>
        					<p>third2.2</p></div>
		<div class="sixth"><p>third2.1</p><p>third2.2</p>
        					<p>third2.2</p></div>
		<div class="sixth"><p>third2.1</p><p>third2.2</p>
        					<p>third2.2</p></div>                            
    </div>
</div>

 */
 
 ?>