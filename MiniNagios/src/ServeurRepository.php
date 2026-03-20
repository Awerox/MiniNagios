<?php
namespace App;

class ServeurRepository
{
    private \PDO $pdo;

    // Injection de dépendance : Le repository a besoin de PDO pour fonctionner
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function listerTous(): array
    {
        $sql = "SELECT * FROM serveurs ORDER BY date_creation DESC";


        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Sauvegarde un objet Serveur dans la base de données
     */
    public function sauvegarder(Serveur $serveur): void
    {
        // 1. Préparation de la requête (CYBERSÉCURITÉ : Les "?" empêchent l'injection SQL)
        $sql = "INSERT INTO serveurs (hostname, ip, os) VALUES (:hostname, :ip, :os)";
        $stmt = $this->pdo->prepare($sql);

        // 2. Exécution en remplaçant les "trous" par les vraies valeurs de l'objet
        // Nous utilisons les getters de l'objet Serveur (Il faudra les créer !)
        $stmt->execute([
            'hostname' => $serveur->getHostname(),
            'ip'       => $serveur->getIp(),
            'os'       => $serveur->getOs()
        ]);
    }
    public function supprimerParId(int $id): void{
        $sql = "DELETE FROM serveurs WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'id' => $id
        ]);
    }
}