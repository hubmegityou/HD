
<?php

require_once "connect.php";
                    require_once "dbinfo.php";
                    
                    
                    $connection = new mysqli($host, $db_user, $db_pass, $db_name);
                    if ($connection->connect_errno!=0){
                        echo "Error: ".$connection->connect_errno;
                        
                    }else{
           
                            $connection -> query ('SET NAMES utf8');
                            $connection -> query ('SET CHARACTER_SET utf8_unicode_ci');
                            $sql = "SELECT $db_subtask_taskid, $db_subtask_name, $db_subtask_sdate, $db_subtask_edate, $db_subtask_description FROM $db_subtask_tab WHERE $db_subtask_done='0' AND $db_subtask_userid =". $_SESSION['id'];
                    $result = $connection->query($sql);}
                            
                            ?>