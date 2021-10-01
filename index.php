<?php
// Ouvre une session pour afficher le donnée de $_SESSION
session_start();
$title = 'Acceuil';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- title -->
    <title><?php if (isset($title)) { echo $title; } else { echo 'Page non trouvée'; } ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include_once 'menu.php' ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <br>
                <h1>Bienvenu sur notre site</h1>
                <?php
                    if (isset($_SESSION['id'])) {
                        ?>
                            <a href="deconnexion.php">Déconnexion</a>
                            <br>
                        <?php
                    } else {
                        ?>
                            <a href="inscription.php">Inscription</a>
                            <a href="connexion.php">Connexion</a>
                        <?php
                    }
                ?>

                <?php

                    if (isset($_SESSION['id'])) {
                        echo 'ID : ' . $_SESSION['id'] . '<br>Nom : ' . $_SESSION['nom'] . "<br>Prénom : " . $_SESSION['prenom'] . "<br>Mail : " . $_SESSION['mail'];
                    }

                ?>
            </div>
        </div>
    </div>

    
</body>
</html>