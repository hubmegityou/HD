<?php
//usuwanie załączników/komentarzy
session_start();
if ($_SESSION['function'] <= 2){
    $tid= $_POST['tid'];    
    $sid= $_POST['sid'];
    $id = $_POST['id'];
    require_once 'database/dbinfo.php';   
    if (isset($_POST['fname'])){
        $fname = $_POST['fname'];
        unlink("attachments/$fname");
        $db_tab = $db_attachment_tab;
        $db_id = $db_attachment_id;
    }
    else{
        $db_tab = $db_messages_tab;
        $db_id = $db_messages_id;
    }
    require_once 'objects.php';
    $connection = db_connection();
    if ($connection != false){
        $sql = "DELETE FROM $db_tab WHERE $db_id='$id'";
        echo $sql;
        if ($connection->query($sql));
            //info że ok
        $connection->close();
    }
}
header("Location: tasks_all.php?sid=$sid&tid=$tid");
?>