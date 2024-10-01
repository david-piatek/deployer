<?php

declare(strict_types=1);

namespace Tests\App\Application;

use App\Application\DeployCommand;
use App\Application\DeployCommandHandler;
use App\Domain\Gateway\Template;
use App\Domain\Model\Supervisor;
use PHPUnit\Framework\TestCase;

final class DeployCommandHandlerTest extends TestCase
{
    private Template $template;
    private Supervisor $supervisor;
    protected function setUp(): void
    {
        $template = new class implements Template {
            public function render(string $appName): string
            {
                return $appName;
            }
        };

        $this->supervisor = new class($template) extends Supervisor {
            public function __construct(Template $template)
            {
                parent::__construct($template);
            }

            public function run(string $appName): string
            {
                return $appName;
            }
        };
    }

    public function testCanBeUsedAsString(): void
    {


        $this->assertEquals(
            (new DeployCommandHandler($this->supervisor))->handle(new DeployCommand('ddd')),
            'dddd'
        );
    }
}
