<?php

declare(strict_types=1);

namespace Updevru\Dkron\Tests\Dto;

use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Dto\StatusDto;

class StatusDtoTest extends TestCase
{
    /**
     * @covers \Updevru\Dkron\Dto\StatusDto::getAgent
     * @covers \Updevru\Dkron\Dto\StatusDto::setAgent
     */
    public function testGetAgent(): void
    {
        $status = new StatusDto();
        $this->assertNull($status->getAgent());

        $status->setAgent(['name' => 'node1']);
        $this->assertEquals(['name' => 'node1'], $status->getAgent());
    }

    /**
     * @covers \Updevru\Dkron\Dto\StatusDto::getSerf
     * @covers \Updevru\Dkron\Dto\StatusDto::setSerf
     */
    public function testGetSerf(): void
    {
        $status = new StatusDto();
        $this->assertNull($status->getSerf());

        $status->setSerf(['ping' => 'pong', 'test' => 'ok']);
        $this->assertEquals(['ping' => 'pong', 'test' => 'ok'], $status->getSerf());
    }

    public function testGetTags(): void
    {
        $status = new StatusDto();
        $this->assertNull($status->getTags());

        $status->setTags(['tagA' => 1, 'tagB' => 'test']);
        $this->assertEquals(['tagA' => 1, 'tagB' => 'test'], $status->getTags());
    }
}
