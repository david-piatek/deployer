<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Domain\Struct\Data;

interface Template
{
    public function render(
        string $templateName,
        Data $data,
    ): string;
}
