<?php

namespace App\Controller\Rest;

use App\Service\HttpClientManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;


/**
 * @OA\Info(
 *  title="Swagger PayeTonKawa",
 *  version="1.0.0",
 *  description="Cette api permet de récupérer les customers et les products d'une autre API pour l'application paye ton kawa.",
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
 */
#[Route('/api/products')]
class ProductController extends AbstractController
{
    private HttpClientManager $httpClientManager;

    public function __construct(HttpClientManager $httpClientManager)
    {
        $this->httpClientManager = $httpClientManager;
    }

    /**
     * @OA\Get(
     *     path="/api/products/",
     *     summary="Get all products",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="products",
     *         in="path",
     *         description="get all products"
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Product not found"
     *     )
     * )
     */
    #[Route('/', name: 'app_product', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse($this->httpClientManager->getAllInformation('/products')->toArray());
    }


    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Get product by ID",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of product to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Product not found"
     *     )
     * )
     */
    #[Route('/{id}', name: 'app_product_by_id', methods: 'GET')]
    public function getProductById(int $id) : JsonResponse
    {
        return new JsonResponse($this->httpClientManager->getInformationById('/products', $id)->toArray());
    }
}
