<?php

	session_start();
	
	if ((isset($_SESSION['online'])) && ($_SESSION['online']==true))
	{
		header('Location: main.php');
		exit();
	}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
<<<<<<< HEAD
	<meta charset="utf-8" />
	<title>Help Desk - projekt</title>
=======
	  <meta charset="UTF-8">
 
      <link rel="stylesheet" href="login/css/style.css">
  
>>>>>>> 614c6c28df6165aa667bafafecc8121937f39667
</head>

<body>
	
	<form action="login.php" method="post">
	
		<header>Login</header>
                
                <label>Username <span></span></label>
                <input type="text" name="login" />
                <label>Password <span></span></label>
                <input type="password" name="pass" />
                
                <button type="submit" class="button"/>Log In</button>

	</form>
	
<?php
	if(isset($_SESSION['error']))	echo $_SESSION['error'];
?>

</body>
</html>