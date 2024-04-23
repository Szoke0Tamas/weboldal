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
    <title>Bejegyzések</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<header>
    <div class="border">
        <div class="border2">
    <div class="container">
        <nav style="height: 60px">
        <br>
    <a href="search.php">Böngészés</a>
    <a href="jelenetesFelvetel.php">Jelentés Felvétele</a>
    <a href="profilKezeles.php">Profilok Kezelése</a>
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
    <h2>Jelentések</h2>
    <hr>
        <?php
        $results = jelentes_query();

        if (isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];
        
            deleteRecord($delete_id);
        
            $results = jelentes_query();
        }        

        // TODO
        foreach ($results as $key => $profil) {
            echo '<div class="reports">';
            echo '<h3 class="name">Jelentő: ' . $profil["FELHASZNALONEV"] . '</h3>';
            echo '<h3 class="name">Jelentett: ' . $profil["KIRE"] . '</h3>';
            echo '<p class="jog"> Ok: ' . $profil["INDOK"] . '</p>';
            echo '<p class="statusz">Leírás: ' . $profil["LEIRAS"]->load() . '</p>';
            echo '<form method="post"><input type="hidden" name="delete_id" value="' . $profil['ID'] . '"><button type="submit">Törlés</button></form>';
            echo '</div>';
        }
        ?>
    </div>
</div>
</div>
</div>
</body>
</html>
