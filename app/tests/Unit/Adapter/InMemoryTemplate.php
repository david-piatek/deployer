<?php

declare(strict_types=1);

namespace Tests\App\Unit\Adapter;

use App\Domain\Gateway\Template;
use App\Domain\Struct\Data;

final class InMemoryTemplate implements Template
{
    public function render(string $templateName, Data $data): string
    {
        return "tmp-$templateName";
    }
}
