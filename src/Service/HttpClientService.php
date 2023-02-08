<?php

namespace App\Service;

class HttpClientService
{
    private HttpClientInterface $client;
    private string $baseApiUrl;

    public function __construct(HttpClientInterface $client, string $baseApiUrl)
    {
        $this->client = $client;
        $this->baseApiUrl = $baseApiUrl;
    }
}