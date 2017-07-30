<?php

    session_start();
    
    if ((!isset($_POST['myTID'])) || (!isset($_POST['myID'])) || (!isset($_POST['stime'])) || (!isset($_POST['etime'])))
	{
            header('Location: tasks_all.php');
            exit();
	}
    
    require_once "dbinfo.php";
    require_once "objects.php";
    $connection = db_connection();
    if ($connection != false){
        $subtask_id = $_POST['myTID'];
        $task_id = $_POST['myID'];
        $sdate = $_POST['stime'];
        $edate = $_POST['etime'];
        $sql = "UPDATE $db_subtask_tab SET $db_subtask_sdate='$sdate', $db_subtask_edate= '$edate' WHERE $db_subtask_id= $subtask_id";
        echo $sql;
        $connection->query($sql); 
    }    
    $connection->close();
    header("Location: tasks_all.php?id=$subtask_id&tid=$task_id");
?>