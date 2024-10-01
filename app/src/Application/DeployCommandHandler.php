<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Gateway\Template;
use App\Domain\Model\Supervisor;

class DeployCommandHandler
{
    public function __construct(
        private readonly Supervisor $supervisor,
    ) {
    }

    public function handle(DeployCommand $command): string
    {
        return  $this->supervisor->run($command->appName);
    }
}
