
<?php

    session_start();
    
    if ((!isset($_POST['comment']))||(!isset($_POST['myID']))||(!isset($_POST['myTID'])))
	{
            header('Location: tasks_all.php');
            exit();
	}
    
    require_once "dbinfo.php";
    require_once "connect.php";
    
    $connection = new mysqli($host, $db_user, $db_pass, $db_name);

    if ($connection->connect_errno!=0){
	echo "Error: ".$connection->connect_errno;
    }
    else{
        $connection -> query ('SET NAMES utf8');
        $connection -> query ('SET CHARACTER_SET utf8_unicode_ci');
        
      
        $comment = $_POST['comment'];
        $subtask_id= $_POST['myID'];
        $curr_timestamp = date('Y-m-d H:i:s');
        $task_id= $_POST['myTID'];
     
        
        
        $sql = "INSERT INTO $db_messages_tab ($db_messages_id, $db_messages_userid, $db_messages_taskid, $db_messages_date, $db_messages_text) VALUES (NULL,'". $_SESSION['id']."', '$subtask_id', '$curr_timestamp', '$comment')";
        $connection->query($sql);
    }    
    $connection->close();
    header("Location: tasks_all.php?id=$task_id&tid=$subtask_id");
?>