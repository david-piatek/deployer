<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Application\Input\Data;

interface Template
{
    public function render(
        string $templateName,
        Data $data,
    ): string;
}
