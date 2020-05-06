<?php
session_start();
?>
<html>
    <head>
        <title> Site Inscription Bol d'Air</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
    <header>
        <div class="container">
            <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
                <?php
                if (isset($_SESSION["login"])){
                    echo '<span class="btn btn-secondary session"><a href="index.php?action=logout" style="color: white;">déconnexion</a> </span>';
                }
                ?>
                Site Bol d'Air</nav>
        </div>
    </header>
    <?php
    if (isset($_SESSION["login"]) && $_GET["action"]=="profil")
    {
        echo $_SESSION["login"];
    }
    if (isset($_GET["action"]) && $_GET["action"]=="inscription")
    {
        include ('form_inscri.php.html');
    }
    if (isset($_GET["action"]) && $_GET["action"]=="logout"){
        session_destroy();
        header("location:index.php");
        exit();
    }
    if (!(isset($_SESSION["login"])) && !(isset($_GET["action"]))){
        include ('connexion_form.html');
    }
    if (isset($_SESSION["login"]) && $_GET["action"]=="profil")
    {
        echo $_SESSION["login"];
    }

    ?>
    <footer>
        <div class="container" style="background-color: #e3f2fd;"> Bol d'air - 2020 3iL - SAV MASTER</div>
    </footer>
    </body>
</html>
