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

	require_once "connect.php";
	require_once "dbinfo.php";
	$connection = new mysqli($host, $db_user, $db_pass, $db_name);
	
	echo "strona główna, zalogowano pomyślnie użytkownika "."<b>".$_SESSION['fname']." ".$_SESSION['lname']."<b />";
	echo "<br />jako ";
		$number = $_SESSION['function'];
		$sql = "SELECT * FROM $db_functions_tab WHERE $db_functions_id=$number";
		$result = $connection->query($sql);
		$row = $result->fetch_assoc();
		echo "$row[$db_functions_desc]";
	
	echo "<br /><br />";
	echo '<a href="logout.php">Wyloguj</a>';

	$connection->close();
?>
</body>