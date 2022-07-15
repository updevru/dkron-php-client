<?php

declare(strict_types=1);

namespace Updevru\Dkron\Tests;

use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Api;
use Updevru\Dkron\Dto\StatusDto;
use Updevru\Dkron\Resource\ExecutionsResource;
use Updevru\Dkron\Resource\JobsResource;
use Updevru\Dkron\Resource\MembersResource;
use Updevru\Dkron\Serializer\JMSSerializer;

class ApiTest extends TestCase
{
    use HelpTrait;

    private function createApi(Client $client): Api
    {
        return new Api(
            $this->createApiClient($client),
            new JMSSerializer()
        );
    }

    /**
     * @covers \Updevru\Dkron\Api::__construct
     */
    public function testApiConstructorSuccess(): void
    {
        $api = $this->createApi($this->createHttpClient(200, ''));

        $this->assertInstanceOf(ExecutionsResource::class, $api->executions);
        $this->assertInstanceOf(JobsResource::class, $api->jobs);
        $this->assertInstanceOf(MembersResource::class, $api->members);
    }

    /**
     * @covers \Updevru\Dkron\Api::getStatus
     * @covers \Updevru\Dkron\Serializer\JMSSerializer::deserialize
     * @covers \Updevru\Dkron\Serializer\JMSSerializer::__construct
     */
    public function testGetStatusSuccess(): void
    {
        $body = <<<JSON
            {
              "agent": {
                "name": "node1",
                "version": "3.2.0"
              },
              "serf": {
                "coordinate_resets": "0",
                "encrypted": "false",
                "event_queue": "0",
                "event_time": "1",
                "failed": "0",
                "health_score": "0",
                "intent_queue": "0",
                "left": "0",
                "member_time": "1",
                "members": "1",
                "query_queue": "0",
                "query_time": "1"
              },
              "tags": {
                "dc": "dc1",
                "expect": "1",
                "port": "6868",
                "region": "global",
                "role": "dkron",
                "rpc_addr": "172.17.0.3:6868",
                "server": "true",
                "version": "3.2.0"
              }
            }
            JSON;
        $client = $this->createHttpClient(200, $body);
        $result = $this->createApi($client)->getStatus();

        $this->assertInstanceOf(StatusDto::class, $result);
        $this->assertIsArray($result->getTags());
        $this->assertIsArray($result->getAgent());
        $this->assertIsArray($result->getSerf());
    }
}
