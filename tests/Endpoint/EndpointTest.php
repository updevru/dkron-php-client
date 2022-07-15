<?php

declare(strict_types=1);

namespace Updevru\Dkron\Tests\Endpoint;

use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Endpoint\Endpoint;

class EndpointTest extends TestCase
{
    /**
     * @covers \Updevru\Dkron\Endpoint\Endpoint::isAvailable
     */
    public function testIsAvailable(): void
    {
        $endpoint = new Endpoint('http://localhost');
        $this->assertTrue($endpoint->isAvailable());
    }

    /**
     * @covers \Updevru\Dkron\Endpoint\Endpoint::isAvailable
     * @covers \Updevru\Dkron\Endpoint\Endpoint::setAvailable
     */
    public function testSetAvailable(): void
    {
        $endpoint = new Endpoint('http://localhost');
        $this->assertTrue($endpoint->isAvailable());

        $endpoint->setAvailable(false);
        $this->assertFalse($endpoint->isAvailable());
    }

    /**
     * @covers \Updevru\Dkron\Endpoint\Endpoint::getUrl
     * @covers \Updevru\Dkron\Endpoint\Endpoint::__construct
     */
    public function testGetUrl(): void
    {
        $endpoint = new Endpoint('http://localhost');
        $this->assertEquals('http://localhost', $endpoint->getUrl());
    }
}
