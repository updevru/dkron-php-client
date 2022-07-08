<?php


namespace Updevru\Dkron\Dto;

use JMS\Serializer\Annotation\Type;

class StatusDto
{
    /**
     * @var array
     * @Type("array<string,string>")
     */
    private $agent;

    /**
     * @var array
     * @Type("array<string,string>")
     */
    private $serf;

    /**
     * @var array
     * @Type("array<string,string>")
     */
    private $tags;

    /**
     * @return array
     */
    public function getAgent(): array
    {
        return $this->agent;
    }

    /**
     * @param array $agent
     */
    public function setAgent(array $agent): void
    {
        $this->agent = $agent;
    }

    /**
     * @return array
     */
    public function getSerf(): array
    {
        return $this->serf;
    }

    /**
     * @param array $serf
     */
    public function setSerf(array $serf): void
    {
        $this->serf = $serf;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }


}