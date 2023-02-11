<?php

namespace App\Service;

use Endroid\QrCode\Factory\QrCodeFactoryInterface;
use App\Repository\UserRepository;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\Result\PngResult;
use Endroid\QrCodeBundle\Response\QrCodeResponse;
use Symfony\Component\Serializer\SerializerInterface;

class QrCodeGeneratorManager
{
    private UserRepository $userRepository;
    private SerializerInterface $serializer;

    public function __construct(UserRepository $userRepository, SerializerInterface $serializer)
    {
        $this->userRepository = $userRepository;
        $this->serializer = $serializer;
    }

    public function generateQrCode()
    {
        $user = $this->userRepository->find(1);
        $qrCode = new QrCode($this->serializer->serialize($user, 'json', ['groups' => 'user']));
        $qrCode->setSize(300);
        $qrCode->setEncoding(new Encoding('UTF-8'));

        return $qrCode;
    }
}