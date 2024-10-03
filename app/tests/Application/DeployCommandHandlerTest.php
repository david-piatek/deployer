<?php

declare(strict_types=1);

namespace Tests\App\Application;

use App\Application\DeployCommand;
use App\Application\DeployCommandHandler;
use App\Domain\Gateway\Template;
use App\Domain\Model\Data;
use PHPUnit\Framework\TestCase;

final class DeployCommandHandlerTest extends TestCase
{
    private Template $template;
    private Data $data;

    protected function setUp(): void
    {
        $this->template = new class implements Template {
            public function render(string $templateName, Data $data): string
            {
                return 'fff';
            }
        };
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
            templates: []
        );
        $handler = new DeployCommandHandler($this->template);
        try {
            $handler->handle($command);
            $this->assertTrue(true);
        } catch (\Throwable $e) {
            // TODO remove
            $this->fail('An unexpected exception was thrown: '.$e->getMessage());
        }
    }

    public function testDeployCommandHandlerGIVENinvalidInputTHENreturnVoid(): void
    {
        $appName = 'toto';
        $command = new DeployCommand(
            data: $this->data,
            templates: []);
        $handler = new DeployCommandHandler($this->template);
        try {
            $handler->handle($command);
            $this->assertTrue(true);
        } catch (\Throwable $e) {
            // TODO remove
            $this->fail('An unexpected exception was thrown: '.$e->getMessage());
        }
    }
}
