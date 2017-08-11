<?php

    session_start();
    
    if ((!isset($_POST['myTID'])) || (!isset($_POST['mySID'])) || (!isset($_POST['stime'])) || (!isset($_POST['etime'])))
	{
            header("Location: tasks_all.php?sid=$subtask_id&tid=$task_id");
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
         
             $_SESSION['alert']= 'Niepoprawna data';
            header("Location: tasks_all.php?sid=$subtask_id&tid=$task_id");
            
        }else{
  
            if ($edate>$select_row[$db_task_edate]){
                $sql_u = "UPDATE $db_task_tab SET $db_task_edate='$edate' WHERE $db_task_id= $task_id"; 
                $connection->query($sql_u);
                
            }
        
        $sql = "UPDATE $db_subtask_tab SET $db_subtask_sdate='$sdate', $db_subtask_edate= '$edate', $db_subtask_conf= '1'  WHERE $db_subtask_id='$subtask_id'";
        $connection->query($sql);
        $_SESSION['alert']= 'Zmieniono datę';
        
        //add notification
        $text = "Zmieniono datę podzadania";
        $curr_timestamp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO $db_notifications_tab ($db_notifications_id, $db_notifications_date, $db_notifications_taskid, $db_notifications_subtaskid, $db_notifications_text) VALUES (NULL, '$curr_timestamp', '$task_id', '$subtask_id', '$text')";        }
        if ($result = $connection -> query($sql)){
            //info testowe: działa
            $notificationid = $connection->insert_id;
            $sql = "SELECT $db_task_userid FROM $db_task_tab WHERE $db_task_id=$task_id";
            $result = $connection -> query($sql);
            $row = $result -> fetch_assoc();
            $masterid = $row[$db_task_userid];
            $sql = "INSERT INTO $db_nots_user_tab ($db_nots_user_id, $db_nots_user_notificationid, $db_nots_user_userid, $db_nots_user_readnots) VALUES (NULL, '$notificationid', '$masterid', '0')";
            if ($result = $connection->query($sql)){
                    //infso testowe: działa
            }
        }
    }
    $connection->close();
    header("Location: tasks_all.php?sid=$subtask_id&tid=$task_id");
?>