<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Model\Data;

readonly class DeployCommand
{
    public function __construct(
        public Data $data,
        /** @var string[] $templates */
        public array $templates,
    ) {
    }
}
