<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class MailerManager
{
    private QrCodeGeneratorManager $qrCodeGeneratorManager;
    public function __construct(QrCodeGeneratorManager $qrCodeGeneratorManager)
    {
        $this->qrCodeGeneratorManager = $qrCodeGeneratorManager;
    }

    public function sendEmail(MailerInterface $mailer): void
    {
        $this->qrCodeGeneratorManager->getQrCodeAuthentication();
        $email = (new Email())
            ->from('hello@gmail.com')
            ->to('you@gmail.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);



    }
}