<?php

namespace App\Tests\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\QrCodeGeneratorManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Serializer\SerializerInterface;
use Endroid\QrCode\QrCode;

class QrCodeManagerTest extends KernelTestCase
{
    /** @test */
    public function TestgenerateQrCode()
    {
        $userRepository = $this->createMock(UserRepository::class);
        $serializerInterface = $this->createMock(SerializerInterface::class);
        $qrCodeManager = new QrCodeGeneratorManager($userRepository, $serializerInterface);
        $user = new User();

        $this->assertInstanceOf(QrCode::class, $qrCodeManager->generateQrCode($user));
    }
}