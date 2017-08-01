<?php  

/*
 * DO POPRAWY
 *  - HASHOWANIE HASEŁ (done)
 *  - WYŚWIETLANIE BŁĘDU DLA PUSTYCH DANYCH
 *  - POŁĄCZENIE Z BAZĄ DANYCH (!!!)
 */

	session_start();

	if ((!isset($_POST['fname'])) || (!isset($_POST['lname'])) || (!isset($_POST['login'])) || (!isset($_POST['pass'])))
	{
		header('Location: add_user.php');
		exit();
	}
	
	//$_SESSION['error'] = '<span style="color:red">Uzupełnij wszystkie pola</span>';
	
	require_once "database/dbinfo.php";
        require_once "objects.php";
        $connection = db_connection();
        if ($connection != false){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$function = $_POST['function'];
		$login = $_POST['login'];
		$password = $_POST['pass'];
		
                $hash_pass = md5($password);

		$sql = "SELECT * FROM $db_functions_tab WHERE $db_functions_desc=$function";
		$result = $connection->query($sql);
		$row = $result->fetch_array();
		$result->free_result();
		$id = $row[$db_functions_id];
		echo $id."test";
                
		$sql = "INSERT INTO $db_users_tab ($db_users_id, $db_users_fname, $db_users_lname, $db_users_email, $db_users_login, $db_users_pass, $db_users_function) VALUES (NULL,$fname,$lname,$email,$login,$hash_pass,$id)";

		if ($connection->query($sql)){
                    echo "dodano";
		}
	}

	$connection->close();
	//header ('Location: main.php');
?>