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

        // remove duplicates
        $endpoints = array_map(fn ($endpoint) => $this->sanitize($endpoint), $endpoints);
        $endpoints = array_unique($endpoints);

        foreach ($endpoints as $endpoint) {
            $this->endpoints[] = new Endpoint($this->sanitize($endpoint));
        }
    }

    protected function sanitize(string $endpoint): string
    {
        if (false === filter_var($endpoint, \FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Endpoint '.$endpoint.' has to be a valid URL');
        }
        $url = parse_url($endpoint);
        $endpoint = $url['scheme'].'://'.$url['host'];
        if (isset($url['port'])) {
            $endpoint .= ':'.$url['port'];
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
