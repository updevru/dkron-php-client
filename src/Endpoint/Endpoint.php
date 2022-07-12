<?php

declare(strict_types=1);

namespace Updevru\Dkron\Endpoint;

class Endpoint
{
    private bool $available = true;

    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): void
    {
        $this->available = $available;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
