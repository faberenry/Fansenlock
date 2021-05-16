<?php
  require('./includes/personaggio.class.inc.php');
  require('./includes/nominativo.class.inc.php');
  require('./includes/stat.class.inc.php');
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Fansenlock</title>
    <link rel="stylesheet" href="prova.css"/>
    <link href='https://fonts.googleapis.com/css?family=IM Fell English SC' rel='stylesheet'>
    <link href="./img/favicon-16x16.png" rel="icon" > 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-16">
  </head>
  <body>
    <?php
      require('header.php');
    ?>
    <div class="content">
      <main>
        <?php
          if( isset($_SESSION['page']) && $_SESSION['page'] !== "index.php"){
            require($_SESSION['page']);
            // unset($_SESSION['page']);
          }else{
            require('home.php');
          }
        ?>
      </main>
    </div>
    <?php
      require('footer.php');
    ?>
  </body>
</html>