<?php
session_start();
if(!isset($_SESSION['loggedin'])){
header("Location:beginsite.php");
exit();
}
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
<div class="container" style="margin:1%;">
    <h2>Profil</h2>
    <hr>
    <?php
    echo'<img src="Image/'.$_SESSION['felhasznalo_kep'].'" alt="felhasználókép" style=" width:10vw; height:18vh">'
    ?>
    <div class="profile-info">
    <form action="profil_control.php" method="post">
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
    <input type="email" name="email" placeholder="régi email" required>
    <input type="email" name="email2" placeholder="új email" required>
    <button name="emailmodositas" type="submit">Email módosítás</button>
    </form>
    <form action="profil_control.php" method="post">
    <input type="password" name="password" placeholder="régi jelszó" required>
    <input tpye="passowrd" name="password2" placeholder="új jelszó" required>
    <button name="jelszomodositas" type="submit">Jelszó módosítás</button>
    </form>
    <form action="profil_control.php" method="post" enctype="multipart/form-data">
    <strong><label for="file">Porfilkép feltöltése</label></strong>
    <input type="file" name="file" accept="image/png, image/jpeg" required>
    <button name="felhasznalo_kepmodositas" type="submit">Proiflkép módosítás</button>
    </form>
    <?php
     echo'<form action="profil_control.php" method="post">
    <input type="text" name="city" placeholder="'.$_SESSION['telepules'].'">
    <input type="text" name="job" placeholder="'.$_SESSION['munkaterulet'].'">
    <input type="text" name="hobby" placeholder="'.$_SESSION['hobbi'].'"><br>
    <textarea name="bio" placeholder="'.$_SESSION['bemutatkozas'].'"></textarea>
    <button name="adatmodositas" type="submit">Adatmódosítás</button>
    </form>';
    ?>
    </form>
    <form action="profil_control.php" method="post">
    <input type="text" name="username" placeholder="Felhasználónév" required>
    <input tpye="email" name="email" placeholder="Email" required>
    <input tpye="passowrd" name="password" placeholder="Jelszó" required>
    <button name="fioktorles" type="submit">Fiók törlése</button>
    </form>

</div>
</div>
</body>
</html>
