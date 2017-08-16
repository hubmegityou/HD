<?php

    session_start();

    if ($_SESSION['function']!=1) //function := 1 ==> admin
    {
            header('Location: main.php');
            exit();
    }
    
    if(isset($_SESSION['alert'])){      
        echo "<script type=\"text/javascript\">window.onload = function(){alert('".$_SESSION['alert']."')}</script>";
        unset($_SESSION['alert']);
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
    font-size: 16px;"> <div class="circle" id="circle"> </div><a href="nots.php" class="btn btn-danger square-btn-adjust">Powiadomienia</a>
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
                        <a  href="old_tasks.php" ><i "></i>Zamknięte zadania</a>
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
                        <a class="active-menu" href="add_user.php"><i "></i> Dodaj użytkownika</a>
                    </li>';    
                   }
                   
                   
                   ?>
                    <li>
                        <a  href="edit_profile.php" ><i "></i>Edytuj profil</a>
                    </li>
                    	
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Dodaj użytkownika</h2> 
                       </div>
                     </div>
                 <hr />
                     <div class="subtask-form">
                     <form action="addu.php" method="post">
                         <center>
		
                         <div class="stemat"><p class="left">Imię: <br> <input type="text" name="fname" required/></p></div>
                         <div class="stemat"><p class="left">Nazwisko: <br> <input type="text" name="lname" required/></p></div>
                         <div class="stemat"><p class="left">Login: <br> <input type="text" name="login" required/></p></div>
                         <div class="stemat"><p class="left">Adres email: <br> <input type="email" name="email" required/></p></div>
                         <div class="stemat"><p class="left">Hasło: <br> <input type="password" name="pass1" required /></p></div>
                         <div class="stemat"><p class="left">Powtórz hasło: <br> <input type="password" name="pass2" required /></p><br></div>
                         <div class="stemat"><p class="left">Funkcja: <br>
                        <select name="function" required>
				<option value="1">admin</option>
				<option value="2">manager</option>
				<option value="3">grafik</option>
				<option value="4">wykonawca</option>
                                <option value="5">montażysta</option>
                                <br />
			</select></p></div>
                        <div><p class="left"><br><button type="submit">Dodaj</button></p></div>
                            <div style="clear:both"></div>
                            <br><br><br>
                        </center> 
                        
                </form>
                 

    </div>

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

<script type="text/javascript" src="js/notifications.js"></script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
