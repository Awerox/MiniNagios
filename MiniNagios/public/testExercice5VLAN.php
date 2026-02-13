<?php
// 1. Chargement automatique des classes (Grâce à Composer)
require '../vendor/autoload.php';

// 2. Importation des classes qu'on veut utiliser

use App\SwitchReseau ;




try {
    // ON ESSAYE (TRY) d'exécuter ce code dangereux

    $switch_apa = new SwitchReseau("Roso","172.32.50.12",24,8);
    #echo "<div style='background-color:#ffcccc; padding:10px; border:1px solid red; margin:10px;'>";
    echo $switch_apa->afficherStatut()."\n";
    #echo "</div>";
    $switch_fahhh = new SwitchReseau("Roso","172.32.50.12",24,7853201144444);
}
catch (Exception $e) {
    // SI UNE ERREUR SURVIENT, on tombe ici
    // $e contient les infos sur l'erreur
    echo "<div style='background-color:#ffcccc; padding:10px; border:1px solid red; margin:10px;'>";
    echo "<strong>🛑 ALERTE MATERIEL :</strong> " . $e->getMessage();
    echo "</div>";
}

