<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: loginsite.php");
    exit;
}
require_once('dao.php');
$_SESSION['userid']=get_logged_in_user_id($_SESSION['username']);

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felhasználó kapcsolatai</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<header>
    <div class="border">
        <div class="border2">
    <div class="container">
        <nav>
            <br>
        <a href="search.php">Böngészés</a>
    <a href="jelenetesFelvetel.php">Jelentés Felvétele</a>
    <?php
    if($_SESSION['admin']==1 || $_SESSION['moderator']==1){
    echo'<a href="jelenteskezeles.php">Jelentések Kezelése</a>
    <a href="profilKezeles.php">Profilok Kezelése</a>';
    }
    ?>
    <a href="logout.php">Kijelentkezés</a><br>
            <hr>
            <ul>
                <li><a href="profil.php">Profil</a></li><br>
                <li><a href="ertesitesek.php">Értesítések</a></li><br>
				<li><a href="bejegyzesek.php">Bejegyzések</a></li>
            </ul>
        </nav>
    </div>
    </div>
    </div>
</header>
<div class="border">
    <div class="border2">
<div class="container">
    <div class="contacts">
    <h2>Kapcsolataim</h2>
    <hr>
        <?php
        $connected_usernames = get_user_connections($_SESSION['userid']);
foreach ($connected_usernames as $user) {
    echo '<div class="contact">';
    echo '<h4>' . $user["username"] . '</h4>';
    echo '<form  action="kapcsolatprofil.php" method="post">';
    echo '<input hidden type="number" name="aktid" value="' . $user["id"] . '" required><br>';
    echo '<button type="submit" style="margin-top: -5%;">Megtekintés</button>';
    echo '</form>';
    echo '</div>';
}
        ?>
    </div>
</div>
    </div>
    </div>
</body>
</html>
