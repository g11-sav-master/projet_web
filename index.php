<?php
session_start();
?>
<html>
    <head>
        <title> Site Inscription Bol d'Air</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
    <?php
    if (isset($_SESSION["login"]))
    {

    }
    else {
        ?>
    <form action="connexion.php">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" >
        </div>
        <div class="form-group">
            <label for="motdepasse">Mot de Passe</label>
            <input type="password" class="form-control" id="motdepasse">
        </div>
        <button type="submit" class="btn btn-primary">Connexion</button>
    </form>
    <?php
    }
    ?>
    </body>
</html>
