<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ProfilControllerTest extends WebTestCase
{
    public function testProfilRequiresAuthentication(): void
    {
        $client = static::createClient();
        $client->request('GET', '/profil');

        // Doit rediriger vers la page de login
        self::assertResponseRedirects('/login');
    }
}
