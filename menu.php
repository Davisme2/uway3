<?php
require_once 'config_function/function.php';
$active = 'active';
$lien_connexion = '';
$lien_inscription = '';
$lien = '';
$profil = '';

// Si il y a une session ouverte alors afficher
if(isset($_SESSION['id'])){

  // Si nous sommes sur la page profil alors
  if ($title == 'Bienvenue') {
  $lien_connexion = $active . '" ' . 'href="/deconnexion.php';
  }

  // Si nous sommes sur la page profil alors
  if ($title == 'Accueil') {
    $lien_connexion = '" ' . 'href="/deconnexion.php';
    }
}

// Si il y a une session ouverte alors afficher
if(!isset($_SESSION['id'])){

  // Si nous sommes sur la page d'Accueil alors
  if ($title == 'Accueil') {
  $lien_inscription .= '" ' . 'href="/inscription.php';
  }

  // Si nous sommes sur la page d'Accueil alors
  if ($title == 'Accueil') {
  $lien_connexion .= '" ' . 'href="/connexion.php';
  }

  // Si nous sommes sur la page S'inscrire alors
  if ($title == 'Inscription') {
  $lien_inscription .= $active . '" ' . 'href="/inscription.php';
  }

  // Si nous sommes sur la page S'inscrire alors
  if ($title == 'Inscription') {
  $lien_connexion .= '" ' . 'href="/connexion.php';
  }

  // Si nous sommes sur la page se connecter alors
  if ($title == 'Connexion') {
  $lien_inscription .= '" ' . 'href=/inscription.php';
  }

  // Si nous sommes sur la page se connecter alors
  if ($title == 'Connexion') {
  $lien_connexion .= $active . '" ' . 'href=/inscription.php';
  }
}

// Affichage connecté ou déconnecté
if(isset($_SESSION['id'])) {
  $lien = 'Se déconnecter';
} else {
  $lien = 'Se connecter';
}

// Affichage du profil
if(isset($_SESSION['id'])) {
  $profil = false;
} else {
  $profil = 'S\'inscrire';
}

?>
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
              <img src="asset/img/bootstrap-logo.svg" width="38" height="30" class="d-inline-block align-top" alt="Bootstrap" loading="lazy">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link <?php if($title === 'Accueil') {echo "active";} ?>" aria-current="page" href="/index.php">Acceuil</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link <?= $lien_inscription ?> "><?= $profil ?></a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link <?= $lien_connexion ?> "><?= $lien ?></a>
                </li>
              </ul>
            </div>
        </div>
    </nav>
</div>