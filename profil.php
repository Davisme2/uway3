<?php
session_start();
$title = 'Bienvenue';
include('db/connexiondb.php');

// S'il n'y a pas de session alors on ne va pas sur cette page
if(!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit;
}

// On récupère les informations de l'utilisateur connecté
$afficher_profil = $DB->query("SELECT * FROM utilisateur WHERE id = ?", array($_SESSION['id']));
$afficher_profil = $afficher_profil->fetch();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($title)) {echo $title;} ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require_once 'menu.php' ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <br>
                <h1>Bienvenue sur votre profil</h1>
                <br>
                <p class="alert alert-success">M. <?= $afficher_profil['nom'] . " " . $afficher_profil['prenom']; ?></p>
                <br>
                <div class="alert alert-danger">
                    <ul>
                        <li>Id : <?= $afficher_profil['id'] ?></li>
                        <li>Pseudo : <?= $afficher_profil['pseudo'] ?></li>
                        <li>Email : <?= $afficher_profil['mail'] ?></li>
                        <li>Date d'inscription : <?= $afficher_profil['date_inscription'] ?></li>
                        <li>Née le : <?= $afficher_profil['date_naissance'] ?> à <?= $afficher_profil['ville'] ?></li>
                    </ul>
                </div>
                <div>
                    <a href="modifier-profil.php">Modifier votre profil</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/bootstrap.min.js"></script>
</body>
</html>