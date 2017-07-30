<?php

    session_start();

    if((!isset($_SESSION['online']) || !$_SESSION['online']) /*&& $_SESSION['function'] == 2 */ ) //function := 2 ==> manager
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
                        <a  href="main.php" ><i "></i> Strona główna</a>
                    </li>
                    
                    <li>
                        <a  href="tasks.php" ><i "></i> Moje aktywne zadania</a>
                    </li>			
	 
                  <li>
                        <a  href="old_tasks.php" ><i "></i>Zamknięte zadania</a>
                    </li>
                   <?php 
                   
                   If ($_SESSION['function']=="2" ){
                      echo '<li>
                        <a class="active-menu" href="add_tasks.php"><i "></i> Dodaj zadanie</a>
                    </li>';  
                      
                     echo ' <li><a href="add_subtasks.php"><i "></i> Dodaj podzadanie</a>
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
                        <h2>Dodaj zadanie</h2> 
                    </div>
                </div>
                 <hr />
        <div class="subtask-form">
        <center>
        <br />
<form enctype="multipart/form-data" action="addt.php" method="post" id="formularz">
        <div class="stemat"><p class="tematt">Temat zadania: <br /><input type="text" name="topic" class="stematp" required/></p></div>
        <div class="stemat"><p class="termint"> Priorytet:
            <input type="radio" name="priority" value="1"/> tak 
            <input type="radio" name="priority" value="0" checked/> nie </p></div>
        <div class="termin"><p class="termint">Termin rozpoczęcia: <input type="date" name="stime" class="terminp" required/></p></div>
        <div class="termin"><p class="termint">Termin wykonania: <input type="date" name="etime" class="terminp" required/></p></div>
        <div class="stresc"><p class="tresct">Treść zadania: <br /><textarea name="description" id="trescp" rows="6" style="width:88%" required></textarea></p></div>
        <div class="stresc"><p class="tresct">Załącz plik: <br /><input type="file" size="32" name="attachment" value=""/><p/><div/>
                <div class="stresc"><button type="submit">Dodaj</button></center><div/>
</form>
                 <br>
                 <br>
             <!-- #f5f5f6 kolor tła guzika -->        
        </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    
   
</body>
</html>
