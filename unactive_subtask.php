<?php
    require_once "dbinfo.php";
    require_once "objects.php";
    $connection = db_connection();
    if ($connection != false){
        $id = $_POST['myID'];
        $sql = "UPDATE $db_subtask_tab SET $db_subtask_done = NOT $db_subtask_done WHERE $db_subtask_id=$id";
        if ($row = $connection->query($sql)){
            if ($_POST['active'] == '0')
                header('Location: old_tasks.php');
            else
                header('Location: tasks.php');
        }  
         echo "<script type=\"text/javascript\">alert('nie udalo się :(');</script>";
    }                            
?>