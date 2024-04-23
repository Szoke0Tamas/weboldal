<?php
session_start();
if(!isset($_SESSION['loggedin'])){
header("Location:beginsite.php");
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
                <li><a href="ertesitesek.php">Értesítések</a></li><br>
				<li><a href="profil.php">Profil</a></li>
            </ul>
        </nav>
    </div>
</div>
</div>
</header>
<div class="border">
        <div class="border2">
<div class="container">
    <h2>Bejegyzések</h2>
    <div class="posts">
        <?php
        $results = bejegyzes_query();

        if (isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];
        
            deleteBRecord($delete_id);
        
            $results = bejegyzes_query();
        }

        if (isset($_POST['bejegyzes_kepmodositas'])) {
            $username=htmlspecialchars($_SESSION['ID']);
            $kep = $_POST['bejegyzes_kepmodositas'];
            if(isset($_FILES['file'])){
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    $allowed_mime_type_arr = array('image/jpeg','image/png');
                    $mime = mime_content_type($_FILES['file']['tmp_name']);
                    if(array_search($mime, $allowed_mime_type_arr)){
                        $filename = $_FILES["file"]["name"];
                        $tempname = $_FILES["file"]["tmp_name"];
                        $folder = "Image/".$filename;
                        update_user_bejegyzespicture($username,$filename,$tempname,$folder);
                        $kep=get_bejegyzes_picture_by_username($username);
                        unset($_FILES['file']);
                        $_SESSION['success'] ="Sikeres kép módosítás!";
                        header("Location: bejegyzesek.php");
                        exit();
                    }
                        $_SESSION['error'] ="Csak képek tölthetőek fel!";
                        header("Location: bejegyzesek.php");
                        exit();
                }
                    $_SESSION['error'] ="Hiba történt a kép feltöltése során!";
                    header("Location: bejegyzesek.php");
                    exit();
            }
                $_SESSION['error'] ="Nincs file kiválasztva!";
                header("Location: bejegyzesek.php");
                exit();
        }

    foreach ($results as $key => $profil) {
        if($profil['FELHASZNALO_ID'] === $_SESSION['user_id']){
            echo '<div class="profils3">';
            echo '<img src="'.$profil["KEPEK"].'">';
            echo '<h3 class="name">' . $profil["CIM"] . '</h3>';
            echo '<p class="statusz">' . $profil['LEIRAS']->load() . '</p>';
            echo '<p class="jog">' . $profil["DATUM"] . '</p><br>';
            echo '<hr>';
            echo '<h4>Módosítás</h4>';
            echo '
            <form action="update_post.php" method="post" enctype="multipart/form-data">
            <input class="bejelentett" type="text" name="cim" placeholder="Cím" required ><br>
            <textarea name="leiras" rows="10" cols="50" placeholder="Írj egy új bejegyzést..."></textarea><br>
            <button type="submit" name="submit">Módosítás</button>
            </form>';
            echo '<form method="post" enctype="multipart/form-data">
            <strong><label for="file">Kép feltöltése/módosítása</label></strong><br>
            <input type="file" name="file" accept="image/png, image/jpeg" required><br>
            <button name="bejegyzes_kepmodositas" type="submit" value="' . $profil['KEPEK'] . '">Kép feltöltése</button>
            </form>';
            echo '<form method="post"><input type="hidden" name="delete_id" value="' . $profil['ID'] . '"><button type="submit">Törlés</button></form>';
            echo '</div>';
        }
        }
        ?>
    </div>
    <div class="new_post">
        <h3>Új bejegyzés létrehozása</h3>
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
        <form action="create_post.php" method="post" enctype="multipart/form-data">
            <input class="bejelentett" type="text" name="cim" placeholder="Cím" required ><br>
            <textarea name="leiras" rows="10" cols="50" placeholder="Írj egy új bejegyzést..."></textarea><br>
            <button type="submit" name="submit">Feltöltés</button>
        </form>
    </div>
</div>
</div>
</div>
</body>
</html>
