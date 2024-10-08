<?php

declare(strict_types=1);

namespace App\UI\Command;

use App\Application\DeployCommand;
use App\Application\DeployCommandHandler;
use App\Application\Input\Data;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Serializer;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:deploy')]
class DeployAppCommand extends Command
{
    public function __construct(
        private readonly DeployCommandHandler $handler,
        private readonly Serializer $serializer,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /*
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

        */

        $dataInputCommand = file_get_contents('toto');
        $data = $this->serializer->deserialize($dataInputCommand, Data::class, 'json');
        $this->handler->handle(
            command: new DeployCommand(
                data: $data,
                templates: [],
            )
        );
        (new SymfonyStyle($input, $output))->title('Finish deploy.'.$data->appName);

        return Command::SUCCESS;
    }
}
