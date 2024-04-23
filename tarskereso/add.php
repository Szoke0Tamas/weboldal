<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: beginsite.php");
    exit();
}

require_once('dao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bejelol'])) {
    $bejelol = $_POST['bejelol'];
    add_connection(get_logged_in_user_id($_SESSION['username']), $bejelol);
    header("Location: search.php");
    exit();
}
?>
