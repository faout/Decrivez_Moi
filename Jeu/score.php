<?php
require_once("../Core/init.php");
init_session();
$score=DataBase::getInstance();
$user=new Users();
$final_score=$score->Select_score("scores","score",$user->data()->pseudo)->catchResult()->total_score;
if($final_score==null){
$final_score=0;
}
$bonne_reponse = $score->count_reponse('scores',array($user->data()->pseudo))->catchResult()->reponse;

$bad_response = $score->count_reponse('reponse',array($user->data()->pseudo))->catchResult()->reponse;

 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../Style/style.css">
    <title></title>
  </head>
  <body>
    <h3> Scores: <?php echo $final_score; ?></h3>
    <h3> Vous avez donné : <?php echo  $bonne_reponse ?> bonnes reponses </h3>
    <h3> Vous avez donné : <?php echo  $bad_response; ?> mauvaises reponses</h3>

  </body>
</html>
