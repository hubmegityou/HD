<?php

	session_start();
	
	if ($_SESSION['function']!=1) //function := 1 ==> admin
	{
		header('Location: main.php');
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>HD - dodawanie użytkownika</title>
</head>

<body>
	<form action="add.php" method="post">
		
		Imię: <br /> <input type="text" name="fname" /> <br />
		Nazwisko: <br /> <input type="text" name="lname" /> <br />
		Adres email: <br /> <input type="email" name="email" /> <br />
		Funkcja: <br />
				<select name="function">
				<option>admin</option>
				<option>manager<ation>
				<option>grafik<ation>
				<option>pracownik<ation>
				<br />
				</select><br />
		Login: <br /> <input type="text" name="login" /> <br />
		Hasło: <br /> <input type="password" name="pass" /> <br />	<?php if(isset($_SESSION['error']))	echo $_SESSION['error']; ?>
		<br /><input type="submit" value="Dodaj" />
				
	</form>
</body>
</html>