<?php
namespace App;

class Database
{
    // Méthode statique car on a juste besoin de l'outil de connexion
    public static function getConnection(): \PDO
    {
        $host = '127.0.0.1';
        $dbname = 'mininagios';
        $user = 'root'; // Adaptez selon votre configuration locale
        $pass = '';     // Adaptez selon votre configuration locale

        try {
            // Le DSN (Data Source Name)
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

            // Options de sécurité et de gestion d'erreurs
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, // Lève des Exceptions en cas d'erreur SQL
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // Retourne des tableaux associatifs
            ];

            return new \PDO($dsn, $user, $pass, $options);

        } catch (\PDOException $e) {
            // Si la BDD est inaccessible, on arrête tout proprement
            throw new \Exception("ERREUR CRITIQUE : Impossible de se connecter à la base de données.");
        }
    }
}