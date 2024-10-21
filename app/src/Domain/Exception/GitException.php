<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class GitException extends \RuntimeException
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
