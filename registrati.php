
<div class="content_reg" >
  <h3 class="sottotitolo">Registrati</h3>
  <div class="form_reg">
    <form action="./includes/registrati.inc.php?flag=registrazione" method="post" >
      <table class="table_reg">
      <?php
        if( isset($_GET['errorR']) && $_GET['errorR'] === "emptyfields" ){
          echo "<p class='error'>Campi vuoti!</p>";
        }else if(  isset($_GET['errorR']) && $_GET['errorR'] === "invalidmail" ){
          echo "<p class='error'>Mail non valida!</p>";
        }else if(  isset($_GET['errorR']) && $_GET['errorR'] === "pwdcnd" ){
          echo "<p class='error'>Password non corrispondono!</p>";
        }else if(  isset($_GET['errorR']) && $_GET['errorR'] === "usrwrg" ){
          echo "<p class='error'>Utente esiste già!</p>";
        }else if(  isset($_GET['signup']) && $_GET['signup'] === "success" ){
          echo "<p class='success'>Registrazione effettuata, loggati!</p>";
        }
      ?>
        <tr>
          <td>Username : </td>
          <td><input type="text" placeholder="Username" class="reg_dati_style" name="username" 
              <?php if( isset($_GET['username']) ) { echo "value='".$_GET['username']."'"; } ?>></td>
        </tr>
        <tr>
          <td>E-mail : </td>
          <td><input type="mail" placeholder="E-mail" class="reg_dati_style" name="mail" 
              <?php if( isset($_GET['mail']) ) { echo "value='".$_GET['mail']."'"; } ?>></td>
        </tr>
        <tr>
          <td>Password : </td>
          <td><input type="password" placeholder="Password" class="reg_dati_style" name="pwd" ></td>
        </tr>
        <tr>
          <td>Ripeti password : </td>
          <td><input type="password" placeholder="Ripeti password" class="reg_dati_style" name="pwd_rep" ></td>
        </tr>
      </table>
      <br><button type="submit" class="btn_reg_style">Registrati</button>
    </form>
  </div>
</div>
<script>
  document.onload(controllo());
  function controllo(){
    var url = window.location;
    if( url.href.includes("registrati.php") ){
      window.location = "./includes/link.inc.php?falg=ok&page=registrati";
    }
  }
</script>