<?php

declare(strict_types=1);

namespace Updevru\Dkron\Tests\Dto;

use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Dto\MemberDto;

class MemberDtoTest extends TestCase
{
    /**
     * @covers \Updevru\Dkron\Dto\MemberDto::setStatus
     * @covers \Updevru\Dkron\Dto\MemberDto::getStatus
     */
    public function testSetStatus(): void
    {
        $dto = new MemberDto();
        $dto->setStatus(1);
        $this->assertEquals(1, $dto->getStatus());
    }

    /**
     * @covers \Updevru\Dkron\Dto\MemberDto::setDelegateMax
     * @covers \Updevru\Dkron\Dto\MemberDto::getDelegateMax
     */
    public function testSetDelegateMax(): void
    {
        $dto = new MemberDto();
        $dto->setDelegateMax(1);
        $this->assertEquals(1, $dto->getDelegateMax());
    }

    /**
     * @covers \Updevru\Dkron\Dto\MemberDto::setName
     * @covers \Updevru\Dkron\Dto\MemberDto::getName
     */
    public function testSetName(): void
    {
        $dto = new MemberDto();
        $dto->setName('test');
        $this->assertEquals('test', $dto->getName());
    }

    /**
     * @covers \Updevru\Dkron\Dto\MemberDto::setProtocolCur
     * @covers \Updevru\Dkron\Dto\MemberDto::getProtocolCur
     */
    public function testSetProtocolCur(): void
    {
        $dto = new MemberDto();
        $dto->setProtocolCur(1);
        $this->assertEquals(1, $dto->getProtocolCur());
    }

    /**
     * @covers \Updevru\Dkron\Dto\MemberDto::setAddr
     * @covers \Updevru\Dkron\Dto\MemberDto::getAddr
     */
    public function testSetAddr(): void
    {
        $dto = new MemberDto();
        $dto->setAddr('127.0.0.1');
        $this->assertEquals('127.0.0.1', $dto->getAddr());
    }

    /**
     * @covers \Updevru\Dkron\Dto\MemberDto::setPort
     * @covers \Updevru\Dkron\Dto\MemberDto::getPort
     */
    public function testSetPort(): void
    {
        $dto = new MemberDto();
        $dto->setPort(80);
        $this->assertEquals(80, $dto->getPort());
    }

    /**
     * @covers \Updevru\Dkron\Dto\MemberDto::setProtocolMax
     * @covers \Updevru\Dkron\Dto\MemberDto::getProtocolMax
     */
    public function testSetProtocolMax(): void
    {
        $dto = new MemberDto();
        $dto->setProtocolMax(1);
        $this->assertEquals(1, $dto->getProtocolMax());
    }

    /**
     * @covers \Updevru\Dkron\Dto\MemberDto::setTags
     * @covers \Updevru\Dkron\Dto\MemberDto::getTags
     */
    public function testSetTags(): void
    {
        $dto = new MemberDto();
        $dto->setTags(['tag' => 1]);
        $this->assertEquals(['tag' => 1], $dto->getTags());
    }

    /**
     * @covers \Updevru\Dkron\Dto\MemberDto::setProtocolMin
     * @covers \Updevru\Dkron\Dto\MemberDto::getProtocolMin
     */
    public function testSetProtocolMin(): void
    {
        $dto = new MemberDto();
        $dto->setProtocolMin(1);
        $this->assertEquals(1, $dto->getProtocolMin());
    }

    /**
     * @covers \Updevru\Dkron\Dto\MemberDto::setDelegateMin
     * @covers \Updevru\Dkron\Dto\MemberDto::getDelegateMin
     */
    public function testSetDelegateMin(): void
    {
        $dto = new MemberDto();
        $dto->setDelegateMin(1);
        $this->assertEquals(1, $dto->getDelegateMin());
    }

    /**
     * @covers \Updevru\Dkron\Dto\MemberDto::setDelegateCur
     * @covers \Updevru\Dkron\Dto\MemberDto::getDelegateCur
     */
    public function testSetDelegateCur(): void
    {
        $dto = new MemberDto();
        $dto->setDelegateCur(1);
        $this->assertEquals(1, $dto->getDelegateCur());
    }
}
