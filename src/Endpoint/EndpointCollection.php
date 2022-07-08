<?php


namespace Updevru\Dkron\Endpoint;


class EndpointCollection implements EndpointInterface
{
    /** @var Endpoint[] */
    private $endpoints = [];

    public function __construct(array $endpoints)
    {
        if (count($endpoints) === 0) {
            throw new \InvalidArgumentException('Parameter endpoints cannot be empty');
        }

        // remove duplicates
        $endpoints = array_map(function ($endpoint) {
            return $this->sanitize($endpoint);
        }, $endpoints);
        $endpoints = array_unique($endpoints);

        foreach ($endpoints as $endpoint) {
            $this->endpoints[] = new Endpoint($this->sanitize($endpoint));
        }
    }

    protected function sanitize(string $endpoint): string
    {
        if (filter_var($endpoint, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException('Endpoint ' . $endpoint . ' has to be a valid URL');
        }
        $url = parse_url($endpoint);
        $endpoint = $url['scheme'] . '://' . $url['host'];
        if (isset($url['port'])) {
            $endpoint .= ':' . $url['port'];
        }

        return strtolower($endpoint);
    }

    public function getAvailableEndpoint(): string
    {
        foreach ($this->endpoints as $endpoint) {
            if ($endpoint->isAvailable()) {
                return $endpoint->getUrl();
            }
        }

        throw new \LogicException("No available endpoint");
    }
}