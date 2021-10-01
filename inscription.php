<?php
session_start();

require_once('db/connexiondb.php');
require_once('config_function/function.php');
$title = 'inscription';

// S'il y a une session alors on ne retourne plus sur cette page
if (isset($_SESSION['id'])) {
    header('location: index.php');
    exit;
}


//Vérification sur l'envoi du formulaire
if (!empty($_POST)) {

    // extraction de toutes les données de la variable globale $_POST
    extract($_POST);
    $valid = (boolean) true;

    if (isset($_POST['inscription'])) {
        $nom      = htmlentities(trim($nom)); // On récupère le nom
        $prenom   = htmlentities(trim($prenom)); // On récupère le prenom
        $pseudo   = htmlentities(trim($pseudo)); // On récupère le pseudo
        $mail     = htmlentities(strtolower(trim($mail))); // On récupère le mail
        $password = (String) trim($password); // On récupère le mot de passe
        $confpass = (String) trim($confpass); // On récupère la confirmation du mot de passe
        $jour     = (int) $jour; // On récupère le jour
        $mois     = (int) trim($mois); // On récupère le mois
        $annee    = (int) $annee; // On récupère l'année
        $region   = htmlentities(trim($region)); // On récupère la region
        $ville    = htmlentities(trim($ville)); // On récupère la ville
        $date_naissance = (String) null; // On récupère la date de naissance

        // vérification nom
        if (empty($nom)){
            $valid = false;
        }

        //vérification prenom
        if (empty($prenom)) {
            $valid = false;
        }
        


        // vérifications pseudo
        if (empty($pseudo)) {
            $valid = false;

        }else{
            // On vérifie si le pseudo existe déjà dans la base de donnée
            $req_pseudo = $DB->query("SELECT pseudo FROM utilisateur WHERE pseudo = ?", array($pseudo));
            $req_pseudo = $req_pseudo->fetch();

            if ($req_pseudo['pseudo'] <> "") {
                $valid = false;
                $er_pseudo = "r";
            }
        }




        // vérification email
        if (empty($mail)) {
            $valid = false;
        }
        // On vérifie si le mail est dans un bon format
        elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)){
            $valid = false;
            $er_mail = "r";

        }else{
            //On vérifie que le mail est disponible
            $req_mail = $DB->query("SELECT mail FROM utilisateur WHERE mail = ?", 
            array($mail));

            $req_mail = $req_mail->fetch();

            if ($req_mail['mail'] <> "") {
                $valid = false;
                $er_mail = "r";
            }
        }

        



        // Vérification du mot de passe
        if(empty($password)) {
            $valid = false;
        }elseif($password != $confpass) {
            $valid = false;
            $er_mdp = "r";
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

        // Si toutes les conditions sont remplies alors on fait le traitement
        if ($valid) {
            //la date de l'ordinateur
            $date_inscription = date("Y-m-d");

            // Chiffrage du mot de passe
            $pass_hash = password_hash($password, PASSWORD_BCRYPT);

            $date_inscription = date('Y-m-d H:i:s');

            // préparation de la requette pour stocker les valeurs dans la bdd
            $DB->insert("INSERT INTO utilisateur (nom, prenom, pseudo, mail, pass, date_naissance, region, ville, date_inscription)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)", 
                array($nom, $prenom, $pseudo, $mail, $pass_hash, $date_naissance, $region, $ville, $date_inscription));

            header('Location: index.php');
            exit;
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
                            <input type="text" name="nom" id="" placeholder="Nom" class="form-control" value="<?php if (isset($nom)) {echo $nom;} ?>" required>
                        </div>
                        <br>
                        <div>
                            <input type="text" name="prenom" id="" placeholder="Prenom" class="form-control" value="<?php if (isset($prenom)) {echo $prenom;} ?>" required>
                        </div>
                        <br>
                        <div>
                            <input type="text" name="pseudo" id="" placeholder="Pseudo" class="form-control" value="<?php if (isset($pseudo)) {echo $pseudo;} ?>" required>
                            <?php if (isset($er_pseudo)) {alert_pseudo();} ?>
                        </div>
                        <br>
                        <div>
                            <input type="text" name="mail" id="" placeholder="email" class="form-control"  value="<?php if (isset($mail)) {echo $mail;} ?>" required>
                            <?php if(isset($er_mail)) { alert_email(); } ?>
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
                        <div>
                            <input type="password" name="password" id="" placeholder="Mot de passe" class="form-control" required>
                        </div>
                        <br>
                        <div>
                            <input type="password" name="confpass" id="" placeholder="Confirmer le mot de passe" class="form-control" required>
                                <?php if (isset($er_mdp)) {alert_password();} ?>
                        </div>
                        <br>
                    </section>

                    <input type="submit" name="inscription" value="S'inscrire" class="btn btn-primary">
                </form>
                <br>
                </div>
            </div>
        </div>

        <script src="js/bootstrap.min.js"></script>
    </body>
</html>