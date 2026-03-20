<?php
namespace App;

class Securite
{
    /**
     * Vérifie si l'utilisateur est connecté.
     * Si non, redirige immédiatement vers la page de connexion.
     */
    public static function verifierConnexion(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['admin_id'])) {
            header("Location: login.php");
            exit();
        }
    }
}