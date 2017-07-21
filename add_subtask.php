<?php

/*
 * 
 * DO POPRAWY
 *  - KOMUNIKATY O BŁĘDZIE
 * 
 */
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
	<title>HD - dodawanie podzadania</title>
</head>

<body>
DODAWANIE NOWEGO PODZADANIA <br />
 <form action="addsubt.php" method="post">
<?php
    require_once "connect.php";
    require_once "dbinfo.php";
    $connection = mysqli_connect($host, $db_user, $db_pass, $db_name);
    $connection -> query ('SET NAMES utf8');
    $connection -> query ('SET CHARACTER_SET utf8_unicode_ci');
    $sql = "SELECT $db_users_fname, $db_users_lname, $db_functions_desc FROM $db_users_tab INNER JOIN $db_functions_tab ON $db_users_function = $db_functions_id WHERE $db_users_function > 1 ORDER BY $db_users_function, $db_users_lname ASC";
    $result = $connection->query($sql);
        echo '<select name="name">';
        echo '<option value="">Wybierz osobę</option>';
        while($row = $result->fetch_assoc()) {
            $person = "$row[$db_users_fname] $row[$db_users_lname]";
            echo '<option value="'.$person.'">'.$row[$db_functions_desc].' '.$person.'</option>';
        }
        echo '</select>';
    echo "<br/><br/>";
    $id = $_SESSION['id'];
    $sql = "SELECT $db_task_id, $db_task_name, $db_task_edate, $db_task_userid FROM $db_task_tab WHERE $db_task_userid = $id";
    $result = $connection->query($sql);
        echo '<select name="task">';
        echo '<option value="">Wybiez zadanie</option>';
        while($row = $result->fetch_assoc()) {
            echo '<option value="'.$row[$db_task_id].' '.$row[$db_task_edate].'">'.$row[$db_task_name].'</option>';
        }
        echo '</select>';
    
    $connection->close();
?>
        <br />Temat podzadania: <input type="text" name="topic"/>
        <br />Treść podzadania: <input type="text" name="description"/>
        <br />Termin wykonania: <input type="date" name="time"/>
        <br /><input type="submit" value="Stwórz"/>
</form>

</body>
</html>
