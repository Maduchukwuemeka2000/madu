<?php
//note:the To_Do list has only the task and the time to carry out such task

header("Access-Control-Allow-Oringin : *");
header("Content-Type : application/json");
header("Access-Control-Allow-Methods : *");

require_once '../Db.php';
require_once 'Query.php';

//instantiating database connection
$db = new Db() ;
echo $db->con();
die();
//instantiating CRUD
$testing = new Query($db->$con);

//testing the to_do Api


