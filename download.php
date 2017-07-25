<?php
    require_once 'dbinfo.php';
    require_once 'connect.php';
    $id = $_GET['id'];
    $connection = new mysqli($host, $db_user, $db_pass, $db_name);
    $connection -> query ('SET NAMES utf8');
    $connection -> query ('SET CHARACTER_SET utf8_unicode_ci');
    $sql = "SELECT $db_attachment_name, $db_attachment_size, $db_attachment_type FROM $db_attachment_tab WHERE $db_attachment_id='$id'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    header("Cache-control: private");
    header("Content-Type: ".$row[$db_attachment_type]);
    header("Content-Length: ".$row[$db_attachment_size]);
    header("Content-Disposition: attachment; filename=\"".$row[$db_attachment_name]."\"");
    readfile("attachments/".$row[$db_attachment_name]);
?>