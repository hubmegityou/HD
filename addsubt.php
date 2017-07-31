<?php 
 /*
 * DOKOŃCZYĆ
 *  - ŁADOWANIE DANYCH DO BAZY (done)
 *  - KOMUNIKATY O BŁĘDZIE
 *  - POPRAWNE PRZEKIEROWANIA PO NIEWYPEŁNIENIU FORMULARZA (done)
 *  - WERYFIKACJA DATY (CZY KONIEC NIE WCZEŚNIEJ NIŻ ZADANIE GŁÓWNE LUB WYŚWIETLANIE KOŃCOWEJ DATY)
 */
    session_start();
    if (($_POST['user'] == '') || ($_POST['task'] == '') || (!isset($_POST['topic'])) || (!isset($_POST['description'])) || (!isset($_POST['etime']))){
	header('Location: add_subtasks.php');
	exit();
    }
    
    require_once "dbinfo.php";
    require_once "objects.php";
    $connection = db_connection();
    if ($connection != false){
        
        $sdate = $_POST['stime'];
        $edate = $_POST['etime'];
        
        if ($sdate > $edate){
            
                
            echo "<script type=\"text/javascript\">alert('Niepoprawna data');</script>"; // sa ale tak jakby ich nie było bo strona przeskakuje dalej i aletu nie widac xDDDD
            header('Location: add_subtasks.php');
            close();
        }
        
        $taskid = $_POST['task'];
        $userid = $_POST['user'];
        $topic = $_POST['topic'];
        $desc = $_POST['description'];
        
        $sql = "INSERT INTO $db_subtask_tab ($db_subtask_id,$db_subtask_taskid,$db_subtask_name,$db_subtask_sdate,$db_subtask_edate,$db_subtask_description,$db_subtask_userid) VALUES (NULL,$taskid,'$topic','$sdate','$edate','$desc',$userid)";
        if ($result = $connection->query($sql)){
            echo "<script type=\"text/javascript\">alert('dodawanie zakończone');</script>";// sa ale tak jakby ich nie było bo strona przeskakuje dalej i aletu nie widac xDDDD
        }
    }    
    $connection->close();
    //header('Location: main.php');
?>