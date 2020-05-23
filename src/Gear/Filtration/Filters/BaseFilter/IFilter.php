<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters\BaseFilter;

/**
 * IFilter
 */
interface IFilter
{
    /**
     * @param IFilter $filter
     *
     * @return IFilter
     */
    public function setFilter(IFilter $filter): IFilter;

    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string;
}
