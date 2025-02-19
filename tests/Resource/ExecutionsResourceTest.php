<?php

declare(strict_types=1);

namespace Updevru\Dkron\Tests\Resource;

use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Dto\ExecutionDto;
use Updevru\Dkron\Resource\ExecutionsResource;
use Updevru\Dkron\Serializer\JMSSerializer;
use Updevru\Dkron\Tests\HelpTrait;

class ExecutionsResourceTest extends TestCase
{
    use HelpTrait;

    private function createApi(Client $client): ExecutionsResource
    {
        return new ExecutionsResource(
            $this->createApiClient($client),
            new JMSSerializer()
        );
    }

    /**
     * @covers \Updevru\Dkron\Resource\ExecutionsResource::getExecutions
     */
    public function testBusySuccess(): void
    {
        parent::__construct();

        $body = '
[
  {
    "id": "1657177943281880377-node1",
    "job_name": "test",
    "started_at": "2022-07-07T07:12:23.281880377Z",
    "finished_at": "0001-01-01T00:00:00Z",
    "success": false,
    "output": "app log\n",
    "node_name": "node1",
    "group": 1657177943249763800,
    "attempt": 1
  },
  {
    "id": "1657177943281885377-node1",
    "job_name": "test",
    "started_at": "2022-07-07T07:12:25.281880377Z",
    "finished_at": "2022-07-07T07:13:25.281880377Z",
    "success": false,
    "output": "app log\n",
    "node_name": "node1",
    "group": 1657177943249763800,
    "attempt": 1
  }
]
';
        $client = $this->createHttpClient(200, $body);
        $result = $this->createApi($client)->getExecutions();

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertInstanceOf(ExecutionDto::class, current($result));

        $dto = current($result);
        $this->assertEquals('1657177943281880377-node1', $dto->getId());
        $this->assertEquals('test', $dto->getJobName());
        $this->assertFalse($dto->isSuccess());
        $this->assertEquals("app log\n", $dto->getOutput());
        $this->assertEquals('node1', $dto->getNodeName());
        $this->assertEquals('1657177943249763800', $dto->getGroup());
        $this->assertEquals(1, $dto->getAttempt());
        $this->assertInstanceOf(\DateTime::class, $dto->getFinishedAt());
        $this->assertInstanceOf(\DateTime::class, $dto->getStartedAt());
        $this->assertEquals('0001-01-01T00:00:00', $dto->getFinishedAt()->format('Y-m-d\TH:i:s'));
        $this->assertEquals('2022-07-07T07:12:23', $dto->getStartedAt()->format('Y-m-d\TH:i:s'));
    }

    /**
     * @covers \Updevru\Dkron\Resource\ExecutionsResource::getExecutionsByJob
     */
    public function testGetExecutionsByJobSuccess(): void
    {
        $body = '
[
  {
    "id": "1657192800011065479-node1",
    "job_name": "test",
    "started_at": "2022-07-07T11:20:00.011065479Z",
    "finished_at": "0001-01-01T00:00:00Z",
    "success": false,
    "node_name": "node1",
    "group": 1657192800001404400,
    "attempt": 1,
    "output_truncated": false
  },
  {
    "id": "1657192500049360380-node1",
    "job_name": "test",
    "started_at": "2022-07-07T11:15:00.04936038Z",
    "finished_at": "0001-01-01T00:00:00Z",
    "success": false,
    "node_name": "node1",
    "group": 1657192500000897000,
    "attempt": 1,
    "output_truncated": false
  }
]
';
        $client = $this->createHttpClient(200, $body);
        $result = $this->createApi($client)->getExecutionsByJob('test');

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertInstanceOf(ExecutionDto::class, current($result));
    }

    /**
     * @covers \Updevru\Dkron\Resource\ExecutionsResource::getExecutionById
     */
    public function testGetExecutionById(): void
    {
        $body = '
{
  "id": "1657192800011065479-node1",
  "job_name": "test",
  "started_at": "2022-07-07T11:20:00.011065479Z",
  "finished_at": "0001-01-01T00:00:00Z",
  "success": false,
  "node_name": "node1",
  "group": 1657192800001404400,
  "attempt": 1
}
';
        $client = $this->createHttpClient(200, $body);
        $result = $this->createApi($client)->getExecutionById('test', '1657192800011065479-node1');

        $this->assertInstanceOf(ExecutionDto::class, $result);
    }
}
