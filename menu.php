<?php
$active = 'active';
$lien_connexion = 'href="/connexion.php"';
$lien_deconnexion = 'href="/deconnexion.php"';

if(isset($_SESSION['id'])){
  $lien_deconnexion .= $active . '" ' . $lien_deconnexion;
} else {
  $lien_connexion .= $active . '" ' . $lien_connexion;
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
                  <a class="nav-link <?php if($title === 'Inscription') {echo "active";} ?>" href="/inscription.php">S'inscrire</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link <?php if (isset($_SESSION['id'])) {echo $lien_deconnexion;} else {echo $lien_connexion;} ?>><?php if(isset($_SESSION['id'])) {echo 'Se déconnecter';} else {echo 'Se connecter';} ?></a>
                </li>
              </ul>
            </div>
        </div>
    </nav>
</div>