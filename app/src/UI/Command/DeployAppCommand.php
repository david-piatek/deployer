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
    public function __construct(
        private readonly string $templatePath,
        private readonly DeployCommandHandler $handler,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            // configure an argument
            ->addArgument('app_name', InputArgument::REQUIRED, 'Application you want deploy.')
            // ...
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Start deploying.');
        /** @var string $appName */
        $appName = $input->getArgument('app_name');
        $this->handler->handle(
            new DeployCommand($appName)
        );
        $output->writeln('Username: '.$appName);

        // ... put here the code to create the user
        dump($this->templatePath);
        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}
