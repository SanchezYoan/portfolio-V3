<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ContactControllerTest extends WebTestCase
{
    public function testContactPageIsAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/contact');

        self::assertResponseIsSuccessful();
    }

    public function testContactPageContainsForm(): void
    {
        $client = static::createClient();
        $client->request('GET', '/contact');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('#vue-page');
    }
}
