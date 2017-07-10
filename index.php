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
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Help Desk - projekt</title>
</head>

<body>
	
	<form action="login.php" method="post">
	
		Login: <br /> <input type="text" name="login" /> <br />
		Hasło: <br /> <input type="password" name="pass" /> <br /><br />
		<input type="submit" value="Zaloguj się" />
				
	</form>
	
<?php
	if(isset($_SESSION['error']))	echo $_SESSION['error'];
?>

</body>
</html>