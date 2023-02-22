<?php

namespace App\Controller\Rest;

use App\Service\HttpClientManager;
use App\Service\MailerManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Schema(
 *     schema="Customers",
 *     type="object",
 *     description="Un customer",
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


    /**
     * @OA\Get(
     *     path="/api/customers/",
     *     summary="Get all customer",
     *     tags={"Customers"},
     *     @OA\Parameter(
     *         name="customer",
     *         in="path",
     *         description="get all customers"
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Customers")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Customer not found"
     *     )
     * )
     */
    #[Route('/', name: 'app_customers', methods: 'GET')]
    public function index(MailerInterface $mailer) : JsonResponse
    {
        return new JsonResponse($this->httpClientManager->getALlInformation('/customers'));
    }

    /**
     * @OA\Get(
     *     path="/api/cutomers/{id}",
     *     summary="Get cutomer by ID",
     *     tags={"Customers"},
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
     *         @OA\JsonContent(ref="#/components/schemas/Customers")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Customer not found"
     *     )
     * )
     */
    #[Route('/{id}', name: 'app_customers_by_id', methods: 'GET')]
    public function getCustomersById(int $id) : JsonResponse
    {
        return new JsonResponse($this->httpClientManager->getInformationById('/customers', $id, 'Client introuvable'));
    }
}
