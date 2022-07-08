<?php

namespace Updevru\Dkron\Value;

use Updevru\Dkron\Exception\InvalidArgumentException;

class JobSearchValue
{
    const SORT_ORDER_ASC = 'ASC';
    const SORT_ORDER_DESC = 'DESC';

    private $request = [];

    private $allowOrder = [self::SORT_ORDER_ASC, self::SORT_ORDER_DESC];

    public function getRequest() : array
    {
        return $this->request;
    }

    /**
     * Filter jobs by metadata
     * @param array $metadata
     * @return JobSearchValue
     */
    public function setMetadata(array $metadata) : self
    {
        $this->request['metadata'] = $metadata;

        return $this;
    }

    /**
     * Sorting field
     * @param string $field
     * @return JobSearchValue
     */
    public function setSort(string $field) : self
    {
        $this->request['_sort'] = $field;

        return $this;
    }

    /**
     * Sort order (ASC/DESC)
     * @param string $order
     * @return JobSearchValue
     */
    public function setOrder(string $order) : self
    {
        if (!in_array($order, $this->allowOrder)) {
            throw new InvalidArgumentException(
                sprintf('Invalid order must %s given %s', implode(',', $this->allowOrder), $order)
            );
        }

        $this->request['_order'] = $order;

        return $this;
    }

    /**
     * Filter query text
     * @param string $q
     * @return JobSearchValue
     */
    public function setFilterQuery(string $q) : self
    {
        $this->request['q'] = $q;

        return $this;
    }

    /**
     * Start index
     * @param int $start
     * @return JobSearchValue
     */
    public function setStart(int $start) : self
    {
        $this->request['_start'] = $start;

        return $this;
    }

    /**
     * Start index
     * @param int $end
     * @return JobSearchValue
     */
    public function setEnd(int $end) : self
    {
        $this->request['_end'] = $end;

        return $this;
    }
}