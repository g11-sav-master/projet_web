<?php
$db= pg_connect("host=localhost dbname=postgres user=admin  ")
or die('Connexion impossible : ' . pg_last_error());

$query = 'SELECT * FROM utilisateur';
$resp = pg_query($query)  or die('Échec de la requête : ' . pg_last_error());
echo "<table>\n";
while ($line = pg_fetch_array($resp, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";
pg_free_result($resp);
pg_close($db);
?>