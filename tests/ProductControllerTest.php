<?php

namespace App\Tests\Service;

use App\Service\HttpClientManager;
use App\Service\MailerManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Mailer\Mailer;


class ProductControllerTest extends KernelTestCase
{
    /** @test */
    public function TestGetALlInformationProducts()
    {
        $httpClientManager = static::getContainer()->get(HttpClientManager::class);
        $this->assertEquals(200, $httpClientManager->getALlInformation('/products')->getStatusCode());
    }

    /** @test */
    public function TestGetInformationProductById()
    {
        $httpClientManager = static::getContainer()->get(HttpClientManager::class);
        $this->assertEquals(200, $httpClientManager->getInformationById('/products',1)->getStatusCode());
    }

    /** @test */
    public function testGetInformationProductByIdWithInvalidId()
    {
        $httpClientManager = static::getContainer()->get(HttpClientManager::class);
        $this->assertEquals(500, $httpClientManager->getInformationById('/products',11111)->getStatusCode());

    }
}