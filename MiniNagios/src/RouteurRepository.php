<?php

namespace App;

class RouteurRepository
{
    private \PDO $pdo;

    // Injection de dépendance : Le repository a besoin de PDO pour fonctionner
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Sauvegarde un objet Serveur dans la base de données
     */
    public function sauvegarder(Routeur $routeur): void
    {
        // 1. Préparation de la requête (CYBERSÉCURITÉ : Les "?" empêchent l'injection SQL)
        $sql = "INSERT INTO routeurs (hostname, ip, nbports) VALUES (:hostname, :ip, :nbports)";
        $stmt = $this->pdo->prepare($sql);

        // 2. Exécution en remplaçant les "trous" par les vraies valeurs de l'objet
        // Nous utilisons les getters de l'objet Serveur (Il faudra les créer !)
        $stmt->execute([
            'hostname' => $routeur->getHostname(),
            'ip' => $routeur->getIp(),
            'nbports' => $routeur->getNbports()
        ]);
    }

    public function listerTous(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM serveurs");
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $montableau = $stmt->fetchAll();
        // print_r($montableau);
        return $montableau;
    }

    public function supprimerParId(int $id): void
    {
        $sql = "DELETE FROM serveurs WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

}