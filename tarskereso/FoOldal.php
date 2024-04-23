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
    <title>Regisztráció</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
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
    <a href="profil.php">Profil</a>
    <a href="logout.php">Kijelentkezés</a><br><hr>
    <div class="cont">
        <?php
        echo "<h1>"."Üdvözöllek " .$_SESSION['username']."</h1>"
        ?>
        <p>Ha ez az első belépésed vagy még nem olvastad el akkor kérlek szány időt arra, hogy elolvasod a részletes szabályzatát az oldalnak.</p>
        <h4>Ha már elolvastad akkor nyugodtan mehetsz a böngészésre, de ha csak ki akarod hagyni akkor figyelmeztetlek, hogy a szabályzat nem tudása nem lehet kifogás és az sem hogy nem találod.&#128521</h4>
        <h4>Kezdjünk is hozzá:</h4>
        <h4>Felhasználási feltételek:</h4>
        <ol>
            <li>
                A társkereső használatával elfogadod és beleegyezel a jelen szabályzat minden pontjába, ha valamelyik pont nem felel meg neked a profil menűpont alatt tudod törölni fiókodat.
            </li>
            <li>
                A honlapot kizárólag 18 éven felüli felhasználók vehetik igénybe, így ha te nem vagy annyi és csak bekamuztad akkor kérlek légy empatikus azokkal az oldalon lévő személyekkel akik komolyan veszik az oldalt és így is töltötték ki adataikat és kérlek a profil menűpont alatt töröld fiókodat.
            </li>
            <li>
            A társkereső honlap célja a komoly kapcsolatok kialakítása, ezért a hamis profilok létrehozása, vagy az oldal más felhasználóinak zaklatása tilos.
            </li>
        </ol>
        <h4>Profil létrehozása:</h4>
        <ol>
            <li>
                Az általad létrehozott profilnak valós és pontos információkat kell tartalmaznia kérlek tiszteld meg ezzel a többi felhasználót.
            </li>
            <li>
                Obszcén vagy mások személyiségi jogait sértő tartalmak tilosak mind bejegyzésként mind profilkép ként és mind bemutatkozásként.
            </li>
            <li>
            Tilos más felhasználók profiljainak illetéktelen felhasználása vagy azok adatainak bármilyen módon való felhasználása.
            </li>
        </ol>
        <h4>Kommunikáció:</h4>
        <ol>
            <li>
            A kommunikáció során tisztelettudó és udvarias hangnemet kell fenntartani.
            </li>
            <li>
            A zaklatás, trágár vagy bántó kifejezések használata nem megengedett, és az ilyen viselkedés blokkoláshoz vagy kitiltáshoz vezethet.
            </li>
            <li>
            Kérlek, jelezzd az adminisztrátoroknak azokat a felhasználókat, akikkel szemben bármilyen jogsértő vagy kellemetlen viselkedést tapasztalsz.
            </li>
        </ol>
        <h4>Felelősség korlátozása:</h4>
        <ol>
            <li>
            Fenntartjuk a jogot, hogy a felhasználói fiókokat tiltjuk vagy korlátozzuk, ha jogsértést vagy szabálytalanságot tapasztalunk.
            </li>
        </ol>
        <br>
        <p>Ha eddig eljutottál és ténylegesen el is olvastad a szabályzatot akkor köszönöm, hogy fordítottál erre időt.&#128521</p><br>
        Üdvözlettel: Az egyik adminisztrátor.
    </div>
    <br>
</nav>
</div>
</div>
</div>
</body>
</html>