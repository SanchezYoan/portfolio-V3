<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ProjectControllerTest extends WebTestCase
{
    public function testProjectListIsAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/project');

        self::assertResponseIsSuccessful();
    }

    public function testProjectShowRedirectsOnInvalidId(): void
    {
        $client = static::createClient();
        $client->request('GET', '/project/99999');

        self::assertResponseStatusCodeSame(404);
    }
}
