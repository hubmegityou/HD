<?php
/*
 * DOKOŃCZYĆ
 *  - ŁADOWANIE DANYCH DO BAZY
 *  - KOMUNIKATY O BŁĘDZIE
 *  - POPRAWNE PRZEKIEROWANIA PO NIEWYPEŁNIENIU FORMULARZA
 */
    session_start();
    /*
    if ((!isset($_POST['topic'])) || (!isset($_POST['description'])) || (!isset($_POST['time'])) || (!isset($_POST['name'])))
	{
		header('Location: add_tasks.php');
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
        $topic = $_POST['topic'];
        $date = $_POST['date'];
        $desc = $_POST['desc'];
        $userid = $_SESSION['id'];
        
        $sql = "INSERT INTO $db_task_tab () VALUES ()";
        if ($result = $connection->query($sql)){
            //info: dodano poprawnie
        }
    }    
        
?>

