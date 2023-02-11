<?php

namespace App\Service;

use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\Writer\Result\PngResult;
use Endroid\QrCodeBundle\Response\QrCodeResponse;

class QrCodeGeneratorManager
{
    private BuilderInterface $builder;

    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    public function getQrCodeAuthentication()
    {
        $qrCode = $this->generateQrCode();
        $response = new QrCodeResponse($qrCode);
    }

    public function generateQrCode() : PngResult
    {
        return $this->builder
            ->size(400)
            ->margin(20)
            ->build();
    }


}