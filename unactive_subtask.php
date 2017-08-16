<?php
if (empty($_POST)){
    header("Location: main.php");
    exit();
}
require_once "database/dbinfo.php";
require_once "objects.php";
$connection = db_connection();
if ($connection != false){
    $id = $_POST['myID'];
    $sql = "UPDATE $db_subtask_tab SET $db_subtask_done = NOT $db_subtask_done WHERE $db_subtask_id='$id'";
    if ($row = $connection->query($sql)){
        if ($_POST['active'])
            header("Location: tasks.php");
        else
            header("Location: old_tasks.php");
    }
    $connection->close();
}                            
?>