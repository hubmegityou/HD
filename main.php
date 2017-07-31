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
   <!-- KALENDARZ -->
   <link rel='stylesheet' href='calendar/fullcalendar.css' />
	<script src='calendar/lib/jquery.min.js'></script>
	<script src='calendar/lib/moment.min.js'></script>
        <script src='calendar/fullcalendar.js'></script>
        <script src='calendar/locale/pl.js'></script>
   
        
      <script>
	$(document).ready(function() {
            var date= new Date();
        
		$('#calendar').fullCalendar({
                        height: 700,
			defaultDate: date,
			eventLimit: true,
			events: [ 
       //Z TYM COŚ TRZEBA ZROBIĆ!!!!!!!!!!
                          <?php 

                        require_once "dbinfo.php";
                        require_once "objects.php";
                        $connection = db_connection();
                        if ($connection != false){
                            $sql= "select $db_subtask_name, $db_subtask_sdate, $db_subtask_edate FROM $db_subtask_tab WHERE $db_subtask_done='0' AND $db_subtask_userid =". $_SESSION['id'];                        
                            $result = $connection->query($sql);
                            
                            while($row = $result->fetch_assoc()){
                                $row[$db_subtask_edate] = strtotime("$row[$db_subtask_edate] + 1 day");
                                $row[$db_subtask_edate] = date("Y-m-d", $row[$db_subtask_edate]);
                                $rows= "{ title: '".$row[$db_subtask_name]."', start: '".$row[$db_subtask_sdate]."', end: '".$row[$db_subtask_edate]."'},";    
                                echo $rows;}  
                        }
                        //else info o błędzie

                        while($row = $result->fetch_assoc()){
                        $row[$db_task_edate] = strtotime("$row[$db_task_edate] + 1 day");
                        $row[$db_task_edate] = date("Y-m-d", $row[$db_task_edate]);
                        $rows= "{ title: '".$row[$db_task_name]."', start: '".$row[$db_task_sdate]."', end: '".$row[$db_task_edate]."'},";    
                        echo $rows;
                         }
                         $connection->close();
?>  
			]
		});
		
	});
	</script>
        
<?php 
If($_SESSION['function']=="2" ){ ?>


  <script>
$(document).ready(function() {
    var date= new Date();

        $('#calendar2').fullCalendar({
                height: 700,
                defaultDate: date,
                eventLimit: true,
                events: [ 

                  <?php 
        //Z TYM TEŻ
                require_once "dbinfo.php";
                require_once "objects.php";
                $connection = db_connection();
                if ($connection != false){
                    $sql= "select $db_task_name, $db_task_sdate, $db_task_edate FROM $db_task_tab WHERE $db_task_done='0' AND $db_task_userid =". $_SESSION['id'];                        
                    $result = $connection->query($sql);

                    while($row = $result->fetch_assoc()){
                        $row[$db_task_edate] = strtotime("$row[$db_task_edate] + 1 day");
                        $row[$db_task_edate] = date("Y-m-d", $row[$db_task_edate]);
                        $rows= "{ title: '".$row[$db_task_name]."', start: '".$row[$db_task_sdate]."', end: '".$row[$db_task_edate]."'},";    
                        echo $rows;
                        }

                }
                $connection->close();
                ?>  
                ]
        });

});
              </script><?php } //WTF PO CO TO???? ?> 
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
    font-size: 16px;"> 
        <a href="logout.php" class="btn btn-danger square-btn-adjust">Wyloguj</a> 
    </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="template/assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
                    <li>
                        <a  class="active-menu" href="main.php" ><i "></i> Strona główna</a>
                    </li>
                    
                    <li>
                        <a  href="tasks.php" ><i "></i> Moje aktywne zadania</a>
                    </li>			
	 
                    <li>
                        <a href="old_tasks.php" ><i "></i>Zamknięte zadania</a>
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
                   }
                   
                     If ($_SESSION['function']=="1"){
                       echo '<li>
                        <a  href="add_user.php"><i "></i> Dodaj użytkownika</a>
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
                     <h2>Strona główna</h2> 
                       </div>
                     </div>
                 <hr /><?php
                       If($_SESSION['function']=="2" ){
                            echo "<br>";
                            echo "<h2>Zadania</h2>" ;
                            echo "<br><br><br>";
                            echo "<div id='calendar2'></div>";
                            } ?>
                 <br>
                 <br>
                 <br>
                 <br>
                     <h2>Podzadania</h2>
                     <br>
                     <br>      
                     <div id='calendar'></div>
                 <br>
                     
             
                 
                 
               
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