<?php
namespace App;

class Validator
{
    /**
     * Vérifie si une chaîne ressemble à une IP v4 valide.
     * Cette méthode est STATIQUE (mot clé static).
     * On l'appelle directement par la Classe, pas par un objet.
     */
    public static function isIpValid(string $ip): bool
    {
        // filter_var est une fonction native de PHP très puissante pour la sécurité
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return true;
        } else {
            return false;
        }
    }


    public static function verifieNbPorts(int $nbPorts): void
    {
        // Petit rappel de la Séance 2 : Validation !
        if ($nbPorts < 1 || $nbPorts > 65535) {
            throw new \Exception("SERVICE : Le port $nbPorts est invalide.");
        }
    }

    /**
     * Vérifie si une chaîne ressemble à un nom d'hôte.
     * Cette méthode est STATIQUE (mot clé static).
     * On l'appelle directement par la Classe, pas par un objet.
     */
    public static function isHostnameValid(string $hostname): bool
    {
        return preg_match('/^[a-zA-Z0-9-]+$/',$hostname);
    }
public static function isPrinterTypeValid(string $type): bool{
        $imprimanteVerif=["Laser", "Jet d’encre", "Thermique", "Matricielle"];
        return in_array($type,$imprimanteVerif);

}

    public static function isOsSupported(string $os): bool {
        $listeOS=["Debian 12","Debian", "Ubuntu 24.04", "Windows Server 2022", "RedHat 9"];
        return in_array($os,$listeOS);
}
}


