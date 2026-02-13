<?php
require '../vendor/autoload.php';
use App\Routeur;

echo "<a href='ajouter_machine.php'>&larr; Retour au formulaire</a><hr>";

// Vérification de la méthode d'envoi
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Récupération des données
    $nom = $_POST['hostname'];
    $ip  = $_POST['ip'];
    $nbPorts  = $_POST['nbPorts'];

    echo "<h3>Résultat du montage de routeur :</h3>";

    // 2. Tentative de création (Code "Naïf")
    // ATTENTION : Si le constructeur lance une Exception, le script plantera ici !
    try {
        $nouveauRouteur = new Routeur($nom, $ip, $nbPorts);
        echo "<div style='color:green; border: 1px solid green; padding: 10px;'>";
        echo "✅ Succès ! <br>";
        echo $nouveauRouteur->afficherStatut();
        echo "</div>";
    }
    catch (\Exception $e) {
        echo "<div style='color:red; border: 1px solid red; padding: 10px;'>";
        echo "Problème avec le nombre de ports <br>";
        echo $e->getMessage();
        echo "</div>";
    }

    // Si tout va bien, on affiche le succès


} else {
    // Redirection si accès direct sans POST
    header("Location: ajouter_routeur.php");
    exit();
}