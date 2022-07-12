<?php

declare(strict_types=1);

namespace Updevru\Dkron\Tests;

use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Api;
use Updevru\Dkron\Dto\MemberDto;
use Updevru\Dkron\Dto\StatusDto;
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
     * @covers \Api::getStatus
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

    /**
     * @covers \Api::leave
     */
    public function testLeaveSuccess(): void
    {
        $body = <<<JSON
            {
              "Name": "node1",
              "Addr": "172.17.0.3",
              "Port": 8946,
              "Tags": {
                "dc": "dc1",
                "expect": "1",
                "port": "6868",
                "region": "global",
                "role": "dkron",
                "rpc_addr": "172.17.0.3:6868",
                "server": "true",
                "version": "3.2.0"
              },
              "Status": 1,
              "ProtocolMin": 1,
              "ProtocolMax": 3,
              "ProtocolCur": 4,
              "DelegateMin": 5,
              "DelegateMax": 6,
              "DelegateCur": 7
            }
            JSON;
        $client = $this->createHttpClient(200, $body);
        $result = $this->createApi($client)->leave();

        $this->assertInstanceOf(MemberDto::class, $result);
        $this->assertEquals('node1', $result->getName());
        $this->assertEquals('172.17.0.3', $result->getAddr());
        $this->assertEquals('8946', $result->getPort());
        $this->assertIsArray($result->getTags());
        $this->assertEquals('1', $result->getProtocolMin());
        $this->assertEquals('3', $result->getProtocolMax());
        $this->assertEquals('4', $result->getProtocolCur());
        $this->assertEquals('5', $result->getDelegateMin());
        $this->assertEquals('6', $result->getDelegateMax());
        $this->assertEquals('7', $result->getDelegateCur());
    }

    /**
     * @covers \Api::isLeader
     */
    public function testGetIsLeaderSuccess(): void
    {
        $client = $this->createHttpClient(200, null);
        $result = $this->createApi($client)->isLeader();

        $this->assertTrue($result);
    }

    /**
     * @covers \Api::isLeader
     */
    public function testGetIsNotLeaderSuccess(): void
    {
        $client = $this->createHttpClient(404, null);
        $result = $this->createApi($client)->isLeader();

        $this->assertFalse($result);
    }
}
