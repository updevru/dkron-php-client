<?php

declare(strict_types=1);

namespace Updevru\Dkron\Resource;

use Updevru\Dkron\ApiClient;
use Updevru\Dkron\Serializer\SerializerInterface;

/**
 * @codeCoverageIgnore
 */
abstract class AbstractResource
{
    protected ApiClient $client;
    protected SerializerInterface $serializer;

    public function __construct(ApiClient $client, SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }
}
