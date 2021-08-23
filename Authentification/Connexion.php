<?php
require_once '../Core/init.php';
init_session();
DataBase::getInstance();
if(Input::exists()){
$user= new Users();

if($user->login(Input::Post('pseudo'),Input::Post('password'))){
  header("location:../Home/page_joueur.php");

}


else {
foreach ($user->errors() as $error) {
  echo $error;
  echo '<br>';
}

}
}


?>


<!doctype html>
<html>
<head>
<link rel="stylesheet" href="../Style/style.css"/>
</head>

<body>
    <form class="login-form" action ="Connexion.php" method="post">
      <h3>Connexion</h3>
      <label for="pseudo">Pseudo:</label>
      <input type ="text" name ="pseudo" placeholder="Entrez votre pseudo" required>
      </br> </br>
      <label for="password">Password:</label>
      <input type="password" name ="password" placeholder="Entrez votre mot de passe" required>
      </br> </br>
      <button type="submit" name="login">Connexion</button>
    </form>
</body>

</html>
