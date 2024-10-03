<?php

declare(strict_types=1);

namespace App\UI\Command;

use App\Application\DeployCommand;
use App\Application\DeployCommandHandler;
use App\Domain\Model\Data;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:deploy')]
class DeployAppCommand extends Command
{
    public function __construct(
        private readonly DeployCommandHandler $handler,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var string $appName */
        $appName = $input->getArgument('app_name');
        // TODO Validate directory structure

        $data = new Data(
            appName: 'appName',
            environment: 'environment',
            namespace: 'namespace',
            url: 'url',
            tag: 'tag',
            imagePullSecrets: 'imagePullSecrets',
            inputPort: 12,
            outputPort: 23,
        );

        $this->handler->handle(
            command: new DeployCommand(
                data: $data,
                templates: [],
            )
        );
        (new SymfonyStyle($input, $output))->title('Finish deploy.'.$appName);

        return Command::SUCCESS;
    }
}
