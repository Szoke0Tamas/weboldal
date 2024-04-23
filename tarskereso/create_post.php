<?php
/*include_once("dao.php");
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
    else if(insert_post($userID, $cim, $leiras)==true){
        $_SESSION['success'] ="Sikeres bejegyzés felvétel!";
        header("Location: bejegyzesek.php");
        exit();
    }
    else{
        $_SESSION['error'] ="Sikertelen vmi miatt felvétel!";
        header("Location: bejegyzesek.php");
        exit();
    }


}*/

include_once("dao.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userID= htmlspecialchars($_SESSION['user_id']);
    $cim = htmlspecialchars($_POST['cim']);
    $leiras = htmlspecialchars($_POST['leiras']);

    if (strlen($cim) > 20 || empty($cim)){
        $_SESSION['error'] = "A cím maximum 20 karakter lehet és nem lehet üres!";
        header("Location: bejegyzesek.php");
        exit();
    }
    else if (strlen($leiras) > 200){
        $_SESSION['error'] = "A leírás maximum 200 karakter lehet!";
        header("Location: bejegyzesek.php");
        exit();
    }
    else if(insert_post($userID, $cim, $leiras)==true){
        $_SESSION['success'] ="Sikeres bejegyzés felvétel!";
        header("Location: bejegyzesek.php");
        exit();
    }
    else{
        $_SESSION['error'] ="Sikertelen bejegyzés felvétel valami miatt!";
        header("Location: bejegyzesek.php");
        exit();
    }
}

?>
