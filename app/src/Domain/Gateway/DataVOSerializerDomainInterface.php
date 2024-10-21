<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Domain\ValueObject\DataVO;

interface DataVOSerializerDomainInterface
{
    public function deserialize(mixed $data, string $type, string $format, array $context = []): DataVO;
}
