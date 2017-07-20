<?php 
 /*
 * DOKOŃCZYĆ
 *  - ŁADOWANIE DANYCH DO BAZY
 *  - KOMUNIKATY O BŁĘDZIE
 *  - POPRAWNE PRZEKIEROWANIA PO NIEWYPEŁNIENIU FORMULARZA
 *  - WERYFIKACJA DATY (CZY KONIEC NIE WCZEŚNIEJ NIŻ ZADANIE GŁÓWNE LUB WYŚWIETLANIE KOŃCOWEJ DATY)
 */
    session_start();
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
        
        $today = date('Y-m-d');
        $sql = "INSERT INTO $db_subtask_tab ($db_subtask_id, $db_subtask_taskid, $db_subtask_name, $db_subtask_sdate, $db_subtask_edate, $db_subtask_description, $db_subtask_userid) VALUES (NULL, $taskid, '$topic', '$today', '$date', '$desc', $userid)";
        if ($result = $connection->query($sql)){
            //info: dodano poprawnie
        }
        
    }    
    $connection->close();
?>