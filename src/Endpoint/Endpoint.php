<?php

declare(strict_types=1);

namespace Updevru\Dkron\Endpoint;

class Endpoint
{
    private bool $available = true;
    private string $url;
    private ?string $login;
    private ?string $password;

    public function __construct(string $url, ?string $login = null, ?string $password = null)
    {
        $this->url = $url;
        $this->login = $login;
        $this->password = $password;
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

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}
