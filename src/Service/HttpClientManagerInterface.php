<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface HttpClientManagerInterface
{
    public function getALlInformation(string $endPoint): ResponseInterface;

    public function getInformationById(string $endPoint, int $id): ResponseInterface;

}