    <?php
    require '../vendor/autoload.php';

    // 1. PROTECTION : On vérifie que l'utilisateur est connecté
    // Si ce n'est pas le cas, la méthode redirigera vers login.php
    App\Securite::verifierConnexion();

    use App\ServeurRepository;
    use App\Database;

    // 2. LOGIQUE : Récupération des données
    $monPDO = \App\Database::getConnection();
    $monRepository = new ServeurRepository($monPDO);
    $monTableauServeurs = $monRepository->listerTous();
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau de Bord - MiniNagios</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body { background-color: #f8fafc; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
            .navbar { background-color: #1e293b; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
            .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
            .table thead { background-color: #f1f5f9; }
            .btn-add { background-color: #2563eb; color: white; transition: all 0.2s; }
            .btn-add:hover { background-color: #1d4ed8; color: white; transform: translateY(-1px); }
        </style>
    </head>
    <body>

    <nav class="navbar navbar-dark mb-4 p-3">
        <div class="container">
            <span class="navbar-brand d-flex align-items-center">
                <span class="me-2">🖥️</span> MiniNagios Dashboard
            </span>
            <div class="d-flex align-items-center">
                <span class="text-light opacity-75 me-3">Connecté en tant qu'administrateur</span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0 text-dark">Liste des serveurs surveillés</h2>
            <a href="ajouter_machine.php" class="btn btn-add">➕ Ajouter un serveur</a>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ Opération réussie !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th class="ps-4">Hostname</th>
                            <th>Adresse IP</th>
                            <th>Système d'exploitation</th>
                            <th>Date d'ajout</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(empty($monTableauServeurs)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    Aucun serveur enregistré dans la base de données.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($monTableauServeurs as $srv): ?>
                                <tr class="align-middle">
                                    <td class="ps-4 fw-bold text-primary"><?= htmlspecialchars($srv['hostname']) ?></td>
                                    <td><code class="bg-light px-2 py-1 rounded text-dark"><?= htmlspecialchars($srv['ip']) ?></code></td>
                                    <td>
                                        <span class="badge bg-secondary opacity-75"><?= htmlspecialchars($srv['os']) ?></span>
                                    </td>
                                    <td class="text-muted small"><?= htmlspecialchars($srv['date_creation']) ?></td>
                                    <td class="text-center">
                                        <a href="supprimer.php?id=<?= $srv['id'] ?>"
                                           class="btn btn-sm btn-outline-danger"
                                           onclick="return confirm('Supprimer définitivement ce serveur ?');">
                                            🗑️ Supprimer
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <footer class="mt-5 text-center text-muted small">
            &copy; 2026 MiniNagios
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>