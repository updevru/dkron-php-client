<?php

declare(strict_types=1);

namespace Updevru\Dkron\Dto;

use JMS\Serializer\Annotation\Type;

class StatusDto
{
    /**
     * @Type("array<string,string>")
     */
    private array $agent;

    /**
     * @Type("array<string,string>")
     */
    private array $serf;

    /**
     * @Type("array<string,string>")
     */
    private array $tags;

    public function getAgent(): array
    {
        return $this->agent;
    }

    public function setAgent(array $agent): void
    {
        $this->agent = $agent;
    }

    public function getSerf(): array
    {
        return $this->serf;
    }

    public function setSerf(array $serf): void
    {
        $this->serf = $serf;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }
}
