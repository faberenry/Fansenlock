<?php
class Statistica{
  private $value;
  private $mod;

  public function __constructor($value, $mod){
    $this->value = $value;
    $this->mod = $mod;
  }

  public function getMod(){
    return $this->mod;
  }

  public function getValue(){
    return $this->value;
  }
 
  public function setMod($mod){
    $this->mod = $mod;
  }
  
  public function setValue($value){
    $this->value = $value;
  }

  public function toString(){
    return "Value: ".$this->value." Mod :".$this->mod."<br>";
  }
}
?>