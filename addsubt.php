<?php
 session_start();
 
 /*
 * DOKOŃCZYĆ
 *  - ŁADOWANIE DANYCH DO BAZY
 *  - KOMUNIKATY O BŁĘDZIE
 *  - POPRAWNE PRZEKIEROWANIA PO NIEWYPEŁNIENIU FORMULARZA
 */
    /*
    if (($_POST['name'] == '') || ($_POST['task'] == '') || (!isset($_POST['topic'])) || (!isset($_POST['description'])) || (!isset($_POST['time']))){
	header('Location: add_subtasks.php');
	exit();
    }
    */
    require_once "dbinfo.php";
    require_once "connect.php";
    
    $connection = new mysqli($host, $db_user, $db_pass, $db_name);

    if ($connection->connect_errno!=0){
	echo "Error: ".$connection->connect_errno;
    }
    else{
        $connection -> query ('SET NAMES utf8');
        $connection -> query ('SET CHARACTER_SET utf8_unicode_ci');
        
        $taskid = $_POST['task'];
        $userid = $_POST['user'];
        $topic = $_POST['topic'];
        $desc = $_POST['description'];
        $date = $_POST['time'];
        
        $row = $result->fetch_assoc();
    }    
    $connection->close();
?>