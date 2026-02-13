<?php
class Vehicule {
    public function demarrer() {
        echo "Vroum ! Le moteur tourne.<br>\n";
    }
}

class Moto extends  Vehicule { // "extends" = Hérite de
    public function faireWheeling() {
        echo "La moto se lève sur la roue arrière !<br>";
    }
}

$maMoto = new Moto();
$maMoto->demarrer();      // Fonctionne ! (Hérité du parent)
$maMoto->faireWheeling(); // Fonctionne ! (Spécifique à la moto)