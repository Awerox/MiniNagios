<?php
require '../vendor/autoload.php';

use App\Serveur;
use App\CryptoService;
use App\ServeurRepository;
use App\Database;

// Protection de session
App\Securite::verifierConnexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom  = $_POST['hostname'] ?? '';
    $ip   = $_POST['ip'] ?? '';
    $os   = $_POST['os'] ?? '';
    $pass = $_POST['root_pass'] ?? '';

    try {
        // 1. Instanciation du serveur
        $nouveauServeur = new Serveur($nom, $ip, $os);

        // 2. Chiffrement Sensible (Hybride)
        // INSTANCE de CryptoService
        $crypto = new CryptoService();

        // CHIFFREMENT du mot de passe saisi
        $mdpChiffre = $crypto->chiffrerSensible($pass);

        // 3. Attribution du mot de passe chiffré à l'objet Serveur
        $nouveauServeur->setRootPasswordHybride($mdpChiffre);

        // 4. Persistance en base de données via le Repository
        $pdo = Database::getConnection();
        $repo = new ServeurRepository($pdo);
        $repo->sauvegarder($nouveauServeur);

        // Redirection vers le dashboard avec message de succès
        header("Location: dashboard.php?success=1");
        exit();

    } catch (\Exception $e) {
        die("Erreur critique lors de l'enregistrement : " . $e->getMessage());
    }

} else {
    header("Location: ajouter_machine.php");
    exit();
}