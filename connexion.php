<?php
$db= pg_connect("host=localhost dbname=postgres user=admin  ")
or die('Connexion impossible : ' . pg_last_error());
$query = 'SELECT Login,Password FROM utilisateur';
$resp = pg_query($query)  or die('Échec de la requête : ' . pg_last_error());
if ( $_POST["login"] == $resp["Login"] && $_POST["motdepasse"] == $resp["password"])
    {
        $_SESSION["login"]=$_POST["login"];
        header("location:index.php");
        echo "vous êtes connecté en tant que ".$_SESSION["login"];
    }
else{
    echo "erreur de connexion";
    header("location:index.php");
}
