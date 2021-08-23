<?php
require_once('../Core/init.php');
init_session();
$db=DataBase::getInstance();
$user=new Users();


if(isset($_POST['name']) && isset($_POST['photoid']))

{


  $db->Insert('reponse', array('name' => $_POST['name'],
  'photoid' => $_POST['photoid'],
  'pseudo'=>$user->data()->pseudo));


}


 ?>
