<?php

namespace Updevru\Dkron\Tests\Serializer;

use Updevru\Dkron\Serializer\JMSCustomHandler;
use PHPUnit\Framework\TestCase;

class JMSCustomHandlerTest extends TestCase
{
    public function cutMilliSecondsProvider()
    {
        return [
            ['2022-07-08T10:43:17.909841068Z', '2022-07-08T10:43:17.90984Z'],
            ['2022-07-08T10:43:17.9098Z', '2022-07-08T10:43:17.9098Z'],
            ['2022-07-08T10:43:17', '2022-07-08T10:43:17'],
        ];
    }

    /**
     * @covers JMSCustomHandler::cutMilliSeconds
     * @dataProvider cutMilliSecondsProvider
     */
    public function testCutMilliSecondsSuccess(string $source, string $result) : void
    {
        $return = (new JMSCustomHandler())->cutMilliSeconds($source);
        $this->assertEquals($result, $return);
    }
}
