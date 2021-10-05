<?php
session_start();
$title = 'Connexion';
require_once ('db/connexiondb.php');
require_once ('config_function/function.php');

// S'il y a une session ouverte alors on ne retourne plus sur cette page
if (isset($_SESSION['id'])) {
    header('Location: profil.php');
    exit;
}

if (!empty($_POST)){
    extract($_POST);
    $valid = (boolean) true;

    // Si le bouton connexion est enclanché alors
    if (isset($_POST['connexion'])) {
        
        $mail = htmlentities(strtolower(trim($mail)));
        $password = trim($password);

        // Vérification si un mail est renseigné
        if (empty($mail)) {
            $valid = false;
        }

        // Vérification si il y a un mot de passe renseigné
        if (empty($password)) {
            $valid = false;
            $er_password = 'r';
        }

            $password_crypt = crypt($password, '$6$rounds=5000$ksdjkjhsdn543jhg564t5fhfgjfghdfd');

            // Vérification si le mail et le mot de passe existe déjà dans la base de donnée
            $req = $DB->query("SELECT mail,pass FROM utilisateur WHERE mail = ? OR pass = ?",
                array($mail, $password_crypt));
        
            $req = $req->fetch();

            // Si le mail et le mot de passe n'existe déjà dans la bdd alors l'utilisateur n'est pas encore inscrit $req renvoie false
            if ($req == false) {
                $valid = false;
                $er_mail = 'r';
            } 
            
            
        // Dans le cas où le mail ou le mot de passe existent alors on charge la session du visiteur en utilisant les variables $_SESSION
        if ($valid) {

            // On récupère toutes les données de la bdd dans le but de charger la session du visiteur qui se log avec des login qui exitent dans la bdd
            $req_fin = $DB->query("SELECT * FROM utilisateur");
            $req_fin = $req_fin->fetch();

            // Remise à 0 de n_password dans la bdd si il est égale à 1
            if ($req_fin['n_password'] == 1) {

                $DB->insert("UPDATE utilisateur SET n_password = 0 WHERE id = ?", array($req_fin['id']));

            }

            $_SESSION['id']     =   $req_fin['id'];
            $_SESSION['nom']    =   $req_fin['nom'];
            $_SESSION['prenom'] =   $req_fin['prenom'];
            $_SESSION['mail']   =   $req_fin['mail'];

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
            <div class="col-md-4">
                <h1>Se connecter</h1>
                <br>
                <form action="" method="POST" class="form-group">
                    <div>
                        <input type="email" name="mail" id="" placeholder="Adresse mail" class="form-control" value="<?php if(isset($mail)) {echo $mail;} ?>" required>
                    </div>
                    <br>
                    <div>
                        <input type="password" name="password" id="" placeholder="Mot de passe" class="form-control" value="<?php if(isset($password)) {echo $password;} ?>" required>
                    </div>
                    <br>
                    <?php if(isset($er_mail)) {non_inscrit();} ?>
                    <div>
                        <input type="submit" value="Connexion" name="connexion" class="btn btn-primary">
                    </div>
                    <br>
                </form>
                <div>
                    <a href="motdepasse.php">Mot de passe oublié ?</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/bootstrap.min.js"></script>
</body>
</html>