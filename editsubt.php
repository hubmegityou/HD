<?php
session_start();
if (($_POST['user'] == '') || ($_POST['task'] == '') || (!isset($_POST['topic'])) || (!isset($_POST['description'])) || (!isset($_POST['etime']))){
    header('Location: team_tasks.php');
    exit();
}
require_once "database/dbinfo.php";
require_once "objects.php";
$connection = db_connection();
if ($connection != false){
    $sdate = $_POST['stime'];
    $edate = $_POST['etime'];
    if ($sdate > $edate){
        echo "<script type=\"text/javascript\">window.alert('Niepoprawna data');
        window.location.href = 'team_tasks.php';</script>"; 
        close();
    }
    $subtaskid=$_POST['subtaskid'];
    $taskid = $_POST['task'];
    $userid = $_POST['user'];
    $topic = $_POST['topic'];
    $desc = $_POST['description'];



    $sql = "UPDATE $db_subtask_tab SET $db_subtask_taskid='$taskid' ,$db_subtask_name='$topic',$db_subtask_sdate='$sdate',$db_subtask_edate='$edate',$db_subtask_description='$desc',$db_subtask_userid='$userid' WHERE $db_subtask_id='$subtaskid'";
    if ($result = $connection->query($sql)){
        echo "<script type=\"text/javascript\">window.alert('Edytwano podzadanie');</script>"; 
        $text = "Edytowano podzadanie";
        $curr_timestamp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO $db_notifications_tab ($db_notifications_id, $db_notifications_date, $db_notifications_taskid, $db_notifications_subtaskid, $db_notifications_text) VALUES (NULL, '$curr_timestamp', '$taskid', '$subtaskid', '$text')";
        if ($result = $connection -> query($sql)){
                //info testowe: działa
            $notificationid = $connection->insert_id;       
            $sql = "INSERT INTO $db_nots_user_tab ($db_nots_user_id, $db_nots_user_notificationid, $db_nots_user_userid, $db_nots_user_readnots) VALUES (NULL, '$notificationid', '$userid', '0')";
            if ($result = $connection->query($sql)){
                //info testowe: działa
            }
        }
    }
    $connection->close();
}
echo "<script type=\"text/javascript\">window.location.href = 'team_tasks.php';</script>";
?>