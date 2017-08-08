<?php
session_start();
    
    if (!isset($_FILES)){
        header("location: tasks_all.php?sid=$sid&tid=$tid");
        exit();
    }
    
    require_once "database/dbinfo.php";
    require_once "objects.php";
    $connection = db_connection();
    if ($connection != false){
        $time=date("y-m-d_H-i-s");
        
        //kontrola typu (do poprawy)
        $ext = substr($_FILES['attachment']['name'], -3);
        if($ext != 'exe' && $ext!='php' && $ext !='.js'){
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], 'attachments/'.$time.$_FILES['attachment']['name'])){
                $sql = "INSERT INTO $db_attachment_tab ($db_attachment_id, $db_attachment_name, $db_attachment_type, $db_attachment_size, $db_attachment_taskid) VALUES (NULL, '".$time.$_FILES['attachment']['name']."', '".$_FILES['attachment']['type']."', '".$_FILES['attachment']['size']."', '".$_POST['myTID']."')";
                if ($result = $connection->query($sql));      
            }
        }
        unset($_FILES);
    
    $connection->close();
    $sid=$_POST['mySID'];
    $tid=$_POST['myTID'];
    header("location: tasks_all.php?sid=$sid&tid=$tid"); 
    }
    ?>