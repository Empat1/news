<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ApiTest extends ApiTestCase
{

    /**
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     */

    public function testNews(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/news');
        $this->assertResponseStatusCodeSame(401);
        $response = $client->withOptions([
            'headers' => ['x-auth-token' => 'apiToken1', 'content-type' => 'application/json; charset=utf-8'],
        ])->request('GET', '/api/news');
        $this->assertResponseStatusCodeSame(200);
        $resultArray = $response->toArray();
        $this->assertJson($response->getContent());
        $this->assertIsArray($resultArray);
    }

    /**
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     */

    public function testComments(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/comments');
        $this->assertResponseStatusCodeSame(401);
        $response = $client->withOptions([
            'headers' => ['x-auth-token' => 'apiToken1', 'content-type' => 'application/json; charset=utf-8'],
        ])->request('GET', '/api/comments');
        $this->assertResponseStatusCodeSame(200);
        $resultArray = $response->toArray();
        $this->assertJson($response->getContent());
        $this->assertIsArray($resultArray);
    }


}
