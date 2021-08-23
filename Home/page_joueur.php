<?php
require_once '../Core/init.php';
init_session();
$user= new Users();

if($user->isLog() && $user->is_admin()){


  //echo ' <a href="logout.php"> Deconnection .</a>';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../Style/style.css"/>
  </head>
  <body>
    <div class="link">
      <a href="../Authentification/Deconnection.php"> Deconnection </a>
      <a href="score_page.php">Score</a>
      <a href="admin.php">Liste des joueurs</a>
    </div>
  <div class="page">
    <h3>Bienvenu <?php echo $user->data()->pseudo; ?></h3>
    <button class='button'> <a href="../Jeu/jeu.php">Commencer le jeu </a></button>
  </div>
  </body>
</html>

<?php
}
else if($user->isLog()){

?>

<!doctype html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../Style/style.css"/>
</head>
<body>
     <div class="page">
     <h3>Bienvenu <?php echo $user->data()->pseudo; ?></h3>
     <button > <a href="../Jeu/jeu.php">COMMENCER </a></button>
   </div>
   <div class="link">
     <a href="../Authentification/Deconnection.php"> Deconnection </a>
     <a href="score_page.php">Score</a>
   </div>
</body>
</html>

 <?php
}
else {
header("location:homePage.php");

}

 ?>
