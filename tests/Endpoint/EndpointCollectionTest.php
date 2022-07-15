<?php

declare(strict_types=1);

namespace Updevru\Dkron\Tests\Endpoint;

use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Endpoint\Endpoint;
use Updevru\Dkron\Endpoint\EndpointCollection;

class EndpointCollectionTest extends TestCase
{
    public function getConstructorCountProvider(): array
    {
        return [
            [['http://localhost']],
            [['http://localhost', 'http://anotherhost']],
            [['http://localhost', 'http://anotherhost', 'https://anotherhost:322']],
        ];
    }

    /**
     * @dataProvider getConstructorCountProvider
     * @covers \Updevru\Dkron\Endpoint\EndpointCollection::__construct
     */
    public function testConstructorCountSuccess(array $urls): void
    {
        $collection = new EndpointCollection($urls);
        $this->assertCount(\count($urls), $collection->getEndpoints());
    }

    public function getConstructorValidProvider(): array
    {
        return [
            [
                ['http://localhost'],
                ['http://localhost'],
            ],
            [
                ['https://localhost:4000'],
                ['https://localhost:4000'],
            ],
            [
                ['https://LOCALHOST:4000'],
                ['https://localhost:4000'],
            ],
            [
                ['https://localhost:4000', 'https://LOCALHOST:4000', 'https://LOCALHOST2:4000', 'https://localhost1:4001'],
                ['https://localhost:4000', 'https://localhost2:4000', 'https://localhost1:4001'],
            ],
        ];
    }

    /**
     * @covers \Updevru\Dkron\Endpoint\EndpointCollection::__construct
     * @covers \Updevru\Dkron\Endpoint\EndpointCollection::sanitize
     * @dataProvider getConstructorValidProvider
     */
    public function testConstructorValidSuccess(array $urls, array $validUrls): void
    {
        $collection = new EndpointCollection($urls);
        $this->assertCount(\count($validUrls), $collection->getEndpoints());

        foreach ($collection->getEndpoints() as $endpoint) {
            $this->assertTrue(\in_array($endpoint->getUrl(), $validUrls, true));
        }
    }

    /**
     * @covers \Updevru\Dkron\Endpoint\EndpointCollection::__construct
     * @covers \Updevru\Dkron\Endpoint\EndpointCollection::sanitize
     */
    public function testConstructorError(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new EndpointCollection(['broken_url']);
    }

    /**
     * @covers \Updevru\Dkron\Endpoint\EndpointCollection::__construct
     * @covers \Updevru\Dkron\Endpoint\EndpointCollection::sanitize
     */
    public function testConstructorCountError(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new EndpointCollection([]);
    }

    /**
     * @covers \Updevru\Dkron\Endpoint\EndpointCollection::getAvailableEndpoint
     * @covers \Updevru\Dkron\Endpoint\EndpointCollection::getEndpoints
     */
    public function testGetAvailableEndpointSuccess(): void
    {
        $urls = ['https://localhost:4001', 'https://localhost:4002', 'https://localhost:4003'];
        $collection = new EndpointCollection($urls);
        $endpoint1 = $collection->getAvailableEndpoint();
        $this->assertInstanceOf(Endpoint::class, $endpoint1);
        $this->assertTrue(\in_array($endpoint1->getUrl(), $urls, true));
        $endpoint1->setAvailable(false);
        unset($urls[array_search($endpoint1->getUrl(), $urls, true)]);

        $endpoint2 = $collection->getAvailableEndpoint();
        $this->assertInstanceOf(Endpoint::class, $endpoint2);
        $this->assertTrue(\in_array($endpoint2->getUrl(), $urls, true));
        $endpoint2->setAvailable(false);
        unset($urls[array_search($endpoint2->getUrl(), $urls, true)]);

        $endpoint3 = $collection->getAvailableEndpoint();
        $this->assertInstanceOf(Endpoint::class, $endpoint3);
        $this->assertTrue(\in_array($endpoint3->getUrl(), $urls, true));
        $endpoint3->setAvailable(false);
        unset($urls[array_search($endpoint3->getUrl(), $urls, true)]);

        $this->assertEmpty($urls);
        $this->assertNotEmpty($collection->getEndpoints());

        $this->expectException(\LogicException::class);
        $collection->getAvailableEndpoint();
    }

    /**
     * @covers \Updevru\Dkron\Endpoint\EndpointCollection::makeUnavailable
     */
    public function testMakeUnavailable(): void
    {
        $collection = new EndpointCollection(['https://localhost:4001']);
        $endpoint = $collection->getAvailableEndpoint();
        $this->assertInstanceOf(Endpoint::class, $endpoint);

        $collection->makeUnavailable($endpoint);

        $this->expectException(\LogicException::class);
        $collection->getAvailableEndpoint();
    }
}
