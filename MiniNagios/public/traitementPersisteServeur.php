<?php
require '../vendor/autoload.php';

use App\Serveur;
use App\Database;
use App\ServeurRepository;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['hostname'];
    $ip  = $_POST['ip'];
    $os  = $_POST['os'];

    try {
        // 1. Instanciation de l'objet (Le code va valider l'IP et l'OS tout seul !)
        $nouveauServeur = new Serveur($nom, $ip, $os);

        // 2. Connexion à la BDD
        $pdo = Database::getConnection();

        // 3. Création du Repository et Sauvegarde
        $repo = new ServeurRepository($pdo);
        $repo->sauvegarder($nouveauServeur);

        // 4. Redirection vers un tableau de bord en cas de succès
        header("Location: dashboard.php?success=1");
        exit();

    } catch (Exception $e) {
        // Affichage de l'erreur (IP invalide, OS interdit, ou BDD plantée)
        echo "<div style='color:red; border:1px solid red; padding:10px;'>";
        echo "Erreur : " . $e->getMessage();
        echo "</div>";
        echo "<br><a href='ajouter_machine.php'>Retour au formulaire</a>";
    }

} else {
    header("Location: ajouter_machine.php");
}