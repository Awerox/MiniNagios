<?php
namespace App;

class Service
{
    private string $nom;
    private int $port;
    private bool $estDemarre; // État du service (Allumé/Éteint)

    private bool $estCritique=false;

    public function __construct(string $nom, int $port)
    {
        Validator::verifieNbPorts($port) ;
        $this->port = $port;


        $this->nom = $nom;
        $this->estDemarre = false; // Par défaut, un service est éteint


    }

    public function demarrer(): void
    {
        $this->estDemarre = true;
    }

    public function arreter(): void
    {
        $this->estDemarre = false;
    }

    public function getStatut(): string
    {
        // Retourne un bout de HTML (Rouge ou Vert)
        $couleur = $this->estDemarre ? "green" : "red";
        $etat    = $this->estDemarre ? "ON" : "OFF";

        return "<span style='color:$couleur'>[$this->nom : $etat : Port $this->port]</span>";
    }

public function estCritique(): bool {
        return $this->estCritique; }
public function estDemarre(): bool {
        return $this->estDemarre;
}
}