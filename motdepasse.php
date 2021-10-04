<?php
session_start();
$title = 'Mot de passe oublié';

include('db/connexiondb.php');

if (isset($_SESSION['id'])) {
    header('Location: index.php');
    exit;
}

if (!empty($_POST)){
    extract($_POST);
    $valid = true;


    if(isset($_POST['oublie'])){
        // On récupère le mail afin d'envoyer le mail pour la récupération du mot de passe
        $mail = htmlentities(strtolower(trim($mail)));

        // Si le champs mail est vide alors on ne le traite pas
        if(empty($mail)){
            $valid = false;
        }


        // Si tout vas bien alors
        if($valid){

            // Verifions si le mail existe et on intéroge donc la base de donnée pour recupérer le nom, le prenom, le mail, et le new password   
            $verification_mail = $DB->query("SELECT nom, prenom, mail, n_password FROM utilisateur WHERE mail = ?", array($mail));

            $verification_mail = $verification_mail->fetch();

            // Si le mail entré par le visiteur existe dans la bdd alors
            if(isset($verification_mail['mail'])){

                if($verification_mail['n_password'] == 0){
                    
                    // On génère un nouveau mot de passe de façon aléatoire entre 7 caractères minimum et 10 caractère maximum
                    $new_pass = rand(1657447, 1585785784564);

                    // on crypte ce mot de passe
                    $new_pass_crypt = crypt($new_pass, '$6$rounds=5000$ksdjkjhsdn543jhg564t5fhfgjfghdfd');
                    /*
                    $objet = 'Nouveau mot de passe';
                    $to = $verification_mail['mail'];


                    // ===== Création du header du mail
                    $header = "From: MAIL_ENTREPRISE <no-reply@test.com> \n";
                    $header .= "Reply-To: ".$to."\n";
                    $header .= "MIME-version: 1.0\n";
                    $header .= "Content-type: text/html; charset=utf-8\n";
                    $header .= "Content-Transfer-Encoding: 8bit";


                    // ===== Contenu de votre message
                    $contenu = "<html>".
                                    "<body>".
                                        "<p style='text-align: center; font-size: 18px'><b>Bonjour Mr, Mme".$verification_mail['nom']."</b>,</p><br/>".
                                        "<p style='text-align: justify'><i><b>Nouveau mot de passe : </b></i>".$new_pass."</p><br/>".
                                    "</body>".
                                "</html>";

                    // ===== Une fois le mail envoyé, on enregistre dans la bdd le nouveau mot de passe crypté ainsi
                    mail($to, $objet, $contenu, $header);
                    */
                    $DB->insert("UPDATE utilisateur SET pass = ?, n_password = 1 WHERE mail = ?",
                        array($new_pass_crypt, $verification_mail['mail']));

                }
            }

            // Si le mail entré par l'utilisateur n'existe pas dans la bdd alors on redirige le visiteur vers la page de connexion
            // le mot de passe de davis93m@gmail.com est 1553211025153
            header('Location: connexion.php');
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
        <h1>Mot de passe oublié ?</h1>
            <div class="col-md-4">
                <br>
                <form action="" method="POST" class="form-group">
                    <div>
                        <input type="email" name="mail" id="" placeholder="Adresse mail" class="form-control" value="<?php if(isset($mail)) {echo $mail;} ?>" required>
                    </div>
                    <br>
                    <div>
                        <input type="submit" value="Envoyer" name="oublie" class="btn btn-primary">
                    </div>
                </form>
                <br>
                <div>
                    <a href="inscription.php">Inscription</a> / <a href="connexion.php">Connexion</a>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>