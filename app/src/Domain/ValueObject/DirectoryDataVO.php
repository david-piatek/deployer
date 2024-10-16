<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

readonly class DirectoryDataVO
{
    public function __construct(
        public string $data,
        public array $templates,
    ) {
    }
}
