<?php
require_once __DIR__ . "/vendor/autoload.php";
include ("database.php");

header('Content-Type: application/json');
header("Cache-Control: no-cache, must-revalidate");
$cursor=$client->find(['balance' =>['$lt' => 0]],
['projection'=>['name'=>1, '_id'=>0]]);
$toClient=array();
    foreach($cursor as $record)
    {
        array_push($toClient,(array)$record);
    }
echo json_encode($toClient);