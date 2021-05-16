<?php

class Nominativo{
  private $nome;
  private $cognome;

  public function getNome(){
    return $this->nome;
  }
  
  public function getCognome(){
    return $this->cognome;
  }

  public function setNome($nome){
    $this->nome = $nome;
  }

  public function setCognome($cognome){
    $this->cognome = $cognome;
  }

  public function toString(){
    return "Nome : ".$this->nome." Cognome : ".$this->cognome."<br>";
  }

}

?>