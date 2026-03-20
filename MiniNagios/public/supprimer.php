<?php
require "../vendor/autoload.php";

use App\Database;
use App\ServeurRepository;

// 1. On récupère l'ID depuis l'URL (ex: supprimer.php?id=5)
$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $pdo = Database::getConnection();
        $repository = new ServeurRepository($pdo);

        // 2. Appel de votre nouvelle méthode
        $repository->supprimerParId((int)$id);

        // 3. Redirection vers le dashboard avec un message de confirmation
        header('Location: dashboard.php');
        exit;
    } catch (\Exception $e) {
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
} else {
    die("ID invalide.");
}