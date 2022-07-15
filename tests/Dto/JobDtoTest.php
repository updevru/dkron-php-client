<?php

declare(strict_types=1);

namespace Updevru\Dkron\Tests\Dto;

use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Dto\JobDto;

class JobDtoTest extends TestCase
{
    /**
     * @covers \Updevru\Dkron\Dto\JobDto::getConcurrency
     * @covers \Updevru\Dkron\Dto\JobDto::setConcurrency
     */
    public function testSetConcurrency(): void
    {
        $dto = new JobDto();
        $this->assertEquals(JobDto::CONCURRENCY_ALLOW, $dto->getConcurrency());

        $dto->setConcurrency(JobDto::CONCURRENCY_FORBID);
        $this->assertEquals(JobDto::CONCURRENCY_FORBID, $dto->getConcurrency());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::setProcessors
     * @covers \Updevru\Dkron\Dto\JobDto::getProcessors
     */
    public function testSetProcessors(): void
    {
        $dto = new JobDto();
        $this->assertEquals([], $dto->getProcessors());

        $dto->setProcessors(['processor' => 'test']);
        $this->assertEquals(['processor' => 'test'], $dto->getProcessors());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::setDependentJobs
     * @covers \Updevru\Dkron\Dto\JobDto::getDependentJobs
     */
    public function testSetDependentJobs(): void
    {
        $dto = new JobDto();
        $this->assertNull($dto->getDependentJobs());

        $dto->setDependentJobs(['job', 'test']);
        $this->assertEquals(['job', 'test'], $dto->getDependentJobs());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::setExecutor
     * @covers \Updevru\Dkron\Dto\JobDto::getExecutor
     */
    public function testSetExecutor(): void
    {
        $dto = new JobDto();
        $this->assertEquals('shell', $dto->getExecutor());

        $dto->setExecutor('docker');
        $this->assertEquals('docker', $dto->getExecutor());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::setExpiresAt
     * @covers \Updevru\Dkron\Dto\JobDto::getExpiresAt
     */
    public function testSetExpiresAt(): void
    {
        $date = new \DateTime();

        $dto = new JobDto();
        $this->assertNull($dto->getExpiresAt());

        $dto->setExpiresAt($date);
        $this->assertEquals($date, $dto->getExpiresAt());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::setSchedule
     * @covers \Updevru\Dkron\Dto\JobDto::getSchedule
     */
    public function testSetSchedule(): void
    {
        $dto = new JobDto();
        $this->assertEquals('* * * * * *', $dto->getSchedule());

        $dto->setSchedule('0 */5 * * * *');
        $this->assertEquals('0 */5 * * * *', $dto->getSchedule());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::setLastError
     * @covers \Updevru\Dkron\Dto\JobDto::getLastError
     */
    public function testSetLastError(): void
    {
        $date = new \DateTime();

        $dto = new JobDto();
        $this->assertNull($dto->getLastError());

        $dto->setLastError($date);
        $this->assertEquals($date, $dto->getLastError());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::setTags
     * @covers \Updevru\Dkron\Dto\JobDto::getTags
     */
    public function testSetTags(): void
    {
        $dto = new JobDto();
        $this->assertNull($dto->getTags());

        $dto->setTags(['tagA' => 'test', 'tagB' => 'test2']);
        $this->assertEquals(['tagA' => 'test', 'tagB' => 'test2'], $dto->getTags());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::setSuccessCount
     * @covers \Updevru\Dkron\Dto\JobDto::getSuccessCount
     */
    public function testSetSuccessCount(): void
    {
        $dto = new JobDto();
        $this->assertEquals(0, $dto->getSuccessCount());

        $dto->setSuccessCount(5);
        $this->assertEquals(5, $dto->getSuccessCount());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::setMetadata
     * @covers \Updevru\Dkron\Dto\JobDto::getMetadata
     */
    public function testSetMetadata(): void
    {
        $dto = new JobDto();
        $this->assertNull($dto->getMetadata());

        $dto->setMetadata(['fieldA' => 'test', 'fieldB' => 'test2']);
        $this->assertEquals(['fieldA' => 'test', 'fieldB' => 'test2'], $dto->getMetadata());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::getDisplayName
     * @covers \Updevru\Dkron\Dto\JobDto::setDisplayName
     */
    public function testSetDisplayName(): void
    {
        $dto = new JobDto();
        $this->assertNull($dto->getDisplayName());

        $dto->setDisplayName('test');
        $this->assertEquals('test', $dto->getDisplayName());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::getLastSuccess
     * @covers \Updevru\Dkron\Dto\JobDto::setLastSuccess
     */
    public function testSetLastSuccess(): void
    {
        $date = new \DateTime();

        $dto = new JobDto();
        $this->assertNull($dto->getLastSuccess());

        $dto->setLastSuccess($date);
        $this->assertEquals($date, $dto->getLastSuccess());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::isDisabled
     * @covers \Updevru\Dkron\Dto\JobDto::setDisabled
     */
    public function testSetDisabled(): void
    {
        $dto = new JobDto();
        $this->assertFalse($dto->isDisabled());

        $dto->setDisabled(true);
        $this->assertTrue($dto->isDisabled());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::getNext
     * @covers \Updevru\Dkron\Dto\JobDto::setNext
     */
    public function testSetNext(): void
    {
        $date = new \DateTime();

        $dto = new JobDto();
        $this->assertNull($dto->getNext());

        $dto->setNext($date);
        $this->assertEquals($date, $dto->getNext());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::setExecutorConfig
     * @covers \Updevru\Dkron\Dto\JobDto::getExecutorConfig
     */
    public function testSetExecutorConfig(): void
    {
        $dto = new JobDto();
        $this->assertEquals([], $dto->getExecutorConfig());

        $dto->setExecutorConfig(['command' => 'echo Hi']);
        $this->assertEquals(['command' => 'echo Hi'], $dto->getExecutorConfig());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::setOwnerEmail
     * @covers \Updevru\Dkron\Dto\JobDto::getOwnerEmail
     */
    public function testSetOwnerEmail(): void
    {
        $dto = new JobDto();
        $this->assertNull($dto->getOwnerEmail());

        $dto->setOwnerEmail('mail@test');
        $this->assertEquals('mail@test', $dto->getOwnerEmail());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::getParentJob
     * @covers \Updevru\Dkron\Dto\JobDto::setParentJob
     */
    public function testSetParentJob(): void
    {
        $dto = new JobDto();
        $this->assertNull($dto->getParentJob());

        $dto->setParentJob('test');
        $this->assertEquals('test', $dto->getParentJob());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::isEphemeral
     * @covers \Updevru\Dkron\Dto\JobDto::setEphemeral
     */
    public function testSetEphemeral(): void
    {
        $dto = new JobDto();
        $this->assertFalse($dto->isEphemeral());

        $dto->setEphemeral(true);
        $this->assertTrue($dto->isEphemeral());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::getName
     * @covers \Updevru\Dkron\Dto\JobDto::setName
     */
    public function testSetName(): void
    {
        $dto = new JobDto();
        $this->assertNull($dto->getName());

        $dto->setName('test');
        $this->assertEquals('test', $dto->getName());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::getStatus
     * @covers \Updevru\Dkron\Dto\JobDto::setStatus
     */
    public function testSetStatus(): void
    {
        $dto = new JobDto();
        $this->assertNull($dto->getStatus());

        $dto->setStatus(JobDto::STATUS_SUCCESS);
        $this->assertEquals(JobDto::STATUS_SUCCESS, $dto->getStatus());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::getOwner
     * @covers \Updevru\Dkron\Dto\JobDto::setOwner
     */
    public function testSetOwner(): void
    {
        $dto = new JobDto();
        $this->assertNull($dto->getOwner());

        $dto->setOwner('test');
        $this->assertEquals('test', $dto->getOwner());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::getTimezone
     * @covers \Updevru\Dkron\Dto\JobDto::setTimezone
     */
    public function testSetTimezone(): void
    {
        $dto = new JobDto();
        $this->assertNull($dto->getTimezone());

        $dto->setTimezone('UTC');
        $this->assertEquals('UTC', $dto->getTimezone());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::getRetries
     * @covers \Updevru\Dkron\Dto\JobDto::setRetries
     */
    public function testSetRetries(): void
    {
        $dto = new JobDto();
        $this->assertEquals(0, $dto->getRetries());

        $dto->setRetries(5);
        $this->assertEquals(5, $dto->getRetries());
    }

    /**
     * @covers \Updevru\Dkron\Dto\JobDto::getErrorCount
     * @covers \Updevru\Dkron\Dto\JobDto::setErrorCount
     */
    public function testSetErrorCount(): void
    {
        $dto = new JobDto();
        $this->assertEquals(0, $dto->getErrorCount());

        $dto->setErrorCount(5);
        $this->assertEquals(5, $dto->getErrorCount());
    }
}
