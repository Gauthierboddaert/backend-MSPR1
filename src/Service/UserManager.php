<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager
{
    private UserPasswordHasherInterface $userPasswordHasher;
    private HttpClientManager $clientManager;
    private EntityManagerInterface $entityManager;

    public function __construct(
        HttpClientManager $clientManager,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $userPasswordHasher
    )
    {
        $this->clientManager = $clientManager;
        $this->entityManager = $entityManager;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function createUserFromApi() : bool
    {
        $data = $this->clientManager->getALlInformation('/customers')->toArray();

        foreach ($data as $user)
        {
            try {
                $cp = $user['company']['companyName'] ?? '';
                $email = $user['email'] ?? '';
                $firstName = $user['firstName'] ?? '';
                $userName = $user['username'] ?? '';
                $lastName = $user['lastName'] ?? '';
                $user = new User();
                $user->setPassword($this->userPasswordHasher->hashPassword($user,'coucou'));
                $user->setRoles(['PUBLIC_ACCESS']);
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