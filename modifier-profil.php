<?php
session_start();
$title = 'Bienvenue';
require_once ('db/connexiondb.php');
require_once ('config_function/function.php');

// S'il y a une session ouverte alors on ne retourne plus sur cette page
if (!isset($_SESSION['id'])) {
    header('Location: profil.php');
    exit;
}


// On récupère les informations de l'utilisteur connecté
$afficher_profil = $DB->query("SELECT * FROM utilisateur WHERE id = ?", array($_SESSION['id']));
$afficher_profil = $afficher_profil->fetch();

if(!empty($_POST)){
    extract($_POST);
    $valid = true;

    if (isset($_POST['modif'])){

        $nom = htmlentities(trim($nom));
        $prenom = htmlentities(trim($prenom));
        $mail = htmlentities(trim($mail));
        $password = (String) trim($password); // On récupère le mot de passe
        $confpass = (String) trim($confpass); // On récupère la confirmation du mot de passe
        $jour     = (int) $jour; // On récupère le jour
        $mois     = (int) trim($mois); // On récupère le mois
        $annee    = (int) $annee; // On récupère l'année
        $region   = htmlentities(trim($region)); // On récupère la region
        $ville    = htmlentities(trim($ville)); // On récupère la ville
        $date_naissance = (String) null; // On récupère la date de naissance


        if(empty($nom)){
            $valid = false;
        }

        //vérification prenom
        if (empty($prenom)) {
            $valid = false;
        }

        if(empty($mail)){
            $valid = false;
        }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)){
            $valid = false;
            $er_mail = 'r';
        }else{
            $req_mail = $DB->query("SELECT mail FROM utilisateur WHERE mail = ?", array($mail));
            $req_mail = $req_mail->fetch();

            if($req_mail['mail'] <> ""){
                $valid = false;
                $er_mail = 'a';
            }
            
        }

        // Vérification du mot de passe
        if(empty($password)) {
            $valid = false;
        }elseif($password != $confpass) {
            $valid = false;
            $er_mdp = "r";
        }

        // On vérifie que l'utilisateur existe bien !
        $req = $DB->query("SELECT id FROM utilisateur WHERE id = ?", array($_SESSION['id']));
        $req = $req->fetch();

        // Si on a pas de résultat alors c'est que l'utilisateur n'existe pas
        if($req['id'] == ""){
            $valid = false;
            $er_general = "L'utilisateur n'existe pas";
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


        if ($valid){

            $DB->insert("UPDATE utilisateur SET prenom = ?, nom = ?, pseudo = ?, mail = ?, date_naissance = ?, region = ?, ville = ? WHERE id = ?",
                array($prenom, $nom, $pseudo, $mail, $date_naissance, $region, $ville, $_SESSION['id']));

                $_SESSION['nom']            = $nom;
                $_SESSION['prenom']         = $prenom;
                $_SESSION['mail']           = $mail;
                $_SESSION['date_naissance'] = $date_naissance;
                $_SESSION['region']         = $region;
                $_SESSION['ville']          = $ville;

                header('Location: profil.php');
                exit;
        }
    }
}

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
                <h1>Modifier vos informations</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <br>
                <form action="" method="POST" class="form-group">
                    <div>
                        <input type="text" name="nom" id="" placeholder="Nom" class="form-control" value=" <?php if(isset($nom)) {echo $nom;}else{ echo $afficher_profil['nom'];} ?>" required>
                    </div>
                    <br>
                    <div>
                        <input type="text" name="prenom" id="" placeholder="Prenom" class="form-control" value=" <?php if(isset($prenom)) {echo $prenom;}else{ echo $afficher_profil['prenom'];} ?>" required>
                    </div>
                    <br>
                    <div>
                        <input type="email" name="mail" id="" placeholder="Nouveau mail" class="form-control" value=" <?php if(isset($mail)) {echo $mail;}else{ echo $afficher_profil['mail'];} ?>" required>
                        <?php if (isset($er_mail)) {alert_email();} ?>
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
                                        <option value="<?= $region ?>"><?= $region ?></option>
                                    <?php } ?>
                                        <option value="" hidden>Regions et District</option>
                                    <?php add_region(); ?>
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
                    <div>
                        <input type="password" name="password" id="" placeholder="Entrer le nouveau mot de passe" class="form-control" value="<?php if(isset($password)) {echo $password;} ?>" required>
                    </div>
                    <br>
                    <div>
                        <input type="password" name="confpass" id="" placeholder="Confirmer le nouveau mot de passe" class="form-control" required>
                        <?php if (isset($er_mdp)) {alert_password();} ?>
                    </div>
                    <br>
                    <div>
                        <input type="submit" value="Modifier" name="modif" class="btn btn-primary">
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>