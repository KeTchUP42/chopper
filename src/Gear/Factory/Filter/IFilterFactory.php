<?php
declare(strict_types = 1);

namespace Chopper\Gear\Factory\Filter;

use Chopper\Gear\Filtration\Filters\BaseFilter\IFilter;

/**
 * IFilterFactory
 */
interface IFilterFactory
{
    /**
     * Method creates new filter
     *
     * @return IFilter
     */
    public function createFilter(): IFilter;
}
