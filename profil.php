<?php
$db = pg_connect("host=localhost dbname=postgres user=projet password=projet  ")
or die('Connexion impossible : ' . pg_last_error());
$query2="SELECT nom,prenom,est_capitaine, est_valide, date_expiration, nom_categorie, nom_raid, paiement_valide
FROM projet.forme_duo
INNER JOIN projet.utilisateur ON forme_duo.id_utilisateur=utilisateur.id_utilisateur
INNER JOIN projet.participant ON forme_duo.id_utilisateur=participant.id_utilisateur
INNER JOIN projet.participant_duo ON forme_duo.id_part_duo=participant_duo.id_part_duo
INNER JOIN projet.validation_medicale ON forme_duo.id_utilisateur=validation_medicale.id_utilisateur
INNER JOIN projet.categorie_raid ON participant_duo.id_categorie=categorie_raid.id_categorie
INNER JOIN projet.raid ON participant_duo.id_raid=raid.id_raid
WHERE participant.id_utilisateur =".$_SESSION["idPart"].";";
$resp=pg_query($query2);
$resp=pg_fetch_all($resp);
?>
<div class="container">
    <table class="table">
        <tr>
            <th>participant</th>
            <td><?php echo $resp[0]["prenom"]." ".$resp[0]["nom"];?>
            </td>
        </tr>
        <tr>
            <th> capitaine </th>
            <td><?php echo ($resp[0]["est_capitaine"]? "oui" :"non");?>
            </td>
        </tr>
        <tr>
            <th> validation médicale </th>
            <td><?php echo ($resp[0]["est_valide"]? "oui " :"non ");?>
            </td>
        </tr>
        <tr>
            <th> épreuve </th>
            <td><?php echo ($resp[0]["nom_raid"]." - ".$resp[0]["nom_categorie"]);?>
            </td>
        </tr>
        <tr>
            <th> paiement reçu </th>
            <td><?php echo ( $resp[0]["paiement_valide"]?"oui":"non");?>
            </td>
        </tr>
    </table>
</div>
