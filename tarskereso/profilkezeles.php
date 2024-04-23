<?php
session_start();
if(!isset($_SESSION['loggedin'])){
header("Location:beginsite.php");
exit();
}
if($_SESSION['admin']!=1 && $_SESSION['moderator']!=1){
header("Location:FoOldal.php");
exit();
}
include_once("dao.php");
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilok kezelése</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<header>
    <div class="border">
        <div class="border2">
    <div class="container">
        <nav style="height:60px;">
        <br>
    <a href="search.php">Böngészés</a>
    <a href="jelenetesFelvetel.php">Jelentés Felvétele</a>
    <a href="jelenteskezeles.php">Jelentések Kezelése</a>
    <a href="profil.php">Profil</a>
    <a href="logout.php">Kijelentkezés</a>
    <br>
        </nav>
    </div>
</div>
</div>
</header>
<div class="border">
        <div class="border2">
<div class="container">
    <div class="notifications">
    <h2>Profilok</h2>
    <hr>
        <?php
        $results = profilkezeles_query();

        if (isset($_POST['vissza_id'])) {
            $vissza_id = $_POST['vissza_id'];
        
            visszaRecord($vissza_id);
        
            $results = profilkezeles_query();
        }else if (isset($_POST['visszatilt_id'])) {
            $visszatilt_id = $_POST['visszatilt_id'];
        
            visszatiltRecord($visszatilt_id);
        
            $results = profilkezeles_query();
        }else if (isset($_POST['tilt_id'])) {
            $tilt_id = $_POST['tilt_id'];
        
            tiltRecord($tilt_id);
        
            $results = profilkezeles_query();
        }else if (isset($_POST['felfuggesztes_id'])) {
            $felfuggesztes_id = $_POST['felfuggesztes_id'];
        
            felfuggesztesRecord($felfuggesztes_id);
        
            $results = profilkezeles_query();
        }

        foreach ($results as $key => $profil) {
            echo '<div class="profils" style="margin:5%;">';
            echo '<p class="name" style="margin-top:2%;">' . $profil["FELHASZNALONEV"] . '</p>';
            if($profil['MODERATOR']==1){
                echo '<p class="jog">Moderátor</p>';
            }else if($profil['ADMIN']==1){
                echo '<p class="jog">Admin</p>';
            }else{
                echo '<p class="jog">Tag</p>';
            }

            if($profil['FELFUGGESZTETT']==1){
                echo '<p class="statusz">Felfüggesztett</p>';
                echo '<form method="post"><input type="hidden" name="vissza_id" value="' . $profil['ID'] . '"><button style="margin-top: -6%; margin-left:50%; display: flow-root;" type="submit">Felfüggesztés visszavonása</button></form>';
                echo '<form method="post"><input type="hidden" name="tilt_id" value="' . $profil['ID'] . '"><button style="margin-top: -8.5%; margin-left:75%; display: flow-root;" type="submit">Tiltás</button></form>';
            }else if($profil['TILTOTT']==1){
                echo '<p class="statusz">Tiltott</p>';
                echo '<form method="post"><input type="hidden" name="visszatilt_id" value="' . $profil['ID'] . '"><button style="margin-top: -6%; margin-left:50%; display: flow-root;" type="submit">Tiltás visszavonása</button></form>';
            }else{
                echo '<p class="statusz">-</p>';
                echo '<form method="post"><input type="hidden" name="felfuggesztes_id" value="' . $profil['ID'] . '"><button style="margin-top: -6%; margin-left:50%; display: flow-root;" type="submit">Felfüggesztés</button></form>';
                echo '<form method="post"><input type="hidden" name="tilt_id" value="' . $profil['ID'] . '"><button style="margin-top: -8.5%; margin-left:75%; display: flow-root;" type="submit">Tiltás</button></form>';
            }
            echo '</div>';
        }
        ?>
    </div>
</div>
</div>
</div>
</body>
</html>
