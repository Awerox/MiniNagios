<?php
namespace App;

class Routeur extends EquipementReseau
{
    private int $nbPorts;

    public function __construct(string $hostname, string $ip, int $nbPorts)
    {

        if ($nbPorts < 1 || $nbPorts > 128) {
            // Si le nombre de ^ports est trop petit ou trop grand
            throw new \Exception("ERREUR MATERIELLE : le nombre de ports n'est pas valide. Ici vous demandez $nbPorts pas correct.");
        }

        //  Appel du constructeur parent (qui va valider IP et Hostname)
        parent::__construct($hostname, $ip);

        //  Assignation
        $this->nbPorts = $nbPorts;
    }

    public function afficherStatut(): string
    {
        return parent::afficherStatut() . " | Ports : $this->nbPorts";
    }
}