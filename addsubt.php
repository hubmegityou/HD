<?php
 session_start();
    
    if (($_POST['name'] == '') || ($_POST['task'] == '') || (!isset($_POST['topic'])) || (!isset($_POST['description'])) || (!isset($_POST['time']))){
	header('Location: add_subtask.php');
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
        
        $name = explode(" ", $_POST['name']);
        $fname = $name[0];
        $lname = $name[1];
        $topic = $_POST['topic'];
        $desc = $_POST['description'];
        $date = $_POST['time'];
    }    
    $connection->close();
?>