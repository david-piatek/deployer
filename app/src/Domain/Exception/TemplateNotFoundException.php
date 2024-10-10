<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class TemplateNotFoundException extends \RuntimeException
{
    public function __construct(string $templatePath)
    {
        parent::__construct('Template '.$templatePath.' not found');
    }
}
