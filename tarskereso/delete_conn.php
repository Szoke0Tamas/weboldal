<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: beginsite.php");
    exit();
}

require_once('dao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['aktid'])) {
    if (delete_connection($_SESSION['userid'], $_POST['aktid'])) {
        header("Location: profil.php");
        exit();
    } else {
        echo '<p>Hiba történt az ismerős törlése során.</p>';
    }
} 
?>
