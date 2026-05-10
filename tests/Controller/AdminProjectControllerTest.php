<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AdminProjectControllerTest extends WebTestCase
{
    public function testAdminRequiresAuthentication(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin/project');

        // Doit rediriger vers la page de login
        self::assertResponseRedirects('/login');
    }
}
