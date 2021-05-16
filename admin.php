<div class="content_admin">
  <button class="admin_inserisci" type="submit" 
          onclick="inserisci('./includes/inserisciRiassunto.inc')">Riassunto</button>
  <button class="admin_inserisci" type="submit"
          onclick="inserisci('./includes/inserisciImmagine.inc')">Immagine</button>
</div>
<script>
  function inserisci( nome ){
    window.location = "./includes/link.inc.php?flag=ok&link="+nome;
  }
</script>
