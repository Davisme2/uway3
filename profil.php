<?php
session_start();
$title = 'Bienvenue';
include('db/connexiondb.php');

// S'il n'y a pas de session alors on ne va pas sur cette page
if(!isset($_SESSION['id'])) {
    header('Location: index');
    exit;
}

// On récupère les informations de l'utilisateur connecté
$afficher_profil = $DB->query("SELECT * FROM utilisateur WHERE id = ?", array($_SESSION['id']));
$afficher_profil = $afficher_profil->fetch();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <base href="/"/>
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
            <div class="col-sm-0 col-md-2 col-lg-3"></div>
            <div class="col-sm-12 col-md-8 col-lg-6">
                <div style="background-color: white; padding: 15px 10px; margin-top: 20px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); border-radius: 10px">
                <h1 style="text-align: center;">Bienvenue </h1>
                <p style="text-align: center;" class="alert alert-success">M. <?= $afficher_profil['nom'] . " " . $afficher_profil['prenom']; ?></p>
 
                    <div class="alert alert-dark">
                            <div style="margin: 20px 0;">
                                <?php
                                    if(file_exists("public/avatars/" . $_SESSION['id'] . "/" . $_SESSION['avatar']) && isset($_SESSION['avatar'])){
                                ?>
                                    <img src="<?= "public/avatars/" . $_SESSION['id'] . "/" . $_SESSION['avatar']; ?> " alt="" width="120" class="sz-image"/>
                                <?php
                                    }else{
                                ?>
                                    <img src="public/avatars/defaults/default.png" alt="" width="120" class="sz-image"/>
                                <?php
                                    }
                                ?>
                            </div>
                        <ul>
                            <li>Id : <?= $afficher_profil['id'] ?></li>
                            <li>Pseudo : <?= $afficher_profil['pseudo'] ?></li>
                            <li>Email : <?= $afficher_profil['mail'] ?></li>
                            <li>Date d'inscription : <?= $afficher_profil['date_inscription'] ?></li>
                            <li>Née le : <?= $afficher_profil['date_naissance'] ?> à <?= $afficher_profil['ville'] ?></li>
                        </ul>
                        <div>
                            <a href="/modifier-profil" style="text-decoration: none;">Modifier votre profil</a> / <a href="/avatar" style="text-decoration: none;">Ajouter un avatar</a> / <a href="/admin" style="text-decoration: none;">Administration</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    <script src="js/bootstrap.min.js"></script>
</body>
</html>