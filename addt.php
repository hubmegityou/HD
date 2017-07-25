<?php
/*
 * DOKOŃCZYĆ
 *  - ŁADOWANIE DANYCH DO BAZY (done)
 *  - KOMUNIKATY O BŁĘDZIE
 *  - POPRAWNE PRZEKIEROWANIA PO NIEWYPEŁNIENIU FORMULARZA (done)
 */
    session_start();
    
    if ((!isset($_POST['topic'])) || (!isset($_POST['description'])) || (!isset($_POST['stime'])) || (!isset($_POST['etime'])))
	{
            header('Location: add_tasks.php');
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
        
        $priority = $_POST['priority'];
        $sdate = $_POST['stime'];
        $edate = $_POST['etime'];
        
        if ($sdate > $edate){
            
                //info o niepoprawnej dacie
            
            header('Location: add_tasks.php');
            close();
        }
        $topic = $_POST['topic'];
        $desc = $_POST['description'];
        $userid = $_SESSION['id'];
        
        $sql = "INSERT INTO $db_task_tab ($db_task_id, $db_task_name, $db_task_description, $db_task_sdate, $db_task_edate, $db_task_userid, $db_task_priority, $db_task_done) VALUES (NULL, '$topic', '$desc', '$sdate', '$edate', $userid, $priority, 0)";
        if ($result = $connection->query($sql)){
            //info: dodano poprawnie
        }
        $sql = "SELECT $db_task_id FROM $db_task_tab WHERE $db_task_name='$topic' AND $db_task_userid='$userid' AND $db_task_sdate='$sdate' AND $db_task_edate='$edate'";
        if ($result = $connection->query($sql))
                echo "done id<br/>";
        $row = $result->fetch_assoc();
        var_dump($_FILES);
        if (move_uploaded_file($_FILES['attachment']['tmp_name'], 'attachments/'.$_FILES['attachment']['name']))
                echo "<br/>done<br/>";
        $sql = "INSERT INTO $db_attachment_tab ($db_attachment_id, $db_attachment_name, $db_attachment_type, $db_attachment_size, $db_attachment_taskid) VALUES (NULL, '".$_FILES['attachment']['name']."', '".$_FILES['attachment']['type']."', '".$_FILES['attachment']['size']."', '$row[$db_task_id]')";
        echo $sql;
        if ($result = $connection->query($sql))
                echo "<br/>done attach";
    }
    $connection->close();
    //header('Location: main.php');
?>