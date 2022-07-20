<?php

declare(strict_types=1);

namespace Updevru\Dkron\Endpoint;

class EndpointCollection implements EndpointInterface
{
    /** @var Endpoint[] */
    private array $endpoints = [];

    public function __construct(array $endpoints)
    {
        if (0 === \count($endpoints)) {
            throw new \InvalidArgumentException('Parameter endpoints cannot be empty');
        }

        foreach ($endpoints as $i => $endpoint) {
            if (empty($endpoint['url'])) {
                throw new \InvalidArgumentException(sprintf('On set #%s parameter url cannot be empty', $i));
            }

            $this->endpoints[] = new Endpoint(
                $this->sanitize($endpoint['url']),
                $endpoint['login'] ?? null,
                $endpoint['password'] ?? null,
            );
        }
    }

    protected function sanitize(string $endpoint): string
    {
        if (false === filter_var($endpoint, \FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Endpoint '.$endpoint.' has to be a valid URL');
        }

        return strtolower($endpoint);
    }

    public function getAvailableEndpoint(): Endpoint
    {
        foreach ($this->endpoints as $endpoint) {
            if ($endpoint->isAvailable()) {
                return $endpoint;
            }
        }

        throw new \LogicException('No available endpoint');
    }

    public function makeUnavailable(Endpoint $endpoint): void
    {
        foreach ($this->endpoints as $item) {
            if ($item->getUrl() === $endpoint->getUrl()) {
                $item->setAvailable(false);
            }
        }
    }

    /**
     * @return Endpoint[]
     */
    public function getEndpoints(): array
    {
        return $this->endpoints;
    }
}
