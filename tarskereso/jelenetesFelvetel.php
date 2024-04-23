<?php
session_start();
if(!isset($_SESSION['loggedin'])){
header("Location:beginsite.php");
exit();
}
/*$_SESSION['error']="";
$_SESSION['success']="";*/
/*unset($_SESSION['error']);
unset($_SESSION['success']);*/
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelenetések felvétele</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<header>
    <div class="border">
        <div class="border2">
    <div class="container">
        <nav style="height: 60px;">
        <br>
    <a href="search.php">Böngészés</a>
    <?php
    if($_SESSION['admin']==1 || $_SESSION['moderator']==1){
    echo'<a href="jelenteskezeles.php">Jelentések Kezelése</a>
    <a href="profilKezeles.php">Profilok Kezelése</a>';
    }
    ?>
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
    <form action="jelentes_control.php" method="post" style="border:2px solid #dd2476; border-radius: 5px;">
        <h2>Jelentés felvétele</h2>
        <div id="error">
        <?php
            if (isset($_SESSION['error'])) {
                echo "<p>". $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            }
        ?>
        </div>
        <div id="success" >
        <?php
            if (isset($_SESSION['success'])) {
                echo "<p>". $_SESSION['success'] . "</p>";
                unset($_SESSION['success']);
            }
        ?>
        </div>
        <hr>
        <input class="bejelentett" type="text" name="usernameOther" placeholder="Bejelentett" required ><br>
        <input class="bejelentett" type="text" name="indok" placeholder="Indok" required ><br>
        <textarea class="bejelntes" name="tartalom" cols="30" rows="10" placeholder="Leírás"></textarea><br>
        <button class="elkuld" type="submit">Elküld</button>
    </form>
</div>
</div>
</div>
</body>
</html>
