<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use MongoDB\Driver\Exception\ExecutionTimeoutException;

class UserManager
{
    private HttpClientManager $clientManager;
    private EntityManagerInterface $entityManager;
    public function __construct(HttpClientManager $clientManager, EntityManagerInterface $entityManager)
    {
        $this->clientManager = $clientManager;
        $this->entityManager = $entityManager;
    }

    public function createUserFromApi() : bool
    {
        $data = $this->clientManager->getALlInformation('/customers');

        /**
         * @var User $user
         */
        foreach ($data as $user)
        {
            try {

                $cp = $user['company']['companyName'] ?? '';
                $cp = $user['createdAt'] ?? new \DateTimeImmutable();
                $email = $user['email'] ?? '';
                $firstName = $user['firstName'] ?? '';
                $userName = $user['username'] ?? '';
                $lastName = $user['lastName'] ?? '';
                $user = new User();
                $user->setPassword('coucou');
                $user->setRoles(['user']);
                $user->setCompagnyName($cp);
                $user->setCreatedAt(new \DateTimeImmutable());
                $user->setEmail($email);
                $user->setFirstname($firstName);
                $user->setLastname($lastName);
                $user->setUsername($userName);
                $this->entityManager->persist($user);
            }catch (\Exception $exception)
            {
                dd($exception->getMessage());
                return false;
            }

        }

        $this->entityManager->flush();
        return true;
    }

}