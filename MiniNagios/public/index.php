<?php
// 1. Chargement automatique des classes (Grâce à Composer)
require '../vendor/autoload.php';

// 2. Importation des classes qu'on veut utiliser
use App\Serveur;
use App\Routeur;
use App\Imprimante;

// 3. Instanciation des objets
// On crée des objets concrets avec le mot clé "new"
$monServeurWeb = new Serveur("SRV-WEB-01", "192.168.1.10", "Debian 12");
$monServeurAD  = new Serveur("SRV-AD-01", "192.168.1.11", "Windows Server 2022");
$monRouteur    = new Routeur("RTR-CORE", "10.0.0.1", 24);
$monImprimante = new Imprimante(HP-Etage-1, "192.168.1.50","Laser",false);
$monImprimante2 = new Imprimante(Canon-Direction, "192.168.1.60","Laser",true);

// 4. Utilisation des objets
echo "<h1>Tableau de bord Mini-Nagios</h1>";

echo "<p>" . $monServeurWeb->afficherStatut() . "</p>";
echo "<p>" . $monServeurAD->afficherStatut() . "</p>";
echo "<p>" . $monRouteur->afficherStatut() . "</p>";
echo "<p>" . $monImprimante->afficherStatut() . "</p>";

// Debug pour voir la structure réelle de l'objet
echo "<pre>";
var_dump($monServeurWeb);
echo "</pre>";