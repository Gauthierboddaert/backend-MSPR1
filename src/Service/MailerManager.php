<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class MailerManager extends AbstractController
{
    private QrCodeGeneratorManager $qrCodeGeneratorManager;
    public function __construct(QrCodeGeneratorManager $qrCodeGeneratorManager)
    {
        $this->qrCodeGeneratorManager = $qrCodeGeneratorManager;
    }

    public function sendEmail(MailerInterface $mailer): void
    {
        $email = (new Email())
            ->from('hello@gmail.com')
            ->to('you@gmail.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html($this->renderView(
                'email/login_email.html.twig',
                array('qrcode' => $this->qrCodeGeneratorManager->generateQrCode())
            ));

        $mailer->send($email);



    }
}