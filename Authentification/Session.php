<?php
class Session{
  public static function session_exists($name){
      return (isset($_SESSION[$name])) ? true : false;
  }
public static function put_session($name,$value){
  return $_SESSION[$name]=$value;

}
public static function get_session($name){
  return $_SESSION[$name];
}

public static function delete_session($name){
  if(self::session_exists($name)){
    unset($_SESSION[$name]);
  }



}
}
?>
