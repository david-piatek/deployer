<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

readonly class FileVO
{
    public function __construct(
        public string $path,
        public string $content = '',
    ) {
    }
}
