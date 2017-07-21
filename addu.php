<?php  
/*
 * DO POPRAWY
 *  - HASHOWANIE HASEŁ (done)
 *  - WYŚWIETLANIE BŁĘDU DLA PUSTYCH DANYCH LUB ISTNIEJĄCEGO USERA
 *  - POŁĄCZENIE Z BAZĄ DANYCH (done)
 * zmiana testowa
 */

session_start();

    if ((!isset($_POST['fname'])) || (!isset($_POST['lname'])) || (!isset($_POST['login'])) || (!isset($_POST['pass']))){
        header('Location: add_user.php');
        exit();
    }

//$_SESSION['error'] = '<span style="color:red">Uzupełnij wszystkie pola</span>';

    require_once "dbinfo.php";
    require_once "connect.php";

    $connection = new mysqli($host, $db_user, $db_pass, $db_name);

    if ($connection->connect_errno!=0){
            echo "Error: ".$connection->connect_errno;
    }
    else{
        $connection -> query ('SET NAMES utf8');
        $connection -> query ('SET CHARACTER_SET utf8_unicode_ci');
        $login = $_POST['login'];
        $sql = "SELECT COUNT($db_users_id) AS 'ile' FROM $db_users_tab WHERE $db_users_login='$login'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        if ($row['ile'] > 0){
            //info o istniejącym userze
            header('Location: add_user.php');
        }
        
        $fname = ucwords($_POST['fname']);
        $lname = ucwords($_POST['lname']);
        $email = $_POST['email'];
        $function = $_POST['function'];
        $password = $_POST['pass'];
        echo $fname[0];
        $hash_pass = md5($password);

        $sql = "SELECT * FROM $db_functions_tab WHERE $db_functions_desc='$function'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $result->free_result();
        $id = $row[$db_functions_id];

        $sql = "INSERT INTO $db_users_tab ($db_users_id,$db_users_fname,$db_users_lname,$db_users_email,$db_users_login,$db_users_pass,$db_users_function) VALUES (NULL,'$fname','$lname','$email','$login','$hash_pass',$id)";
        if ($connection->query($sql)){
            // info: dodano poprawnie
        }
    }

    $connection->close();
    //header ('Location: main.php');

?>