<?php
namespace App;

/**
 * Classe Serveur représentant un équipement réseau spécifique
 * Hérite de EquipementReseau
 */
class Serveur extends EquipementReseau
{
    private string $os;
    private bool $maintenance = false;
    private array $services = [];

    /**
     * Stockage du mot de passe chiffré (Format JSON hybride)
     * @var string|null
     */
    private ?string $rootPasswordHybride = null;

    /**
     * Constructeur de la classe Serveur
     */
    public function __construct(string $hostname, string $ip, string $os)
    {
        parent::__construct($hostname, $ip);

        // Validation de l'OS via le Validator
        if (!Validator::isOsSupported($os)) {
            throw new \Exception("ERREUR DE CONFIGURATION OS : L'os '$os' n'est pas valide !");
        }
        $this->os = $os;
    }

    // --- SECTION : CHIFFREMENT HYBRIDE ---

    /**
     * Définit le mot de passe root après chiffrement par CryptoService
     */
    public function setRootPasswordHybride(string $password): void {
        $this->rootPasswordHybride = $password;
    }

    /**
     * Récupère le hash hybride pour la sauvegarde en base de données
     */
    public function getRootPasswordHybride(): ?string {
        return $this->rootPasswordHybride;
    }

    // --- SECTION : GESTION DES SERVICES ---

    public function getOs(): string {
        return $this->os;
    }

    /**
     * Ajoute un service à surveiller sur ce serveur
     */
    public function ajouterService(Service $service): void {
        $this->services[] = $service;
    }

    /**
     * Méthode requise par les tests unitaires pour vérifier l'ajout de services
     */
    public function recupereServices(): array {
        return $this->services;
    }

    /**
     * Vérifie si un service critique est arrêté
     */
    public function verifierSante(): string {
        foreach($this->services as $service) {
            if (! $service->estDemarre() && $service->estCritique()) {
                return "<span style='color:red'>DANGER </span>";
            }
        }
        return "<span style='color:green'>OK </span>";
    }

    // --- SECTION : MAINTENANCE ET AFFICHAGE ---

    /**
     * Retourne les informations du serveur au format HTML
     */
    public function afficherStatut(): string {
        $html = parent::afficherStatut() . " | OS : $this->os <br>";
        if ($this->maintenance) {
            $html .= "Le serveur est maintenant en maintenance 🚧";
        }
        return $html;
    }

    /**
     * Active le mode maintenance sur le serveur
     */
    public function activerMaintenance(): void {
        $this->maintenance = true;
    }

    /**
     * Méthode requise par les tests unitaires pour vérifier l'état de la maintenance
     */
    public function enMaintenance(): bool {
        return $this->maintenance;
    }
}