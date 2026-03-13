<?php
require '../vendor/autoload.php';
use App\Serveur;
use App\Service ;

$monServeurWeb = new Serveur("SRV-WEB-01", "10.0.210.3", "Debian 12");

$serviceApache = new Service("Apache", 80, true) ;
$serviceSSH = new Service("SSH", 22, false) ;
$serviceApache->demarrer();
$monServeurWeb->ajouterService($serviceApache)  ;
$monServeurWeb->ajouterService($serviceSSH)  ;
echo $monServeurWeb->afficherStatut() ;
