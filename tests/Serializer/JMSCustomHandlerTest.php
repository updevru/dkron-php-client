<?php

declare(strict_types=1);

namespace Updevru\Dkron\Tests\Serializer;

use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Serializer\JMSCustomHandler;

class JMSCustomHandlerTest extends TestCase
{
    public function cutMilliSecondsProvider(): array
    {
        return [
            ['2022-07-08T10:43:17.909841068Z', '2022-07-08T10:43:17.90984Z'],
            ['2022-07-08T10:43:17.9098Z', '2022-07-08T10:43:17.9098Z'],
            ['2022-07-08T10:43:17', '2022-07-08T10:43:17'],
        ];
    }

    /**
     * @covers \JMSCustomHandler::cutMilliSeconds
     * @dataProvider cutMilliSecondsProvider
     */
    public function testCutMilliSecondsSuccess(string $source, string $result): void
    {
        $return = (new JMSCustomHandler())->cutMilliSeconds($source);
        $this->assertEquals($result, $return);
    }
}
