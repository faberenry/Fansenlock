<header>
  <nav class="background">
    <div class="titolo_div">
      <div class="logo_container">
        <a href="#"><img  class="logo" src="img/logo.png"/></a>
      </div>
      <h1 class="titolo">Fansenlock</h1>
    </div>
    <div class="topnav">
      <a href="./includes/link.inc.php?flag=ok&link=home"
      <?php 
        if( !isset($_SESSION['link'])){
          echo "class='active'";
        }else{
          if( $_SESSION['link'] === "home" ) echo "class='active'";
          else echo "class='inactive'";
        }
      ?> >Home</a>
      <a href="./includes/link.inc.php?flag=ok&link=gallery"
        <?php 
          if( isset($_SESSION['link']) ){
            if( $_SESSION['link'] === "gallery" ) echo "class='active'";
            else echo "class='inactive'"; 
          }else{
            echo "class='inactive'";
          }
        ?>
      >Gallery</a>
      <?php 
        if( !isset($_SESSION['utenteLoggato']) ) { ?>
          <form class="login_div" method="post" action="./includes/login.inc.php" name="login_form" > 
            <input class="login_dati_style" type="text" placeholder="Username/Email" name="username_email" id="username_mail" 
              <?php if( isset($_GET['username_email']) ) { echo "value='".$_GET['username_email']."'"; } ?>
            />
            <input class="login_dati_style" type="password" placeholder="Password" name="password" id="password" />
            <button class="login_dati_btn_style" type="submit" name="btnLogin">Login</button>
            <input type="button" class="login_dati_btn_style" onclick="registrati();" name="btnRegistrati" value="Registrati" />
            <?php
              if( isset($_GET['error']) && $_GET['error'] === "emptyfields" ){
                echo "<em class='error'>Campi vuoti!</em><br/>";
              }else if( isset($_GET['error']) && $_GET['error'] === "wrgpwd" ){
                echo "<em class='error'>User/Pwd errati!</em><br/>";
              }else if( isset($_GET['error']) && $_GET['error'] === "wrgusr" ){
                echo "<em class='error'>User/Pwd errati!</em><br/>";
              }else if( isset($_GET['login']) && $_GET['login'] === "success" ){
                echo "<em class='success'>Ti sei loggato!</em><br/>";
              }
            ?>
          </form>
        <?php }else 
              if( isset($_SESSION['utenteLoggato']) && 
                      (strcasecmp($_SESSION['utenteLoggato'], "master") == 0 
                        || strcasecmp($_SESSION['utenteLoggato'], "admin") == 0) ){ ?>
                <a  href="./includes/link.inc.php?flag=ok&link=admin"
                  <?php 
                    if( isset($_SESSION['link'])){
                      if( $_SESSION['link'] === "admin" ) echo "class='active'";
                      else echo "class='inactive'";
                    }
                  ?>
                >ADMIN</a> 
        <?php
            }else if( isset($_SESSION['utenteLoggato']) ){ ?>
          <a 
            <?php 
              if( isset( $_SESSION['firstLog']) ){ 
                if( $_SESSION['firstLog'] == true ) { ?>
                  href="./includes/link.inc.php?flag=ok&link=statPage" <?php
                }else if( $_SESSION['firstLog'] == false ) { ?>
                  href="./includes/link.inc.php?flag=ok&link=profilo" <?php  
                }
              } else { ?>
                href="./includes/link.inc.php?flag=ok&link=profilo" <?php
              }
            ?>
            <?php 
              if( isset($_SESSION['link'])){
                if( $_SESSION['link'] === "profilo" || $_SESSION['link'] === "statPage" ) echo "class='active'";
                else echo "class='inactive'";
              }
            ?>
          >My Profile</a>
      <?php }
            if( isset($_SESSION['utenteLoggato'])) { ?>
              <form class="logout_div" method="post" action="./includes/logout.inc.php">
                <p class='info_login'>Sei loggato come <?php echo $_SESSION['utenteLoggato']; ?></p>
                <button class="login_dati_btn_style" type="submit" name="btnLogout">Logout</button>
              </form>
      <?php } ?>
    </div>
  </nav>
</header>
<script>
  function registrati(){
    window.location = "./includes/registrati.inc.php?flag=pagina_reg";
  }
</script>

