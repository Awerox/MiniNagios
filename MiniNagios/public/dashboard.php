<?php
require "../vendor/autoload.php";

use App\Database;
use App\ServeurRepository;

try {
    $pdo = Database::getConnection();
    $repository = new ServeurRepository($pdo);
    $serveurs = $repository->listerTous();
} catch (\Exception $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - MiniNagios</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .btn { padding: 10px 15px; background: #4aa2e1; color: white; text-decoration: none; border-radius: 5px; }
        .success-msg { padding: 10px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; margin-bottom: 20px; border-radius: 5px; }
    </style>
</head>
<body>

<h1>🚀 Liste des Serveurs Surveillés</h1>

<?php if (isset($_GET['success'])): ?>
    <div class="success-msg">✅ Le serveur a été ajouté avec succès !</div>
<?php endif; ?>

<a href="ajouter_machine.php" class="btn">➕ Ajouter un nouveau serveur</a>

<table>
    <thead>
    <tr>
        <th>Hostname</th>
        <th>IP</th>
        <th>OS</th>
        <th>Date de création</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($serveurs)): ?>
        <tr>
            <td colspan="5" style="text-align: center;">Aucun serveur enregistré.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($serveurs as $s): ?>
            <tr>
                <td><strong><?= htmlspecialchars($s['hostname']) ?></strong></td>
                <td><code><?= htmlspecialchars($s['ip']) ?></code></td>
                <td><?= htmlspecialchars($s['os']) ?></td>
                <td><?= htmlspecialchars($s['date_creation']) ?></td>
                <td>
                    <a href="supprimer.php?id=<?= $s['id'] ?>"
                       style="color: #ff0000; text-decoration: none; font-weight: bold;"
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce serveur ?');">
                        ❌Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>

</body>
</html>