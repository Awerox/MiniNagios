<?php
namespace App;

class Routeur extends EquipementReseau
{
    private int $nbPorts;

    public function __construct(string $hostname, string $ip, int $nbPorts)
    {
        parent::__construct($hostname, $ip);
        $this->nbPorts = $nbPorts;
    }

    public function afficherStatut(): string
    {
        return parent::afficherStatut() . " | Ports : $this->nbPorts";
    }
}