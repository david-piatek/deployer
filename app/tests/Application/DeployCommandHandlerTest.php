<?php

declare(strict_types=1);

namespace Tests\App\Application;

use App\Application\DeployCommand;
use App\Application\DeployCommandHandler;
use App\Domain\Exception\TemplatingException;
use App\Domain\Gateway\Template;
use App\Domain\Model\Data;
use PHPUnit\Framework\TestCase;

final class DeployCommandHandlerTest extends TestCase
{
    private Data $data;

    protected function setUp(): void
    {
        $this->data = new Data(
            appName: 'appName',
            environment: 'environment',
            namespace: 'namespace',
            url: 'url',
            tag: 'tag',
            imagePullSecrets: 'imagePullSecrets',
            inputPort: 12,
            outputPort: 23,
        );
    }

    public function testDeployCommandHandlerGIVENvalidInputTHENreturnVoid(): void
    {
        $command = new DeployCommand(
            data: $this->data,
            templates: ['']
        );
        $handler = new DeployCommandHandler(
            template: new class implements Template {
                public function render(string $templateName, Data $data): string
                {
                    return '';
                }
            });
        $handler->handle($command);
        $this->assertTrue(true);
    }

    public function testDeployCommandHandlerGIVENinvalidInputTHENexceptTemplatingException(): void
    {
        try {
            $command = new DeployCommand(
                data: $this->data,
                templates: ['']);
            // $this->expectException(TemplatingException::class);
            $handler = new DeployCommandHandler(
                template: new class implements Template {
                    public function render(string $templateName, Data $data): string
                    {
                        throw new TemplatingException('ss');
                    }
                });

            $handler->handle($command);
        } catch (\Throwable $e) {
            $this->assertEquals('ss', $e->getMessage());
            // TODO remove
        }
    }
}
