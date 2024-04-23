<?php
session_start();
if(!isset($_SESSION['loggedin'])){
header("Location:beginsite.php");
exit();
}
require_once('dao.php');
$notifications = get_notifications(get_logged_in_user_id($_SESSION['username']),);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Értesítések</title>
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
    <a href="logout.php">Kijelentkezés</a><br><hr>
            <ul>
                <li><a href="kapcsolatok.php">Kapcsolatok</a></li><br>
				<li><a href="profil.php">Profil</a></li><br>
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
    <div class="note">
    <h2>Értesítések</h2>
    <hr>
              <?php
                if ($notifications) {
                    foreach ($notifications as $notification) {
                        echo '<div class="notifications2">';
                        echo '<p class="name">' . $notification["NAME"] . '</p>';
                        echo '<p class="type">' . $notification["TYPE"] . '</p>';
						if($notification["TYPE"]=="jeloles"){
						echo '<form action="accept.php" method="post">';
                        echo '<input type="hidden" name="notid" value="' . $notification["NOTID"] . '">';
						echo '<input type="hidden" name="kit" value="' . $notification["KIT"] . '">';
						echo '<input type="hidden" name="ki" value="' . $notification["KI"] . '">';
                        echo '<button type="submit" style="margin-top: -5%;">Elfogadás</button>';
                        echo '</form>';
                        echo '<form action="reject.php" method="post">';
                        echo '<input type="hidden" name="notid" value="' . $notification["NOTID"] . '">';
						echo '<input type="hidden" name="kit" value="' . $notification["KIT"] . '">';
						echo '<input type="hidden" name="ki" value="' . $notification["KI"] . '">';
                        echo '<button type="submit" style="margin-top: -5%;">Elutasítás</button>';
                        echo '</form>';
                        echo '</div>';}else{
    echo '<form  action="kapcsolatprofil.php" method="post">';
    echo '<input hidden type="number" name="aktid" value="' . $notification["KI"] . '" required><br>';
    echo '<button type="submit">Megtekintés</button>';
    echo '</form>';
						}
                    }
                } else {
                    echo '<p>Nincs új értesítés.</p>';
                }
                ?>
    
</div>
            </div>
</div>
</div>
</body>
</html>
