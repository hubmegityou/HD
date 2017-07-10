<?php

	session_start();
	
	if(!isset($_SESSION['online']) || !$_SESSION['online'])
	{
		header('Location: index.php');
		exit();
	}
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>HD - strona główna</title>
</head>

<body>
<?php

	require_once "dbinfo.php";
	/*$a = 'online';
	if (isset($_SESSION[$a]))
		echo "działa";
	*/
	echo "strona główna, zalogowano pomyślnie użytkownika "."<b>".$_SESSION['fname']." ".$_SESSION['lname']."<b />";
	echo "<br /><br />";
	echo '<a href="logout.php">Wyloguj</a>';
	
?>
</body>