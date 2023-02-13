<?php

namespace App\Controller\Rest;

use App\Repository\UserRepository;
use App\Service\HttpClientManager;
use App\Service\MailerManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/login')]
class LoginController extends AbstractController
{
    private MailerManager $mailerManager;
    private UserRepository $userRepository;

    public function __construct(MailerManager $mailerManager, UserRepository $userRepository)
    {
        $this->mailerManager = $mailerManager;
        $this->userRepository = $userRepository;
    }

    #[Route('/', name: 'app_login', methods: 'POST')]
    public function index(Request $request, MailerInterface $mailer): JsonResponse
    {
        if(empty($request->getContent()))
        {
            return new JsonResponse('Veuillez renseigner un email');
        }

        $user = $this->userRepository->findOneBy(['email' => $request->toArray()['email']]);
        $this->mailerManager->sendEmail($mailer, $user);
        return new JsonResponse('Email envoyer');
    }
}
