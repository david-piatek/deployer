<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Domain\ValueObject\DataVO;

interface DataVOSerializer
{
    public function deserialize(mixed $data, string $type, string $format, array $context = []): DataVO;

}
