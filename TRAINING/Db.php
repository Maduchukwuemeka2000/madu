<?php
//Database Connection
class Db{
   
    //Requirement For Connecting To Mysql
    private $dbname ;
    private $root;
    private $password;
    private $user;
    private $host;
    private static $con=Null;

   public function __construct(){
        try{
             self::$con = new PDO("mysql:dbname = $this->dbname; root = $this->root; host = $this->host"  , $this->user  ,  $this->password);
             self::$con->setAttribute(PDO::ATTR_ERRMODE ,  PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOEXxception $e){
              echo 'Connection Error ' . $e->getmessage();
    }
    finally{
        echo 'Info checked';
    }
    }


    static function con(){
        return self::$con;
    }
}