<?php

namespace App\Controller\Rest;

use App\Service\HttpClientManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;


#[Route('/api/products')]
class ProductController extends AbstractController
{
    private HttpClientManager $httpClientManager;

    public function __construct(HttpClientManager $httpClientManager)
    {
        $this->httpClientManager = $httpClientManager;
    }

    /**
     * @OA\Info(
     *     title="API de gestion de produits",
     *     version="1.0.0",
     *     description="API permettant de gérer les produits d'un site e-commerce.",
     *     @OA\Contact(
     *         email="contact@monsite.com",
     *         name="Service clients"
     *     ),
     *     @OA\License(
     *         name="Licence propriétaire",
     *         url="https://monsite.com/licence-proprietaire"
     *     )
     * )
     *
     * @OA\Server(
     *     url="http://localhost:8000",
     *     description="Serveur local de développement"
     * )
     *
     * @OA\Schema(
     *     schema="Product",
     *     type="object",
     *     description="Un produit",
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         description="L'identifiant unique du produit"
     *     ),
     *     @OA\Property(
     *         property="name",
     *         type="string",
     *         description="Le nom du produit"
     *     ),
     *     @OA\Property(
     *         property="description",
     *         type="string",
     *         description="La description du produit"
     *     ),
     *     @OA\Property(
     *         property="price",
     *         type="number",
     *         format="float",
     *         description="Le prix du produit"
     *     ),
     *     @OA\Property(
     *         property="created_at",
     *         type="string",
     *         format="date-time",
     *         description="La date de création du produit"
     *     ),
     *     @OA\Property(
     *         property="updated_at",
     *         type="string",
     *         format="date-time",
     *         description="La date de dernière modification du produit"
     *     ),
     *     @OA\Property(
     *         property="category",
     *         type="object",
     *         description="La catégorie du produit",
     *         @OA\Property(
     *             property="id",
     *             type="integer",
     *             description="L'identifiant unique de la catégorie"
     *         ),
     *         @OA\Property(
     *             property="name",
     *             type="string",
     *             description="Le nom de la catégorie"
     *         )
     *     )
     * )
     *
     * @OA\Tag(
     *     name="Product",
     *     description="Endpoints pour la gestion des produits"
     * )
     * @OA\PathItem(
     *      path="/api/products"
     * )
     */
    #[Route('/api/products', name: 'app_product', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse($this->httpClientManager->getAllInformation('/products'));
    }

    #[Route('/{id}', name: 'app_product_by_id', methods: 'GET')]
    public function getProductById(int $id) : JsonResponse
    {
        return new JsonResponse($this->httpClientManager->getInformationById('/products', $id));
    }
}
