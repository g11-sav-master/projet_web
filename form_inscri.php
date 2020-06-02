<div class="container">
    <form method="post" action="inscription.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label></label>
                    <select class="form-control" name="raid">
                        <?php
                        $db = pg_connect("host=localhost dbname=postgres user=projet password=projet  ")
                        or die('Connexion impossible : ' . pg_last_error());
                        $query = "SELECT nom_raid,id_raid FROM raid;";
                        $resp = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
                        $resp = pg_fetch_all($resp);
                        foreach ($resp as $raid)
                        {
                            echo '<option value="'.$raid["id_raid"].'">'.$raid["nom_raid"].'</option>';
                        }
                        //$_POST['raid']=$resp[0]['id_raid'];
                        ?>
                    <!--<option value="1">Bol d'air</option>
                    <option value="2">Mini Bol d'air</option> -->
                </select>
                </div>
                <div class="form-group col-md-6">
                    <label></label>
                    <select class="form-control " name="categorie">
                        <?php
                        /* $db = pg_connect("host=localhost dbname=postgres user=projet password=projet  ")
                         or die('Connexion impossible : ' . pg_last_error());*/
                        $query = "SELECT id_categorie,nom_categorie FROM categorie_raid;";
                        $resp = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
                        $resp = pg_fetch_all($resp);
                        foreach ($resp as $categorie)
                        {
                            echo '<option value="'.$categorie["id_categorie"].'">'.$categorie["nom_categorie"].'</option>';
                        }
                        //$_POST["categorie"]=$resp[0]["id_categorie"];
                        ?>
                        </select>
                </div>
            </div>
        <hr noshade>
        <div class="form-group">
                <label> Capitaine </label>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <input type="text" class="form-control" id="nomC" name="nomC" placeholder="Nom">
            </div>
            <div class="form-group col-md-3">
                <input type="text" class="form-control" id="prenomC" name="prenomC" placeholder="Prénom">
            </div>
            <div class="input-group col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">date de naissance</span>
                    </div>
                    <input type="date" class="form-control" id="dateC" name="dateC">
                </div>
            </div>
        </div>
        <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="email" class="form-control" id="mailC" name="mailC" placeholder="adresse mail">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="tel" class="form-control" id="telC" name="telC" placeholder="téléphone">
                    </div>
                </div>
           <!-- <div class="custom-file col-md-6">
                <label class="custom-file-label"> Certificat medical :</label>
                <input type="file" class="custom-file-input" id="certifmedP" name="certifmedP">
            </div> -->
        <hr noshade>
        <div class="form-group">
            <label> Equipier </label>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <input type="text" class="form-control" id="nomE" name="nomE" placeholder="Nom">
            </div>
            <div class="form-group col-md-3">
                <input type="text" class="form-control" id="prenomE" name="prenomE" placeholder="Prénom">
            </div>
            <div class="input-group col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">date de naissance</span>
                    </div>
                    <input type="date" class="form-control" id="dateE" name="dateE">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="email" class="form-control" id="mailE" name="mailE" placeholder="adresse mail">
            </div>
            <div class="form-group col-md-4">
                <input type="tel" class="form-control" id="telE" name="telE" placeholder="téléphone">
            </div>
        </div>
          <!--  <div class="custom-file col-md-6">
                <label class="custom-file-label"> Certificat medical :</label>
                <input type="file" class="custom-file-input" id="certifmedE" name="certifmedE">
            </div> -->
        <hr noshade>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">repas supplémentaires :</span>
                    </div>
                    <input type="number" class="form-control" id="nbrepas" name="nbrepas" value="0">
                </div>
            </div>
                <div class="form-group col-md-4">
                    <small id="repasHelp" class="form-text text-muted">prix unitaire: 7 €</small>
                    <input class="btn btn-primary offset-md-8" type="submit" name="submit" id="submit" value="envoyer inscription">
                </div>
        </div>
        <div class="form-row ">
        </div>
    </form>
</div>
