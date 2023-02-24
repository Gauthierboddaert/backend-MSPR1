<?php

namespace App\Tests\Service;

use App\Service\MailerManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Mailer\Mailer;


class MailerManagerTest extends KernelTestCase
{
    /** @test */
    public function testSomething()
    {
        $this->assertEquals(1, 1);
    }
}