<?php
require_once('db/connexiondb.php');
require_once('config_function/function.php');
$title = 'inscription';

//Vérification sur l'envoi du formulaire
if (!empty($_POST)) {

    // extraction de toutes les données de la variable globale $_POST
    extract($_POST);
    $valid = (boolean) true;

    if (isset($_POST['inscription'])) {
        $pseudo   = (String) trim($pseudo);
        $mail     = (String) trim($mail);
        $password = (String) trim($password);
        $jour     = (int) $jour;
        $mois     = (int) trim($mois);
        $annee    = (int) $annee;
        $region   = (String) $region;
        $ville    = (String) $ville;
        $date_naissance = (String) null;

        // vérifications pseudo
        if (empty($pseudo)) {
            $valid = false;
        }

        // vérification email
        if (empty($mail)) {
            $valid = false;
        }

        // vérification password
        if (empty($password)) {
            $valid = false;
        }

        // vérification jour
        $verif_jour = add_jour();

        if (!in_array($jour, $verif_jour)) {
            $valid = false;
        }

        // vérification mois
        $verif_mois = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);

        if (!in_array($mois, $verif_mois)) {
            $valid = false;
        }

        // vérification année
        $verif_annee = add_annee();

        if (!in_array($annee, $verif_annee)) {
            $valid = false;
        }

        if (!checkdate($mois, $jour, $annee)) {
            $valid = false;
        }else{
            $date_naissance = $annee . '-' . $mois . '-' . $jour;
        }

        // vérification région
        if (empty($region)) {
            $valid = false;
        }

        // vérification Ville
        if (empty($ville)) {
            $valid = false;
        }

        if ($valid) {
            //la date de l'ordinateur
            $date_inscription = date("Y-m-d");

            // préparation de la requette pour stocker les valeurs dans la bdd
            $req = $BDD->prepare("INSERT INTO utilisateur (pseudo, mail, pass, date_naissance, region, ville, date_inscription)
                VALUES(?, ?, ?, ?, ?, ?, ?)");
            
            // exécution de la requette
            $req->execute(array($pseudo, $mail, $password, $date_naissance, $region, $ville, $date_inscription));
        }

    }
}


?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- title -->
        <title><?php if (isset($title)) { echo $title; } else { echo 'Page non trouvée'; } ?></title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <!-- CSS -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php require_once 'menu.php' ?>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                <br>
                <h1>Insciption</h1>
                
                <form method="post" class="form-group">

                    <section>
                        <div>
                            <input type="text" name="pseudo" id="" placeholder="Pseudo" class="form-control" required>
                        </div>
                        <br>
                        <div>
                            <input type="text" name="mail" id="" placeholder="email" class="form-control" required>
                        </div>
                        <br>
                        <div>
                            <input type="password" name="password" id="" placeholder="Mot de passe" class="form-control" required>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <select name="jour" id="" class="form-control form-select" required> 
                                    <?php if (isset($jour) && !empty($jour)){ ?>

                                        <option value="<?= $jour ?>"><?= $jour ?></option>

                                    <?php } ?>

                                        <option value="" hidden>Jour</option>

                                    <?php for ($r = 1; $r <= 31; $r++) { ?>

                                        <option value="<?= $r ?>"><?= $r ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="mois" id="" class="form-control form-select" required>
                                    <?php if (isset($mois) && !empty($mois)){ ?>

                                        <option value="<?= $mois ?>"><?= $mois ?></option>

                                    <?php } ?>

                                    <option value="" hidden>Mois</option>

                                        <?php add_mois(); ?>    

                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="annee" id="" class="form-control form-select" required>
                                    <?php if (isset($annee) && !empty($annee)){ ?>

                                        <option value="<?= $annee ?>"><?= $annee ?></option>

                                    <?php } ?>

                                        <option value="" hidden>Année</option>

                                    <?php for ($r = 1970; $r <= 2005; $r++) { ?>

                                        <option value="<?= $r ?>"><?= $r ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <br>
                                <select name="region" id="" class="form-control form-select" required>
                                    <?php if (isset($region) && !empty($region)) { ?>
                                        <option value="<?= $region ?>"><?php $region ?></option>
                                    <?php } ?>
                                        <option value="" hidden>Regions et District</option>
                                    <?php add_region() ?>
                                </select>
                        <br>
                                <select name="ville" id="" class="form-control form-select" required>
                                    <?php if (isset($ville) && !empty($ville)) { ?>
                                        <option value="<?= $ville ?>"><?= $ville ?></option>
                                    <?php } ?>
                                        <option value="" hidden>Villes</option>
                                    <?php add_ville(); ?>
                                </select>
                        <br>
                    </section>

                    <input type="submit" name="inscription" value="S'inscrire" class="btn btn-primary">
                </form>
                </div>
            </div>
        </div>

        <script src="js/bootstrap.min.js"></script>
    </body>
</html>