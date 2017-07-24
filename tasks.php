


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
    font-size: 16px;">  <a href="logout.php" class="btn btn-danger square-btn-adjust">Wyloguj</a> </div>
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
                        <a class="active-menu"  href="tasks.php" ><i "></i>Moje aktywne zadania</a>
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
                     <h2>Aktywne zadania</h2> 
                       </div>
                     </div>
                 <hr />
                 <br>
                 <br>
                 <br>
                     
                 <div class="container">
	<div class="row">
    
        <div class="timeline-centered">

       
                    
                    <?php  
                    require_once "connect.php";
                    require_once "dbinfo.php";
                    
                    
                    $connection = new mysqli($host, $db_user, $db_pass, $db_name);
                    if ($connection->connect_errno!=0){
                        echo "Error: ".$connection->connect_errno;
                        
                    }else{
           
                            $connection -> query ('SET NAMES utf8');
                            $connection -> query ('SET CHARACTER_SET utf8_unicode_ci');
                            $sql = "SELECT $db_subtask_tab.$db_subtask_id, $db_subtask_tab.$db_subtask_taskid, $db_subtask_tab.$db_subtask_name, $db_subtask_tab.$db_subtask_sdate, $db_subtask_tab.$db_subtask_edate, $db_subtask_tab.$db_subtask_description FROM $db_subtask_tab INNER JOIN $db_task_tab ON $db_subtask_tab.$db_subtask_taskid = $db_task_tab.$db_task_id WHERE $db_subtask_tab.$db_subtask_done='0' AND $db_subtask_tab.$db_subtask_userid =". $_SESSION['id']." ORDER BY $db_task_tab.$db_task_priority DESC, $db_subtask_tab.$db_subtask_edate ASC";
                            $result = $connection->query($sql);

                    }
                    while($row = $result->fetch_assoc()){
                             
                      $sql = "SELECT $db_subtask_tab.$db_subtask_id, $db_task_tab.$db_task_name, $db_task_tab.$db_task_description, $db_task_tab.$db_task_sdate, $db_task_tab.$db_task_edate, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_subtask_tab, $db_task_tab LEFT JOIN $db_users_tab ON task.$db_task_userid = $db_users_tab.$db_users_id WHERE task.$db_task_id =".$row[$db_subtask_taskid];
                      $result2 = $connection->query($sql);
                      $row2=$result2->fetch_assoc();
                      echo "<br/>";
                      echo '<article class="timeline-entry">
                            <div class="timeline-entry-inner">
                            <div class="timeline-icon bg-success">
                            <i class="entypo-feather"></i>
                            </div>
                            <div class="timeline-label">';   
                      echo "<h2><a class='dymek' href ='tasks_all.php' href='add_tasks.php'>$row[$db_subtask_name]<span><br> <br>Nazwa zadania głównego: $row2[$db_task_name] <br> Manager: $row2[$db_users_fname] $row2[$db_users_lname]<br> Data rozpoczęcia: $row2[$db_task_sdate] <br> Data zakończenia: $row2[$db_task_edate]<br> Opis: $row2[$db_task_description]<br> <br>----------------------------------------------------<br> </span> </a><span></span><h2>"; 
                      echo "<a><span>Data rozpoczęcia: $row[$db_subtask_sdate]  <br> ";
                      echo "Data zakończenia: $row[$db_subtask_edate]<br><br>";
                      echo "Opis zadania: <br> $row[$db_subtask_description]";
                      echo "<form action='unactive_subtask.php' method='post'>";
                      echo "<input type='hidden' name='active' value=1>";
                      echo "<input type='hidden' name='myID' value=$row[$db_subtask_id]>";
                      echo "<br /><button type='submit'>Przenieś do zrobionych</button></center>";
                      echo "</form>";
                      echo'</div>
                           </div>
                           </article>'
                          ;}
                    $connection -> close();
                    ?>

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
