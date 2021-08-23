<?php
require_once("../Core/init.php");
init_session();
$user=new Users();

if($user->isLog()){
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../Style/style.css">
  </head>
  <body>
    <h2> Scores </h2>
    <div class="score">
    <a href="../Jeu/score.php">Score</a>
    <a href="../Jeu/Classement_score.php">Classement</a>
  </div>
  </body>
</html>

<?php
}
else {
  header("location:Home_page.php");
}
 ?>
