<?php
require '../vendor/autoload.php';

use App\Serveur;
use App\CryptoService;
use App\ServeurRepository;
use App\Database;

// Protection de session
App\Securite::verifierConnexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom  = $_POST['hostname'];
    $ip   = $_POST['ip'];
    $os   = $_POST['os'];
    $pass = $_POST['root_pass']; // Le mot de passe en clair saisi

    try {
        // 1. Instanciation du serveur
        $nouveauServeur = new Serveur($nom, $ip, $os);

        // 2. Chiffrement Sensible (Hybride)
        $crypto = new CryptoService();
        $mdpChiffre = $crypto->chiffrerSensible($pass);

        // 3. On donne le "charabia" à l'objet
        $nouveauServeur->setRootPasswordHybride($mdpChiffre);

        // 4. Persistance en base de données
        $pdo = Database::getConnection();
        $repo = new ServeurRepository($pdo);
        $repo->sauvegarder($nouveauServeur);

        // Redirection vers le dashboard avec succès
        header("Location: dashboard.php?success=1");
        exit();

    } catch (\Exception $e) {
        die("Erreur critique lors du provisionning : " . $e->getMessage());
    }

} else {
    header("Location: ajouter_machine.php");
    exit();
}