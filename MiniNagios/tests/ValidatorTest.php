<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Validator;

class ValidatorTest extends TestCase
{
    // Un test doit toujours commencer par le mot "test"
    public function testIpValide()
    {
        // Scénario : Je donne une IP correcte
        $resultat = Validator::isIpValid("192.168.1.1");

        // Assertion : Je m'attends à ce que ce soit VRAI (True)
        $this->assertTrue($resultat, "192.168.1.1 devrait être valide");
    }

    public function testIpInvalide()
    {
        // Scénario : Je donne n'importe quoi
        $resultat = Validator::isIpValid("Patate");

        // Assertion : Je m'attends à ce que ce soit FAUX (False)
        $this->assertFalse($resultat, "Patate ne devrait pas être une IP valide");
    }

    public function testIpVide()
    {
        $this->assertFalse(Validator::isIpValid(""), "Une IP vide doit échouer");
    }
}