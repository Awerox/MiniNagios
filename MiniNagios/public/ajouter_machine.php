<?php
require '../vendor/autoload.php';

// PROTECTION : Seul l'admin connecté peut voir ce formulaire
App\Securite::verifierConnexion();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provisionner un Serveur | MiniNagios</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0f172a;
            background-image: radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.1) 0px, transparent 50%);
            color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
        }
        .form-label { font-weight: 600; color: #94a3b8; margin-top: 1rem; font-size: 0.9rem; }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 10px;
            padding: 12px;
        }

        /* --- CORRECTION DES PLACEHOLDERS --- */
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6) !important; /* Blanc cassé transparent */
            font-style: italic;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.08);
            color: white;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .btn-submit {
            background-color: #3b82f6;
            border: none;
            padding: 14px;
            font-weight: 700;
            border-radius: 12px;
            margin-top: 2rem;
            box-shadow: 0 4px 14px rgba(59, 130, 246, 0.4);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="mb-4">
                <a href="dashboard.php" class="text-decoration-none text-muted small">← Retour au Dashboard</a>
            </div>
            <div class="card p-4 shadow-lg">
                <h2 class="h4 fw-bold mb-1 text-white">🏭 Provisionner un Serveur</h2>
                <p class="text-muted small mb-4">Stockage hybride des identifiants activé</p>

                <form method="POST" action="traitement.php">
                    <div class="mb-3">
                        <label class="form-label">Nom d'hôte (Hostname)</label>
                        <input type="text" name="hostname" class="form-control" required placeholder="SRV-WEB-01">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Adresse IP</label>
                        <input type="text" name="ip" class="form-control" required placeholder="192.168.1.10">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Système d'Exploitation</label>
                        <select name="os" class="form-select">
                            <option value="Debian 12">Debian 12</option>
                            <option value="Ubuntu 24.04">Ubuntu 24.04</option>
                            <option value="Windows Server 2022">Windows Server 2022</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mot de passe Root (🔒 Chiffré)</label>
                        <input type="password" name="root_pass" class="form-control" required placeholder="Tapez le mot de passe root">
                    </div>

                    <button type="submit" class="btn btn-primary btn-submit w-100">
                        🚀 Créer le serveur sécurisé
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>