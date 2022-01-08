<?php

declare(strict_types=1);

namespace Tests\Project\Common\Infrastructure\Communication\Http\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function test_index(): void
    {
        $this->client->request('GET', '/');

        $jsonResponse = $this->client->getResponse();

        self::assertResponseIsSuccessful();
        self::assertJson($jsonResponse->getContent());
        self::assertTrue($jsonResponse->headers->contains('Content-Type', 'application/json'));
        self::assertSame(200, $jsonResponse->getStatusCode());
    }
}
