<?php

declare(strict_types=1);

namespace Updevru\Dkron\Serializer;

interface SerializerInterface
{
    /**
     * @param mixed $data
     */
    public function serialize($data): string;

    /**
     * @return mixed
     */
    public function deserialize(string $data, string $type, bool $isArray = false);
}
