<?php

namespace Updevru\Dkron\Tests\Value;

use Updevru\Dkron\Value\JobSearchValue;
use PHPUnit\Framework\TestCase;

class JobSearchValueTest extends TestCase
{
    /**
     * @covers JobSearchValue::getRequest
     * @covers JobSearchValue::setMetadata
     * @covers JobSearchValue::setFilterQuery
     * @covers JobSearchValue::setOrder
     * @covers JobSearchValue::setSort
     * @covers JobSearchValue::setStart
     * @covers JobSearchValue::setEnd
     */
    public function testGetRequestSuccess() : void
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
}
