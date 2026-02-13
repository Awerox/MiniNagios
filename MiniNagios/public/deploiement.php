<?php

require "../vendor/autoload.php";

use App\Service;
use App\Serveur;

$serveurWeb = new Serveur("SRV-WEB-01", "192.168.1.1", "Debian");
$serviceApache = new Service("Apache", 80);
$serviceSSH = new Service("SSH", 22);

$serviceApache->demarrer();
$serveurWeb->ajouterService($serviceApache);
$serveurWeb->ajouterService($serviceSSH);

echo $serveurWeb->afficherStatut();