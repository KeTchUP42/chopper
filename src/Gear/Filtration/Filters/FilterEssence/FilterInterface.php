<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters\FilterEssence;

/**
 * FilterInterface
 */
interface FilterInterface
{
    /**
     * @param FilterInterface $filter
     *
     * @return FilterInterface
     */
    public function setFilter(FilterInterface $filter): FilterInterface;

    /**
     * Method calls next handle method recursive
     *
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string;
}
