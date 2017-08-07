<?php
/*
 * DOKOŃCZYĆ:
 * - KONTROLA BŁĘDÓW DLA NIEISTNIEJĄCYCH PLIKÓW
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
        clearstatcache();
        if (file_exists("attachments/".$name) && $name!=''){
            header("Cache-control: private");
            header("Content-Type: ".$row[$db_attachment_type]);
            header("Content-Length: ".$row[$db_attachment_size]);
            header("Content-Disposition: attachment; filename=\"".substr($name, 17)."\"");
            readfile("attachments/".$name);
        }
        else{
            echo "<script type=\"text/javascript\">alert('wystąpił błąd: plik nie istnieje!');</script>";
            $sql = "DELETE FROM $db_attachment_tab WHERE $db_attachment_id='$id'";
            $connection->query($sql);
            //header("Location: ../tasks_all.php?sid=13&tid=16");
        }
        $connection->close();
    }
}
else {
    echo "<script type=\"text/javascript\">alert('błąd w połączeniu z bazą');</script>"; 
}
?>