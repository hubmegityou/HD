<?php
    session_start();

    if(!isset($_SESSION['online']) || !$_SESSION['online']){
        header('Location: index.php');
        exit();
    }
    
     If(isset($_SESSION['alert']) && $_SESSION['alert']!=''){      
         echo "<script type=\"text/javascript\">window.onload = function(){alert('".$_SESSION['alert']."')}</script>";  
         $_SESSION['alert']='';
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
    font-size: 16px;"><div class="circle" id="circle"></div> <a href="nots.php" class="btn btn-danger square-btn-adjust">Powiadomienia</a>
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
                        <a href="old_tasks.php" ><i "></i>Zamknięte zadania</a>
                    </li>
                   <?php 
                   
                   If ($_SESSION['function']=="2" ){
                      echo '<li>
                        <a  href="add_tasks.php"><i "></i> Dodaj zadanie</a>
                    </li>';
                      echo '<li><a href="add_subtasks.php"><i "></i> Dodaj podzadanie</a>
                    </li>';
                       echo '<li><a href="team_tasks.php"><i "></i> Zadania grupy</a>
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
                     <h2></h2> 
                       </div>
                     </div>
                 <hr />
               
                     <?php  
                    require_once "database/dbinfo.php";
                    require_once "objects.php";
                    $connection = db_connection();
                    if ($connection != false){
                            echo "<div class='subtask-form'>";
                            $tid= $_GET['tid'];    
                            $sid= $_GET['sid'];
                            $sql = "SELECT $db_subtask_taskid, $db_subtask_name, $db_subtask_sdate, $db_subtask_edate, $db_subtask_description FROM $db_subtask_tab WHERE $db_subtask_id=$sid";
                            $result = $connection->query($sql);
                            while($row = $result->fetch_assoc()){
                                $sql = "SELECT $db_subtask_tab.$db_subtask_id, $db_task_tab.$db_task_name, $db_task_tab.$db_task_description, $db_task_tab.$db_task_sdate, $db_task_tab.$db_task_edate, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_subtask_tab, $db_task_tab LEFT JOIN $db_users_tab ON $db_task_tab.$db_task_userid = $db_users_tab.$db_users_id WHERE $db_task_tab.$db_task_id =".$row[$db_subtask_taskid];
                                $result2 = $connection->query($sql);
                                $row2=$result2->fetch_assoc();
                                echo "<div style='float:left; width:57%; margin-left:10px'>";
                                echo "<br>Nazwa zadania głównego: $row2[$db_task_name] <br>";
                                echo "Manager: $row2[$db_users_fname] $row2[$db_users_lname]<br>";
                                echo "Data rozpoczęcia: $row2[$db_task_sdate] <br>";
                                echo "Data zakończenia: $row2[$db_task_edate]<br>";
                                echo "Opis: <br>$row2[$db_task_description]<br>"; 
                                echo "<br><br><br>";
                                echo "Nazwa podzadania: $row[$db_subtask_name]<br><br>";
                                echo "<form action='add_date.php' method='post'>";
                                $sdate= $row[$db_subtask_sdate];
                                $edate= $row[$db_subtask_edate];
                                echo "Termin rozpoczęcia: <input type='date' id='calendar' value= $sdate name='stime'/><br><br>";
                                echo "<input type='hidden' name='myTID' value=$tid>";
                                echo "<input type='hidden' name='mySID' value=$sid>";
                                echo "Termin wykonania: <input type='date' id='calendar2' value=$edate name='etime'/><br><br>";
                                echo "Opis zadania: <br> $row[$db_subtask_description]<br><br>";
                                echo "<br /><button type='submit'>Zatwierdź datę</button>";
                                echo "</form>";
                                echo '</div>';
                                // $connection->close();
                            }
                    }
    echo "<br>ZAŁĄCZNIKI!!!<br><br>";

        $sql = "SELECT $db_attachment_size, $db_attachment_name, $db_attachment_id FROM $db_attachment_tab WHERE $db_attachment_taskid = '$tid'";
        $result = $connection->query($sql);
        while ($row = $result->fetch_assoc()){
            echo "<div style=\"float: left\"><a href=\"download.php/?id=$row[$db_attachment_id]&sid=$sid&tid=$tid\">".substr($row[$db_attachment_name], 17)."</a>\t";
            $attachsize = $row[$db_attachment_size];
            if ($attachsize >= 1073741824) {
                $attachsize = (round($attachsize / 1073741824 * 100) / 100) . "gb";
            } elseif ($attachsize >= 1048576) {
                $attachsize = (round($attachsize / 1048576 * 100) / 100) . "mb";
            } elseif ($attachsize >= 1024) {
                $attachsize = (round($attachsize / 1024 * 100) / 100) . "kb";
            } else {
                $attachsize = $attachsize . "b";
            }
            echo "($attachsize)</div>";
            //usuwanie załączników (admin lub manager)
            if ($_SESSION['function'] <= 2){
                echo "<form action=\"delete_ac.php\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"tid\" value=$tid>";
                echo "<input type=\"hidden\" name=\"sid\" value=$sid>";
                echo "<input type=\"hidden\" name=\"id\" value=$row[$db_attachment_id]>";
                echo "<input type=\"hidden\" name=\"fname\" value=$row[$db_attachment_name]>";
                echo "<div style='position: relative; top: -6px'><input type=\"image\" src=\"template/assets/img/trash.png\" onClick=\"this.form.submit()\"></div>";
                echo "</form>";
            }
        }
        //dodawanie załączników
        echo "<form enctype=\"multipart/form-data\" action=\"attach.php\" method=\"post\">";
        echo "<p>Załącz plik: <br /><input type=\"file\" size=\"32\" name=\"attachment\" value=\"\"/><p/>";
        echo "<input type='hidden' name='mySID' value=$sid>";
        echo "<input type='hidden' name='myTID' value=$tid>";
        echo "<button type=\"submit\">Wyślij</button></center>";
        echo "</form>";
        
    echo "<div style='clear:both'></div>";
    echo '<div style="margin-left:10px">';
    echo "<br><br><br><br><br><br><br>KOMENTARZE!!!!<br><br>";
               
        $sql= "select $db_messages_tab.$db_messages_id, $db_messages_tab.$db_messages_date, $db_messages_tab.$db_messages_text, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_messages_tab LEFT JOIN $db_users_tab ON $db_messages_tab.$db_messages_userid= $db_users_tab.$db_users_id WHERE $db_messages_taskid=$tid ";
        $result = $connection->query($sql);

        while($row = $result->fetch_assoc()){       
            echo "<div style=\"float: left\">Użytkownik: $row[$db_users_fname]  $row[$db_users_lname],  $row[$db_messages_date]</div>";
            //usuwanie komentarzy (admin lub manager)
            if ($_SESSION['function'] <= 2){
                echo "<form action=\"delete_ac.php\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"tid\" value=$tid>";
                echo "<input type=\"hidden\" name=\"sid\" value=$sid>";
                echo "<input type=\"hidden\" name=\"id\" value=$row[$db_messages_id]>";
                echo "<div style='position: relative; top: -6px'><input type=\"image\" src=\"template/assets/img/trash.png\" onClick=\"this.form.submit()\"></div>";
                echo "</form>";
            }
            else echo "<br>";
            echo $row[$db_messages_text];
            echo "<br><br>";
        }
        echo "<form action='add_comment.php' method='post'>";
        echo "<textarea name='comment' id='trescp' rows='6' style='width:50%'></textarea><br><br>";
        echo "<input type='hidden' name='mySID' value=$sid>";
        echo "<input type='hidden' name='myTID' value=$tid>";
        echo "<br /><button type='submit'>Dodaj komentarz</button></form>";
        echo "<br><br></div>";
        echo"</div>";
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
<script type="text/javascript" src="js/datefield.js"></script>
<script type="text/javascript" src="js/datefield2.js"></script>
<script type="text/javascript" src="js/notifications.js"></script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

