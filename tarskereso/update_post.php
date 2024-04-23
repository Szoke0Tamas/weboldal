<?php
include_once("dao.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userID= htmlspecialchars($_SESSION['user_id']);
    $cim = htmlspecialchars($_POST['cim']);
    $leiras = htmlspecialchars($_POST['leiras']);

    if (strlen($cim) > 20){
        $_SESSION['error'] = "Az cim nem lehet 20 szónál több és nem lehet üres!";
        header("Location: bejegyzesek.php");
        exit();
    }
    else if (strlen($leiras) > 200){
        $_SESSION['error'] = "A leirás nem lehet 200 szónál több!";
        header("Location: bejegyzesek.php");
        exit();
    }
    else if(update_post($userID, $cim, $leiras)==true){
        $_SESSION['success'] ="Sikeres bejegyzés felvétel!";
        header("Location: bejegyzesek.php");
        exit();
    }
    else{
        $_SESSION['error'] ="Sikertelen vmi miatt felvétel!";
        header("Location: bejegyzesek.php");
        exit();
    }
}

?>
