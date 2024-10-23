<?php

declare(strict_types=1);

namespace Tests\App\Unit\Adapter;


use App\Domain\Gateway\DataVOSerializerDomainInterface;
use App\Domain\ValueObject\DataVO;

class InMemoryDataVOSerializerDomainInterface implements DataVOSerializerDomainInterface
{

    public function __construct()
    {
    }

    public function deserialize(mixed $data, string $type, string $format, array $context = []): DataVO
    {
        return new DataVO(
            gitConnexionType: 'gitConnexionType',
            gitProvider: 'gitProvider',
            gitRepoRemotePath: 'gitRepoRemotePath',
            appName: 'appName',
            environment: 'environment',
            namespace: 'namespace',
            url: 'url',
            tag: 'tag',
            imagePullSecrets: 'imagePullSecrets',
            inputPort: 12,
            outputPort: 23,
        );
    }
}