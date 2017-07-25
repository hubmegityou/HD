
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
                    require_once "connect.php";
                    require_once "dbinfo.php";
                    
                    
                    $connection = new mysqli($host, $db_user, $db_pass, $db_name);
                    if ($connection->connect_errno!=0){
                        echo "Error: ".$connection->connect_errno;
                        
                    }else{
           
                           $connection -> query ('SET NAMES utf8');
                           $connection -> query ('SET CHARACTER_SET utf8_unicode_ci');
                           $sql = "SELECT $db_task_tab.$db_task_id, $db_task_tab.$db_task_name, $db_task_tab.$db_task_description, $db_task_tab.$db_task_sdate, $db_task_tab.$db_task_edate, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_task_tab LEFT JOIN $db_users_tab ON $db_task_tab.$db_task_userid = $db_users_tab.$db_users_id";
                           $result = $connection->query($sql);

                    }
                    while($row = $result->fetch_assoc()){
                             
                            
                            echo "nazwa zadania: $row[$db_task_name] <br> manager: $row[$db_users_fname]  $row[$db_users_lname] <br> data rozpoczęcia: $row[$db_task_sdate]<br> data zakończenia:  $row[$db_task_edate]<br> opis:  $row[$db_task_description]";
                            echo "<br><br><div id='$row[$db_task_id]' style= 'cursor: pointer; color:red' onclick='hide($row[$db_task_id])' >pokaż podzadania</div> <br>";
                            echo "<div id='sh$row[$db_task_id]' style='display:none'>";
                            $sql = "SELECT  $db_subtask_tab.$db_subtask_name, $db_subtask_tab.$db_subtask_description, $db_subtask_tab.$db_subtask_sdate, $db_subtask_tab.$db_subtask_edate, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_subtask_tab LEFT JOIN $db_users_tab ON $db_subtask_tab.$db_subtask_userid = $db_users_tab.$db_users_id WHERE $db_subtask_taskid=$row[$db_task_id]"; 
                            $result2 = $connection->query($sql);
                            while ($row2=$result2->fetch_assoc()){
                               
                            echo " <br><br> nazwa podzadania: $row2[$db_subtask_name] <br> pracownik: $row2[$db_users_fname]  $row2[$db_users_lname] <br> data rozpoczęcia: $row2[$db_subtask_sdate]<br> data zakończenia:  $row2[$db_subtask_edate]<br> opis:  $row2[$db_subtask_description]";   
                            
                               
                    }
                    echo "</div>";
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


<script>
    
  function hide(id){

    var div = document.getElementById('sh'+id);

div.style.display = 'none';
document.getElementById(id).innerHTML = 'pokaż podzadania';

document.getElementById(id).onclick = function()
{
    if(div.style.display == 'none')
    {
        div.style.display = 'block';
        this.innerHTML = 'ukryj podzadania';
    }
    else
    {
        div.style.display = 'none';
        this.innerHTML = 'zobacz podadania';
    }
};}

</script>