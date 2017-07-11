<?php

	session_start();
	
	if ($_SESSION['function']!=1)
	{
		header('Location: main.php');
		exit();
	}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>HD - dodawanie zadania</title>
</head>

<body>
DODAWANIE NOWEGO ZADANIA <br />
 <form action="addt.php" method="post">
<?php
    require_once "connect.php";
    require_once "dbinfo.php";
    $connection = mysqli_connect($host, $db_user, $db_pass, $db_name);

    $sql = "SELECT $db_users_fname, $db_users_lname FROM $db_users_tab ORDER BY $db_users_lname ASC";
    $result = $connection->query($sql);
        echo '<select name="fname">';
        echo '<option value="">Wybierz osobę</option>';
        while($row = $result->fetch_assoc()) {
        echo '<option value="'.$row[$db_users_fname].'">'.$row[$db_users_fname].'</option>';
        }
        echo '</select>';
?>
        <br />Temat zadania: <input type="text"/>
        <br />Treść zadania: <input type="text"/>
        <br />Termin wykonania: <input type="date"/>
        <br /><input type="submit" value="Stwórz" />
</form>

</body>
</html>
