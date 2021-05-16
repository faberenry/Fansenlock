<?php
class Riassunto {
  private $codRiassunto;
  private $capitolo;
  private $titolo;
  private $data;
  private $testo;

  public function __construct() {
    $this->codRiassunto = "";
    $this->capitolo = "";
    $this->titolo = "";
    $this->data = new DateTime();
    $this->testo = "";
  }

  public function setCodRiassunto( $codRiassunto ) {
    $this->codRiassunto = $codRiassunto;
  }

  public function setCapitolo( $capitolo ) {
    $this->capitolo = $capitolo;
  }

  public function setTitolo( $titolo ) {
    $this->titolo = $titolo;
  }

  public function setData( $data ) {
    $this->data = $data;
  }

  public function setTesto($testo) {
    $this->testo = $testo;
  }

  public function getCodRiassunto() {
    return $this->codRiassunto;
  }

  public function getCapitolo() {
    return $this->capitolo;
  }

  public function getTitolo() {
    return $this->titolo;
  }

  public function getData() {
    return $this->data;
  }

  public function getTesto() {
    return $this->testo;
  }

  public function toString() {
    $string = "CodRiassunto : ".$this->codRiassunto."<br>".
              "Titolo : ".$this->titolo."<br>".
              "Data : ".$this->data."<br>".
              "Testo : ".$this->testo;
    return $string;
  }

}
?>