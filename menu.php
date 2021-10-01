


<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
              <img src="asset/img/bootstrap-logo.svg" width="38" height="30" class="d-inline-block align-top" alt="Bootstrap" loading="lazy">
            </a>
            <div id="navbarSupportedContent2">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link <?php if($title === 'Acceuil') {echo "active";} ?>" aria-current="page" href="/index.php">Acceuil</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link <?php if($title === 'Inscription') {echo "active";} ?>" href="/inscription.php">S'inscrire</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link <?php if($title === 'Connexion') {echo "active";} ?>" href="/connexion.php">Se connecter</a>
                </li>
              </ul>
            </div>
        </div>
    </nav>
</div>