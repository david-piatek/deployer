<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Gateway\Template;

class DeployCommandHandler
{
    public function __construct(
    ) {
    }

    public function handle(DeployCommand $command): void
    {
        // Validate directory structure
        // Validate data
        // apply template -> write output file tmp
        // git clone
        // rm dir
        // git push
        return;
    }
}
