<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Gateway\DataVOSerializer as DataVOSerializerInterface;
use App\Domain\ValueObject\DataVO;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class DataVOSerializer implements DataVOSerializerInterface
{
    public function __construct(
        private SerializerInterface $serializer,
    ){}

    public function deserialize(mixed $data, string $type, string $format, array $context = []): DataVO
    {
       return  $this->serializer->deserialize(
            data: $data,
            type: DataVO::class,
            format: JsonEncoder::FORMAT
        );

    }
}
