
<?php
include_once("dao.php");
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if(find_user_by_username_and_password($username, $password)==="notfound"){
        $_SESSION['error'] ="hibás felhasználónév vagy jelszó";
        header("Location: loginsite.php");
        exit();
    }
    elseif(find_user_by_username_and_password($username, $password)==="exits"){
        $authorization=get_user_authorization_by_user_username($username);
        if($authorization['TILTOTT']==1){
            $_SESSION['error'] ="A felhasználó ki van tiltva a platformról";
            header("Location: loginsite.php");
            exit();

        }
        $_SESSION['admin']=$authorization['ADMIN'];
        $_SESSION['moderator']=$authorization['MODERATOR'];
        $_SESSION['loggedin']="true";
        $_SESSION['user_id']=get_user_id_by_username($username);
        $_SESSION['username']=$username;
        $_SESSION['felhasznalo_kep']="";
        $_SESSION['telepules']="telepules";
        $_SESSION['munkaterulet']="munkaterulet";
        $_SESSION['hobbi']="hobbi";
        $_SESSION['bemutatkozas']="bemutatkozas";
        $_SESSION['felhasznalo_kep']=get_user_picture_by_username($username);
        header("Location: loginsite.php");
        exit();
    }
    else{
        $_SESSION['error'] ="Kiszolgáló hiba miatt a szolgáltatás nem elérhető!";
        header("Location: loginsite.php");
        exit();
    }



}
