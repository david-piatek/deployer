<?php

declare(strict_types=1);

namespace App\UI\Command;

use App\Application\DeployCommand;
use App\Application\DeployCommandHandler;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:deploy')]
class DeployAppCommand extends Command
{
    private const APP_NAME = 'app_name';

    public function __construct(
        private readonly DeployCommandHandler $handler,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument(self::APP_NAME, InputArgument::OPTIONAL, 'The appname to create.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $appName = $input->getArgument(self::APP_NAME);

        if (null === $appName) {
            $appName = $io->ask(
                question: 'What app name do you want to create ?',
                validator: fn (string $appName): string => $appName
            );
        }

        $this->handler->handle(
            command: new DeployCommand(
                appName: $appName,
            )
        );
        $io->title('Finish deploy.'.$appName);

        return Command::SUCCESS;
    }
}
