<?php
include_once("dao.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['emailmodositas'])) {
        $username=htmlspecialchars($_SESSION['username']);
        $email = htmlspecialchars($_POST['email']);
        $newemail = htmlspecialchars($_POST['email2']);

        if(find_user_by_username_and_email($username,$email)==="notfound"){
           $_SESSION['error'] ="Hibás Email-t adott meg!";
           header("Location: profil.php");
           exit();
        }
        if(find_user_by_username_and_email($username,$email)==="exits"){
            if(update_user_email($username,$newemail)==="success"){
               $_SESSION['success'] ="Sikeres Email módosítás";
               header("Location: profil.php");
               exit();
            }
            $_SESSION['error'] ="Hiba történt az Email módosítása során!";
            header("Location: profil.php");
            exit();
        }

    }

    if (isset($_POST['jelszomodositas'])) {
        $username=htmlspecialchars($_SESSION['username']);
        $password = htmlspecialchars($_POST['password']);
        $newpassword = htmlspecialchars($_POST['password2']);
        if(find_user_by_username_and_password($username,$password)==="notfound"){
           $_SESSION['error'] ="Hibás jelszót adott meg!";
           header("Location: profil.php");
           exit();
        }
        if(find_user_by_username_and_password($username,$password)==="exits"){
            if(strlen($newpassword)<8){
               $_SESSION['error'] ="Az új jelszónak minimum 8 karakter hosszúnak kell lennie!";
               header("Location: profil.php");
               exit();
            }
            if(update_user_password($username,$newpassword)==="success"){
               $_SESSION['success'] ="Sikeres jelszó módosítás";
               header("Location: profil.php");
               exit();
            }
            $_SESSION['error'] ="Hiba történt a jelszó módosítása során!";
            header("Location: profil.php");
            exit();

        }
    }

    if (isset($_POST['felhasznalo_kepmodositas'])) {
        $username=htmlspecialchars($_SESSION['username']);
        if(isset($_FILES['file'])){
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                $allowed_mime_type_arr = array('image/jpeg','image/png');
                $mime = mime_content_type($_FILES['file']['tmp_name']);
                if(in_array($mime, $allowed_mime_type_arr)){
                    $filename = $_FILES["file"]["name"];
                    $tempname = $_FILES["file"]["tmp_name"];
                    $folder = "image/".$filename;
                    update_user_profilepicture($username,$filename,$tempname,$folder);
                    $_SESSION['felhasznalo_kep']=get_user_picture_by_username($username);
                    unset($_FILES['file']);
                    $_SESSION['success'] ="Sikeres profilkép módosítás!";
                    header("Location: profil.php");
                    exit();
                }
                    $_SESSION['error'] ="Csak képek tölthetőek fel!";
                    header("Location: profil.php");
                    exit();
            }
                $_SESSION['error'] ="Hiba történt a kép feltöltése során!";
                header("Location: profil.php");
                exit();
        }
            $_SESSION['error'] ="Nincs file kiválasztva!";
            header("Location: profil.php");
            exit();
    }

    if (isset($_POST['adatmodositas'])) {
            $username=$_SESSION['username'];
            $city = htmlspecialchars($_POST['city']);
            $job = htmlspecialchars($_POST['job']);
            $hobby = htmlspecialchars($_POST['hobby']);
            $bio = htmlspecialchars($_POST['bio']);

            if(update_user_plusdata($username,$city,$job,$hobby,$bio)==="success"){
               $_SESSION['success'] ="Sikeres adat módosítás!";
               $_SESSION['telepules']=$city;
               $_SESSION['munkaterulet']=$job;
               $_SESSION['hobbi']=$hobby;
               $_SESSION['bemutatkozas']=$bio;
               header("Location: profil.php");
               exit();
            }
            $_SESSION['error'] ="Hiba történt az adatok módosítása során!";
            header("Location: profil.php");
            exit();
    }

    if (isset($_POST['fioktorles'])) {
        $username=htmlspecialchars($_SESSION['username']);
        $formusername=htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        if($username!=$formusername){
           $_SESSION['error'] ="Hibás felhasználónevet adott meg!";
           header("Location: profil.php");
           exit();
        }
        if($username==$formusername){
            if(find_user_by_3_maindata($username,$email,$password)==="exits"){
                if(delete_user_by_username($username)==="success"){
                    session_unset();
                    session_destroy();
                    header("Location: beginsite.php");
                    exit();
                }
                $_SESSION['error'] ="Hiba történt a fiók törlése során!";
                header("Location: profil.php");
                exit();
            }
            $_SESSION['error'] ="Hibás adatokat adott meg!";
            header("Location: profil.php");
            exit();
        }
    }
}

?>


