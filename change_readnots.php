<?php
if (empty($_GET)){
    header("Location: main.php");
    exit();
}
require_once "database/dbinfo.php";
require_once "objects.php";
$connection = db_connection();
if ($connection != false){
    $sql = "UPDATE $db_nots_user_tab SET $db_nots_user_readnots = '1' WHERE $db_nots_user_id =". $_GET['id'];
    $connection->query($sql);
    $connection->close();
}
?>

