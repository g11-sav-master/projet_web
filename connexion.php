<?php session_start();
    $db = pg_connect("host=localhost dbname=postgres user=projet password=projet  ")
    or die('Connexion impossible : ' . pg_last_error());
    $query = 'SELECT login,mot_passe FROM utilisateur';
    $resp = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    $resp = pg_fetch_array($resp, 0, PGSQL_NUM);
    if ($_POST["login"] == $resp[0] && $_POST["motdepasse"] == $resp[1]) {
        $_SESSION["login"] = $_POST["login"];
        echo "vous êtes connecté en tant que " . $_SESSION["login"];
        header("location:index.php?action=profil");
    } else {
        echo "erreur de connexion";
        header("location:index.php");
    }
