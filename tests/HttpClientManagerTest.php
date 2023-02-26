<?php

namespace App\Tests\Service;

use App\Service\MailerManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Mailer\Mailer;


class HttpClientManagerTest extends KernelTestCase
{
    /** @test */
    public function TestGetALlInformation()
    {
        $this->assertEquals([], []);
    }

    /** @test */
    public function TestGetInformationById()
    {
        $this->assertEquals([], []);
    }

}