<?php
/*
 * DOKOŃCZYĆ:
 * - KONTROLA BŁĘDÓW DLA NIEISTNIEJĄCYCH PLIKÓW
 * - POPRAWIĆ POBIERANIE, BŁĘDY W PLIKACH !!!!!!
 */
require_once 'database/dbinfo.php';
$id = $_GET['id'];
require_once "objects.php";
$connection = db_connection();
if ($connection != false){
    $sql = "SELECT $db_attachment_name, $db_attachment_size, $db_attachment_type FROM $db_attachment_tab WHERE $db_attachment_id='$id'";
    if ($result = $connection->query($sql)){
        $row = $result->fetch_assoc();
        $name = $row[$db_attachment_name];
//        $adress = dirname(__FILE__);
//        header ("Location: $adress\\tasks_all.php?sid=2&tid=3");
        $sid = $_GET['sid'];
        $tid = $_GET['tid'];
        header("location: tasks_all.php?sid=$sid&tid=$tid");
//        clearstatcache();
//        if (file_exists("attachments/".$name) && $name!=''){
//            header("Cache-control: private");
//            header("Content-Type: ".$row[$db_attachment_type]);
//            header("Content-Description: File Transfer");
//            header("Content-Length: ".$row[$db_attachment_size]);
//            header("Content-Disposition: attachment; filename=\"".substr($name, 17)."\";");
//            header("Content-Transfer-Encoding: binary");
//            readfile("attachments/".$name);
//        }
//        else{
//            echo "<script type=\"text/javascript\">window.alert('Wystąpił błąd: plik nie istnieje');</script>";
//            $sql = "DELETE FROM $db_attachment_tab WHERE $db_attachment_id='$id'";
//            $connection->query($sql);
//            header("Location: tasks_all.php?sid=".$_GET['sid']."&tid=".$_GET['tid']);
//        }
        $connection->close();
    }
}
else {
    echo "<script type=\"text/javascript\">window.alert('Błąd w połączeniu z bazą');</script>"; 
}
//header("Location: tasks_all.php?sid=$sid&tid=$tid");
?>