<?php
session_start();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="style2.css">

</head>
<body>

    <div class="border">
<div class="img3"></div>

<div class="container">
    <form action="regist_control.php" method="post">
        <h2>Regisztráció</h2>
        <div id="error" >
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
        <input type="text" name="username" placeholder="Felhasználónév" required><br>
        <input type="email" name="email" placeholder="Email cím" required><br>
        <input type="password" name="password" placeholder="Jelszó" required><br>
        <input type="password" name="password2" placeholder="Jelszó megerősítése" required><br><br>
        <strong><label for="birthdate">Születési dátum</label></strong><br>
        <input type="date" name="birthdate"required><br>
        <br>
        <small>Kérlek valós adatokkal regisztrálj ezzel a többi felhasználót megtisztelve!</small><br>
        <button type="submit">Regisztráció</button>
    </form>
    <br>
    <a href="loginsite.php">Bejelentkezés</a>
</div>
</div>
</body>
</html>
