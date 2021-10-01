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
