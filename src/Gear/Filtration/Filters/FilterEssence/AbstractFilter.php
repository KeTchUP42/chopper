<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters\FilterEssence;

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
     * Method calls next handle method recursive
     *
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string
    {
        if (isset($this->nextFilter)) {
            return $this->nextFilter->handle($data);
        }

        return $data;
    }
}
