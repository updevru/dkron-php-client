<?php

namespace Updevru\Dkron\Tests;

use Nyholm\Psr7\Response;
use Nyholm\Psr7\Factory\Psr17Factory;
use Updevru\Dkron\ApiClient;
use Http\Mock\Client;
use Updevru\Dkron\Endpoint\EndpointCollection;

trait HelpTrait
{
    protected function createApiClient(Client $client) : ApiClient
    {
        return new ApiClient(
            new EndpointCollection(['http://localhost']),
            $client,
            new Psr17Factory(),
            new Psr17Factory()
        );
    }

    protected function createHttpClient(int $status, ?string $body) : Client
    {
        $client = new Client();
        $response = new Response($status, [], $body);
        $client->addResponse($response);

        return $client;
    }
}