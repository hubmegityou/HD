<?php
require_once 'database/dbinfo.php';
require_once 'objects.php';
$connection = db_connection();
if ($connection != false){
    $sql = "UPDATE $db_subtask_tab SET $db_subtask_block=NOT $db_subtask_block WHERE $db_subtask_id=".$_GET['id'];
    echo $sql;
    if ($connection->query($sql)) echo "ok";
    $connection->close();
}
?>