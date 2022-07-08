<?php

namespace Updevru\Dkron\Endpoint;

class Endpoint
{
    /** @var bool */
    private $available = true;

    /** @var string */
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * @param bool $available
     */
    public function setAvailable(bool $available): void
    {
        $this->available = $available;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}