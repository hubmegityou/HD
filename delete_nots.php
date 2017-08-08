<?php
session_start();

require_once "database/dbinfo.php";
    require_once "objects.php";
    $connection = db_connection();
     if ($connection != false){
            if ($_GET['deletenots']=='wszystkie') {    
                $sql="DELETE FROM $db_nots_user_tab WHERE $db_nots_user_userid=".$_SESSION['id'];   
                $connection->query($sql); 
            
            } 
            if ($_GET['deletenots']=='przeczytane') {
                $sql="DELETE FROM $db_nots_user_tab WHERE $db_nots_user_userid=".$_SESSION['id']." AND $db_nots_user_readnots='1'"; ;
                $connection->query($sql);  
             
            } 
            if ($_GET['deletenots']=='nieprzeczytane') {
                $sql="DELETE FROM $db_nots_user_tab WHERE $db_nots_user_userid=".$_SESSION['id']." AND $db_nots_user_readnots='0'";  
                $connection->query($sql);
                
            } 
   
    }
     
        header("location: nots.php");
 

     
     