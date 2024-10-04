<?php

namespace App\Domain\Exception;

class TemplatingException extends \RuntimeException
{
    public function __construct(
        string $message = '',
        int $code = 500,
    ) {
        parent::__construct($message, $code);
        $this->message = "$message";
        $this->code = $code;
    }
}
