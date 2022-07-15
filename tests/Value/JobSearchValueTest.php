<?php

declare(strict_types=1);

namespace Updevru\Dkron\Tests\Value;

use PHPUnit\Framework\TestCase;
use Updevru\Dkron\Value\JobSearchValue;

class JobSearchValueTest extends TestCase
{
    /**
     * @covers \Updevru\Dkron\Value\JobSearchValue::getRequest
     * @covers \Updevru\Dkron\Value\JobSearchValue::setMetadata
     * @covers \Updevru\Dkron\Value\JobSearchValue::setFilterQuery
     * @covers \Updevru\Dkron\Value\JobSearchValue::setOrder
     * @covers \Updevru\Dkron\Value\JobSearchValue::setSort
     * @covers \Updevru\Dkron\Value\JobSearchValue::setStart
     * @covers \Updevru\Dkron\Value\JobSearchValue::setEnd
     */
    public function testGetRequestSuccess(): void
    {
        $value = new JobSearchValue();
        $value->setMetadata(['tag' => 'test'])
            ->setFilterQuery('test')
            ->setOrder(JobSearchValue::SORT_ORDER_ASC)
            ->setSort('name')
            ->setStart(10)
            ->setEnd(30)
        ;

        $request = $value->getRequest();
        $this->assertEquals(['tag' => 'test'], $request['metadata']);
        $this->assertEquals('test', $request['q']);
        $this->assertEquals('name', $request['_sort']);
        $this->assertEquals('ASC', $request['_order']);
        $this->assertEquals(30, $request['_end']);
    }

    public function getSetOrderProvider(): array
    {
        return [
            ['ASC', 'ASC'],
            ['DESC', 'DESC'],
            ['asc', 'ASC'],
            ['desc', 'DESC'],
        ];
    }

    /**
     * @dataProvider getSetOrderProvider
     * @covers \Updevru\Dkron\Value\JobSearchValue::setOrder
     */
    public function testSetOrderSuccess(string $order, string $result): void
    {
        $value = (new JobSearchValue())->setOrder($order);
        $this->assertEquals($result, $value->getRequest()['_order']);
    }

    /**
     * @covers \Updevru\Dkron\Value\JobSearchValue::setOrder
     */
    public function testSetOrderError(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        (new JobSearchValue())->setOrder('test');
    }
}
