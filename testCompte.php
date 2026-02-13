<?php
class CompteBancaire {
    private $solde = 1000; // Privé ! Personne ne doit le modifier directement

    public function retirerArgent($montant) {
        if ($montant <= $this->solde) {
            $this->solde -= $montant;
            echo "Retrait OK. Nouveau solde : " . $this->solde;
        } else {
            echo "Erreur : Fonds insuffisants !";
        }
    }
}

$compte = new CompteBancaire();
//$compte->solde = 5000000; // ERREUR FATALE ! Impossible d'accéder à une propriété privée
$compte->retirerArgent(100); // OK, on passe par la porte d'entrée officielle (Méthode publique)