<?php

declare(strict_types=1);

namespace Updevru\Dkron\Resource;

use Updevru\Dkron\Dto\MemberDto;
use Updevru\Dkron\Exception\ApiErrorException;

class MembersResource extends AbstractResource
{
    /**
     * List leader of cluster.
     */
    public function getLeader(): MemberDto
    {
        return $this->serializer->deserialize($this->client->get('/leader'), MemberDto::class);
    }

    /**
     * List members.
     *
     * @return MemberDto[]
     */
    public function getMembers(): array
    {
        return $this->serializer->deserialize($this->client->get('/members'), MemberDto::class, true);
    }

    /**
     * Check if node is a leader or follower.
     *
     * @throws ApiErrorException
     */
    public function isLeader(): bool
    {
        try {
            $this->client->get('/isleader');
        } catch (ApiErrorException $e) {
            if (404 === $e->getCode()) {
                return false;
            }

            throw $e;
        }

        return true;
    }

    /**
     * Force the node to leave the cluster.
     */
    public function leave(): MemberDto
    {
        return $this->serializer->deserialize($this->client->get('/leave'), MemberDto::class);
    }
}
