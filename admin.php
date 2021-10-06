<?php

// On démarre une session pour utiliser plutard les variables de $_SESSION
session_start();
include('db/connexiondb.php');
include('config_function/function.php');
$title = 'Administration';

if (!isset($_SESSION['id'])){
    header('Location: index');
    exit;
}

// On récupère tous les utilisateurs sauf l'utilisateur en count_chars$
$afficher_profil = $DB->query("SELECT * FROM utilisateur WHERE id <> ?", array($_SESSION['id']));

$afficher_profil = $afficher_profil->fetchAll(); // fetchAll() permet de récupérer tous les données plusieurs enregistrements

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
            <div class="col-sm-12 col-md-12 col-lg-12">
                <br>
                <div style="background-color: white; padding: 15px 10px; margin-top: 20px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); border-radius: 10px">
                <br>
                <h2 style="text-align: center;" class="alert alert-dark alert-dismissible fade show">Utilisateurs</h2> 
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Voir le profil</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                            // Foreach agit comme une boucle mais celle-ci s'arrête de façon intelligente.
                            // Elle s'arrête avec le nombre de lignes qu'il y a dans la variable $afficher_profil

                            // La variable $afficher_profil est comme un tableau contenant plusieurs valeurs
                            // Pour lire chacune des valeurs distinctement on va mettre un pointeur que l'on appellera ici $ap
                            foreach($afficher_profil as $ap){
                                ?>
                                    <tr>
                                        <td><?= $ap['nom'] ?></td>
                                        <td><?= $ap['prenom'] ?></td>
                                        <td><a href="voir_profil.php?id=<?= $ap['id'] ?>">Aller au profil</a></td>
                                    </tr>
                                <?php    
                            }
                        ?>
                    </tbody>
                </table>
                <br>
                <div>
                    <a href="/profil" style="text-decoration:none">< Retour</a>
                </div>
            </div>
        </div>    
    </div>
</body>
</html>