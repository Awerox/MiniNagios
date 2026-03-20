<?php
namespace App;

class Serveur extends EquipementReseau
{
    private string $os;
    private bool $maintenance = false;
    private array $services = [];

    // NOUVEAU : Stockage du hash hybride
    private ?string $rootPasswordHybride = null;

    public function __construct(string $hostname, string $ip, string $os)
    {
        parent::__construct($hostname, $ip);
        if (!Validator::isOsSupported($os)) {
            throw new \Exception("ERREUR DE CONFIGURATION OS : L'os '$os' n'est pas valide !");
        }
        $this->os = $os;
    }

    // NOUVEAU : Accesseurs pour le mot de passe chiffré
    public function setRootPasswordHybride(string $password): void {
        $this->rootPasswordHybride = $password;
    }

    public function getRootPasswordHybride(): ?string {
        return $this->rootPasswordHybride;
    }

    public function getOs(): string {
        return $this->os;
    }

    public function ajouterService(Service $service): void {
        $this->services[] = $service;
    }

    public function verifierSante(): string {
        foreach($this->services as $service) {
            if (! $service->estDemarre() && $service->estCritique()) {
                return "<span style='color:red'>DANGER </span>";
            }
        }
        return "<span style='color:green'>OK </span>";
    }

    public function afficherStatut(): string {
        $html = parent::afficherStatut() . " | OS : $this->os <br>";
        if ($this->maintenance) {
            $html .= "Le serveur est maintenant en maintenance 🚧";
        }
        return $html;
    }

    public function activerMaintenance(): void {
        $this->maintenance = true;
    }
}