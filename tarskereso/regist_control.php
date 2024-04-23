
<?php
include_once("dao.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);
    $birthdate = $_POST['birthdate'];

    $date = new DateTime($birthdate);
    $diff = $date->diff(new DateTime());
    $years = $diff->y;
    if (strlen($username) > 35) {
        $_SESSION['error'] = "A felhasználónév túl hosszú!";
        header("Location: registsite.php");
        exit();
    }
    elseif (strlen($password) < 8){
        $_SESSION['error'] = "A jelszónak legalább 8 karakter hosszúnak kell lennie!";
        header("Location: registsite.php");
        exit();
    }
    elseif ($password!=$password2){
        $_SESSION['error'] = "A két megadott jelszó nem egyezik meg";
        header("Location: registsite.php");
        exit();
    }
    elseif ($years<18){
        $_SESSION['error'] ="A platformot csak 18 éven felüliek használhatják!";
        header("Location: registsite.php");
        exit();
    }
    elseif (find_user_by_username($username)==="already"){
        $_SESSION['error'] ="Ez a felhasználónév már foglalt!";
        header("Location: registsite.php");
        exit();
    }
    elseif (find_user_by_email($email)==="already"){
        $_SESSION['error'] ="Ez a E-mail már foglalt!";
        header("Location: registsite.php");
        exit();
    }
    elseif (insert_user($username, $email, $password, $birthdate)==true){
        $_SESSION['success'] ="Sikeres regisztráció!";
        header("Location: registsite.php");
        exit();
    }
    else{
        $_SESSION['error'] ="Kiszolgáló hiba miatt a szolgáltatás nem elérhető!";
        header("Location: registsite.php");
        exit();
    }


}



?>
