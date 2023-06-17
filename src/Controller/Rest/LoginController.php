<?php

namespace App\Controller\Rest;

use App\Repository\UserRepository;
use App\Service\HttpClientManager;
use App\Service\MailerManager;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    private MailerManager $mailerManager;
    private UserRepository $userRepository;

    public function __construct(MailerManager $mailerManager, UserRepository $userRepository)
    {
        $this->mailerManager = $mailerManager;
        $this->userRepository = $userRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/login/",
     *     summary="Login",
     *     tags={"Login"},
     *     @OA\Parameter(
     *         name="login",
     *         in="path",
     *         description="login user"
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="user not found"
     *     )
     * )
     */
    #[Route('/api/login', name: 'app_login', methods: 'POST')]
    public function index(Request $request, MailerInterface $mailer): JsonResponse
    {
        if(empty($request->getContent()))
        {
            return new JsonResponse('Veuillez renseigner un email');
        }

        $user = $this->userRepository->findOneBy(['email' => $request->toArray()['email']]);
        if(null === $user)
        {
            return new JsonResponse("Cette adresse email ne correspond a aucun compte");
        }

        $this->mailerManager->sendEmail($mailer, $user);
        return new JsonResponse('Email envoyer');
    }
}

