<?php
namespace Tests;

use App\Service;
use PHPUnit\Framework\TestCase;
use App\Serveur;
use function PHPUnit\Framework\assertEquals;

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

    public function testAjoutService(){
        $srv = new Serveur("Test-Srv", "10.0.0.1", "Debian 12");
        $serviceWeb = new Service("Web-Service", 8080, false);
        $this>assertEquals(0, count($srv->recupereServices()));
        $srv->ajouterService($serviceWeb);
        $this>assertEquals(1, count($srv->recupereServices()));
        $this->assertContains($serviceWeb, $srv->recupereServices());

    }

    public function testAlerteRougeSiServiceCritiqueEteint() {
        $srv = new Serveur("Test-Srv", "10.0.0.1", "Debian 12");
        $serviceWeb = new Service("Web-Service", 8080, true);
        $srv->ajouterService($serviceWeb);
        $this->assertTrue(str_contains($srv->verifierSante(),"DANGER") );


    }


}