<?php
class ValidRegistration{
  private $db;
  private $errors=[];
  private $passed=false;


  public function __construct(){
    $this->db=DataBase::getInstance();
  }

public function ValidForm($table,$pseudo,$password){
$this->valid_Pseudo($table,$pseudo);
$this->valid_password($password);

if(empty($this->errors)){
$this->passed=true;
  }
return $this;
}

public function valid_Pseudo($table,$pseudo){
  $check=$this->db->Select($table,array($pseudo));
  if(!empty($pseudo)){
     if(strlen($pseudo)<3){
      //echo "username doit etre minimum de 3";
      $this->addErros("pseudo"," doit avoir au minimum 3 caracteres");
    }
  if(strlen($pseudo)>20){
  //echo "username doit etre minimum de 20";
  $this->addErros("pseudo"," doit avoir au maximum 20 caracteres");
    }
$check=$this->db->Select($table,array($pseudo));
if($check->count()>0){
  $this->addErros("pseudo"," existe deja");
}
}

}

public function valid_password($password){
if(strlen($password)<5){
    $this->addErros("password"," doit avoir au moins 5 caracteres");
  }
}

public function errors(){
  return $this->errors;
}
public function passed(){
  return $this->passed;
}

public function addErros($index,$error){
return $this->errors[$index]=$index.$error;
}
}

 ?>
