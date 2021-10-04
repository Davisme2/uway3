<?php
$active = 'active';
$lien_connexion = '';
$lien = '';

// Si il y a une session ouverte alors afficher
if(isset($_SESSION['id'])){
  if ($title == 'Bienvenue') {
    $lien_connexion .= $active . '" ' . 'href="/deconnexion.php"';
  }
  if ($title !== 'Bienvenue') {
    $lien_connexion .= '" ' . 'href="/deconnexion.php"';
  }
}

// Si il y a une session ouverte et que le titre est Accueil alors afficher
if(isset($_SESSION['id']) && ($title !== 'Connexion')){
  $lien_connexion .= '" ' . 'href="/deconnexion.php"';
}

// Si il y a une session ouverte et que le titre de la page est Connexion alors afficher
if (!isset($_SESSION['id']) && $title == 'Connexion') {
  $lien_connexion .= $active . '" ' . 'href="/connexion.php';
}

// Si il y a une session ouverte et que le titre de la page est different alors afficher
if (!isset($_SESSION['id']) && $title !== 'Connexion') {
  $lien_connexion .= '" ' . 'href="/connexion.php';
}

// Affichage connecté ou déconnecté
if(isset($_SESSION['id'])) {
  $lien = 'Se déconnecter';
} else {
  $lien = 'Se connecter';
}

// Affichage du profil
if(isset($_SESSION['id'])) {
  $profil = 'Profil';
} else {
  $profil = 'S\'inscrire';
}

?>
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
              <img src="asset/img/bootstrap-logo.svg" width="38" height="30" class="d-inline-block align-top" alt="Bootstrap" loading="lazy">
            </a>
            <div id="navbarSupportedContent2">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link <?php if($title === 'Accueil') {echo "active";} ?>" aria-current="page" href="/index.php">Acceuil</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link <?php if($title === 'Bienvenue') {echo "active";} ?>" href="/inscription.php"><?= $profil ?></a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link <?= $lien_connexion ?> "><?= $lien ?></a>
                </li>
              </ul>
            </div>
        </div>
    </nav>
</div>