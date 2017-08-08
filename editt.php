<?php
session_start();
    
if ((!isset($_POST['topic'])) || (!isset($_POST['description'])) || (!isset($_POST['stime'])) || (!isset($_POST['etime']))){
        header('Location: team_tasks.php');
        exit();
    }

require_once "database/dbinfo.php";
require_once "objects.php";
$connection = db_connection();
if ($connection != false){

    $priority = $_POST['priority'];
    $sdate = $_POST['stime'];
    $edate = $_POST['etime'];

    if ($sdate > $edate){
        echo "<script type=\"text/javascript\">window.alert('Niepoprawna data');
        window.location.href = 'team_tasks.php';</script>";

        close();
    }

    $taskid= $_POST['taskid'];
    $topic = $_POST['topic'];
    $desc = $_POST['description'];
    $userid = $_SESSION['id'];
    
    $sql = "UPDATE $db_task_tab SET  $db_task_name='$topic', $db_task_description='$desc', $db_task_sdate='$sdate', $db_task_edate='$edate', $db_task_userid= '$userid', $db_task_priority='$priority', $db_task_done='0' WHERE $db_task_id='$taskid'";
    if ($result = $connection->query($sql)){
        echo "<script type=\"text/javascript\">window.alert('Edytowano zadanie');</script>";
    }

    //dodawanie załącznika
    if (isset($_FILES)){
        $time=date("y-m-d_H-i-s");
        if (move_uploaded_file($_FILES['attachment']['tmp_name'], 'attachments/'.$time.$_FILES['attachment']['name'])){
            $sql = "INSERT INTO $db_attachment_tab ($db_attachment_id, $db_attachment_name, $db_attachment_type, $db_attachment_size, $db_attachment_taskid) VALUES (NULL, '".$time.$_FILES['attachment']['name']."', '".$_FILES['attachment']['type']."', '".$_FILES['attachment']['size']."','$taskid')";
            if ($result = $connection->query($sql));
                 
            }
        unset($_FILES);
        }
    }
$connection->close();
echo "<script type=\"text/javascript\">window.location.href = 'team_tasks.php';</script>";
?>