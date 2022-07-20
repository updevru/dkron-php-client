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
            [[['url' => 'http://localhost']]],
            [[['url' => 'http://localhost'], ['url' => 'http://anotherhost']]],
            [[['url' => 'http://localhost'], ['url' => 'http://anotherhost'], ['url' => 'https://anotherhost:322']]],
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
                [['url' => 'http://localhost']],
                ['http://localhost'],
            ],
            [
                [['url' => 'https://localhost:4000']],
                ['https://localhost:4000'],
            ],
            [
                [['url' => 'https://LOCALHOST:4000']],
                ['https://localhost:4000'],
            ],
            [
                [['url' => 'https://localhost:4000'], ['url' => 'https://LOCALHOST2:4000'], ['url' => 'https://localhost1:4001']],
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
    public function testConstructorInvalidUrlError(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new EndpointCollection([['url' => 'broken_url']]);
    }

    /**
     * @covers \Updevru\Dkron\Endpoint\EndpointCollection::__construct
     * @covers \Updevru\Dkron\Endpoint\EndpointCollection::sanitize
     */
    public function testConstructorEmptyUrlError(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new EndpointCollection([['url' => null]]);

        $this->expectException(\InvalidArgumentException::class);
        new EndpointCollection([['url2' => null]]);
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
        $urls = [['url' => 'https://localhost:4001'], ['url' => 'https://localhost:4002'], ['url' => 'https://localhost:4003']];
        $collection = new EndpointCollection($urls);
        $endpoint1 = $collection->getAvailableEndpoint();
        $this->assertInstanceOf(Endpoint::class, $endpoint1);
        $this->assertEquals($endpoint1->getUrl(), $urls[0]['url']);
        $endpoint1->setAvailable(false);

        $endpoint2 = $collection->getAvailableEndpoint();
        $this->assertInstanceOf(Endpoint::class, $endpoint2);
        $this->assertEquals($endpoint2->getUrl(), $urls[1]['url']);
        $endpoint2->setAvailable(false);

        $endpoint3 = $collection->getAvailableEndpoint();
        $this->assertInstanceOf(Endpoint::class, $endpoint3);
        $this->assertEquals($endpoint3->getUrl(), $urls[2]['url']);
        $endpoint3->setAvailable(false);

        $this->assertNotEmpty($collection->getEndpoints());

        $this->expectException(\LogicException::class);
        $collection->getAvailableEndpoint();
    }

    /**
     * @covers \Updevru\Dkron\Endpoint\EndpointCollection::makeUnavailable
     */
    public function testMakeUnavailable(): void
    {
        $collection = new EndpointCollection([['url' => 'https://localhost:4001']]);
        $endpoint = $collection->getAvailableEndpoint();
        $this->assertInstanceOf(Endpoint::class, $endpoint);

        $collection->makeUnavailable($endpoint);

        $this->expectException(\LogicException::class);
        $collection->getAvailableEndpoint();
    }
}
