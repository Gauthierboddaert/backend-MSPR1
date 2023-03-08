<?php

namespace App\Service;

use App\Entity\User;
use Endroid\QrCode\QrCode;
use Symfony\Contracts\HttpClient\ResponseInterface;

interface QrCodeManagerInterface
{
    public function generateQrCode(User $user) : QrCode;
}