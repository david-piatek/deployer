<?php

declare(strict_types=1);

namespace Tests\App\Unit\Factory;

use App\Application\DeployCommand;
use Zenstruck\Foundry\ObjectFactory;

/**
 * @extends ObjectFactory<DeployCommand>
 */
final class DataFactory extends ObjectFactory
{
    public static function class(): string
    {
        return DeployCommand::class;
    }

    protected function defaults(): array|callable
    {
        return [];
    }
}
