<?php

namespace App\Command;

use App\Service\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:import-user')]
class insertUserInDb extends Command
{
    private UserManager $userManager;
    public function __construct(UserManager $userManager, string $name = null)
    {
        parent::__construct($name);
        $this->userManager = $userManager;
    }

    // the command description shown when running "php bin/console list"
    protected static $defaultDescription = 'insert user in db from api';

    // ...
    protected function configure(): void
    {
        $this
            ->setHelp('This command allows you to import data of user from api')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if($this->userManager->createUserFromApi())
        {
            return Command::SUCCESS;
        }

        return Command::FAILURE;
    }
}