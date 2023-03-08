<?php

namespace App\Service;

use App\Entity\User;
use Endroid\QrCode\QrCode;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

interface MailerManagerInterface
{
    public function sendEmail(MailerInterface $mailer, User $user): void;
}