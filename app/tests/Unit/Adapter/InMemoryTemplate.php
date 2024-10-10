<?php

declare(strict_types=1);

namespace Tests\App\Unit\Adapter;

use App\Application\Input\Data;
use App\Domain\Gateway\Template;

final class InMemoryTemplate implements Template
{
    public function render(string $templateName, Data $data): string
    {
        return "tmp-$templateName";
    }
}
