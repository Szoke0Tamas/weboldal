<?php
session_start();
if(!isset($_SESSION['loggedin'])){
header("Location:beginsite.php");
exit();
}
require_once('dao.php'); 
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
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
                <li><a href="kapcsolatok.php">Kapcsolatok</a></li><br>
                <li><a href="ertesitesek.php">Értesítések</a></li><br>
				<li><a href="bejegyzesek.php">Bejegyzések</a></li>
            </ul>
        </nav>
    </div>
</div>
</div>
</header>

<div class="border">
<div class="container" style="margin:1%">
    <div class="profile-info">
<?php
$_SESSION['akt']=$_POST['aktid'];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['aktid'])) {
    $userData = get_user_data_by_id($_POST['aktid']); 

    if ($userData) {
        $username = $userData['FELHASZNALONEV'];
        $email = $userData['EMAIL'];
        $telepules = $userData['TELEPULES'];
        $munkaterulet = $userData['MUNKATERULET'];
        echo '<h2>' . $username . ' profilja</h2>';
        echo '<hr>';
        echo '<p><h4>Felhasználónév: </h4>' . $username . '</p>';
        echo '<p><h4>Email cím: </h4>' . $email . '</p>';
        echo '<p><h4>Település: </h4>' . $telepules . '</p>';
        echo '<p><h4>Munkaterület: </h4>' . $munkaterulet . '</p>';
		if(is_frind(get_logged_in_user_id($_SESSION['username']), $_SESSION['akt'])){
		echo '<form action="delete_conn.php" method="post">';
        echo '<input type="hidden" name="aktid" value="' . $_SESSION['akt'] . '">';
        echo '<button type="submit" name="delete_conn" style="margin-top:0%; margin-bottom: 2%;">Ismerős törlése</button>';
        echo '</form>';
		echo '<form action="uzenet.php" method="post">';
        echo '<input type="hidden" name="aktid" value="' . $_SESSION['akt'] . '">';
        echo '<button type="submit" name="send_message" style="margin-top: -5%; margin-bottom: 2%;">Üzenet küldése</button>';
        echo '</form>';
		}else{
			echo '<form action="add.php" method="post">';
            echo '<input type="hidden" name="bejelol" value="' .$_SESSION['akt']. '" required>';
            echo '<button type="submit" name="bejeloles" style="margin-top: -5%;" margin-bottom: 2%;>Bejelölés</button>';
            echo '</form>';
		}

    } else {
        echo '<p>Hiba: A felhasználó adatainak betöltése sikertelen.</p>';
    }
} 
?>
</div>
<br>
<div class="profile_bejegyzes">
    <?php
        $results = bejegyzes_query();
        if($results){
        foreach ($results as $key => $profil) {
            if($profil['FELHASZNALO_ID'] === $_POST['aktid']){
                echo '<div class="profils2">';
                echo '<img src="'.$profil["KEPEK"].'">';
                echo '<h3 class="name">' . $profil["CIM"] . '</h3><br><br>';
                echo '<p class="statusz">' . $profil['LEIRAS']->load() . '</p><br>';
                echo '<p class="jog">' . $profil["DATUM"] . '</p><br>';
                echo '<br>';
                echo '</div>';
            }
        }
        }
    ?>
</div>
</div>
</div>
</body>
</html>
