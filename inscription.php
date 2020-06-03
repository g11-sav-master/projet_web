<?php
$db = pg_connect("host=localhost dbname=postgres user=projet password=projet  ")
or die('Connexion impossible : ' . pg_last_error());
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$logC = $_POST["mailC"];
$passC = generateRandomString();
$logE = $_POST["mailE"];
$passE = generateRandomString();

//création des utilisateurs
print_r($_POST);
if (isset($_POST["nomE"]) && isset($_POST["nomC"])) {
    $query = "INSERT INTO projet.utilisateur (nom,prenom,e_mail,num_tel,date_naissance,login,mot_passe) 
            VALUES ('" . $_POST["nomC"] . "','" . $_POST["prenomC"] . "','" . $_POST["mailC"] . "','" . $_POST["telC"] . "','" . $_POST["dateC"] . "','" . $logC . "','" . $passC . "'),
            ('" . $_POST["nomE"] . "','" . $_POST["prenomE"] . "','" . $_POST["mailE"] . "','" . $_POST["telE"] . "','" . $_POST["dateE"] . "','" . $logE . "','" . $passE . "') ;
            SELECT id_utilisateur FROM projet.utilisateur WHERE (nom='" . $_POST["nomC"] . "' AND prenom='" . $_POST["prenomC"] . "') OR (nom='" . $_POST["nomE"] . "' and prenom='" . $_POST["prenomE"] . "') 
            ORDER BY id_utilisateur DESC;";
    $resp = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    $ids = pg_fetch_all($resp);
    $cap = (int)($ids[0]['id_utilisateur']); //id capitaine
    $eqi = (int)($ids[1]['id_utilisateur']); //id équipier
//création des participants
    $query2 = "INSERT INTO projet.participant (id_utilisateur) VALUES (" . $cap . "),(" . $eqi . ");";
    $resp = pg_query($query2) or die('Échec de la requête : ' . pg_last_error());
//création de la participation
    $query3 = "INSERT INTO projet.participant_duo (id_categorie,id_raid,nbr_repas,paiement_valide) VALUES (" . $_POST["categorie"] . "," . $_POST["raid"] . "," . $_POST["nbrepas"] . ",false); 
                SELECT id_part_duo FROM projet.participant_duo ORDER BY id_part_duo DESC;";
    $part = pg_query($query3);
    $part = pg_fetch_array($part);
    $queryV = "INSERT INTO projet.validation_medicale (id_utilisateur,est_valide,date_expiration) 
                VALUES (".$cap.",false,".date("'Y-m-d'")." ),(".$eqi.',false,'.date("'Y-m-d'").')';
   // print_r($queryV);
    $valid = pg_query($queryV);
//ajout des membres de l'équipe
    $query4 = "INSERT INTO projet.forme_duo VALUES (" . $part[0] . "," . $cap . ",TRUE),(" . $part[0] . "," . $eqi . ", FALSE);";
    $resp4 = pg_query($query4) or die('Échec de la requête : ' . pg_last_error());
    header("location:index.php");
}
if (!(isset($_POST["nomE"]))){
    $query = "INSERT INTO projet.utilisateur (nom,prenom,e_mail,num_tel,date_naissance,login,mot_passe) 
            VALUES ('" . $_POST["nomC"] . "','" . $_POST["prenomC"] . "','" . $_POST["mailC"] . "','" . $_POST["telC"] . "','" . $_POST["dateC"] . "','" . $logC . "','" . $passC . "') ;
            SELECT id_utilisateur FROM projet.utilisateur WHERE (nom='" . $_POST["nomC"] . "' AND prenom='" . $_POST["prenomC"] . "')
            ORDER BY id_utilisateur DESC;";
    $resp = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    $ids = pg_fetch_all($resp);
    $cap = (int)($ids[0]['id_utilisateur']); //id capitaine
//création des participants
    $query2 = "INSERT INTO projet.participant (id_utilisateur) VALUES (" . $cap . ");";
    $resp = pg_query($query2) or die('Échec de la requête : ' . pg_last_error());
//création de la participation
    $query3 = "INSERT INTO projet.participant_duo (id_categorie,id_raid,nbr_repas,paiement_valide) VALUES (" . $_POST["categorie"] . "," . $_POST["raid"] . "," . $_POST["nbrepas"] . ",false); 
                SELECT id_part_duo FROM projet.participant_duo ORDER BY id_part_duo DESC;";
    $part = pg_query($query3);
    $part = pg_fetch_array($part);
//ajout des membres de l'équipe
    $query4 = "INSERT INTO projet.forme_duo VALUES (" . $part[0] . "," . $cap . ",TRUE);";
    $resp4 = pg_query($query4) or die('Échec de la requête : ' . pg_last_error());
    header("location:index.php");
}
else {
    echo "<p> Une erreur s'est produite, veuillez réessayer.</p>";
}

/** requêtes de réccupération des mots de passes:
 *SELECT login, mot_passe, utilisateur.id_utilisateur,forme_duo.id_utilisateur,forme_duo.id_part_duo,participant_duo.id_part_duo
FROM projet.utilisateur
INNER JOIN projet.forme_duo ON utilisateur.id_utilisateur=forme_duo.id_utilisateur
INNER JOIN projet.participant_duo ON forme_duo.id_part_duo=participant_duo.id_part_duo;
 */
