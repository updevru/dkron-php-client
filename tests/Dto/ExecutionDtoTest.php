<?php

declare(strict_types=1);

namespace Updevru\Dkron\Tests\Dto;

use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Dto\ExecutionDto;

class ExecutionDtoTest extends TestCase
{
    /**
     * @covers \Updevru\Dkron\Dto\ExecutionDto::setGroup
     * @covers \Updevru\Dkron\Dto\ExecutionDto::getGroup
     */
    public function testSetGroup(): void
    {
        $dto = new ExecutionDto();
        $dto->setGroup('group');

        $this->assertEquals('group', $dto->getGroup());
    }

    /**
     * @covers \Updevru\Dkron\Dto\ExecutionDto::setId
     * @covers \Updevru\Dkron\Dto\ExecutionDto::getId
     */
    public function testSetId(): void
    {
        $dto = new ExecutionDto();
        $dto->setId('id');

        $this->assertEquals('id', $dto->getId());
    }

    /**
     * @covers \Updevru\Dkron\Dto\ExecutionDto::setAttempt
     * @covers \Updevru\Dkron\Dto\ExecutionDto::getAttempt
     */
    public function testSetAttempt(): void
    {
        $dto = new ExecutionDto();
        $dto->setAttempt(1);

        $this->assertEquals(1, $dto->getAttempt());
    }

    /**
     * @covers \Updevru\Dkron\Dto\ExecutionDto::setOutput
     * @covers \Updevru\Dkron\Dto\ExecutionDto::getOutput
     */
    public function testSetOutput(): void
    {
        $dto = new ExecutionDto();
        $dto->setOutput('output');

        $this->assertEquals('output', $dto->getOutput());
    }

    /**
     * @covers \Updevru\Dkron\Dto\ExecutionDto::setJobName
     * @covers \Updevru\Dkron\Dto\ExecutionDto::getJobName
     */
    public function testSetJobName(): void
    {
        $dto = new ExecutionDto();
        $dto->setJobName('test');

        $this->assertEquals('test', $dto->getJobName());
    }

    /**
     * @covers \Updevru\Dkron\Dto\ExecutionDto::setStartedAt
     * @covers \Updevru\Dkron\Dto\ExecutionDto::getStartedAt
     */
    public function testSetStartedAt(): void
    {
        $value = new \DateTime();

        $dto = new ExecutionDto();
        $dto->setStartedAt($value);

        $this->assertEquals($value, $dto->getStartedAt());
    }

    /**
     * @covers \Updevru\Dkron\Dto\ExecutionDto::setSuccess
     * @covers \Updevru\Dkron\Dto\ExecutionDto::isSuccess
     */
    public function testSetSuccess(): void
    {
        $dto = new ExecutionDto();
        $dto->setSuccess(true);

        $this->assertTrue($dto->isSuccess());
    }

    /**
     * @covers \Updevru\Dkron\Dto\ExecutionDto::setFinishedAt
     * @covers \Updevru\Dkron\Dto\ExecutionDto::getFinishedAt
     */
    public function testSetFinishedAt(): void
    {
        $value = new \DateTime();

        $dto = new ExecutionDto();
        $dto->setFinishedAt($value);

        $this->assertEquals($value, $dto->getFinishedAt());
    }

    /**
     * @covers \Updevru\Dkron\Dto\ExecutionDto::setNodeName
     * @covers \Updevru\Dkron\Dto\ExecutionDto::getNodeName
     */
    public function testSetNodeName(): void
    {
        $dto = new ExecutionDto();
        $dto->setNodeName('test');

        $this->assertEquals('test', $dto->getNodeName());
    }
}
