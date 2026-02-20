<?php
namespace MiniNagios\tests;

use App\Serveur;
use PHPUnit\Framework\TestCase;

class ServeurTest extends TestCase
{
    public function testModeMaintenance()
    {
        $srv = new Serveur("Test-Srv", "10.0.0.1", "Debian 12");

        // 1. Vérif par défaut
        $this->assertFalse($srv->enMaintenance());

        // 2. On active
        $srv->activerMaintenance();
        $this->assertTrue($srv->enMaintenance());

        // 3. On vérifie l'affichage
        // La fonction str_contains vérifie si le texte contient la balise
        $this->assertStringContainsString("🚧", $srv->afficherStatut());
    }

    public
}