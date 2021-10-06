<?php
// Ouvre une session pour afficher le donnée de $_SESSION
session_start();
$title = 'Accueil';



?>

<!DOCTYPE html>
<html lang="en">
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
    <?php include_once 'menu.php' ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-0 col-md-2 col-lg-3"></div>
            <div class="col-sm-12 col-md-8 col-lg-6">
                <br>
                    <h1>Bienvenu sur notre site</h1>
                <br>
                    <p>Veuillez vous connecter svp</p>
                <br>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                    Porro, possimus optio accusamus commodi adipisci minus.
                    Odio cum sequi quia magni voluptatum sint expedita modi, 
                    animi ratione nostrum sunt harum obcaecati assumenda est 
                    aspernatur tenetur minima incidunt accusantium non saepe 
                    quasi consequatur quis corrupti dicta! Odit enim reiciendis 
                    mollitia facere tempore alias iure aspernatur expedita, 
                    recusandae eligendi eos sit placeat, minus rerum est harum 
                    dolorem maxime vitae facilis vero impedit! Maxime.
                </p>
                <br>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>