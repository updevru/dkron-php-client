<?php

namespace Updevru\Dkron\Tests\Resource;

use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Dto\JobDto;
use Updevru\Dkron\Resource\JobsResource;
use Updevru\Dkron\Serializer\JMSSerializer;
use Updevru\Dkron\Tests\HelpTrait;

class JobsResourceTest extends TestCase
{
    use HelpTrait;

    private function createApi(Client $client) : JobsResource
    {
        return new JobsResource(
            $this->createApiClient($client),
            new JMSSerializer()
        );
    }

    /**
     * @covers JobsResource::getJobs
     */
    public function testGetJobsSuccess() : void
    {
        $body = '[
  {
    "id": "test",
    "name": "test",
    "displayname": "Test",
    "timezone": "UTC",
    "schedule": "0 */5 * * * *",
    "owner": "Test team",
    "owner_email": "team@test.test",
    "success_count": 0,
    "error_count": 0,
    "last_success": null,
    "last_error": null,
    "disabled": true,
    "tags": null,
    "metadata": null,
    "retries": 0,
    "dependent_jobs": null,
    "parent_job": "",
    "processors": {},
    "concurrency": "allow",
    "executor": "shell",
    "executor_config": {
      "command": "echo Hi"
    },
    "status": "",
    "next": "2022-07-07T14:55:00Z",
    "ephemeral": false,
    "expires_at": null
  },
  {
    "id": "test2",
    "name": "test2",
    "displayname": "",
    "timezone": "",
    "schedule": "0 0 0 * * *",
    "owner": "",
    "owner_email": "",
    "success_count": 1,
    "error_count": 0,
    "last_success": "2022-07-07T20:27:39.654855874Z",
    "last_error": null,
    "disabled": false,
    "tags": {"tag": "test"},
    "metadata": {"dc":"cloud"},
    "retries": 0,
    "dependent_jobs": null,
    "parent_job": "",
    "processors": {},
    "concurrency": "allow",
    "executor": "shell",
    "executor_config": {
      "command": "echo Hello"
    },
    "status": "success",
    "next": "2022-07-08T00:00:00Z",
    "ephemeral": false,
    "expires_at": null
  }
]';
        $client = $this->createHttpClient(200, $body);
        $result = $this->createApi($client)->getJobs();

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertInstanceOf(JobDto::class, current($result));

        $dto = current($result);
        $this->assertEquals('test', $dto->getName());
        $this->assertEquals('Test', $dto->getDisplayName());
        $this->assertEquals('UTC', $dto->getTimezone());
        $this->assertEquals('0 */5 * * * *', $dto->getSchedule());
        $this->assertEquals('Test team', $dto->getOwner());
        $this->assertEquals('team@test.test', $dto->getOwnerEmail());
        $this->assertEquals(0, $dto->getSuccessCount());
        $this->assertEquals(0, $dto->getErrorCount());
        $this->assertNull($dto->getLastSuccess());
        $this->assertTrue($dto->isDisabled());
        $this->assertNull($dto->getTags());
        $this->assertNull($dto->getMetadata());
        $this->assertEquals(0, $dto->getRetries());
        $this->assertNull($dto->getDependentJobs());
        $this->assertEquals("", $dto->getParentJob());
        $this->assertEquals([], $dto->getProcessors());
        $this->assertEquals(JobDto::CONCURRENCY_ALLOW, $dto->getConcurrency());
        $this->assertEquals('shell', $dto->getExecutor());
        $this->assertEquals(['command' => 'echo Hi'], $dto->getExecutorConfig());
        $this->assertEquals('', $dto->getStatus());
        $this->assertEquals('2022-07-07T14:55:00', $dto->getNext()->format('Y-m-d\TH:i:s'));
        $this->assertFalse($dto->isEphemeral());
        $this->assertNull($dto->getExpiresAt());

        $dto = $result[1];
        $this->assertEquals('test2', $dto->getName());
        $this->assertEquals('', $dto->getDisplayName());
        $this->assertEquals('', $dto->getTimezone());
        $this->assertEquals('0 0 0 * * *', $dto->getSchedule());
        $this->assertEquals('', $dto->getOwner());
        $this->assertEquals('', $dto->getOwnerEmail());
        $this->assertEquals(1, $dto->getSuccessCount());
        $this->assertEquals(0, $dto->getErrorCount());
        $this->assertEquals('2022-07-07T20:27:39', $dto->getLastSuccess()->format('Y-m-d\TH:i:s'));
        $this->assertEquals(0, $dto->getErrorCount());
        $this->assertFalse($dto->isDisabled());
        $this->assertEquals(["tag" => "test"], $dto->getTags());
        $this->assertEquals(["dc" => "cloud"], $dto->getMetadata());
        $this->assertEquals(0, $dto->getRetries());
        $this->assertNull($dto->getDependentJobs());
        $this->assertEquals("", $dto->getParentJob());
        $this->assertEquals([], $dto->getProcessors());
        $this->assertEquals(JobDto::CONCURRENCY_ALLOW, $dto->getConcurrency());
        $this->assertEquals('shell', $dto->getExecutor());
        $this->assertEquals(['command' => 'echo Hello'], $dto->getExecutorConfig());
        $this->assertEquals(JobDto::STATUS_SUCCESS, $dto->getStatus());
        $this->assertEquals('2022-07-08T00:00:00', $dto->getNext()->format('Y-m-d\TH:i:s'));
        $this->assertFalse($dto->isEphemeral());
        $this->assertNull($dto->getExpiresAt());
    }

    private function createSingleJobResponse() : string
    {
        return '
{
    "id": "test",
    "name": "test",
    "displayname": "Test",
    "timezone": "UTC",
    "schedule": "0 */5 * * * *",
    "owner": "Test team",
    "owner_email": "team@test.test",
    "success_count": 0,
    "error_count": 0,
    "last_success": null,
    "last_error": null,
    "disabled": true,
    "tags": null,
    "metadata": null,
    "retries": 0,
    "dependent_jobs": null,
    "parent_job": "",
    "processors": {},
    "concurrency": "allow",
    "executor": "shell",
    "executor_config": {
      "command": "echo Hi"
    },
    "status": "",
    "next": "2022-07-07T14:55:00Z",
    "ephemeral": false,
    "expires_at": null
  }
';
    }

    /**
     * @covers JobsResource::getJobByName
     */
    public function testGetJobByNameSuccess()
    {

        $client = $this->createHttpClient(200, $this->createSingleJobResponse());
        $result = $this->createApi($client)->getJobByName('test_job');

        $this->assertInstanceOf(JobDto::class, $result);
        $this->assertStringContainsString('test_job', $client->getLastRequest()->getUri()->getPath());
    }

    /**
     * @covers JobsResource::runJob
     */
    public function testRunJobSuccess()
    {
        $client = $this->createHttpClient(200, $this->createSingleJobResponse());
        $result = $this->createApi($client)->runJob('test_job');

        $this->assertInstanceOf(JobDto::class, $result);
        $this->assertStringContainsString('test_job', $client->getLastRequest()->getUri()->getPath());
    }

    /**
     * @covers JobsResource::deleteJob
     */
    public function testDeleteJobSuccess()
    {
        $client = $this->createHttpClient(200, $this->createSingleJobResponse());
        $result = $this->createApi($client)->deleteJob('test_job');

        $this->assertInstanceOf(JobDto::class, $result);
        $this->assertStringContainsString('test_job', $client->getLastRequest()->getUri()->getPath());
    }

    /**
     * @covers JobsResource::toggleJob
     */
    public function testToggleJobSuccess()
    {
        $client = $this->createHttpClient(200, $this->createSingleJobResponse());
        $result = $this->createApi($client)->toggleJob('test_job');

        $this->assertInstanceOf(JobDto::class, $result);
        $this->assertStringContainsString('test_job', $client->getLastRequest()->getUri()->getPath());
    }
}
