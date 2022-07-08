<?php

namespace Updevru\Dkron\Resource;

use Updevru\Dkron\ApiClient;
use Updevru\Dkron\Serializer\SerializerInterface;

abstract class AbstractResource
{
    /**
     * @var ApiClient
     */
    protected $client;
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    public function __construct(ApiClient $client, SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }
}