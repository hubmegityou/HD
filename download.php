<?php
/*
 * DOKOŃCZYĆ:
 * - INFO O BŁĘDZIE
 */
    require_once 'dbinfo.php';
    require_once 'connect.php';
    $id = $_GET['id'];
    require_once "objects.php";
    $connection = db_connection();
    if ($connection != false){
        $sql = "SELECT $db_attachment_name, $db_attachment_size, $db_attachment_type FROM $db_attachment_tab WHERE $db_attachment_id='$id'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        header("Cache-control: private");
        header("Content-Type: ".$row[$db_attachment_type]);
        header("Content-Length: ".$row[$db_attachment_size]);
        header("Content-Disposition: attachment; filename=\"".substr($row[$db_attachment_name], 17)."\"");
        readfile("attachments/".$row[$db_attachment_name]);
    }else {
         echo "<script type=\"text/javascript\">alert('błąd w połączeniu z bazą');</script>"; 
    }
   
?>