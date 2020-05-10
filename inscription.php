<?php
$db = pg_connect("host=localhost dbname=postgres user=projet password=projet  ")
or die('Connexion impossible : ' . pg_last_error());
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$logC= generateRandomString();
$passC= generateRandomString();
//création des utilisateurs
    $query = "INSERT INTO projet.utilisateur (nom,prenom,e_mail,num_tel,date_naissance,login,mot_passe) 
            VALUES ('".$_POST["nomC"]."','".$_POST["prenomC"]."','".$_POST["mailC"]."','".$_POST["telC"]."','".$_POST["dateC"]."','".$logC."','".$passC."'),
            ('".$_POST["nomE"]."','".$_POST["prenomE"]."','".$_POST["mailE"]."','".$_POST["telE"]."','".$_POST["dateE"]."','".$logE."','".$passE."') ;
            /* réccupération des ids utilisateurs */
            SELECT id_utilisateur FROM projet.utilisateur WHERE (nom=".$_POST["nomC"]." AND prenom=".$_POST["prenomC"].") OR (nom=".$_POST["nomE"]." and prenom=".$_POST["prenomE"].");";
    $resp = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    $ids = pg_fetch_all($resp, PGSQL_NUM);
    $cap=$ids[0]; //id capitaine
    $eqi=$ids[1]; //id équipier
    //création des participants
    $query2 = "INSERT INTO projet.participant (id_utilisateur) VALUES (".$ids[0]."),(".$ids[1].");";
    $resp2 = pg_query($query2);
    //création de la participation
    $query3="INSERT INTO projet.participant_duo (id_categorie,id_raid,nbr_repas,paiement_valide) VALUES (0,0,2,false); 
                SELECT * FROM projet.participant_duo id_part_duo ORDER BY id_part_duo DESC;";
    $part=pg_query($query3);
    $part=pg_fetch_array($part);
    //ajout des membres de l'équipe
    $query4="INSERT INTO projet.forme_duo VALUES (".$part[0].",".$ids[0].",".TRUE."),(".$part[0].",".$ids[1].",".FALSE.");";
    $resp4 = pg_query($query4) or die('Échec de la requête : ' . pg_last_error());



    /**
INSERT INTO projet.participant VALUES (2,NULL),(1,NULL);
            SELECT * FROM public.utilisateur,public.participant WHERE utilisateur.id_utilisateur = participant.id_utilisateur; **/