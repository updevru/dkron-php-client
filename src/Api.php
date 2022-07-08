<?php

namespace Updevru\Dkron;

use Updevru\Dkron\Dto\MemberDto;
use Updevru\Dkron\Dto\StatusDto;
use Updevru\Dkron\Exception\ApiErrorException;
use Updevru\Dkron\Resource\ExecutionsResource;
use Updevru\Dkron\Resource\JobsResource;
use Updevru\Dkron\Resource\MembersResource;

class Api
{
    /** @var ApiClient  */
    private $client;

    /**
     * @var Serializer\SerializerInterface
     */
    private $serializer;

    /** @var JobsResource */
    public $jobs;

    /** @var MembersResource */
    public $members;

    /** @var ExecutionsResource */
    public $executions;

    public function __construct(ApiClient $client, Serializer\SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;

        $this->jobs = new JobsResource($client, $serializer);
        $this->members = new MembersResource($client, $serializer);
        $this->executions = new ExecutionsResource($client, $serializer);
    }

    public function getStatus() : StatusDto
    {
        return $this->serializer->deserialize($this->client->get('/'), StatusDto::class);
    }

    public function isLeader() : bool
    {
        try {
            $this->client->get('/isleader');
        } catch (ApiErrorException $e) {
            if ($e->getCode() === 404) {
                return false;
            }

            throw $e;
        }

        return true;
    }

    public function leave(): MemberDto
    {
        return $this->serializer->deserialize($this->client->get('/leave'), MemberDto::class);
    }
}