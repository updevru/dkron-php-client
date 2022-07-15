<?php

declare(strict_types=1);

namespace Updevru\Dkron\Value;

class JobSearchValue
{
    public const SORT_ORDER_ASC = 'ASC';
    public const SORT_ORDER_DESC = 'DESC';

    private array $request = [];

    private array $allowOrder = [self::SORT_ORDER_ASC, self::SORT_ORDER_DESC];

    public function getRequest(): array
    {
        return $this->request;
    }

    /**
     * Filter jobs by metadata.
     *
     * @return JobSearchValue
     */
    public function setMetadata(array $metadata): self
    {
        $this->request['metadata'] = $metadata;

        return $this;
    }

    /**
     * Sorting field.
     *
     * @return JobSearchValue
     */
    public function setSort(string $field): self
    {
        $this->request['_sort'] = $field;

        return $this;
    }

    /**
     * Sort order (ASC/DESC).
     *
     * @return JobSearchValue
     */
    public function setOrder(string $order): self
    {
        $order = mb_strtoupper($order);

        if (!\in_array($order, $this->allowOrder, true)) {
            throw new \InvalidArgumentException(sprintf('Invalid order must %s given %s', implode(',', $this->allowOrder), $order));
        }

        $this->request['_order'] = $order;

        return $this;
    }

    /**
     * Filter query text.
     *
     * @return JobSearchValue
     */
    public function setFilterQuery(string $q): self
    {
        $this->request['q'] = $q;

        return $this;
    }

    /**
     * Start index.
     *
     * @return JobSearchValue
     */
    public function setStart(int $start): self
    {
        $this->request['_start'] = $start;

        return $this;
    }

    /**
     * Start index.
     *
     * @return JobSearchValue
     */
    public function setEnd(int $end): self
    {
        $this->request['_end'] = $end;

        return $this;
    }
}
