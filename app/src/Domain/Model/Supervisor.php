<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Gateway\Template;

class Supervisor
{
    public function __construct(
        private readonly Template $template,
    ){}

    public function run(string $appName)
    {
        return $this->template->render($appName);
    }
}
