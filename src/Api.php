<?php

declare(strict_types=1);

namespace Updevru\Dkron;

use Updevru\Dkron\Dto\StatusDto;
use Updevru\Dkron\Resource\ExecutionsResource;
use Updevru\Dkron\Resource\JobsResource;
use Updevru\Dkron\Resource\MembersResource;

class Api
{
    private ApiClient $client;
    private Serializer\SerializerInterface $serializer;

    public JobsResource $jobs;
    public MembersResource $members;
    public ExecutionsResource $executions;

    public function __construct(ApiClient $client, Serializer\SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;

        $this->jobs = new JobsResource($client, $serializer);
        $this->members = new MembersResource($client, $serializer);
        $this->executions = new ExecutionsResource($client, $serializer);
    }

    public function getStatus(): StatusDto
    {
        return $this->serializer->deserialize($this->client->get('/'), StatusDto::class);
    }
}
