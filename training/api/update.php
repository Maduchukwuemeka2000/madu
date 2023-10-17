<?php
//note:the To_Do list has only the task and the time to carry out such task

header("Access-Control-Allow-Oringin : *");
header("Content-Type : application/json");
header("Access-Control-Allow-Methods : PUT");

require_once '../Config/Db.php';
require_once '../Model/Query.php';
// require_once "get_all.php";
//database connection
$db = Db::con();

//instantiating CRUD
$testing = new Query($db);

//getting the Id
$testing->id = isset($_GET['id']) ? $_GET['id'] : die();
$testing->To_Do = isset($_GET['to_do']) ? $_GET['to_do'] : die();
$time = isset($_GET['time']) ? new DateTime(str_replace('/', '-', $_GET['time'])) : new DateTime($testing->time);
$testing->time = $time->format('Y-m-d H:i:s');

//checking if the update was made
if ($testing->update() == true) {

    //displying all items
    echo json_encode($testing->read());

}
echo ($testing->time);
