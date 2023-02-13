<?php

namespace App\Controller\Rest;

use App\Service\HttpClientManager;
use App\Service\MailerManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/customers')]
class CustomerController extends AbstractController
{
    private HttpClientManager $httpClientManager;
    private MailerManager $mailerManager;

    public function __construct(HttpClientManager $httpClientManager, MailerManager $mailerManager)
    {
        $this->httpClientManager = $httpClientManager;
        $this->mailerManager = $mailerManager;
    }

    #[Route('/', name: 'app_customers', methods: 'GET')]
    public function index(MailerInterface $mailer) : JsonResponse
    {
        return new JsonResponse($this->httpClientManager->getALlInformation('/customers'));
    }

    #[Route('/{id}', name: 'app_customers_by_id', methods: 'GET')]
    public function getCustomersById(int $id) : JsonResponse
    {
        return new JsonResponse($this->httpClientManager->getInformationById('/customers', $id, 'Client introuvable'));
    }
}
