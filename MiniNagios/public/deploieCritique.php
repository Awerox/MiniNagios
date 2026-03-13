<?php
require "../vendor/autoload.php";

use App\Service;
use App\Serveur;

$serveurWeb = new Serveur("SRV-WEB-01", "192.168.1.1", "Debian");
$serviceApache = new Service("Apache", 80, true);
$serviceSSH = new Service("SSH", 22, false);

$serviceApache->demarrer();
$serveurWeb->ajouterService($serviceApache);
$serveurWeb->ajouterService($serviceSSH);

echo "Vérification statut: <BR>" ;
echo $serveurWeb->afficherStatut();
echo "<BR> Vérification Santé: <BR>" ;
echo $serveurWeb->verifierSante() ;


$serviceApache->arreter();
echo "Vérification statut: <BR>" ;
echo $serveurWeb->afficherStatut();
echo "<BR> Vérification Santé: <BR>" ;

echo $serveurWeb->verifierSante() ;

echo "<BR>" ;