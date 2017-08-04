<?php
require_once "database/dbinfo.php";
require_once "objects.php";
$connection = db_connection();
if ($connection != false){
    $sql="DELETE FROM $db_task_tab WHERE $db_task_id=".$_GET['id'];      
    $connection->query($sql);   
}
