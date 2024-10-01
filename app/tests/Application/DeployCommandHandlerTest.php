<?php

declare(strict_types=1);

namespace Tests\App\Application;

use App\Application\DeployCommand;
use App\Application\DeployCommandHandler;
use App\Domain\Template;
use PHPUnit\Framework\TestCase;

final class DeployCommandHandlerTest extends TestCase
{
    public function testCanBeUsedAsString(): void
    {
        $template = new class implements Template {
            public function render(string $appName): string
            {
                return $appName;
            }
        };
        $this->assertEquals(
            (new DeployCommandHandler($template))->handle(new DeployCommand('ddd')),
            'ddd'
        );
    }
}
