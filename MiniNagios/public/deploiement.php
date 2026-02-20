<?php

require "../vendor/autoload.php";

use App\Service;
use App\Serveur;

$serveurWeb = new Serveur("SRV-WEB-01", "192.168.1.1", "Debian");
$serviceApache = new Service("Apache", 80);
$serviceSSH = new Service("SSH", 22);

$serveurWeb2 = new Serveur("SRV-DB-01", "192.168.1.2", "Windows");
$serviceMySQL = new Service("MySQL", 3306);
$serviceRDP = new Service("RDP", 3389);

$serviceApache->demarrer();
$serveurWeb->ajouterService($serviceApache);
$serveurWeb->ajouterService($serviceSSH);

$serviceMySQL->demarrer();
$serveurWeb2->ajouterService($serviceMySQL);
$serveurWeb2->ajouterService($serviceRDP);

echo $serveurWeb->afficherStatut();

echo $serveurWeb2->afficherStatut();