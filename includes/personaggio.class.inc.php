<?php
class Personaggio{
  private $nominativo;
  private $classe;
  private $razza;
  private $allineamento;
  private $statistiche;
  private $percezionePassiva;
  private $bonusCompetenza;
  private $vita;
  private $velocita;
  
  public function __construct() {
    $this->nominativo = new Nominativo("","");
    $this->classe = "";
    $this->razza = "";
    $this->allineamento = "";
    $this->percezionePassiva = 0;
    $this->bonusCompetenza = 0;
    $this->ca = 0;
    $this->competenza = 0;
    $this->livello = 0;
    $this->vita = 0;
    $this->velocita = 0;
    $this->statistiche = array( "forza" => new Statistica(0,0),
                                "costituzione" => new Statistica(0,0),
                                "destrezza" => new Statistica(0,0),
                                "carisma" => new Statistica(0,0),
                                "intelligenza" => new Statistica(0,0),
                                "saggezza" => new Statistica(0,0) );
  }

  public function getNominativo(){
    return $this->nominativo;
  }

  public function getStat($nome) {
    return $this->statistiche[$nome];
  }

  public function getStatArray(){
    return $this->statistiche;
  }

  public function getClasse(){
    return $this->classe;
  }

  public function getRazza() {
    return $this->razza;
  }

  public function getAllineamento() {
    return $this->allineamento;
  }

  public function getVelocita() {
    return $this->velocita;
  }

  public function getPercezionePassiva(){
    return $this->percezionePassiva;
  }

  public function getBonusCompetenza(){
    return $this->bonusCompetenza;
  }

  public function getCA(){
    return $this->ca;
  }

  public function getCompetenza(){
    return $this->competenza;
  }

  public function getLivello(){
    return $this->livello;
  }

  public function getVita(){
    return $this->vita;
  }

  public function setNominativo($nome, $cognome){
    $this->nominativo->setNome($nome);
    $this->nominativo->setCognome($cognome);
  }

  public function setStat($nome, $value, $mod) {
    $this->statistiche[$nome]->setValue($value);
    $this->statistiche[$nome]->setMod($mod);
  }

  public function setClasse($classe){
    $this->classe = $classe;
  }

  public function setRazza($razza) {
    $this->razza = $razza;
  }

  public function setAllineamento($allineamento) {
    $this->allineamento = $allineamento;
  }

  public function setVelocita($velocita) {
    $this->velocita = $velocita;
  }

  public function setPercezionePassiva($percPass){
    $this->percezionePassiva = $percPass;
  }

  public function setBonusCompetenza($bonusCompetenza){
    $this->bonusCompetenza = $bonusCompetenza;
  }

  public function setCA($ca){
    $this->ca = $ca;
  }

  public function setCompetenza($competenza){
    $this->competenza = $competenza;
  }

  public function setLivello($livello){
    $this->livello = $livello;
  }

  public function setVita($vita){
    $this->vita = $vita;
  }

  public function toString(){
    $string = $this->nominativo->toString();
    $string.="Classe : ".$this->classe."<br>";
    $string.="Razza : ".$this->razza."<br>";
    $string.="Allineamento : ".$this->allineamento."<br>";
    $string.="Livello : ".$this->livello."<br>";
    $string.="Velocita : ".$this->velocita."<br>";
    $string.="CA : ".$this->ca."<br>";
    $string.="PerPass : ".$this->percezionePassiva."<br>";
    $string.="Forza : ".$this->statistiche['forza']->toString();
    $string.="Costituzione : ".$this->statistiche['costituzione']->toString();
    $string.="Intelligenza : ".$this->statistiche['intelligenza']->toString();
    $string.="Saggezza : ".$this->statistiche['saggezza']->toString();
    $string.="Carisma : ".$this->statistiche['carisma']->toString();
    $string.="Destrezza : ".$this->statistiche['destrezza']->toString();
    return $string;
  }

}
?>