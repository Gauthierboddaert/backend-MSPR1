<?php

namespace App\Controller\Rest;

use App\Service\HttpClientManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/products')]
class ProductController extends AbstractController
{
    private HttpClientManager $httpClientManager;

    public function __construct(HttpClientManager $httpClientManager)
    {
        $this->httpClientManager = $httpClientManager;
    }

    #[Route('/', name: 'app_product', methods: 'GET')]
    public function index() : JsonResponse
    {
        return new JsonResponse($this->httpClientManager->getProductInformation('/products'));
    }
}