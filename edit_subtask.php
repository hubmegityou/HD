<?php


        session_start();
	
	if(!isset($_SESSION['online']) || !$_SESSION['online'] /*&& $_SESSION['function'] == 2 */ ) //function := 2 ==> manager
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
                        <a  href="tasks.php" ><i "></i>Moje aktywne zadania</a>
                    </li>			
	 
                    <li>
                        <a  href="old_tasks.php" ><i "></i>Zamknięte zadania</a>
                    </li>
                   <?php 
                   
                   If ($_SESSION['function']=="2"){
                      echo '<li>
                        <a  href="add_tasks.php"><i "></i> Dodaj zadanie</a>
                    </li>';  
                      echo '<li> <a  href="add_subtasks.php"><i "></i> Dodaj podzadanie</a>
                    </li>';
                       echo '<li><a href="team_tasks.php"><i "></i> Zadania grupy</a>
                    </li>';
                   } 
                   
                   
                   ?>
                    	
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Edytuj podzadanie</h2> 
                       </div>
                     </div>
                 <hr />
				 <div class="subtask-form">
<form action="edit_st.php" method="post">
<center>
<?php
    
    
    require_once "database/dbinfo.php";
    require_once "objects.php";
    $connection = db_connection();
    $sql= "SELECT * FROM $db_subtask_tab WHERE $db_subtask_id=".$_GET['id'];
    $result = $connection->query($sql);
    $row_sub = $result->fetch_assoc();
    
    $sql = "SELECT $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname, $db_functions_desc, $db_users_tab.$db_users_id FROM $db_users_tab INNER JOIN $db_functions_tab ON $db_users_function = $db_functions_id INNER JOIN $db_subtask_tab ON  $db_users_tab.$db_users_id=$db_subtask_tab.$db_subtask_userid  WHERE $db_subtask_id=".$_GET['id'];
    $result = $connection->query($sql);
    $row_subtask = $result->fetch_assoc();
    
    $sql = "SELECT $db_users_fname, $db_users_lname, $db_functions_desc, $db_users_id FROM $db_users_tab INNER JOIN $db_functions_tab ON $db_users_function = $db_functions_id WHERE NOT $db_users_id=$row_subtask[$db_users_id] AND $db_users_function>1  ORDER BY $db_users_function, $db_users_lname ASC";
    $result = $connection->query($sql);
        echo '<div class="temat"><p class="stemat">';
        echo '<select name="user" class="task" required>';
        echo '<option value="'.$row_subtask[$db_users_id].'">'.$row_subtask[$db_functions_desc].' '.$row_subtask[$db_users_fname].' '.$row_subtask[$db_users_lname].'</option>';
        while($row = $result->fetch_assoc()) {
            echo '<option value="'.$row[$db_users_id].'">'.$row[$db_functions_desc].' '.$row[$db_users_fname].' '.$row[$db_users_lname].'</option>';
        }
        echo '</select>';
    echo "<br/><br/>";
    $id = $_SESSION['id'];
    $sql = "SELECT $db_task_tab.$db_task_id, $db_task_tab.$db_task_name, $db_task_tab.$db_task_edate, $db_task_tab.$db_task_userid FROM $db_task_tab INNER JOIN $db_subtask_tab ON $db_task_tab.$db_task_id=$db_subtask_tab.$db_subtask_taskid WHERE $db_subtask_id=".$_GET['id'];
    $result = $connection->query($sql);
    $row_task = $result->fetch_assoc();
    $sql = "SELECT $db_task_id, $db_task_name, $db_task_edate, $db_task_userid FROM $db_task_tab WHERE NOT $db_task_id=$row_task[$db_task_id] AND $db_task_userid = $id";
    $result = $connection->query($sql);
        echo '<select name="task" class="task" required>';
        echo '<option value="'.$row_task[$db_task_id].'">'.$row_task[$db_task_name].'</option>';
        while($row = $result->fetch_assoc()) {
            echo '<option value="'.$row[$db_task_id].'">'.$row[$db_task_name].'</option>';
        }
        echo '</select>';
    $connection->close();
    echo "<input type='hidden' value='".$_GET['id']."' name='subtaskid' />";
     echo"<div class='stemat'><p class='tematt'>Temat podzadania: <br><input type='text' value='$row_sub[$db_subtask_name]' name='topic' class='stematp' style='width:90%' required/></p></div>";
     echo "<div class='termin'><p class='termint'>Termin rozpoczęcia: <input type='date' id='calendar' value='$row_sub[$db_subtask_sdate]' name='stime' required/></p></div>";
     echo "<div class='termin'><p class='termint'>Termin wykonania: <input type='date' id='calendar2' value='$row_sub[$db_subtask_edate]' name='etime' required/></p></div>";
     echo "<div class='stresc'><p class='tresct'>Treść podzadania: <br><textarea name='description' id='trescp' rows='6' style='width:90%' required>$row_sub[$db_subtask_description]</textarea></p></div>";
                ?>
        <div><p><button type="submit" >Zapisz</button></p></div>
		</center>
</form>
</div>
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

<script type="text/javascript">
    var datefield=document.createElement("input")
    datefield.setAttribute("type", "date")
    if (datefield.type!=="date"){
        document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
        document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n')
        document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n') 
    }
</script>
 
<script>
if (datefield.type!=="date"){ 
    jQuery(function($){ 
        $('#calendar').datepicker({dateFormat: "yy-mm-dd"});
            
        
        $('#calendar2').datepicker({dateFormat: "yy-mm-dd"});
    });
}
</script>