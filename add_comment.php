
<?php

    session_start();
    
    if ((!isset($_POST['comment']))||(!isset($_POST['mySID']))||(!isset($_POST['myTID']))){
            header('Location: tasks_all.php');
            exit();
	}
    
    require_once "database/dbinfo.php";
    require_once "objects.php";
    $connection = db_connection();
    if ($connection != false){
        $comment = $_POST['comment'];
        $subtask_id= $_POST['mySID'];
        $curr_timestamp = date('Y-m-d H:i:s');
        $task_id= $_POST['myTID'];
        $sql = "INSERT INTO $db_messages_tab ($db_messages_id, $db_messages_userid, $db_messages_taskid, $db_messages_date, $db_messages_text) VALUES (NULL,'". $_SESSION['id']."', '$task_id', '$curr_timestamp', '$comment')";
        $connection->query($sql);
    }    
    $connection->close();
    header("Location: tasks_all.php?sid=$subtask_id&tid=$task_id");
?>