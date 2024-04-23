<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: beginsite.php");
    exit();
}
require_once('dao.php');

$chats = get_chats(get_logged_in_user_id($_SESSION['username']), $_SESSION['akt']); 

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üzenet</title>
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
            <h2>Üzenetek</h2>
            <hr>
            <div class="beszelgetes">
                <?php
                if ($chats) {
                    foreach ($chats as $chat) {
                        echo '<div class="contact">';
						echo '<p>' . name($chat["ktol"]) . ':</p>';
                        echo '<p>' . $chat["tartalom"] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Nincsenek üzenetek.</p>';
                }
                ?>
            </div>
            <form action="send.php" method="post" style="border:2px solid #dd2476; border-radius: 5px;">
			 <?php echo '<input type="hidden" name="uzi" value="' .$_SESSION['akt']. '">';?>
                <textarea class="bejelntes" name="tartalom" cols="30" rows="10" placeholder="Írj üzenetet..."></textarea><br>
                <button class="elkuld" type="submit">Elküld</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
