<?php
//note:the To_Do list has only the task and the time to carry out such task

header("Access-Control-Allow-Oringin : *");
header("Content-Type : application/json");
header("Access-Control-Allow-Methods : GET");

require_once '../Config/Db.php';
require_once '../Model/Query.php';

//database connection
$db = Db::con() ;

//instantiating CRUD
$testing = new Query($db);
echo json_encode($testing->Read());
//testing the to_do Api


