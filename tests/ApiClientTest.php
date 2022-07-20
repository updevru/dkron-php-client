<?php

declare(strict_types=1);

namespace Updevru\Dkron\Tests;

use Http\Client\Exception\NetworkException;
use Http\Mock\Client;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Exception\ApiErrorException;

class ApiClientTest extends TestCase
{
    use HelpTrait;

    /**
     * @covers \Updevru\Dkron\ApiClient::get
     * @covers \Updevru\Dkron\ApiClient::__construct
     * @covers \Updevru\Dkron\ApiClient::sendRequest
     * @covers \Updevru\Dkron\ApiClient::makeUrl
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
     * @covers \Updevru\Dkron\ApiClient::get
     * @covers \Updevru\Dkron\ApiClient::__construct
     * @covers \Updevru\Dkron\ApiClient::sendRequest
     * @covers \Updevru\Dkron\ApiClient::makeUrl
     */
    public function testGetFirstFailSuccess(): void
    {
        $client = new Client();
        $client->addException(new NetworkException('', new Request('GET', 'http://emptyhost/test')));
        $client->addResponse(new Response(200));
        $apiClient = $this->createApiClient($client, [['url' => 'http://emptyhost'], ['url' => 'http://emptyhost2']]);

        $apiClient->get('/test', ['q' => 'test', ['tag' => 1, 'index' => 'job']]);

        $this->assertCount(2, $client->getRequests());
        $this->assertEquals('emptyhost', $client->getRequests()[0]->getUri()->getHost());
        $this->assertEquals('emptyhost2', $client->getRequests()[1]->getUri()->getHost());
    }

    /**
     * @covers \Updevru\Dkron\ApiClient::get
     * @covers \Updevru\Dkron\ApiClient::sendRequest
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
     * @covers \Updevru\Dkron\ApiClient::authenticate
     * @covers \Updevru\Dkron\ApiClient::sendRequest
     */
    public function testGetAuthenticateSuccess(): void
    {
        $client = new Client();
        $apiClient = $this->createApiClient($client, [['url' => 'http://localhost', 'login' => 'test', 'password' => 'test']]);
        $apiClient->get('/test');

        $request = $client->getLastRequest();
        $this->assertCount(1, $request->getHeader('Authorization'));
        $this->assertEquals('Basic aHR0cDovL2xvY2FsaG9zdDp0ZXN0', $request->getHeader('Authorization')[0]);
    }

    /**
     * @covers \Updevru\Dkron\ApiClient::post
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
     * @covers \Updevru\Dkron\ApiClient::post
     * @covers \Updevru\Dkron\ApiClient::sendRequest
     * @covers \Updevru\Dkron\ApiClient::attachBody
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
     * @covers \Updevru\Dkron\ApiClient::delete
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
