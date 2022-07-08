<?php

namespace Updevru\Dkron\Resource;

use Updevru\Dkron\Dto\MemberDto;

class MembersResource extends AbstractResource
{
    /**
     * List leader of cluster.
     * @return MemberDto
     */
    public function getLeader() : MemberDto
    {
        return $this->serializer->deserialize($this->client->get('/leader'), MemberDto::class);
    }

    /**
     * List members.
     * @return MemberDto[]
     */
    public function getMembers() : array
    {
        return $this->serializer->deserialize($this->client->get('/members'), MemberDto::class, true);
    }
}