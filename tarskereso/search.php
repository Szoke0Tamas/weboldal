<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: beginsite.php");
    exit();
}

require_once('dao.php');
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilok</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="border">
    <div class="border2">
        <div class="container">
            <nav style="height:60px;">
                <br>
                <a href="jelenetesFelvetel.php">Jelentés Felvétele</a>
                <?php
                if($_SESSION['admin']==1 || $_SESSION['moderator']==1){
                echo'<a href="jelenteskezeles.php">Jelentések Kezelése</a>
                <a href="profilKezeles.php">Profilok Kezelése</a>';
                }
                ?>
                <a href="profil.php">Profil</a>
                <a href="logout.php">Kijelentkezés</a><br>
            </nav>
        </div>
    </div>
</div>
<div class="border">
    <div class="border2">
        <div class="container">
            <div class="profils">
            <h2>Profilok</h2>
            <hr>
                <?php
$users = get_all_users($_SESSION['username']);

if ($users) {
    foreach ($users as $user) {
        $userId = $user['ID'];
        $username = $user['FELHASZNALONEV'];

        if (!is_user_connected(get_logged_in_user_id($_SESSION['username']) , $userId)) {
            echo '<div class="profile">';
            echo '<img src="profile_image.jpg" alt="Profilkép">';
            echo '<p class="userNev">' . $username . '</p>';
            echo '<form action="kapcsolatprofil.php" method="post">';
            echo '<input type="hidden" name="aktid" value="' . $userId . '" required>';
            echo '<button type="submit">Megtekintés</button>';
            echo '</form>';
            echo '<form action="add.php" method="post">';
            echo '<input type="hidden" name="bejelol" value="' . $userId . '" required>';
            echo '<button type="submit" name="bejeloles">Bejelölés</button>';
            echo '</form>';
            echo '</div>';
        }
    }
} else {
    echo '<p>Nincs elérhető felhasználó.</p>';
}
?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
