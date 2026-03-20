<?php
namespace App;

class EquipementReseau
{
    protected string $hostname;
    protected string $ip;

    public function __construct(string $hostname, string $ip)
    {
        // ÉTAPE 1 : Validation
        if (!Validator::isIpValid($ip)) {
            throw new \Exception("ERREUR DE SÉCURITÉ : L'IP '$ip' n'est pas valide !");
        }

        if (!Validator::isHostnameValid($hostname)) {
            throw new \Exception("ERREUR DE SÉCURITÉ : Le nom '$hostname' n'est pas valide !");
        }

        $this->hostname = $hostname;
        $this->ip = $ip;
    }

    // --- GETTERS (Un seul exemplaire de chaque !) ---

    public function getHostname(): string
    {
        return $this->hostname;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    // --- MÉTHODES D'ACTION ---

    public function afficherStatut(): string
    {
        return "Équipement : $this->hostname ($this->ip)";
    }
}