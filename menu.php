<?php
$active = 'active';
$lien_connexion = '';
$lien = '';

if(isset($_SESSION['id'])){
  $lien_connexion .= $active . '" ' . 'href="/deconnexion.php"';
} elseif ($title = 'Connexion') {
  $lien_connexion .= $active . '" ' . 'href="/connexion.php"';
}else {
  $lien_connexion .= '" ' . 'href="/connexion.php"';
}

if(isset($_SESSION['id'])) {
  $lien = 'Se déconnecter';
} else {
  $lien = 'Se connecter';
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
                  <a class="nav-link <?= $lien_connexion ?> ><?= $lien ?></a>
                </li>
              </ul>
            </div>
        </div>
    </nav>
</div>