<div class="content_statPage">
  <h3 class="titolo_statPage">Inserisci i dati del tuo Personaggio</h3>
    <form class="form_statPage" action="./includes/statPage.inc.php" method="POST">
      <div class="line_form_statPage">
        <div class="column_1_3">
          <label for="nomePersonaggio" class="description_statPage">Nome</label><br>
          <input type="text" placeholder="Nome" id="nomePersonaggio" name="nomePersonaggio" class="statPage_input_style"
                 required/>
        </div>
        <div class="column_1_3">
          <label for="cognomePersonaggio" class="description_statPage">Cognome</label><br>
          <input type="text" placeholder="Cognome" id="cognomePersonaggio" name="cognomePersonaggio"
                 class="statPage_input_style" required/>
        </div>
        <div class="column_1_3">
          <label for="classePersonaggio" class="description_statPage">Classe</label><br>
          <input type="text" placeholder="Classe" id="classePersonaggio" name="classePersonaggio" 
                 class="statPage_input_style" required/>
        </div>
      </div>
      <div class="line_form_statPage"> 
        <div class="column_1_3">
          <label for="allineamentoPersonaggio" class="description_statPage">Allineamento</label><br>
          <input type="text" placeholder="Allineamento" id="allineamentoPersonaggio" name="allineamentoPersonaggio" 
                 class="statPage_input_style" required/>
        </div>
        <div class="column_1_3">
          <label for="razzaPersonaggio" class="description_statPage">Razza</label><br>
          <input type="text" placeholder="Razza" id="razzaPersonaggio" name="razzaPersonaggio"
                 class="statPage_input_style" required/>
         </div>
        <div class="column_1_3">
          <label for="livelloPersonaggio" class="description_statPage">Livello</label><br>
          <input type="number" min="0" max="20" value="0" id="livelloPersonaggio" name="livelloPersonaggio" 
                 class="statPage_input_style" readonly/> 
        </div>
      </div>
      <div class="line_form_statPage">
          <div class="column_1_3">
            <label for="forzaPersonaggio" class="description_statPage" >Forza</label><br/>
            <input type="number" placeholder="Forza" id="forzaPersonaggio" name="forzaPersonaggio" min="1" max="20" value="1" 
                    class="statPage_input_style" required/>
          </div>
          <div class="column_1_3">
            <label for="destrezzaPersonaggio" class="description_statPage" >Destrezza</label> <br/>
            <input type="number" placeholder="Destrezza" id="destrezzaPersonaggio" name="destrezzaPersonaggio" min="1" max="20" 
                   value="1" class="statPage_input_style" required/>
          </div>
          <div class="column_1_3">
            <label for="costituzionePersonaggio" class="description_statPage" >Costituzione</label><br/>
            <input type="number" placeholder="Costituzione" id="costituzionePersonaggio" name="costituzionePersonaggio" min="1"
                   max="20" value="1" class="statPage_input_style" required/>
          </div>
          <div class="column_1_3">
            <label for="intelligenzaPersonaggio" class="description_statPage" >Intelligenza</label><br/>
            <input type="number" placeholder="Intelligenza" id="intelligenzaPersonaggio" name="intelligenzaPersonaggio" min="1"
                   max="20" value="1" class="statPage_input_style" required/>
          </div>
          <div class="column_1_3">
            <label for="saggezzaPersonaggio" class="description_statPage" >Saggezza</label><br/>
            <input type="number" placeholder="Saggezza" id="saggezzaPersonaggio" name="saggezzaPersonaggio" min="1"
                   max="20" value="1" class="statPage_input_style" required/>
          </div>
          <div class="column_1_3">
            <label for="carismaPersonaggio" class="description_statPage" >Carisma</label><br/>
            <input type="number" placeholder="Carisma" id="carismaPersonaggio" name="carismaPersonaggio" min="1"
                   max="20" value="1" class="statPage_input_style" required/>
          </div>
        </div>
        <div class="line_form_statPage">
          <div class="column_1_3">
            <label for="caPersonaggio" class="description_statPage" >CA</label><br/>
            <input type="number" placeholder="CA" id="caPersonaggio" name="caPersonaggio" min="1"
                   max="30" value="10" class="statPage_input_style" required/>
          </div>
          <div class="column_1_3">
            <label for="velocitaPersonaggio" class="description_statPage" >Velocità</label><br/>
            <input type="number" placeholder="Velocità" id="velocitaPersonaggio" name="velocitaPersonaggio" min="1"
                   max="30" value="1" class="statPage_input_style" required/>
          </div>
          <div class="column_1_3">
            <label for="vitaPersonaggio" class="description_statPage" >Vita</label><br/>
            <input type="number" placeholder="Vita" id="vitaPersonaggio" name="vitaPersonaggio" min="1"
                   max="30" value="1" class="statPage_input_style" required/>
          </div>
        </div>
        <div class="line_form_statPage">
          <button class="button_form_statPage" id="salva" name="salva">Salva statistiche!</button>
        </div>
    </form>
    <p class="sfondo">c</p>
    <p class="sfondo">c</p>
</div>