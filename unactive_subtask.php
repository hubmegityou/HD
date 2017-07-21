
<?php

require_once "connect.php";
                    require_once "dbinfo.php";
                    
                    
                    $connection = new mysqli($host, $db_user, $db_pass, $db_name);
                    if ($connection->connect_errno!=0){
                        echo "Error: ".$connection->connect_errno;
                        
                    }else{ 
                            $id= $_POST['myID'];
                            $sql = "UPDATE $db_subtask_tab SET $db_subtask_done = '1' WHERE $db_subtask_tab.$db_subtask_id =$id";
                            $connection->query($sql);}
                            
                            ?>