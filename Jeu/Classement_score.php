<?php
require_once("../Core/init.php");
init_session();
$db=DataBase::getInstance();
$user= new Users();
$test=$db->Classement_score('scores');
$test->execute();
$test->setFetchMode(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../Style/style.css">
    <title></title>
  </head>
  <body>
    <h2>Classement Score</h2>

    <table  style="width:50%">
      <tr >
        <th >Pseudo</th>
        <th>Score</th>
      </tr>
      <?php while(($data=$test->fetch())!==false)
      {
       ?>
        <tr>
        <td> <?php echo $data->pseudo; ?></td>
        <td><?php echo $data->total; ?></td>
      </tr>
    <?php } ?>

    </table>
  </body>
</html>
