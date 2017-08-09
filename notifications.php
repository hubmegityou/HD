<?php

session_start();

require_once "database/dbinfo.php";
    require_once "objects.php";
    $connection = db_connection();
    if ($connection != false){
        $sql= "SELECT count(*) FROM $db_nots_user_tab  WHERE  $db_nots_user_readnots=0  AND $db_nots_user_userid=".$_SESSION['id'];   
        $result = $connection->query($sql);
        // tu musi zwrócić liczbe rekrdów
        var_dump($result);
    }
