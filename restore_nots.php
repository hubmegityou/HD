<?php session_start();

require_once "database/dbinfo.php";
    require_once "objects.php";
    $connection = db_connection();
     if ($connection != false){ 
         
         if(isset($_POST['delete'])){
             foreach($_POST['not'] as $selected){
                 $sql="DELETE  FROM $db_nots_user_tab WHERE  $db_nots_user_id = $selected;";
                $connection->query($sql); }   
         }else{
          
            foreach($_POST['not'] as $selected){
                 $sql="UPDATE $db_nots_user_tab SET $db_nots_user_delete = '0' WHERE $db_nots_user_id = $selected;";
                 $connection->query($sql);
         } }         
    }
        header("location: bin.php");
