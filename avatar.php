<?php
session_start();
$title = 'Avatar';

include('db/connexiondb.php');

if(!empty($_POST)){
    extract($_POST);
    $valid = true;

    if(isset($_POST['avatar'])){

        if (isset($_FILES['file']) and !empty($_FILES['file']['name'])) {
            
            $filename = $_FILES['file']['tmp_name'];

            // Récupération des tailles de l'image
            list($width_orig, $height_orig) = getimagesize($filename);

            if($width_orig >= 500 && $height_orig >= 500 && $width_orig <= 6000 && $height_orig <= 6000){

                $listeExtension = array('jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');
                $listeExtensionIE = array('jpg' => 'image/pjpg', 'jpeg' => 'image/pjpeg');
                $tailleMax = 2097152; // Taille maximum 2 Mo
                // 2Mo = 2097152
                // 3Mo = 3145728
                // 4Mo = 4194304
                // 5Mo = 5242880
                // 7Mo = 7340032
                // 10Mo = 10485760
                // 12Mo = 12582912
                $extensionsValides = array('jpg','jpeg'); // Format accepté

                if ($_FILES['file']['size'] <= $tailleMax) { // Si le fichier est bien de taille inférieur ou égal à 5Mo

                    // Prend l'extension après le point, soit "jpg, jpeg ou png"
                    $extensionUpload = strtolower(substr(strrchr($_FILES['file']['name'], '.'), 1));

                    if (in_array($extensionUpload, $extensionsValides)){ // Vérifie que l'extension est correct
                        
                        $dossier = "public/avatars/" . $_SESSION['id'] . "/"; // On se place dans le dossier de la personne

                        if (!is_dir($dossier)) { // Si le nom du dossier n'existe pas alors on le crée
                            mkdir($dossier);
                        }else{ // Si le nom du dossier existe alors
                            if (file_exists("public/avatars/" . $_SESSION['id'] . "/" . $_SESSION['avatar']) && isset($_SESSION['avatar'])){
                                unlink("public/avatars/" . $_SESSION['id'] . "/" . $_SESSION['avatar']);
                            }
                        }

                        $nom = md5(uniqid(rand(), true)); // Permet de générer un nom unique pour la photo
                        $chemin = "public/avatars/" . $_SESSION['id'] . "/" . $nom . "." . $extensionUpload; // création du chemin pour stocker la photo
                        $resultat = move_uploaded_file($_FILES['file']['tmp_name'], $chemin); // On met la photo dans ce dossier

                        if ($resultat){ // Si on a le résultat alors on compresse l'image

                                //On vérifie si le fichier exite et est accessible en écriture
                            if (is_readable("public/avatars/" . $_SESSION['id'] . "/" . $nom . "." . $extensionUpload)){

                                $verif_ext = getimagesize("public/avatars/" . $_SESSION['id'] . "/" . $nom . "." . $extensionUpload);

                                // Vérification des extensions avec la liste des extensions autorisés
                                if ($verif_ext['mine'] === $listeExtension[$extensionUpload] || $verif_ext['mine'] == $listeExtension[$extensionUpload]){

                                    // j'enregistre le chemin et le nom de l'image dans filename
                                    $filename = "public/avatars/" . $_SESSION['id'] . "/" . $nom . "." . $extensionUpload;

                                    // Vérification des extensions que je souhaite prendre
                                    if ($extensionUpload === 'jpg' || $extensionUpload == 'jpeg' || $extensionUpload === 'pjpg' || $extensionUpload == 'pjpeg'){

                                        $image2 = imagecreatefromjpeg($filename);

                                    }

                                    // Définition de la largeur et de la hauteur maximale
                                    $width2 = 500;
                                    $height2 = 500;

                                    list($width_orig, $height_orig) = getimagesize($filename);

                                    // Redimensionnement
                                    $image_p2 = imagecreatetruecolor($width2, $height2);
                                    imagealphablending($image_p2, false);
                                    imagesavealpha($image_p2, true);

                                    // Calcul des nouvelles dimensions
                                    $point2 = 0;
                                    $ratio = null;

                                    if($width_orig <= $height_orig){
                                        $ratio = $width2 / $width_orig;
                                    }elseif($width_orig > $height_orig){
                                        $ratio = $height2 / $height_orig;
                                    }

                                    $width2 = ($width_orig * $ratio) + 1;
                                    $height2 = ($height_orig * $ratio) + 1;

                                    imagecopyresampled($image_p2, $image, 0, 0, $point2, 0, $width2, $height2, $width_orig, $height_orig);

                                    imagedestroy($image2);

                                    if($extensionUpload == 'jpg' || $extensionUpload == 'jpeg' || $extensionUpload == "pjpg" || $extensionUpload == 'pjpeg'){
                                        $image2 = imagecreatefromjpeg($filename);
                                    }

                                    // Définition de la largeur et de la hauteur maximale
                                    $width2 = 500;
                                    $height2 = 500;

                                    list($width_orig, $height_orig) = getimagesize($filename);

                                    // Redimensionnement
                                    $image_p2 = imagecreatetruecolor($width2, $height2);

                                    imagealphablending($image_p2, false);
                                    imagesavealpha($image_p2, true);

                                    // Calcul des nouvelles dimensions
                                    $point2 = 0;
                                    $ratio = null;
                                    if($width_orig <= $height_orig){
                                        $ratio = $width2 / $width_orig;
                                    }elseif($width_orig > $height_orig){
                                        $ratio = $height2 / $height_orig;
                                    }

                                    $width2 = ($width_orig * $ratio) + 1;
                                    $height2 = ($height_orig * $ratio) + 1;

                                    imagecopyresampled($image_p2, $image2, 0, 0, $point2, 0, $width2, $height2 , $width_orig, $height_orig);

                                    imagedestroy($image2);

                                    if($extensionUpload == 'jpg' || $extensionUpload == 'jpeg' || $extensionUpload == "pjpg" || $extensionUpload == 'pjpeg'){

                                        // Content type
                                        header('Content-Type: image/jpeg');

                                        $exif = exif_read_data($filename);
                                        if(!empty($exif['Orientation'])) {
                                            switch($exif['Orientation']) {
                                                case 8:
                                                    $image_p2 = imagerotate($image_p2,90,0);
                                                break;
                                                case 3:
                                                    $image_p2 = imagerotate($image_p2,180,0);
                                                break;
                                                case 6:
                                                    $image_p2 = imagerotate($image_p2,-90,0);
                                                break;
                                            }
                                        }
                                    }
                                    // Affichage
                                    imagejpeg($image_p2, "public/avatars/" . $_SESSION['id'] . "/" . $nom . "." . $extensionUpload, 75);
                                    imagedestroy($image_p2);
                                } 

                                $DB->insert("UPDATE utilisateur SET avatar = ? WHERE id = ?", array(($nom . "." . $extensionUpload), $_SESSION['id']));

                                $_SESSION['avatar'] = ($nom . "." . $extensionUpload); // On met à jour l'avatar

                                // $_SESSION['flash']['success'] = "Nouvel avatar enregistré !";
                                header('Location: profil');
                                exit;

                                ////////////////FIN DE COMPRESSION DE L'IMAGE ENREGISTREE////////////////////

                            }else{
                                $_SESSION['flash']['warning'] = "Le type MIME de l'image n'est pas bon";
                            }
                        }
                    }else
                        $_SESSION['flash']['error'] = "Erreur lors de l'importation de votre photo.";
                }else
                    $_SESSION['flash']['warning'] = "Votre photo doit être au bon format jpg.";
            }else
                $_SESSION['flash']['warning'] = "Votre photo de profil ne doit pas dépasser 5 Mo !";
        }else
            $_SESSION['flash']['warning'] = "Dimension de l'image minimum 400 x 400 et maximum 6000 x 6000 !";
    }else
        $_SESSION['flash']['warning'] = "Veuillez mettre une image !";
}elseif(isset($_POST['dltav'])){

    // Permet de supprimer une image dans un dossier
    if(file_exists("public/avatars/" . $_SESSION['id'] . "/" . $_SESSION['avatar']) && isset($_SESSION['avatar'])){
        
        unlink("public/avatars/" . $_SESSION['id'] . "/" . $_SESSION['avatar']);
        rmdir("public/avatars/" . $_SESSION['id'] . "/");

        $DB->insert("UPDATE utilisateur SET avatar = ? WHERE id = ?", array(NULL, $_SESSION['id']));

            $_SESSION['avatar'] = NULL; // On met à jour l'avatar
    }

    $_SESSION['flash']['success'] = "Votre avatar a été supprimé !";
    header('Location: profil');
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
    <?php include('menu.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-0 col-md-2 col-lg-3"></div>
            <div class="col-sm-12 col-md-8 col-lg-6">
            <br>
            <div style="background-color: white; padding: 15px 10px; margin-top: 20px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); border-radius: 10px">
                <div style="margin: 20px 0;">
                        <?php
                            if(file_exists("public/avatars/" . $_SESSION['id'] . "/" . $_SESSION['avatar']) && isset($_SESSION['avatar'])){
                        ?>
                            <img src="<?= "public/avatars/" . $_SESSION['id'] . "/" . $_SESSION['avatar']; ?> " width="120" class="sz-image"/>
                        <?php
                            }else{
                        ?>
                            <img src="public/avatars/defaults/default.png"  width="120" class="sz-image"/>
                        <?php
                            }
                        ?>
                    <span class="image-upload">
                        <form action="" method="post" enctype="multipart/form-data">
                            <label for="file" style="margin-bottom: 0px; margin-top: 5px; display:inline-flex">
                                <input type="file" name="file" id="file" class="hide-upload" required/>
                                <i class="fa fa-plus image-plus"></i>
                                <input type="submit" value="Envoyer" name="avatar" class="fa send-upload">
                            </label>      
                        </form>
                    </span>
                    
                    <div style="border-top: 2px solid #ccc; margin-top: 20px; padding-top: 20px">
                        <form action="" method="post">
                            <label><b>Suprimer l'avatar</b></label>
                            <input type="submit" value="Suprimer" name="dltav" class="fa trash-avatar">
                        </form>
                    </div>
                    <br>
                    <div>
                        <a href="/profil" style="text-decoration: none;">< Retour</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.js"></script>
</body>
</html>