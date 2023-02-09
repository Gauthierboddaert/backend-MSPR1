<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpClientManager
{
    private HttpClientInterface $client;
    private string $baseApiUrl;

    public function __construct(HttpClientInterface $client, string $baseApiUrl)
    {
        $this->client = $client;
        $this->baseApiUrl = $baseApiUrl;
    }

    public function getProductInformation(string $endPoint): array
    {

        $response = $this->client->request(
            'GET',
            $this->baseApiUrl.$endPoint
        );

        return $response->toArray();
    }
}