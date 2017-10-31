<?php
//kosz na usunięte powiadomienia
    session_start();

    if(!isset($_SESSION['online']) || !$_SESSION['online']){
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
   <link rel="Stylesheet" type="text/css" hr>
   
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
    font-size: 16px;"> <div class="circle" id="circle"></div><a href="nots.php" class="btn btn-danger square-btn-adjust">Powiadomienia</a> 
        <a href="logout.php" class="btn btn-danger square-btn-adjust">Wyloguj</a> 
    </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                      <?php 
                    
                    require_once "database/dbinfo.php";
                    require_once "database/connect.php";
    
                    $connection = db_connection(); 
                    
                    $sql='SELECT COUNT(id) FROM cats';
                    $result= $connection->query($sql);
                    $row = $result->fetch_assoc();
                    $ile=$row['COUNT(id)'];
                    
                    $id= rand(1,$ile);
                    $sql2= "SELECT link FROM cats WHERE ID=$id";
                    $result2= $connection->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $path=$row2['link'];
                    
                    
                   echo " <img src='$path' class='user-image img-responsive'/>";
      
                       ?>
					</li>
				
                    <li>
                        <a  href="main.php" ><i "></i> Strona główna</a>
                    </li>
                    
                    <li>
                        <a  href="tasks.php" ><i "></i> Moje aktywne zadania</a>
                    </li>			
	 
                    <li>
                        <a href="old_tasks.php" ><i "></i>Zamknięte zadania</a>
                    </li>
					<li>
                        <a  href="suspended.php" ><i "></i>Zawieszone</a>
                    </li>
                   <?php 
                   
                   If ($_SESSION['function']=="2" ){
                      echo '<li>
                        <a  href="add_tasks.php"><i "></i> Dodaj zadanie</a>
                    </li>';  
                      echo '<li>
                        <a  href="add_subtasks.php"><i "></i> Dodaj podzadanie</a>
                    </li>';  
                       echo '<li><a href="team_tasks.php"><i "></i> Zadania grupy</a>
                    </li>';
					 echo '<li><a href="managers.php"><i "></i> Zadania innych managerów</a>
                    </li>';
                   }
                   
                     If ($_SESSION['function']=="1"){
                       echo '<li>
                        <a  href="add_user.php"><i "></i> Dodaj użytkownika</a>
                    </li>';    
                   }
                   ?>
                    <li>
                        <a  href="edit_profile.php" ><i "></i>Edytuj profil</a>
                    </li>
					
					<li>
                        <a  href="search.php" ><i "></i>Wyszukaj</a>
                    </li>
					
                    	
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Kosz</h2> 
                       </div>
                     </div>
                 <hr />

                 <form  action="restore_nots.php" method='post' onsubmit="return (del(3))">
                  <select onchange='changeChecked()' id='deletenots' name="deletenots" style="margin-left: 30px">
                        <option value="----" >----</option>
                        <option value="wszystkie">wszystkie</option>
                        <option value="przeczytane">przeczytane</option>
                        <option value="nieprzeczytane">nieprzeczytane</option>
                  </select>
                 
                      <button type="submit" name="restore">Przywróć</button>
                      <button type="submit"  name="delete" value="delete" >Usuń</button>
                  

                 <a href="nots.php" style='position:relative; margin-left: 30%; background-color: grey' class="btn btn-danger square-btn-adjust">Powiadomienia</a>
                 <a href="bin.php" style='position:relative; background-color: #e0610d' class="btn btn-danger square-btn-adjust">Kosz</a> 
                 
                 <br><br><br><br><br>
                 
<?php 
    
    require_once "database/dbinfo.php";
    require_once "database/connect.php";
    
    $connection = db_connection();



    $test= "SELECT $db_task_name, $db_task_id FROM $db_task_tab";
    $result3 = $connection->query($test); 
        while($row2 = $result3->fetch_assoc()){
        
    

   $sql = "SELECT $db_notifications_tab.$db_notifications_date, $db_notifications_tab.$db_notifications_type, $db_nots_user_tab.$db_nots_user_color,$db_nots_user_tab.$db_nots_user_id, $db_nots_user_tab.$db_nots_user_taskid, $db_nots_user_tab.$db_nots_user_subtaskid, $db_nots_user_tab.$db_nots_user_readnots "
        . " FROM $db_notifications_tab INNER JOIN $db_nots_user_tab ON $db_notifications_tab.$db_notifications_id=$db_nots_user_tab.$db_nots_user_notificationid "
        . " WHERE $db_nots_user_tab.$db_nots_user_taskid=$row2[$db_task_id] AND $db_nots_user_tab.$db_nots_user_userid = ".$_SESSION['id']." AND $db_nots_user_delete=1 "
        . " ORDER BY $db_notifications_tab.$db_notifications_date DESC";
        
        $result = $connection->query($sql);
        if (mysqli_num_rows($result)>0){
			$sql_getnots=" SELECT count($db_nots_user_id) FROM $db_nots_user_tab  WHERE  $db_nots_user_readnots=0 AND $db_nots_user_delete=1 AND $db_nots_user_taskid= $row2[$db_task_id] AND $db_nots_user_userid=".$_SESSION['id'];
			 $result_getnots= $connection->query($sql_getnots);
			  $row_getnots= $result_getnots->fetch_assoc();
        echo "<br><div class='circle2' id='circle2'>".$row_getnots["count($db_nots_user_id)"]."</div><div class='clickme' id='$row2[$db_task_id]' style='cursor:pointer'> $row2[$db_task_name]</div><div style='clear:both'></div>";}
        
        echo "<div id='show$row2[$db_task_id]' style='display:none'>";
        while($row = $result->fetch_assoc()){

            switch ($row[$db_notifications_type]){
                case 1: $text = "Dodano nowy komentarz do aktywnego zadania: ";
                        break;
                case 2: $text = "Dodano nowy załącznik do aktywnego zadania: ";
                        break;
                case 3: $text = "Edytowano aktywne zadanie: ";
                        break;
                case 4: $text = "Masz przydzielone nowe podzadanie: ";
                        break;
                case 5: $text = "Edytowano twoje aktywne podzadanie: ";
                        break;
                case 6: $sql = "SELECT $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname, $db_subtask_tab.$db_subtask_name "
                        . "FROM $db_subtask_tab INNER JOIN $db_users_tab ON $db_subtask_tab.$db_subtask_userid=$db_users_tab.$db_users_id "
                        . "WHERE $db_subtask_id=$row[$db_nots_user_subtaskid]";
                        $result2 = $connection->query($sql);
                        $row2 = $result2->fetch_assoc();
                        $text = "Użytkownik <b>".$row2[$db_users_fname]." ".$row2[$db_users_lname]."</b> zmienił datę w podzadaniu: <b>".$row2[$db_subtask_name]."</b>";
                        break;
                case 7: $sql = "SELECT $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname, $db_subtask_tab.$db_subtask_name "
                        . "FROM $db_subtask_tab INNER JOIN $db_users_tab ON $db_subtask_tab.$db_subtask_userid=$db_users_tab.$db_users_id "
                        . "WHERE $db_subtask_id=$row[$db_nots_user_subtaskid]";
                        $result2 = $connection->query($sql);
                        $row2 = $result2->fetch_assoc();
                        $text = "Użytkownik <b>".$row2[$db_users_fname]." ".$row2[$db_users_lname]."</b> zatwierdził datę w podzadaniu: <b>".$row2[$db_subtask_name]."</b>";
                        break;
                case 8: $sql = "SELECT $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname, $db_subtask_tab.$db_subtask_name "
                        . "FROM $db_subtask_tab INNER JOIN $db_users_tab ON $db_subtask_tab.$db_subtask_userid=$db_users_tab.$db_users_id "
                        . "WHERE $db_subtask_id=$row[$db_nots_user_subtaskid]";
                        $result2 = $connection->query($sql);
                        $row2 = $result2->fetch_assoc();
                        $text = "Użytkownik <b>".$row2[$db_users_fname]." ".$row2[$db_users_lname]."</b> zakończył swoje podzadanie: <b>".$row2[$db_subtask_name]."</b>";
                        break;
            }
            //nazwa subtasku (type z przedziału 4-5)
            if ($row[$db_notifications_type] == 4 || $row[$db_notifications_type] == 5){
                $sql_subtaskname = "SELECT $db_subtask_name FROM $db_subtask_tab WHERE $db_subtask_id = $row[$db_nots_user_subtaskid]";
                $result_subtaskname = $connection->query($sql_subtaskname);
                $row_name = $result_subtaskname->fetch_assoc();
                $text = $text."<b>".$row_name[$db_subtask_name]."</b> w zadaniu: ";
                }
            //naswa tasku
            if($row[$db_notifications_type] <= 5){
                $sql_taskname = "SELECT $db_task_name FROM $db_task_tab WHERE $db_task_id = $row[$db_nots_user_taskid]";
                $result_taskname = $connection->query($sql_taskname);
                $row_name = $result_taskname->fetch_assoc();
                $text = $text."<b>".$row_name[$db_task_name]."</b>";
                }
            if ($row[$db_nots_user_readnots]==0){
                echo "<div class='teamtask-form'>";
                echo "<p class='team-taskform'>";
                echo "<input class='checkboxu' type='checkbox' name='not[]' id='not' value='$row[$db_nots_user_id]'>   <a  href='javascript:change_read($row[$db_nots_user_id],$row[$db_nots_user_subtaskid], $row[$db_nots_user_taskid], $row[$db_notifications_type])' style='color:black; text-decoration: none'><i>$row[$db_notifications_date]</i>".'    '." $text</a><input id='$row[$db_nots_user_id]' type='color' style='float:right' class='color' value='#ff0000'>".'<br><br>';
                echo "</p>";
                echo "</div>";
            }else {
                if ($row[$db_notifications_type] >= 6){
                    $url = "team_tasks.php";
                }
                else{
                    $url = "tasks_all.php?sid=$row[$db_nots_user_subtaskid]&tid=$row[$db_nots_user_taskid]";
                }
                echo "<p class='team-taskform' style='background-color: $row[$db_nots_user_color]'>";
                echo "<input class='checkboxr' type='checkbox' name='not[]' id='not' value='$row[$db_nots_user_id]'><a href=\"$url\" style='color:black; text-decoration: none'><i>$row[$db_notifications_date]</i>".'    '." $text</a><input id='$row[$db_nots_user_id]' type='color' style='float:right' class='color' value='#ff0000'>".'<br><br>'; 
                echo "</p>";
                }
        }             
        echo '</div>';
    }



?>
     </form>
                                 
    </d
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    
   
</body>
</html>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/changeChecked.js"></script>
<script type="text/javascript" src="js/change_readnots.js"></script>
<script type="text/javascript" src="js/notifications.js"></script>
<script type="text/javascript" src="js/list.js"></script>
