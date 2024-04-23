<?php //módosítva
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: beginsite.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['notid']) && isset($_POST['ki']) &&isset($_POST['kit'])) {
    $notid = $_POST['notid'];
	    $ki = $_POST['ki'];
		    $kit = $_POST['kit'];

    require_once('dao.php');
    $success = accept_connection($notid, $ki, $kit);
    if ($success) {
      
        header("Location: ertesitesek.php");
        exit();
    } else {
      
        echo "Hiba történt az elfogadás során.";
    }
}
?>
