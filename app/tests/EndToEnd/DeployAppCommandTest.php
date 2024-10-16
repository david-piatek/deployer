<?php

declare(strict_types=1);

namespace Tests\App\EndToEnd;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DeployAppCommandTest extends KernelTestCase
{
    public function __construct(
        private readonly DeployCommandHandler $handler,
        private readonly SerializerInterface $serializer,
        private readonly string $tmpPath,
    ) {
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

        $dataInputCommand = file_get_contents($this->tmpPath.DIRECTORY_SEPARATOR.'data.json');
        try {
            $data = $this->serializer->deserialize(
                data: $dataInputCommand,
                type: Data::class,
                format: JsonEncoder::FORMAT
            );
        } catch (InvalidDataException $exception) {
            dd($exception);
        }
        $this->handler->handle(
            command: new DeployCommand(
                data: $data,
                templates: [''],
            )
        );
        (new SymfonyStyle($input, $output))->title('Finish deploy.'.$data->appName);

        return Command::SUCCESS;
    }
}
