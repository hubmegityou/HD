<?php

    session_start();
    
    if ((!isset($_POST['myTID'])) || (!isset($_POST['mySID'])) || (!isset($_POST['stime'])) || (!isset($_POST['etime'])))
	{
         //   header('Location: tasks_all.php');
            exit();
	}
    
    require_once "database/dbinfo.php";
    require_once "objects.php";
    $connection = db_connection();
    if ($connection != false){
        $subtask_id = $_POST['mySID'];
        $task_id = $_POST['myTID'];
        $sdate = $_POST['stime'];
        $edate = $_POST['etime'];
        
        $sql= "Select $db_task_edate, $db_task_priority from $db_task_tab WHERE $db_task_id=$task_id";
        $select_result = $connection->query($sql);
        $select_row = $select_result -> fetch_assoc();
        
        If(($edate>$select_row[$db_task_edate]) && ($select_row[$db_task_priority]==1)){
         
            echo "<script type=\"text/javascript\">alert('Niepoprawna data');</script>";
            header('Location: add_subtasks.php');
            
        }else{
  
            if ($edate>$select_row[$db_task_edate]){
                $sql_u = "UPDATE $db_task_tab SET $db_task_edate='$edate' WHERE $db_task_id= $task_id"; 
                $connection->query($sql_u);
            }
            
            
        $sql = "UPDATE $db_subtask_tab SET $db_subtask_sdate='$sdate', $db_subtask_edate= '$edate' WHERE $db_subtask_id= $subtask_id";
        $connection->query($sql); 
               
        
        
    }   } 
    $connection->close();
    header("Location: tasks_all.php?sid=$subtask_id&tid=$task_id");
?>