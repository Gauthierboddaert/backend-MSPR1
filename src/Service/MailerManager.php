<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Serializer\SerializerInterface;


class MailerManager extends AbstractController implements MailerManagerInterface
{
    private QrCodeGeneratorManager $qrCodeGeneratorManager;
    private SerializerInterface $serializer;
    public function __construct(
        QrCodeGeneratorManager $qrCodeGeneratorManager,
        SerializerInterface $serializer
    )
    {
        $this->qrCodeGeneratorManager = $qrCodeGeneratorManager;
        $this->serializer = $serializer;
    }

    public function sendEmail(MailerInterface $mailer, User $user): void
    {
        $email = (new Email())
            ->from('hello@gmail.com')
            ->to('you@gmail.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html($this->renderView(
                'email/login_email.html.twig',
                array(
                    'qrcode' => $this->qrCodeGeneratorManager->generateQrCode($user),
                    'user_data' => $this->serializer->serialize($user, 'json', ['groups' => 'user'])
                )
            ));


        $mailer->send($email);
    }
}