<?php
//note:the To_Do list has only the task and the time to carry out such task

header("Access-Control-Allow-Oringin : *");
header("Content-Type : application/json");
header("Access-Control-Allow-Methods : POST");

require_once '../Config/Db.php';
require_once '../Model/Query.php';

//database connection
$db = Db::con();

//instantiating CRUD
$testing = new Query($db);

//testing the to_do Api

//getting the Id
$testing->To_Do = isset($_GET['to_do']) ? $_GET['to_do'] : die();
$time = isset($_GET['time']) ? new DateTime(str_replace('/', '-', $_GET['time'])) : new DateTime($testing->time);
$testing->time = $time->format('Y-m-d H:i:s');
$testing->Create_To_Do();

//displying all the items
echo json_encode($testing->Read());
