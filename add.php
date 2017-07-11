<?php 

	session_start();

	if ((!isset($_POST['fname'])) || (!isset($_POST['lname'])) || (!isset($_POST['login'])) || (!isset($_POST['pass'])))
	{
		header('Location: add_user.php');
		exit();
	}
	
	//$_SESSION['error'] = '<span style="color:red">Uzupełnij wszystkie pola</span>';
	
	require_once "dbinfo.php";
	require_once "connect.php";

	$connection = new mysqli($host, $db_user, $db_pass, $db_name);

	if ($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
	else
	{
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$function = $_POST['function'];
		$login = $_POST['login'];
		$password = $_POST['pass'];
		/*
                $hash_pass = md5($password);
		echo $hash_pass;
                 */
		$sql = "SELECT * FROM $db_functions_tab WHERE $db_functions_desc=$function";
		$result = $connection->query($sql);
		$row = $result->fetch_assoc();
		$result->free_result();
		$id = $row[$db_functions_id];
		echo $id."test";
		$sql = "INSERT INTO $db_users_tab ($db_users_id, $db_users_fname, $db_users_lname, $db_users_email, $db_users_login, $db_users_pass, $db_users_function) VALUES (NULL,$fname,$lname,$email,$login,$hash_pass,$id)";

		if ($connection->query($sql))
		{
                    echo "dodano";
		}
	}

	$connection->close();
	//header ('Location: main.php');
?>