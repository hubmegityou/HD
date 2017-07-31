<?php
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
                     <h2>............</h2> 
                       </div>
                     </div>
                 <hr />
                 <br>
                 <br>
                 <br>
                     <?php  
                    require_once "dbinfo.php";
                    require_once "objects.php";
                    $connection = db_connection();
                    if ($connection != false){
                            $tid= filter_input(INPUT_GET, 'tid', FILTER_VALIDATE_INT);    
                            $sid= filter_input(INPUT_GET, 'sid', FILTER_VALIDATE_INT);
                            $sql = "SELECT $db_subtask_taskid, $db_subtask_name, $db_subtask_sdate, $db_subtask_edate, $db_subtask_description FROM $db_subtask_tab WHERE $db_subtask_id=$sid";
                            $result = $connection->query($sql);
                            while($row = $result->fetch_assoc()){
                                $sql = "SELECT $db_subtask_tab.$db_subtask_id, $db_task_tab.$db_task_name, $db_task_tab.$db_task_description, $db_task_tab.$db_task_sdate, $db_task_tab.$db_task_edate, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_subtask_tab, $db_task_tab LEFT JOIN $db_users_tab ON $db_task_tab.$db_task_userid = $db_users_tab.$db_users_id WHERE $db_task_tab.$db_task_id =".$row[$db_subtask_taskid];
                                $result2 = $connection->query($sql);
                                $row2=$result2->fetch_assoc();
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
                                echo "Termin rozpoczęcia: <input type='date' value= $sdate name='stime'/><br><br>";
                                echo "<input type='hidden' name='myTID' value=$tid>";
                                echo "<input type='hidden' name='mySID' value=$sid>";
                                echo "Termin wykonania: <input type='date' value=$edate name='etime'/><br><br>";
                                echo "Opis zadania: <br> $row[$db_subtask_description]<br><br>";
                                echo "<br /><button type='submit'>Zatwierdź date</button>";
                                echo "</form>";
                                // $connection->close();
                            }
                    }
    echo "<br><br>ZAŁĄCZNIKI!!!<br><br>";
//wyświetlanie załączników
/*
    require_once "dbinfo.php"
    require_once "objects.php";
    $connection = db_connection();
    if ($connection != false){
        $tid= filter_input(INPUT_GET, 'tid', FILTER_VALIDATE_INT);    
        $id= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
 */
        $sql = "SELECT $db_attachment_size, $db_attachment_name, $db_attachment_id FROM $db_attachment_tab WHERE $db_attachment_taskid = '$tid'";
        $result = $connection->query($sql);
        while ($row = $result->fetch_assoc()){
            echo "<a href=\"download.php/?id=".$row[$db_attachment_id]."\">".substr($row[$db_attachment_name], 17)."</a>\t";
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
            echo "($attachsize)<br>";
        }
//dodawanie załączników
        echo "<form enctype=\"multipart/form-data\" action=\"attach.php\" method=\"post\" id=\"formularz\">";
        echo "<p>Załącz plik: <br /><input type=\"file\" size=\"32\" name=\"attachment\" value=\"\"/><p/>";
        echo "<input type='hidden' name='mySID' value=$sid>";
        echo "<input type='hidden' name='myTID' value=$tid>";
        echo "<button type=\"submit\">Wyślij</button></center>";
        echo "</form>";
        
    
    echo "<br><br><br>KOMENTARZE!!!!<br><br>";
                /*
    require_once "dbinfo.php";
    require_once "objects.php";
    $connection = db_connection();
    if ($connection != false){
               */
        $sql= "select $db_messages_tab.$db_messages_date, $db_messages_tab.$db_messages_text, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_messages_tab LEFT JOIN $db_users_tab ON $db_messages_tab.$db_messages_userid= $db_users_tab.$db_users_id WHERE $db_messages_taskid=$tid ";
        $result = $connection->query($sql);

        while($row = $result->fetch_assoc()){       
            echo "Użytkownik: $row[$db_users_fname]  $row[$db_users_lname],  $row[$db_messages_date]<br>";
            echo $row[$db_messages_text];
            echo "<br><br>";
        }
        echo "<form action='add_comment.php' method='post'>";
        echo "<textarea name='comment' id='trescp' rows='6' style='width:50%'></textarea><br><br>";
        echo "<input type='hidden' name='mySID' value=$sid>";
        echo "<input type='hidden' name='myTID' value=$tid>";
        echo "<br /><button type='submit'>Dodaj komentarz</button></form>";

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


<script>
			var NotifcationsTest = {
				VerifyBrowserSupport: function() {
					return ("Notification" in window);
				},
				ShowNotification: function(){
					var notification = new Notification("Witaj świecie!");
				},
				RequestForPermissionAndShow: function(){
					// Mamy prawo wyświetlać powiadomienia
					if (Notification.permission === "granted") {
						NotifcationsTest.ShowNotification();
					}
					// Brak wsparcia w Chrome dla właściwości permission
					else if (Notification.permission !== "denied") {
						Notification.requestPermission(function (permission) {
							// Dodajemy właściwość permission do obiektu Notification
							if(!("permission" in Notification)) {
								Notification.permission = permission;
							}
							if (permission === "granted") {
								NotifcationsTest.ShowNotification();
							}
						});
					}
				}
			}
			window.onload = function(){
					if(!NotifcationsTest.VerifyBrowserSupport()){
						alert("Brak wsparcia dla Notifications API");				
					}
					NotifcationsTest.RequestForPermissionAndShow();	
			};
			
		</script>