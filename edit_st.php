<?php
session_start();
    if (empty($_POST)){
        header('Location: team_tasks.php');
        exit();
    }

require_once "database/dbinfo.php";
require_once "objects.php";
$connection = db_connection();
if ($connection != false){
    $sdate = $_POST['stime'];
    $edate = $_POST['etime'];
    $topic = $_POST['topic'];
    $desc = $_POST['description'];
    
    if ($sdate > $edate){
        $_SESSION['alert']= 'Niepoprawna data';
        header('Location: team_tasks.php'); 
        close();
    } 
    
    If($_POST['task']=='task'){

        $priority = $_POST['priority'];
        $taskid= $_POST['taskid'];
        $userid = $_SESSION['id'];
        $sql = "UPDATE $db_task_tab SET $db_task_name='$topic', $db_task_description='$desc', $db_task_sdate='$sdate', $db_task_edate='$edate', $db_task_userid= '$userid', $db_task_priority='$priority', $db_task_done='0' WHERE $db_task_id='$taskid'";
        if ($result = $connection->query($sql)){
            $_SESSION['alert']= 'Edytowano zadanie';
        }
        $text = 3; //3: edytowano zadanie
        $sql = "INSERT INTO $db_notifications_tab ($db_notifications_id, $db_notifications_date, $db_notifications_taskid, $db_notifications_subtaskid, $db_notifications_type) VALUES (NULL, '".date('Y-m-d H:i:s')."', '$taskid', NULL, '$text')";
        if ($result = $connection -> query($sql)){
            //info kontrolne, że działa
            $notificationid = $connection->insert_id;
            $sql = "SELECT $db_subtask_userid FROM $db_subtask_tab WHERE $db_subtask_taskid=$taskid AND $db_subtask_userid<>".$_SESSION['id']." GROUP BY $db_subtask_userid";
            $result = $connection->query($sql);
            while ($row = $result->fetch_assoc()){
                $sql = "INSERT INTO $db_nots_user_tab ($db_nots_user_id, $db_nots_user_notificationid, $db_nots_user_userid, $db_nots_user_readnots) VALUES (NULL, '$notificationid', '$row[$db_subtask_userid]', '0')";
                $connection->query($sql);
            }
        }
        //dodawanie załącznika
        if (isset($_FILES)){
            $time=date("ymdHis");
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], 'attachments/'.$time.$_FILES['attachment']['name'])){
                $sql = "INSERT INTO $db_attachment_tab ($db_attachment_id, $db_attachment_name, $db_attachment_type, $db_attachment_size, $db_attachment_taskid) VALUES (NULL, '".$time.$_FILES['attachment']['name']."', '".$_FILES['attachment']['type']."', '".$_FILES['attachment']['size']."','$taskid')";
                if ($result = $connection->query($sql));
                    //info: dodano załącznik poprawnie
                }
            unset($_FILES);
            }
    }
    else{
        $subtaskid=$_POST['subtaskid'];
        $taskid = $_POST['task'];
        $userid = $_POST['user'];

        $sql = "UPDATE $db_subtask_tab SET $db_subtask_taskid='$taskid' ,$db_subtask_name='$topic',$db_subtask_sdate='$sdate',$db_subtask_edate='$edate',$db_subtask_description='$desc',$db_subtask_userid='$userid' WHERE $db_subtask_id='$subtaskid'";
        if ($result = $connection->query($sql)){
            $_SESSION['alert']= 'Edytowano podzadanie'; 
            $text = 5; //5: edytowano podzadanie
            $curr_timestamp = date('Y-m-d H:i:s');
            $sql = "INSERT INTO $db_notifications_tab ($db_notifications_id, $db_notifications_date, $db_notifications_taskid, $db_notifications_subtaskid, $db_notifications_type) VALUES (NULL, '$curr_timestamp', '$taskid', '$subtaskid', '$text')";
            if ($result = $connection -> query($sql)){
                    //info testowe: działa
                $notificationid = $connection->insert_id;       
                $sql = "INSERT INTO $db_nots_user_tab ($db_nots_user_id, $db_nots_user_notificationid, $db_nots_user_userid, $db_nots_user_readnots) VALUES (NULL, '$notificationid', '$userid', '0')";
                if ($result = $connection->query($sql)){
                    //info testowe: działa
                }
            }
        }
    }
    $connection->close();
}
header('location: team_tasks.php');
?>