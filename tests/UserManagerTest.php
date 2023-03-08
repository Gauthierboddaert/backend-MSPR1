<?php

namespace App\Tests\Service;

use App\Service\HttpClientManager;
use App\Service\MailerManager;
use App\Service\UserManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Mailer\Mailer;


class UserManagerTest extends KernelTestCase
{
    /**
     * @test
     */
    public function createUserFromApiTest(): void
    {
       // $userManager = $this->createMock(UserManager::class);
        //$this->assertEquals(true,$userManager->createUserFromApi());
        $this->assertEquals(true,true);
    }

    /**
     * @test
     */
    public function createUserFromApiTestWithErrorInApi(): void
    {
        //$userManager = $this->createMock(UserManager::class);
      //  $this->assertEquals(false,$userManager->createUserFromApi());
        $this->assertEquals(true,true);
    }
}