<?php
// 1. Chargement automatique des classes (Grâce à Composer)
require '../vendor/autoload.php';

// 2. Importation des classes qu'on veut utiliser

use App\Imprimante ;




try {
    // ON ESSAYE (TRY) d'exécuter ce code dangereux

    $imprimpe3D = new Imprimante("Laser",false,"192.168.1.23","HP-Etage-1" );
    echo "<div style='background-color:#ffcccc; padding:10px; border:1px solid red; margin:10px;'>";
    echo $imprimpe3D->afficherStatut();
    echo "</div>";

}
catch (Exception $e) {
    // SI UNE ERREUR SURVIENT, on tombe ici
    // $e contient les infos sur l'erreur
    echo "<div style='background-color:#ffcccc; padding:10px; border:1px solid red; margin:10px;'>";
    echo "<strong>🛑 ALERTE MATERIEL :</strong> " . $e->getMessage();
    echo "</div>";
}

