<?php

namespace Updevru\Dkron\Tests\Resource;

use Http\Mock\Client;
use Updevru\Dkron\Dto\MemberDto;
use Updevru\Dkron\Resource\MembersResource;
use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Serializer\JMSSerializer;
use Updevru\Dkron\Tests\HelpTrait;

class MembersResourceTest extends TestCase
{
    use HelpTrait;

    private function createApi(Client $client) : MembersResource
    {
        return new MembersResource(
            $this->createApiClient($client),
            new JMSSerializer()
        );
    }

    /**
     * @covers MembersResource::getLeader
     */
    public function testGetLeaderSuccess() : void
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
        $result = $this->createApi($client)->getLeader();

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
     * @covers MembersResource::getMembers
     */
    public function testGetMembersSuccess()
    {
        $body = '
[
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
    "ProtocolMax": 5,
    "ProtocolCur": 2,
    "DelegateMin": 2,
    "DelegateMax": 5,
    "DelegateCur": 4,
    "id": "d2c84895-b06c-4277-00d5-5585f0a2ce65",
    "statusText": "alive"
  }
]
';
        $client = $this->createHttpClient(200, $body);
        $result = $this->createApi($client)->getMembers();

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(MemberDto::class, current($result));
    }
}
