<?php

// cette fonction permet de générer tous les jours du mois, de les stocker dans un tableau
// et de retourner celui-ci pour être utiliser plutard
function add_jour () {
    $resultat = array();
    for ($t = 1; $t <= 31; $t++) {
        array_push($resultat, $t);
    }

    return $resultat;

}

// cette fonction permet de générer tous les mois de l'année
function add_mois () {
    $result = [
        "Janvier",
        "Fevrier",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Août",
        "Septembre",
        "Octobre",
        "Novembre",
        "Decembre"
    ];

    for ($i = 0; $i <= 11; $i++) {
        $fin = "<option value='$i'>$result[$i]</option>";
        echo $fin;
    }
}


// cette fonction permet de générer tous les date de 1970 à 2000, de les stocker dans un tableau
// et de retourner celui-ci pour être utiliser plutard
function add_annee () {
    $resultat = array();
    for ($t = 1970; $t <= 2005; $t++) {
        array_push($resultat, $t);
    }

    return $resultat;

}

// cette fonction permet de générer toutes les regions de la Côte d'ivoire
function add_region () {
    $result = [
        "Agnéby-Tiassa",
        "Bafing",
        "Bagoué",
        "Bélier",
        "Béré",
        "Boukani",
        "Cavally",
        "Folon",
        "Gbêkê",
        "Gbôklé",
        "Gôh",
        "Gontougo",
        "Grands-Ponts",
        "Guémon",
        "Hambol",
        "haut-Sassandra",
        "iffou",
        "Indénié-Djuablin",
        "Kabadougou",
        "La mé",
        "Lôh-Djiboua",
        "Marahoué",
        "Moronou",
        "Nawa",
        "N'Zi",
        "Poro",
        "San-Pédro",
        "Sud-Comoé",
        "Tchologo",
        "Tonkpi",
        "Worodougou",
        "Abidjan",
        "Yamoussoukro"
    ];

    foreach ($result as $resultat) {
        $fin = "<option value='$resultat'>$resultat</option>";
        echo $fin;
    }
}

// cette fonction permet de générer toutes les ville de la Côte d'ivoire
function add_ville () {
    $result = [
        "Sassandra",
        "Soubré",
        "San-Pédro",
        "Abengourou",
        "Aboisso",
        "Minignan",
        "Odiéné",
        "gagnoa",
        "Divo",
        "Yamoussoukro",
        "Daoukro",
        "Bongouanou",
        "Dimbokro",
        "Agboville",
        "Dabou",
        "Adzopé",
        "Man",
        "Daloa",
        "Bouaflé",
        "Boundiali",
        "Korhogo",
        "Ferkéssédougou",
        "Bouaké",
        "Katiola",
        "Mankono",
        "Touba",
        "Séguéla",
        "Bouna",
        "Bondoukrou",
        "Abidjan"
    ];

    foreach ($result as $resultat) {
        $fin = "<option value='$resultat'>$resultat</option>";
        echo $fin;
    }
}

function non_inscrit () {
    echo "<div class='alert alert-danger'>Le mail ou le mot de passe est incorrect</div>";
}

function alert_email() {
    echo "<div class='alert alert-danger'>Cette adresse mail existe déjà</div>";
}

function alert_wrong_mail () {
    echo "<div class='alert alert-danger'>Cette adresse mail existe déjà</div>";
}

function alert_wrong_mail_deux () {
    echo "<div class='alert alert-danger'>L'adresse ou le mot de passe ne correspond pas</div>";
}

function alert_password() {
    echo "<div class='alert alert-danger'>Les mots de passe ne correspondent pas</div>";
}

function alert_pseudo() {
    echo "<div class='alert alert-danger'>Ce pseudo existe déjà</div>";
}