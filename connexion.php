<?php session_start();
    $db = pg_connect("host=localhost dbname=postgres user=projet password=projet  ")
    or die('Connexion impossible : ' . pg_last_error());
    $query = "SELECT login,mot_passe,id_utilisateur FROM utilisateur WHERE login='".$_POST['login']."' AND mot_passe ='".$_POST['motdepasse']."' ;";
    $resp = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    $resp = pg_fetch_array($resp);
$_SESSION["idPart"] = $resp[2];
if ($_POST["login"] == $resp[0] && $_POST["motdepasse"] == $resp[1]) {
        $_SESSION["login"] = $_POST["login"];
        header("location:index.php?action=profil");
    } else {
        echo "erreur de connexion";
        header("location:index.php");
    }
