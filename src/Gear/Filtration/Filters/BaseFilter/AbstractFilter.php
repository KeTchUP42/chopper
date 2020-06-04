<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters\BaseFilter;

/**
 * AbstractFilter
 */
abstract class AbstractFilter implements FilterInterface
{
    /**
     * @var FilterInterface
     */
    protected $nextFilter;

    /**
     * @param FilterInterface $filter
     *
     * @return FilterInterface
     */
    public function setFilter(FilterInterface $filter): FilterInterface
    {
        $this->nextFilter = $filter;

        return $filter;
    }

    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string
    {
        if ($this->nextFilter) {
            return $this->nextFilter->handle($data);
        }

        return $data;
    }
}
