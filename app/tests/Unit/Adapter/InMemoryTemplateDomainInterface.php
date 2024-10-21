<?php

declare(strict_types=1);

namespace Tests\App\Unit\Adapter;

use App\Domain\Gateway\TemplateDomainInterface;
use App\Domain\ValueObject\Data;

final class InMemoryTemplateDomainInterface implements TemplateDomainInterface
{
    public function render(string $templateName, Data $data): string
    {
        return "tmp-$templateName";
    }
}
