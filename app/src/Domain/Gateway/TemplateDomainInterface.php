<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Domain\ValueObject\DataVO;

interface TemplateDomainInterface
{
    public function render(
        string $templateName,
        DataVO $data,
    ): string;
}
