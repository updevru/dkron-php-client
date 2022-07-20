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

    /**
     * @covers \Updevru\Dkron\Endpoint\Endpoint::getLogin
     * @covers \Updevru\Dkron\Endpoint\Endpoint::__construct
     */
    public function testGetEmptyLogin(): void
    {
        $endpoint = new Endpoint('http://localhost');
        $this->assertEquals('http://localhost', $endpoint->getUrl());
        $this->assertEmpty($endpoint->getLogin());
    }

    /**
     * @covers \Updevru\Dkron\Endpoint\Endpoint::getLogin
     * @covers \Updevru\Dkron\Endpoint\Endpoint::__construct
     */
    public function testGetLogin(): void
    {
        $endpoint = new Endpoint('http://localhost', 'login');
        $this->assertEquals('http://localhost', $endpoint->getUrl());
        $this->assertEquals('login', $endpoint->getLogin());
    }

    /**
     * @covers \Updevru\Dkron\Endpoint\Endpoint::getPassword
     * @covers \Updevru\Dkron\Endpoint\Endpoint::__construct
     */
    public function testGetEmptyPassword(): void
    {
        $endpoint = new Endpoint('http://localhost');
        $this->assertEquals('http://localhost', $endpoint->getUrl());
        $this->assertEmpty($endpoint->getPassword());
    }

    /**
     * @covers \Updevru\Dkron\Endpoint\Endpoint::getPassword
     * @covers \Updevru\Dkron\Endpoint\Endpoint::__construct
     */
    public function testGetPassword(): void
    {
        $endpoint = new Endpoint('http://localhost', null, 'password');
        $this->assertEquals('http://localhost', $endpoint->getUrl());
        $this->assertEquals('password', $endpoint->getPassword());
    }
}
