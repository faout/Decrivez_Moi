<?php
class DataBase{
  private $host='mysql.info.unicaen.fr';
  private $user='22010821';
  private $password='pekeixi7wi9oF1ai';
  private $dbname='22010821_bd';
  private $pdo;
  private $errors=false;
  private $query;
  private $count;
  private $result;
  private $pseudo;
  private $score;
  private static $instance=null;

  private function __construct(){
    try {
    $this->pdo = new PDO('mysql:host='. $this->host .';dbname='.$this->dbname.'' , $this->user, $this->password);

    } catch (PDOExeception $e) {
      die($e->getMessage());
    }

  }
  public static function getInstance(){
    if(!isset(self::$instance)){
      self::$instance=new DataBase();
      }
      return self::$instance;
  }

public function Query($requete,$data=array()){
$this->query=$this->pdo->prepare($requete);
if($this->query->execute($data)){
$this->result=$this->query->fetchAll(PDO::FETCH_OBJ);
  $this->count=$this->query->rowCount();
}
return $this;
}

public function Select($table,$data=array()){
  $sql="SELECT * FROM {$table} WHERE pseudo=?";
    return $this->Query($sql,$data);
}

public function Insert($table,$data=array()){
$table_column= implode(',', array_keys($data));
$table_value= implode("','",$data);
$rq="INSERT INTO {$table} ($table_column) VALUES('$table_value')";
$stmt=$this->pdo->prepare($rq);
if($stmt->execute()){
return $this;
}
}

public function SelectAll($table){
  $rq = "SELECT * FROM {$table} ";
  $stmt = $this->pdo->prepare($rq);
  $stmt->execute();
  $data = $stmt->fetchall();
   return $data;

}
public function Select_score($table,$score,$name){
$sql="SELECT SUM($score) as total_score FROM {$table} WHERE pseudo =:col_name ";
  $data=array(":col_name"=>$name);
  return $this->Query($sql,$data);

}
public function count_reponse($table,$data=array()){
$sql="SELECT COUNT(pseudo) as reponse FROM {$table} WHERE pseudo=?";
return $this->Query($sql,$data);
}

public function Classement_score($table){
$sql="SELECT pseudo, SUM(score) as total FROM {$table} GROUP BY pseudo ORDER BY total DESC";
$stmt = $this->pdo->prepare($sql);
return $stmt;
}

public function count(){
return $this->count;
}
public function results(){
  return $this->result;
}
public function catchResult(){
  return $this->results()[0];
}
}

 ?>
