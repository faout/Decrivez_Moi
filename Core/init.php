<?php
function init_session():bool{
  if(!session_id()){
    session_start();
    session_regenerate_id();
    return true;
}
  return false;

}


require_once '../BD_requete/DB.php';
require_once '../Authentification/valid_registration.php';
require_once '../Authentification/input.php';
require_once '../Authentification/Users.php';
require_once '../Authentification/Session.php';




?>
