<?php

namespace App\Tests\Service;

use App\Service\HttpClientManager;
use App\Service\MailerManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Mailer\Mailer;


class CustomersControllerTest extends KernelTestCase
{
    /** @test */
    public function TestGetALlInformationCustomers()
    {
        $httpClientManager = static::getContainer()->get(HttpClientManager::class);
        $this->assertEquals(200, $httpClientManager->getALlInformation('/customers')->getStatusCode());
    }

    /** @test */
    public function TestGetInformationCustomerById()
    {
        $httpClientManager = static::getContainer()->get(HttpClientManager::class);
        $this->assertEquals(200, $httpClientManager->getInformationById('/customers',3)->getStatusCode());
    }

    /** @test */
    public function testGetInformationCustomerByIdWithInvalidId()
    {
        $httpClientManager = static::getContainer()->get(HttpClientManager::class);
        $this->assertEquals(400, $httpClientManager->getInformationById('/customers',11111)->getStatusCode());

    }
}