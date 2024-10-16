<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class FileSystemException extends \RuntimeException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
