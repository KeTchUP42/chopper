<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters\BaseFilter;

/**
 * Filter
 */
abstract class Filter implements IFilter
{
    /**
     * @var IFilter
     */
    protected $nextFilter;

    /**
     * @param IFilter $filter
     *
     * @return IFilter
     */
    public function setFilter(IFilter $filter): IFilter
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
