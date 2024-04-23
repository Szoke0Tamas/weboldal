<?php
include_once("dao.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userID= htmlspecialchars($_SESSION['user_id']);
    $username = htmlspecialchars($_POST['usernameOther']);
    $content = htmlspecialchars($_POST['tartalom']);
    $indok = htmlspecialchars($_POST['indok']);

    if (strlen($content) == 0){
        $_SESSION['error'] = "A tartalom nem lehet üres!";
        header("Location: jelenetesFelvetel.php");
        exit();
    }
    else if (strlen($indok) > 20){
        $_SESSION['error'] = "Az indok nem lehet 20 szónál több és nem lehet üres!";
        header("Location: jelenetesFelvetel.php");
        exit();
    }
    else if (strlen($content) > 200){
        $_SESSION['error'] = "A tartalom nem lehet 200 szónál több!";
        header("Location: jelenetesFelvetel.php");
        exit();
    }
    else if (!find_user_by_username($username)){
        $_SESSION['error'] ="Ez a felhasználónév nem létezik!";
        header("Location: jelenetesFelvetel.php");
        exit();
    }
    else if(insert_report_recording($userID, $username, $indok, $content)==true){
        $_SESSION['success'] ="Sikeres jelentés felvétel!";
        header("Location: jelenetesFelvetel.php");
        exit();
    }
    else{
        header("Location: jelenetesFelvetel.php");
        exit();
    }


}



?>
