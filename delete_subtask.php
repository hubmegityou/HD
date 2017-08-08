<?php
require_once "database/dbinfo.php";
require_once "objects.php";
$connection = db_connection();
if ($connection != false){
    $sql="DELETE FROM $db_subtask_tab WHERE $db_subtask_id=". $_GET['id'];      
    $connection->query($sql); 
}
