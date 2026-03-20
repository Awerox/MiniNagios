<?php
require '../vendor/autoload.php';

use App\Database;
// On commence par démarrer la session pour pouvoir stocker l'ID de l'admin plus tard
session_start();

// 1. Connexion à la base de données (À adapter selon vos paramètres de connexion)
$host = 'localhost';
$dbname = 'mininagios';
$user_db = 'root';
$pass_db = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user_db, $pass_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// 2. Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {

    $email = trim($_POST['email']);
    $password_saisi = $_POST['password'];

    // 3. Recherche de l'administrateur par son email
    $stmt = $pdo->prepare("SELECT id, password_hash FROM administrateurs WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 4. Vérification du mot de passe avec password_verify
    // Le hash $2y$12$... est automatiquement reconnu par cette fonction
    if ($user && password_verify($password_saisi, $user['password_hash'])) {

        // SUCCÈS : On régénère l'ID de session par sécurité (anti-fixation de session)
        session_regenerate_id();

        // Stockage des informations en session
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['email'] = $email;

        // Redirection vers le tableau de bord
        header('Location: dashboard.php');
        exit();

    } else {
        // ÉCHEC : Identifiants incorrects
        header('Location: login.php?erreur=1');
        exit();
    }

} else {
    // Si on tente d'accéder au fichier sans passer par le formulaire
    header('Location: login.php');
    exit();
}