<?php

declare(strict_types=1);

namespace Updevru\Dkron\Tests;

use Http\Mock\Client;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Exception\ApiErrorException;

class ApiClientTest extends TestCase
{
    use HelpTrait;

    /**
     * @covers \ApiClient::get
     */
    public function testGetSuccess(): void
    {
        $client = new Client();
        $apiClient = $this->createApiClient($client);

        $apiClient->get('/test', ['q' => 'test', ['tag' => 1, 'index' => 'job']]);
        $request = $client->getLastRequest();

        $this->assertCount(1, $client->getRequests());
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/v1/test', $request->getUri()->getPath());
        $this->assertEquals('q=test&0[tag]=1&0[index]=job', urldecode($request->getUri()->getQuery()));
    }

    /**
     * @covers \ApiClient::get
     */
    public function testGetError(): void
    {
        $client = new Client();
        $client->addResponse(new Response(404));
        $apiClient = $this->createApiClient($client);

        $this->expectException(ApiErrorException::class);
        $this->expectExceptionCode(404);
        $apiClient->get('/test');
    }

    /**
     * @covers \ApiClient::post
     */
    public function testPostSuccess(): void
    {
        $client = new Client();
        $apiClient = $this->createApiClient($client);

        $apiClient->post('/test');
        $request = $client->getLastRequest();

        $this->assertCount(1, $client->getRequests());
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/v1/test', $request->getUri()->getPath());
        $this->assertEquals('', (string) $request->getBody());
    }

    /**
     * @covers \ApiClient::post
     */
    public function testPostWithBodySuccess(): void
    {
        $client = new Client();
        $apiClient = $this->createApiClient($client);

        $apiClient->post('/test', '{"json":"ok"}');
        $request = $client->getLastRequest();

        $this->assertCount(1, $client->getRequests());
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/v1/test', $request->getUri()->getPath());
        $this->assertEquals('{"json":"ok"}', (string) $request->getBody());
        $this->assertEquals('application/json; charset=utf-8', $request->getHeader('Content-Type')[0]);
    }

    /**
     * @covers \ApiClient::delete
     */
    public function testDeleteSuccess(): void
    {
        $client = new Client();
        $apiClient = $this->createApiClient($client);

        $apiClient->delete('/test');
        $request = $client->getLastRequest();

        $this->assertCount(1, $client->getRequests());
        $this->assertEquals('DELETE', $request->getMethod());
        $this->assertEquals('/v1/test', $request->getUri()->getPath());
    }
}
