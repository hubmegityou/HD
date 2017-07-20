
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
    font-size: 16px;">  <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
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
	 
                  
                   <?php 
                   
                   If ($_SESSION['function']=="1"||$_SESSION['function']=="2" ){
                      echo '<li>
                        <a  href="add_tasks.php"><i "></i> Dodaj zadanie</a>
                    </li>';  
                   } ?>
                    	
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
                            $sql = "SELECT $db_subtast_taskid, $db_subtast_name, $db_subtast_sdate, $db_subtast_edate, $db_subtask_description FROM $db_subtast_tab WHERE $db_subtast_edate >='". date("Y-m-d") ."' AND $db_subtast_userid =". $_SESSION['id'];
                            $result = $connection->query($sql);

                    }
                    while($row = $result->fetch_assoc()){
                             
                      $sql = "SELECT $db_task_tab.$db_task_name, $db_task_tab.$db_task_description, $db_task_tab.$db_task_sdate, $db_task_tab.$db_task_edate, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_task_tab LEFT JOIN $db_users_tab ON task.$db_task_userid = $db_users_tab.$db_users_id WHERE task.$db_task_id =".$row[$db_subtast_taskid];
                      $result2 = $connection->query($sql);  
                      $row2=$result2->fetch_assoc();  
                         
                           
                      echo '<article class="timeline-entry">
                            <div class="timeline-entry-inner">
                            <div class="timeline-icon bg-success">
                            <i class="entypo-feather"></i>
                            </div>
                            <div class="timeline-label">';   
                      echo "<h2><a class='dymek'>$row[$db_subtast_name]<span><br> <br>Nazwa zadania głównego: $row2[$db_task_name] <br> Manager: $row2[$db_users_fname] $row2[$db_users_lname]<br> Data rozpoczęcia: $row2[$db_task_sdate] <br> Data zakończenia: $row2[$db_task_edate]<br> Opis: $row2[$db_task_description]<br> </span> </a><span></span><h2>"; 
                      echo "<p>Data rozpoczęcia: $row[$db_subtast_sdate]  <br> ";
                      echo "Data zakończenia: $row[$db_subtast_edate]  <br><br>";
                      echo "Opis zadania: <br> $row[$db_subtask_description]";
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
