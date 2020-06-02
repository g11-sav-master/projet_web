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
            <h1 class="text-center" style=" color: #37adff; font-family: 'Bebas Neue';">Raid Bol d'Air</h1>
            <ul class="nav justify-content-center" style=" background-color: #37adff; font-family: 'Bebas Neue';">
                    <li class="nav-item">
                        <a  class="nav-link" style=" color: white; font-family: 'Bebas Neue';" href="index.php?action=inscription">inscription</a>
                    </li>
                <li class="nav-item">
                    <a  class="nav-link" style=" color: white; font-family: 'Bebas Neue';" href="index.php">connexion</a>
                </li>
                <?php
                if (isset($_SESSION["login"])) {
                    echo '<span class="btn btn-secondary session"><a href="index.php?action=logout" style="color: white;">déconnexion</a> </span>';
                }
                if (isset($_GET["action"]) && $_GET["action"]=="inscription"){
                    echo '';
                }
                ?>
            </ul>
        </div>
    </header>
    <?php
    if ((!(isset($_SESSION["login"])) && !(isset($_GET["action"]))) || !(isset($_GET["action"]))){

        include ('connexion_form.html');
    }

    if (isset($_SESSION["login"]) && $_GET["action"]=="profil")
    {
        include ("profil.php");
    }
    if (isset($_GET["action"]) && $_GET["action"]=="inscription")
    {
        include('form_inscri.php');
    }
    if (isset($_GET["action"]) && $_GET["action"]=="logout"){
        session_destroy();
        header("location:index.php");
        exit();
    }

    ?>
    <footer>
        <div class="container" style="background-color: #37adff; color: white; font-family: 'sansation'">
            <p class="text-center">
                Bol d'air - 2020 3iL - SAV MASTER
            </p> </div>
    </footer>
    </body>
</html>
