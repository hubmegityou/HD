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
    require_once "objects.php";
    $connection = db_connection();
    if ($connection != false){
        $login = $_POST['login'];
        $sql = "SELECT COUNT($db_users_id) AS 'ile' FROM $db_users_tab WHERE $db_users_login='$login'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        if ($row['ile'] > 0){
            
                 echo "<script type=\"text/javascript\">alert('Użytkownik już istnieje');</script>";
            
            header('Location: add_user.php');
            close();
        }
        
        $fname = ucwords($_POST['fname']);
        $lname = ucwords($_POST['lname']);
        $email = $_POST['email'];
        $function = $_POST['function'];
        $password = $_POST['pass'];
        $hash_pass = md5($password);

        $sql = "SELECT * FROM $db_functions_tab WHERE $db_functions_desc='$function'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $result->free_result();
        $id = $row[$db_functions_id];

        $sql = "INSERT INTO $db_users_tab ($db_users_id,$db_users_fname,$db_users_lname,$db_users_email,$db_users_login,$db_users_pass,$db_users_function) VALUES (NULL,'$fname','$lname','$email','$login','$hash_pass',$id)";
        if ($connection->query($sql)){
             echo "<script type=\"text/javascript\">alert('Dodawanie zakończone');</script>";
        }
    }
    $connection->close();
    header('Location: main.php');

?>