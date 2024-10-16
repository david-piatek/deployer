<?php

declare(strict_types=1);

namespace App\Domain\Struct;

readonly class FileSystemStruct
{
    public function __construct(
        public readonly string $data,
        public readonly array $templates,
    ) {
    }
}
