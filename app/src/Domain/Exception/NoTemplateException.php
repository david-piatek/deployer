<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class NoTemplateException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('You should have a template object');
    }
}
