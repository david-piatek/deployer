<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Template;

class DeployCommandHandler
{
    public function __construct(
        private readonly Template $template,
    ) {
    }

    public function handle(DeployCommand $command): string
    {
        return $this->template->render($command->appName);
    }
}
