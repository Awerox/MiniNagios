<?php
$erreur = isset($_GET['erreur']) || isset($_GET['error']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | MiniNagios</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --dark-bg: #0f172a;
        }

        body {
            background-color: var(--dark-bg);
            background-image:
                    radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.15) 0px, transparent 50%),
                    radial-gradient(at 100% 100%, rgba(37, 99, 235, 0.1) 0px, transparent 50%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        /* Formes décoratives en arrière-plan */
        .bg-shape {
            position: absolute;
            z-index: -1;
            filter: blur(80px);
            border-radius: 50%;
        }
        .shape-1 { width: 300px; height: 300px; background: #3b82f6; top: -100px; right: -100px; opacity: 0.2; }
        .shape-2 { width: 400px; height: 400px; background: #1d4ed8; bottom: -150px; left: -150px; opacity: 0.2; }

        .login-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            width: 100%;
            max-width: 420px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-header h4 {
            color: white;
            font-weight: 800;
            font-size: 1.8rem;
            letter-spacing: -1px;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .form-label {
            color: #cbd5e1;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 10px;
            display: block;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 25px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 14px 16px;
            color: white;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
            color: white;
        }

        .form-control::placeholder {
            color: #64748b;
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            margin-top: 10px;
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.4);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            padding: 12px;
            border-radius: 12px;
            font-size: 0.9rem;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            color: #64748b;
            font-size: 0.85rem;
        }

        /* Petit effet pulse sur l'icône de logo fictive */
        .logo-icon {
            width: 48px;
            height: 48px;
            background: var(--primary);
            border-radius: 12px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(59, 130, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }
    </style>
</head>
<body>

<div class="bg-shape shape-1"></div>
<div class="bg-shape shape-2"></div>

<div class="login-card">
    <div class="login-header">
        <div class="logo-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 16 16">
                <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
            </svg>
        </div>
        <h4>MiniNagios</h4>
        <p>Connexion</p>
    </div>

    <?php if ($erreur): ?>
        <div class="alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            Identifiants incorrects
        </div>
    <?php endif; ?>

    <form action="traitement_login.php" method="POST">
        <div class="input-group-custom">
            <label for="email" class="form-label">Identifiant</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required autofocus>
        </div>

        <div class="input-group-custom">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-primary">Connexion</button>
    </form>

    <p class="footer-text">
        &copy; 2026 MiniNagios<br>
        <span style="font-size: 0.7rem; opacity: 0.5;">BTS SIO SLAM : BtsSlam2026!</span>
    </p>
</div>

</body>
</html>