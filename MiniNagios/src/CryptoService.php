<?php
namespace App;

class CryptoService
{
    private $clePubliqueRsa;

    public function __construct()
    {
        $cheminCle = __DIR__ . '/../config/public_key.pem';

        // Vérification 1 : Est-ce que le fichier existe ?
        if (!file_exists($cheminCle)) {
            throw new \Exception("ERREUR CRYPTO : Le fichier public_key.pem est introuvable à l'adresse : " . $cheminCle);
        }

        $contenu = file_get_contents($cheminCle);

        // Vérification 2 : Est-ce que la clé est exploitable par OpenSSL ?
        $this->clePubliqueRsa = openssl_pkey_get_public($contenu);

        if (!$this->clePubliqueRsa) {
            throw new \Exception("ERREUR CRYPTO : La clé publique RSA n'est pas valide (format incorrect).");
        }
    }

    /**
     * Chiffre une donnée avec une méthode hybride (AES + RSA)
     */
    public function chiffrerSensible(string $donneeClaire): string
    {
        // 1. Générer une clé AES aléatoire
        $cleAes = openssl_random_pseudo_bytes(32);

        // 2. Générer un IV
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

        // 3. Chiffrer la donnée avec AES
        $donneeChiffree = openssl_encrypt($donneeClaire, 'aes-256-cbc', $cleAes, 0, $iv);

        // 4. Chiffrer la clé AES avec RSA
        // On vérifie si le chiffrement réussit
        $succes = openssl_public_encrypt($cleAes, $cleAesChiffreeRsa, $this->clePubliqueRsa);

        if (!$succes) {
            // Récupère l'erreur OpenSSL précise si ça échoue
            $erreur = openssl_error_string();
            throw new \Exception("ERREUR RSA : Échec du chiffrement de la clé AES. Détail : " . $erreur);
        }

        // 5. Assemblage du JSON
        $enveloppe = [
            'iv'   => base64_encode($iv),
            'key'  => base64_encode($cleAesChiffreeRsa),
            'data' => $donneeChiffree
        ];

        return json_encode($enveloppe);
    }
}