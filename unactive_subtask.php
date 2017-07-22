<?php

    require_once "connect.php";
    require_once "dbinfo.php";

    $connection = new mysqli($host, $db_user, $db_pass, $db_name);
    if ($connection->connect_errno!=0){
        echo "Error: ".$connection->connect_errno;

    }else{ 
        $id = $_POST['myID'];
        $sql = "UPDATE $db_subtask_tab SET $db_subtask_done = NOT $db_subtask_done WHERE $db_subtask_id=$id";
        if ($row = $connection->query($sql)){
            if ($_POST['active'] == '0')
                header('Location: old_tasks.php');
            else
                header('Location: tasks.php');
        }
           
        //else komunikat o błędzie
    }                            
?>