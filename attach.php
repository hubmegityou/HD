<?php
session_start();
    /*
    if (!isset($_FILE)){
        header("Location: tasks_all.php?id=".$_POST['myTID']."&tid=".$_POST['myID']);
        exit();
    }
    */
    require_once "dbinfo.php";
    require_once "connect.php";
    
    $connection = new mysqli($host, $db_user, $db_pass, $db_name);

    if ($connection->connect_errno!=0){
	echo "Error: ".$connection->connect_errno;
    }
    else{
        $connection -> query ('SET NAMES utf8');
        $connection -> query ('SET CHARACTER_SET utf8_unicode_ci');
        $time=date("y-m-d_H-i-s");
        
        //kontrola typu
        $ext = substr($_FILES['attachment']['name'], -3);
        if($ext != 'exe' && $ext!='php' && $ext !='.js'){
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], 'attachments/'.$time.$_FILES['attachment']['name'])){
                $sql = "INSERT INTO $db_attachment_tab ($db_attachment_id, $db_attachment_name, $db_attachment_type, $db_attachment_size, $db_attachment_taskid) VALUES (NULL, '".$time.$_FILES['attachment']['name']."', '".$_FILES['attachment']['type']."', '".$_FILES['attachment']['size']."', '".$_POST['myTID']."')";
                if ($result = $connection->query($sql));
                    //info: załącznik dodany poprawnie
            }
        }
        //else info o błędzie
        unset($_FILE);
    }
    $connection->close();
    header("Location: tasks_all.php?sid=".$_POST['mySID']."&tid=".$_POST['myTID']);
?>