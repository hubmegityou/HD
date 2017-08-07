<?php
session_start();
if ($_SESSION['function'] <= 2){
    $tid= $_POST['tid'];    
    $sid= $_POST['sid'];
    $id = $_POST['id'];
    //$fname = $_POST['fname'];
    //jakiś warunek czy plik istnieje
    //unlink("attachments/$fname");
    require_once 'database/dbinfo.php';
    require_once 'objects.php';
    $connection = db_connection();
    if ($connection != false){
        $sql = "DELETE FROM $db_messages_tab WHERE $db_messages_id='$id'";
        if ($connection->query($sql));
            //info że ok
        $connection->close();
    }
}
header("Location: tasks_all.php?sid=$sid&tid=$tid");
?>