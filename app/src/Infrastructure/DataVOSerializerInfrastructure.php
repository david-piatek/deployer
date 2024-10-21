<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Exception\SerializeException;
use App\Domain\Gateway\DataVOSerializerDomainInterface;
use App\Domain\ValueObject\DataVO;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

readonly class DataVOSerializerInfrastructure implements DataVOSerializerDomainInterface
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function deserialize(mixed $data, string $type, string $format, array $context = []): DataVO
    {
        try {
            return $this->serializer->deserialize(
                data: $data,
                type: DataVO::class,
                format: JsonEncoder::FORMAT
            );
        } catch (\Throwable $e) {
            throw new SerializeException($e->getMessage());
        }
    }
}
