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

    public function getALlInformation(string $endPoint): array
    {

        $response = $this->client->request(
            'GET',
            $this->baseApiUrl.$endPoint
        );

        return $response->toArray();
    }

    public function getInformationById(string $endPoint, int $id, string $messageError = 'produit introuvable'): array
    {
        $response = $this->client->request(
            'GET',
            $this->baseApiUrl.$endPoint.'/'.$id
        );

        if($response->getStatusCode() === 500 || $response->getStatusCode() === 400 ){
            return [$messageError];
        };


        return $response->toArray();
    }
}