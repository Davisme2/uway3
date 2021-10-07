<?php
session_start();
include('../db/connexiondb.php');
$title = 'Erreur';

$erreur = (int) htmlentities(trim($_GET['erreur']));

if(!is_int($erreur) || $erreur <= 0){
    header('Location: /');
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
    <title><?php if(isset($title)) {echo $title;} ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include('../menu.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-0 col-md-2 col-lg-3"></div>
            <div class="col-sm-12 col-md-8 col-lg-6">
                <h1 style="text-align: center; margin-top: 20px"><?= 'Erreur' . $erreur ?></h1>
            </div>
        </div>
    </div>
    <script src="../js/bootstrap.js"></script>
</body>
</html>