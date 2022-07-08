<?php

namespace Updevru\Dkron;

use Http\Message\RequestFactory;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Updevru\Dkron\Endpoint\EndpointInterface;
use Updevru\Dkron\Exception\ApiErrorException;

class ApiClient
{
    const VERSION = 'v1';

    /**
     * @var EndpointInterface
     */
    private $endpoints;
    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * @var RequestFactory
     */
    private $requestFactory;
    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    public function __construct(
        EndpointInterface $endpoints,
        ClientInterface $client,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory
    ) {
        $this->endpoints = $endpoints;
        $this->client = $client;
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
    }

    private function sendRequest(string $method, string $uri, ?string $body, ?array $query = []) : string
    {
        $request = $this->requestFactory->createRequest($method, $this->makeUrl($uri, $query));

        if (!empty($body)) {
            $request = $request->withBody($this->streamFactory->createStream($body))
                ->withHeader('Content-Type', 'application/json; charset=utf-8')
            ;
        }

        $response = $this->client->sendRequest($request);

        if (!in_array($response->getStatusCode(), [200, 201])) {
            throw new ApiErrorException(
                sprintf("Response code: %s, body: %s", $response->getStatusCode(), (string) $response->getBody()),
                $response->getStatusCode()
            );
        }

        return (string) $response->getBody();
    }

    public function get(string $uri, ?array $query = []) : string
    {
        return $this->sendRequest('GET', $uri, null, $query);
    }

    public function post(string $uri, ?string $body = null, ?array $query = []) : string
    {
        return $this->sendRequest('POST', $uri, $body, $query);
    }

    public function delete(string $uri) : string
    {
        return $this->sendRequest('DELETE', $uri, null);
    }

    private function makeUrl(string $uri, ?array $query = [])
    {
        $url = sprintf('%s/%s/%s', $this->endpoints->getAvailableEndpoint(), self::VERSION, ltrim($uri, '/'));

        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        return $url;
    }
}