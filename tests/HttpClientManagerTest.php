<?php

namespace App\Tests\Service;

use App\Service\HttpClientManager;
use App\Service\MailerManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Mailer\Mailer;


class HttpClientManagerTest extends KernelTestCase
{
    /** @test */
    public function TestGetALlInformation()
    {

        $httpClientManager = $this->createMock(HttpClientManager::class);
        $this->assertEquals([], $httpClientManager->getALlInformation('https://615f5fb4f7254d0017068109.mockapi.io/api/v1/customers'));
    }

    /** @test */
    public function TestGetInformationById()
    {
        $httpClientManager = $this->createMock(HttpClientManager::class);
        $this->assertEquals([], $httpClientManager->getInformationById('https://615f5fb4f7254d0017068109.mockapi.io/api/v1/customers',1));
    }

    /** @test */
    public function testGetInformationByIdWithInvalidId()
    {
        $httpClientManager = $this->createMock(HttpClientManager::class);
        $response = $httpClientManager->getInformationById('https://615f5fb4f7254d0017068109.mockapi.io/api/v1/customers',2);

        $this->assertEquals([], $response);

    }
}