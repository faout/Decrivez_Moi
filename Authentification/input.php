<?php
class Input{
  public static function exists($type='post'){
  switch ($type) {
    case 'post':
      return (!empty($_POST)) ? true: false;
      break;

    default:
    return false;
      break;
  }
  }

  public static function Post($data){
    if(isset($_POST[$data])){
      return $_POST[$data];
    }
  }
}


 ?>
