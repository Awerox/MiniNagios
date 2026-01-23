<?php
namespace App;

// "extends" signifie que Serveur hérite de tout ce que possède EquipementReseau
class Serveur extends EquipementReseau
{
    private string $os; // Attribut spécifique au Serveur

    public function __construct(string $hostname, string $ip, string $os)
    {
        // On appelle d'abord le constructeur du parent pour gérer IP et Hostname
        parent::__construct($hostname, $ip);

        // Puis on gère la spécificité du Serveur
        $this->os = $os;
    }

    // On surcharge (réécrit) la méthode d'affichage pour ajouter l'OS
    public function afficherStatut(): string
    {
        // On récupère le texte du parent et on ajoute l'OS
        return parent::afficherStatut() . " | OS : $this->os";
    }
}