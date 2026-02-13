<?php
// 1. DÉFINITION DU PLAN (CLASSE)
class Voiture {
    public $couleur; // Attribut (Caractéristique)

    public function klaxonner() { // Méthode (Action)
        echo "Tut tut ! Je suis une voiture " . $this->couleur . "<br>\n";
    }
}

// 2. CRÉATION DES OBJETS (INSTANCIATION)
$peugeot = new Voiture(); // On crée une instance
$peugeot->couleur = "Rouge";

$ferrari = new Voiture(); // On crée une autre instance
$ferrari->couleur = "Jaune";

// 3. UTILISATION
$peugeot->klaxonner(); // Affiche : Tut tut ! Je suis une voiture Rouge
$ferrari->klaxonner(); // Affiche : Tut tut ! Je suis une voiture Jaune