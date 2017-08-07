<?php

var_dump($_POST);



    session_start();
    
    if ((!isset($_POST['topic'])) || (!isset($_POST['description'])) || (!isset($_POST['stime'])) || (!isset($_POST['etime']))){
          //  header('Location: add_tasks.php');
            exit();
	}
    
    require_once "database/dbinfo.php";
    require_once "objects.php";
    $connection = db_connection();
    if ($connection != false){
        
       echo  $priority = $_POST['priority'];
       echo  $sdate = $_POST['stime'];
       echo  $edate = $_POST['etime'];
        
        if ($sdate > $edate){
            
                 echo "<script type=\"text/javascript\">alert('Niepoprawna data');</script>"; // tez niby jest ale go nie ma xD
            
            header('Location: add_tasks.php');
            close();
        }
        
       echo  $taskid= $_POST['taskid'];
       echo  $topic = $_POST['topic'];
       echo  $desc = $_POST['description'];
       echo $userid = $_SESSION['id'];
        
        
        
        
        
        $sql = "UPDATE $db_task_tab SET  $db_task_name='$topic', $db_task_description='$desc', $db_task_sdate='$sdate', $db_task_edate='$edate', $db_task_userid= '$userid', $db_task_priority='$priority', $db_task_done='0' WHERE $db_task_id=$taskid";
        if ($result = $connection->query($sql)){
            //info: dodano poprawnie
        }
        
        //dodawanie załącznika
        if (isset($_FILE)){
            $time=date("y-m-d_H-i-s");
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], 'attachments/'.$time.$_FILES['attachment']['name'])){
                $sql = "INSERT INTO $db_attachment_tab ($db_attachment_id, $db_attachment_name, $db_attachment_type, $db_attachment_size, $db_attachment_taskid) VALUES (NULL, '".$time.$_FILES['attachment']['name']."', '".$_FILES['attachment']['type']."', '".$_FILES['attachment']['size']."','$taskid')";
                if ($result = $connection->query($sql));
                     echo "<script type=\"text/javascript\">alert('Załącznik został dodany');</script>";// to też niby jest ake go nie ma xd
                }
            unset($_FILE);
            }
        }
    $connection->close();
   // header('Location: main.php');
?>