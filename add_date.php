<?php

    session_start();
    
    if ((!isset($_POST['myTID'])) || (!isset($_POST['myID'])) || (!isset($_POST['stime'])) || (!isset($_POST['etime'])))
	{
            header('Location: tasks_all.php');
            exit();
	}
    
    require_once "dbinfo.php";
    require_once "connect.php";
    
    $connection = new mysqli($host, $db_user, $db_pass, $db_name);

    if ($connection->connect_errno!=0){
	echo "Error: ".$connection->connect_errno;
    }
    else{
        $connection -> query ('SET NAMES utf8');
        $connection -> query ('SET CHARACTER_SET utf8_unicode_ci');
        
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