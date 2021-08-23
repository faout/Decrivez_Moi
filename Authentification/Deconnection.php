<?php
require_once '../Core/init.php';
init_session();
$user=new Users();
$user->logout();
//unset($_SESSION['user']);
header("location:../Home/homePage.php");



 ?>
