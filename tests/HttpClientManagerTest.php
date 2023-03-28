<?php

namespace App\Tests\Service;

use App\Service\HttpClientManager;
use App\Service\MailerManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Mailer\Mailer;
use Symfony\Contracts\HttpClient\ResponseInterface;



class HttpClientManagerTest extends KernelTestCase
{
    /** @test */
    public function TestGetALlInformation()
    {
        $httpClientManager = static::getContainer()->get(HttpClientManager::class);
        $this->assertInstanceOf(ResponseInterface::class, $httpClientManager->getALlInformation('/customers'));
    }

    /** @test */
    public function TestGetInformation()
    {
        $httpClientManager = static::getContainer()->get(HttpClientManager::class);
        $this->assertInstanceOf(ResponseInterface::class, $httpClientManager->getInformationById('/customers', 7));
    }
}