<?php
//Database Connection
class Db
{

    //DB Parameters
    private $dbname;
    private $port = '3306';
    private $password;
    private $user = 'root';
    private $host = 'localhost';
    private static $con = null;

    private function __construct()
    {

        try {
            self::$con = new PDO("mysql:dbname = $this->dbname; port = $this->port; host = $this->host", $this->user, $this->password);
            self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOEXxception $e) {
            echo 'Connection Error ' . $e->getmessage();
        }

    }

    public static function con()
    {
        $inst = new Db();
        return $inst::$con;

    }
}
