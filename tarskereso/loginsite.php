<?php
session_start();

if(isset($_SESSION['loggedin'])){
header("Location:FoOldal.php");
exit();
}

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="border">
<div class="img2"></div>
<div class="container">
    <form action="login_control.php" method="post">
        <h2>Bejelentkezés</h2>
        <div id="error" >
        <?php
            if (isset($_SESSION['error'])) {
                echo "<p>". $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            }
        ?>
        </div>
        <input type="text" name="username" placeholder="Felhasználónév" required><br>
        <input type="password" name="password" placeholder="Jelszó" required><br>
        <button type="submit">Bejelentkezés</button>
    </form>
    <div>
    <p>"Az emberek törékenysége olyan, mint a finom porcelán: könnyen megrepedhet, de ha óvatosan bánunk vele, csodálatos szépséget sugároz."</p>
        <a href="registsite.php">Regisztráció</a>
    </div>
    <img class="hrt" src="Image/heart.png" alt="" style="height:95px;width:95px;">


</div>
</div>
</body>
</html>
