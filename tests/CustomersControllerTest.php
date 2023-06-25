<?php

namespace App\Tests\Service;

use App\Service\HttpClientManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


final class CustomersControllerTest extends KernelTestCase
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
        $this->assertEquals(200, $httpClientManager->getInformationById('/customers',30)->getStatusCode());
    }

    /** @test */
    public function testGetInformationCustomerByIdWithInvalidId()
    {
        $httpClientManager = static::getContainer()->get(HttpClientManager::class);
        $this->assertEquals(500, $httpClientManager->getInformationById('/customers',11111)->getStatusCode());

    }
}