<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: beginsite.php");
    exit();
}

require_once('dao.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tartalom']) && isset($_POST['uzi'])) {
    $result = send_message(get_logged_in_user_id($_SESSION['username']), $_POST['uzi'], $_POST['tartalom']);

    if ($result) {
       
        header("Location: uzenet.php"); 
        exit();
    } else {
        echo "Hiba történt az üzenet küldése közben.";
    }
}
?>
