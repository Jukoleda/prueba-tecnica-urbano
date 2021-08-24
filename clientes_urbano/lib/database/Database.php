<?php

class Database {
    
     public static $host = "localhost";
     public static $user  = "root";
     public static $pass = "";
     public static $db = "urbano_db";
    
     public static function Connect() {
          $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$db.";charset=utf8", self::$user, self::$pass);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $pdo;
     }

     public static function Call($sp, $params = array()){
          $statement = self::Connect()->prepare("call " . $sp);
          $val = $statement->execute($params);
          return $val ? $statement->fetchAll(PDO::FETCH_OBJ) : $val;
     }
     
     public static function Query($query){
          $statement = self::Connect()->query($query);
          return $statement->fetchAll(PDO::FETCH_OBJ);

     }

}

?>