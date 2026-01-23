<?php

namespace App;

class Imprimante extends EquipementReseau
{
    private string $type;
    private bool $estCouleur;

    public function __construct(string $hostname, string $ip, string $type, bool $estCouleur)
    {

        parent::__construct($hostname, $ip);
        $this->type = $type;
        $this->estCouleur = $estCouleur;
    }

    public function afficherStatut(): string
    {
            $couleurTexte = $this->estCouleur ? "OUI" : "NON";

        return parent::afficherStatut() . " | Type : $this->type | Type : $this->estCouleur";
    }

}