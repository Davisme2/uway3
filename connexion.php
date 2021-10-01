<?php
session_start();
$title = 'Connexion';
require_once ('db/connexiondb.php');
require_once ('config_function/function.php');

// S'il y a une session ouverte alors on ne retourne plus sur cette page
if (isset($_SESSION['id'])) {
    header('Location: index.php');
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
            // Vérification si le mail et le mot de passe existe déjà dans la base de donnée
            $req = $DB->query("SELECT * FROM utilisateur WHERE mail = ? AND pass = ?", array($mail, crypt($password, '$6$rounds=5000$ksdjkjhsdn543jhg564t5fhfgjfghdfd')));
        
            $req = $req->fetch();

            var_dump($req['id']);
            exit;

            // Si le mail et le mot de passe n'existe déjà dans la bdd alors l'utilisateur n'est pas encore inscrit
            if ($req['id'] == "") {
                $valid = false;
                $er_mail = 'r';
            }


        

        // Dans le cas où le mail ou le mot de passe existen déjà alors on charge une session du visiteur en utilisant les variables $_SESSION
        if ($valid) {

            $_SESSION['id'] = $req['id']; // l'id de session unique pour les requêtes futures
            $_SESSION['nom'] = $req['nom'];
            $_SESSION['prenom'] = $req['prenom'];
            $_SESSION['mail'] = $req['mail'];

            header('Location: index.php');
            exit;
        }
    }
}

var_dump($req);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <br>
                    <div>
                        <input type="submit" value="Connexion" name="connexion" class="btn btn-primary">
                    </div>
                </form>
                <div>
                    <a href="inscription.php">Inscription</a>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>