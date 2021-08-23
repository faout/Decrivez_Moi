<?php
class Users{
private $db=null;
private $data;
private $session='user';
private $admin_session='admin';
private $admin;
private $errors=array();
private $is_log;

public function __construct($user=null){
$this->db=DataBase::getInstance();

if(!$user){
if(Session::session_exists($this->session)){
  $user_session=Session::get_session($this->session);
if($this->find_data($user_session)){
  $this->is_log = true;
  }
}
}
$this->find_data($user);
}

public function createUser($table,$data=array()){
$create= $this->db->Insert($table,$data);
    if(!$create){
      throw new Exception("Il y a eu une erreur lors de la création");
    }
  }


public function passwordHash($password){
  return password_hash($password,PASSWORD_DEFAULT);
}
public function find_data($pseudo){
 $check=$this->db->Select('users',array($pseudo));
 if($check->Count()>0){
$this->data=$check->catchResult();
return $this->data;
}
else {
  return false;
}

}
public function login($pseudo,$password){
$user = $this->find_data($pseudo);
if($user){
  if(password_verify($password,$this->data()->password)){
    Session::put_session($this->session,$this->data()->pseudo);
    Session::put_session($this->admin_session,$this->data()->admin);
    return true;
    }
else {
  //echo "no mactch pass or username";

    $this->addErrors("Invalide username ou password");
    }
}
else {
//echo "username doesnt existe";
$this->addErrors("ce compte n'existe pas");
}

return false;
}
public function data(){
  return $this->data;
}
public  function addErrors($errors){
  return $this->errors[]=$errors;
}
public function errors(){
  return $this->errors;
}
public function isLog(){
  return $this->is_log;
}

public function logout(){
  Session::delete_session($this->session);
  //unset($_SESSION['user']);
}
public function is_admin(){
  if(Session::session_exists($this->admin_session)){
    $session = Session::get_session($this->admin_session);
    if($session==1){
      return true;
    }
  return false;
   }

}


}
 ?>
