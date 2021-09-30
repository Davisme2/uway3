<?php
require_once('db/connexiondb.php');
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
        $departement = (int) $departement;
        $date_naissance = (String) null;

        // vérifications pseudo
        if (empty($pseudo)) {
            $valid = false;
            $err_pseudo = 'Veuillez renseigner ce champs';
        }

        // vérification email
        if (empty($mail)) {
            $valid = false;
            $err_mail = 'Veuillez renseigner ce champs';
        }

        // vérification password
        if (empty($password)) {
            $valid = false;
            $err_password = 'Veuillez renseigner ce champs';
        }

        // vérification jour
        $verif_jour = array(1, 2, 3);

        if (!in_array($jour, $verif_jour)) {
            $valid = false;
            $err_jour = 'Veuillez renseigner ce champs';
        }

        // vérification mois
        $verif_mois = array(1, 2, 3);

        if (!in_array($mois, $verif_mois)) {
            $valid = false;
            $err_mois = 'Veuillez renseigner ce champs';
        }

        // vérification année
        $verif_annee = array(1, 2, 3);

        if (!in_array($annee, $verif_annee)) {
            $valid = false;
            $err_annee = 'Veuillez renseigner ce champs';
        }

        // vérification departement
        $verif_departement = array(1, 2, 3);

        if (!in_array($departement, $verif_departement)) {
            $valid = false;
            $err_departement = 'Veuillez renseigner ce champs';
        }

        if ($valid) {

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
        <title><?php if (isset($title)) { echo $title; } else { echo 'Erreur'; } ?></title>

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
                
                <form action="" method="post" class="form-group">

                    <section>
                        <div>
                            <input type="text" name="pseudo" id="" placeholder="Pseudo" class="form-control">
                        </div>
                        <br>
                        <div>
                            <input type="text" name="email" id="" placeholder="email" class="form-control">
                        </div>
                        <br>
                        <div>
                            <input type="password" name="password" id="" placeholder="Mot de passe" class="form-control">
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <select name="jour" id="" class="form-control form-select"> 
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
                                <select name="mois" id="" class="form-control form-select">
                                    <?php if (isset($mois) && !empty($mois)){ ?>

                                        <option value="<?= $mois ?>"><?= $mois ?></option>

                                    <?php } ?>

                                    <option value="" hidden>Mois</option>

                                        <option value='Janvier'>Janvier</option>
                                        <option value='Fevrier'>Fevrier</option>
                                        <option value='Mars'>Mars</option>
                                        <option value='Avril'>Avril</option>
                                        <option value='Mai'>Mai</option>
                                        <option value='Juin'>Juin</option>
                                        <option value='Juillet'>Juillet</option>
                                        <option value='Aout'>Août</option>
                                        <option value='Septembre'>Septembre</option>
                                        <option value='Octobre'>Octobre</option>
                                        <option value='Novembre'>Novembre</option>
                                        <option value='Decembre'>Decembre</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="année" id="" class="form-control form-select">
                                    <?php if (isset($year) && !empty($year)){ ?>

                                        <option value="<?= $year ?>"><?= $year ?></option>

                                    <?php } ?>

                                        <option value="" hidden>Année</option>

                                    <?php for ($r = 1999; $r >= 1914; $r--) { ?>

                                        <option value="<?= $r ?>"><?= $r ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <select name="departement" id="" class="form-control" >
                            <option value="1">Science</option>
                            <option value="2">Mathématique</option>
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