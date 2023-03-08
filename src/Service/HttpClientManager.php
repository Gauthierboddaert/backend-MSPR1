<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class HttpClientManager implements HttpClientManagerInterface
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $baseUriClient)
    {
        $this->client = $baseUriClient;
    }

    public function getALlInformation(string $endPoint): ResponseInterface
    {
        return $this->client->request(
            'GET',
            $endPoint
        );
    }

    public function getInformationById(string $endPoint, int $id): ResponseInterface
    {
        try{
            return $this->client->request(
                'GET',
                $endPoint.'/'.$id
            );
        }catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }
}