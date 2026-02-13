<?php
namespace App; // On déclare que cette classe appartient à l'espace de nom "App"

class EquipementReseau
{
    // ATTRIBUTS : Les caractéristiques de l'objet
    // Visibilité "protected" : accessible par la classe elle-même ET ses enfants (héritage)
    // Nous n'utilisons pas "public" pour respecter l'ENCAPSULATION.
    protected string $hostname;
    protected string $ip;

    // CONSTRUCTEUR : La méthode appelée automatiquement à la création (new)
    // C'est ici qu'on force la cohérence de l'objet.
    // Pas de setter ! Un équipement DOIT avoir une IP dès sa naissance.
    public function __construct(string $hostname, string $ip)
    {

        // ÉTAPE 1 : Validation défensive
        // Avant même d'assigner quoi que ce soit, on vérifie !
        if (!Validator::isIpValid($ip)) {

            // Si l'IP est pourrie, on lance une Exception (une erreur fatale contrôlée)
            throw new \Exception("ERREUR DE SÉCURITÉ : L'IP '$ip' n'est pas valide !");
        }

        if (!Validator::isHostnameValid($hostname)) {
            // Si l'IP est pourrie, on lance une Exception (une erreur fatale contrôlée)
            throw new \Exception("ERREUR DE SÉCURITÉ : Le nom '$hostname' n'est pas valide !");
        }





        $this->hostname = $hostname;
        $this->ip = $ip;
    }

    // MÉTHODE : Une action que l'objet peut faire
    public function afficherStatut(): string
    {
        return "Équipement : $this->hostname ($this->ip)";
    }
}