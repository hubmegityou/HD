
<?php

	session_start();
	
	if(!isset($_SESSION['online']) || !$_SESSION['online'])
	{
		header('Location: index.php');
		exit();
	}
       
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HelpDesk</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="template/assets/css/bootstrap.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="template/assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
     <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link rel="Stylesheet" type="text/css" href="timeline/style.css" />
   
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
               
                <a class="navbar-brand" href="main.php"><?php echo $_SESSION['fname']." ".$_SESSION['lname']?></a> 
            </div>
    <div style="color: white;
    padding: 15px 50px 5px 50px;
    float: right;
    font-size: 16px;"> <a href="nots.php" class="btn btn-danger square-btn-adjust">Powiadomienia</a>
        <a href="logout.php" class="btn btn-danger square-btn-adjust">Wyloguj</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="template/assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
                    <li>
                        <a   href="main.php" ><i "></i> Strona główna</a>
                    </li>
                    
                    <li>
                        <a href="tasks.php" ><i "></i>Moje aktywne zadania</a>
                    </li>			
	 
                  <li>
                        <a href="old_tasks.php" ><i "></i>Zamknięte zadania</a>
                    </li>
                   <?php 
                   
                   If ($_SESSION['function']=="2" ){
                      echo '<li>
                        <a  href="add_tasks.php"><i "></i> Dodaj zadanie</a>
                    </li>';
                      echo '<li><a href="add_subtasks.php"><i "></i> Dodaj podzadanie</a>
                    </li>';
                      echo '<li><a class="active-menu" href="team_tasks.php"><i "></i> Zadania grupy</a>
                    </li>';
                      
                   } 
                   
                   
                     If ($_SESSION['function']=="1"){
                       echo '<li>
                        <a  href="add_user.php"><i "></i> Dodaj użytkownika</a>
                    </li>';    
                   }?>
                    	
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Zadania grupy</h2> 
                          </div>
                     </div>
                 <hr />
                          
                    <?php  
                    require_once "database/dbinfo.php";
                    require_once "objects.php";
                    $connection = db_connection();
                           $sql = "SELECT $db_task_tab.$db_task_id, $db_task_tab.$db_task_name, $db_task_tab.$db_task_description, $db_task_tab.$db_task_sdate, $db_task_tab.$db_task_edate, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_task_tab LEFT JOIN $db_users_tab ON $db_task_tab.$db_task_userid = $db_users_tab.$db_users_id";
                           $result = $connection->query($sql);

                    
                    while($row = $result->fetch_assoc()){
                
                            echo "<div class='teamtask-form'>";
                            echo "<p class='team-taskform'";
                            echo "<br><div style ='float:left;position: relative;left: 30px; width:40%'> nazwa zadania: $row[$db_task_name] <br> manager: $row[$db_users_fname]  $row[$db_users_lname] <br>  data rozpoczęcia: $row[$db_task_sdate]<br>  data zakończenia:  $row[$db_task_edate]<br> opis:  $row[$db_task_description]</div>";
                            echo "<br><br><button style ='float:right;position: relative;right: 30px;' type='submit' id='utask'  onclick='deleteTask($row[$db_task_id])'>usuń</button>";
                            echo "<br> <br><button style ='float:right;position: relative;right: 30px;' type='submit' id='etask'  onclick='editTask($row[$db_task_id])'>edytuj</button><br><br> <br>";  
                            echo "<br><br><button type='submit' style='position: relative;left: 30px;' id='$row[$db_task_id]'  onclick='hide($row[$db_task_id])'>pokaż podzadania</button><br><br> <br>";
                            echo "<div id='sh$row[$db_task_id]' style='display:none'>";
                            echo "</p>";
                            $sql = "SELECT  $db_subtask_tab.$db_subtask_name, $db_subtask_tab.$db_subtask_id, $db_subtask_tab.$db_subtask_description, $db_subtask_tab.$db_subtask_sdate, $db_subtask_tab.$db_subtask_edate, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_subtask_tab LEFT JOIN $db_users_tab ON $db_subtask_tab.$db_subtask_userid = $db_users_tab.$db_users_id WHERE $db_subtask_taskid=$row[$db_task_id]"; 
                            $result2 = $connection->query($sql);
                            while ($row2=$result2->fetch_assoc()){ 
                                echo "<p class='team-subtaskform'>";
                                echo "nazwa podzadania: $row2[$db_subtask_name] <br> pracownik: $row2[$db_users_fname]  $row2[$db_users_lname] <br> data rozpoczęcia: $row2[$db_subtask_sdate]<br> data zakończenia:  $row2[$db_subtask_edate]<br> opis:  $row2[$db_subtask_description]";  
                                echo "<br><br><button  type='submit' id='usub'  onclick='deleteSubtask($row2[$db_subtask_id])'>usuń</button>";
                                echo '  ';
                                echo "<button type='submit'  id='esub'  onclick='editSubtask($row2[$db_subtask_id])'>edytuj</button><br><br>";
                                echo "<br><br>";
                                echo "</p>";
                            }
                            echo "</div>";
                            echo "</div>";
                            echo "<br><br><br>";
                    
                           }
       
                      $connection -> close();
                    ?>
                  
                 <br>
                 <br>
                 <br>        

    </div>

    
	</div>
</div>
                 
                 
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    
   
</body>
</html>
<script type="text/javascript" src="js/subtasks.js"></script>
<script type="text/javascript" src="js/deleteSubtask.js"></script>
<script type="text/javascript" src="js/editSubtask.js"></script>
<script type="text/javascript" src="js/deleteTask.js"></script>
<script type="text/javascript" src="js/editTask.js"></script>