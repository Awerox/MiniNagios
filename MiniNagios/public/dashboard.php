<?php
require '../vendor/autoload.php';

use App\ServeurRepository ;
use App\Database;
$monPDO = \App\Database::getConnection() ;
$monRepository = new ServeurRepository($monPDO) ;
$monTableauServeurs = $monRepository->listerTous() ;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord - Mini-Nagios</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 8px 15px; text-decoration: none; color: white; background: #007bff; border-radius: 4px; }
        .btn-danger { background: #dc3545; }
    </style>
</head>
<body>
<h1>🖥️ Dashboard Serveurs</h1>

<?php if (isset($_GET['success'])): ?>
    <div style="color: green; margin-bottom: 15px;">✅ Opération réussie !</div>
<?php endif; ?>

<a href="ajouter_machine.php" class="btn">➕ Ajouter un serveur</a> <table>
    <thead>
    <tr>
        <th>Hostname</th>
        <th>IP</th>
        <th>OS</th>
        <th>Date d'ajout</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($monTableauServeurs as $srv): ?>
        <tr>
            <td><?= htmlspecialchars($srv['hostname']) ?></td>
            <td><?= htmlspecialchars($srv['ip']) ?></td>
            <td><?= htmlspecialchars($srv['os']) ?></td>
            <td><?= htmlspecialchars($srv['date_creation']) ?></td>
            <td>
                <a href="supprimer.php?id=<?= $srv['id'] ?>"
                   class="btn btn-danger"
                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce serveur ?');">
                    🗑️ Supprimer
                </a> </td>
        </tr>
    <?php endforeach; ?>

    <?php if(empty($serveurs)): ?>
        <tr><td colspan="6" style="text-align:center;">Aucun serveur enregistré.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
</body>