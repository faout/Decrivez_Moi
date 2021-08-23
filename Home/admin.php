<?php
require_once("../Core/init.php");
init_session();
$test=DataBase::getInstance();
$user=$test->SelectAll('users');
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../Style/style.css">
  </head>
  <body>
    <table style="width:100%">
      <tr>
        <th>Pseudo</th>
        <th>Date de creation</th>
      </tr>
      <?php foreach ($user as $key => $value)
      { ?>
        <tr>
        <td> <?php echo $value['pseudo']; ?></td>
        <td><?php echo $value['creationDate']; ?></td>
      </tr>
    <?php } ?>

    </table>
  </body>
</html>
