<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

readonly class RepoVO
{
    public function __construct(
        public string $gitRepoUrl,
        public string $appName,
        public string $environment,
        public string $namespace,
        public string $url,
        public string $tag,
        public ?string $imagePullSecrets = null,
        public ?int $inputPort = 80,
        public ?int $outputPort = 80,
    ) {
    }
}
