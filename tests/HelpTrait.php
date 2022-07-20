<?php

declare(strict_types=1);

namespace Updevru\Dkron\Tests;

use Http\Mock\Client;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Updevru\Dkron\ApiClient;
use Updevru\Dkron\Endpoint\EndpointCollection;

trait HelpTrait
{
    protected function createApiClient(Client $client, array $endpoints = []): ApiClient
    {
        $endpoints = (\count($endpoints) > 0) ? $endpoints : [['url' => 'http://emptyhost']];

        return new ApiClient(
            new EndpointCollection($endpoints),
            $client,
            new Psr17Factory(),
            new Psr17Factory()
        );
    }

    protected function createHttpClient(int $status, ?string $body): Client
    {
        $client = new Client();
        $response = new Response($status, [], $body);
        $client->addResponse($response);

        return $client;
    }
}
