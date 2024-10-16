<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Domain\ValueObject\DataVO;

interface Template
{
    public function render(
        string $templateName,
        DataVO $data,
    ): string;
}
