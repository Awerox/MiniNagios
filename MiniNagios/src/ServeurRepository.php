<?php
namespace App;

class ServeurRepository
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Sauvegarde un objet Serveur en base de données
     */
    public function sauvegarder(Serveur $serveur): void
    {
        // AJOUT de root_password_hybride dans la requête SQL
        $sql = "INSERT INTO serveurs (hostname, ip, os, root_password_hybride) 
                VALUES (:hostname, :ip, :os, :root_pass)";

        $stmt = $this->pdo->prepare($sql);

        // Exécution avec les données de l'objet Serveur
        $stmt->execute([
            'hostname'  => $serveur->getHostname(),
            'ip'        => $serveur->getIp(),
            'os'        => $serveur->getOs(),
            'root_pass' => $serveur->getRootPasswordHybride() // Récupère le "charabia" chiffré
        ]);
    }

    public function listerTous(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM serveurs");
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public function supprimerParId(int $id): void {
        $sql = "DELETE FROM serveurs WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
}