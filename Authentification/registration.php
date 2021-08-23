<?php
require_once '../Core/init.php';
//init_session();

if(Input::exists()){
  $valid= new ValidRegistration();
  $user=new Users();

$test=$valid->ValidForm('users',Input::Post('pseudo'),Input::Post('password'));

if($test->passed())
{
$user->createUser('users',array(
'pseudo'=>Input::Post('pseudo'),
'password'=>$user->passwordHash(Input::Post('password')),
'admin'=>0,
'creationDate'=>date("Y-m-d H:m:s")
));
header("location:Connexion.php");

}


else {
$error=$test->errors() ;

}

}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../Style/style.css">
    <title></title>
  </head>
  <body>
    <form class="resistration-form" action ="registration.php" method="post">
      <label for="pseudo">Pseudo:</label>
      <input type ="text" name ="pseudo" placeholder="Entrer votre pseudo" required>
      <div><?php echo $error['pseudo'] ?? '' ;?></div>
    </br>
    <label for="password">Password:</label>
      <input type="password" name ="password" placeholder="enter your password" required>
       <div><?php echo $error['password'] ?? '' ?> </div>
    </br> </br>
      <button type="submit" name="inscription"> INSCRIPTION </button>
    </form>
  </body>
</html>
