<?php

declare(strict_types=1);

namespace Updevru\Dkron;

use Http\Client\Exception\NetworkException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Updevru\Dkron\Endpoint\Endpoint;
use Updevru\Dkron\Endpoint\EndpointInterface;
use Updevru\Dkron\Exception\ApiErrorException;

class ApiClient
{
    public const VERSION = 'v1';

    private EndpointInterface $endpoints;
    private ClientInterface $client;
    private RequestFactoryInterface $requestFactory;
    private StreamFactoryInterface $streamFactory;

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

    private function sendRequest(string $method, string $uri, ?string $body, ?array $query = []): string
    {
        while ($endpoint = $this->endpoints->getAvailableEndpoint()) {
            try {
                $request = $this->requestFactory->createRequest($method, $this->makeUrl($endpoint, $uri, $query));

                if (!empty($body)) {
                    $request = $this->attachBody($request, $body);
                }

                if ($endpoint->getUrl() && $endpoint->getPassword()) {
                    $request = $this->authenticate($request, $endpoint);
                }

                $response = $this->client->sendRequest($request);

                if (!\in_array($response->getStatusCode(), [200, 201], true)) {
                    throw new ApiErrorException(sprintf('Response code: %s, body: %s', $response->getStatusCode(), (string) $response->getBody()), $response->getStatusCode());
                }

                return (string) $response->getBody();
            } catch (NetworkException $e) {
                $this->endpoints->makeUnavailable($endpoint);
            } catch (ApiErrorException $e) {
                throw $e;
            }
        }
    }

    public function get(string $uri, ?array $query = []): string
    {
        return $this->sendRequest('GET', $uri, null, $query);
    }

    public function post(string $uri, ?string $body = null, ?array $query = []): string
    {
        return $this->sendRequest('POST', $uri, $body, $query);
    }

    public function delete(string $uri): string
    {
        return $this->sendRequest('DELETE', $uri, null);
    }

    private function makeUrl(Endpoint $endpoint, string $uri, ?array $query = []): string
    {
        $url = sprintf('%s/%s/%s', $endpoint->getUrl(), self::VERSION, ltrim($uri, '/'));

        if (!empty($query)) {
            $url .= '?'.http_build_query($query);
        }

        return $url;
    }

    private function attachBody(RequestInterface $request, string $body): RequestInterface
    {
        return $request->withBody($this->streamFactory->createStream($body))
            ->withHeader('Content-Type', 'application/json; charset=utf-8');
    }

    private function authenticate(RequestInterface $request, Endpoint $endpoint): RequestInterface
    {
        $header = sprintf('Basic %s', base64_encode(sprintf('%s:%s', $endpoint->getLogin(), $endpoint->getPassword())));

        return $request->withHeader('Authorization', $header);
    }
}
