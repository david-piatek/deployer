<?php

declare(strict_types=1);

namespace Tests\App\Unit\Adapter;

use App\Domain\Gateway\TemplateDomainInterface;
use App\Domain\ValueObject\DataVO;

final class InMemoryTemplateDomainInterface implements TemplateDomainInterface
{
    public function render(string $templateName, DataVO $data): string
    {
        return "tmp-$templateName";
    }
}
