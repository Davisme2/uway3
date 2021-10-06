<?php

session_start();
include('db/connexiondb.php');
include('config_function/function.php');
$title = 'Administration';

// Si aucune session n'est ouverte alors on redirige le visiteur vers la page d'acceuil
if (!isset($_SESSION['id'])){
    header('Location: index');
    exit;
}


// Récupération de l'id passé en argument dans l'URL
$id = (int)htmlentities(trim($_GET['id']));

// Si $id n'est pas un entier ou si il est égale à 0 ou si est égale à l'id de session ouvert alors on redirige vers acceuil
if (!is_int($id) || $id <= 0 || $id == $_SESSION['id']){
    header('Location: admin');
    exit;
}



// On récupère les informations de l'utilisateur grâce à son ID
$afficher_profil = $DB->query("SELECT * FROM utilisateur WHERE id = ?", array($id));
$afficher_profil = $afficher_profil->fetch();



if (!isset($afficher_profil['id'])){
    header('Location: admin');
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <base href="/"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- title -->
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
        <div class="col-sm-12 col-md-12 col-lg-12">
            <br>
            <div style="background-color: white; padding: 15px 10px; margin-top: 20px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); border-radius: 10px">
            <br>
            <h3 style="text-align: center;" class="alert alert-success">Bienvenu sur le profil de : <?= $afficher_profil['nom'] . " " . $afficher_profil['prenom']; ?></h3>
            <br>
            <p>
                Quelques informations sur lui :
            </p>
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
                <a href="/admin" style="text-decoration: none;">< Retour</a> / <a href="modifier-profil" style="text-decoration: none;">Modifier son profil</a>
            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.min.js"></script>
</body>
</html>