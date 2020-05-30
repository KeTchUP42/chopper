<?php
declare(strict_types = 1);

namespace Chopper\Gear\Factory\Filter;

use Chopper\Gear\Filtration\Filters\BaseFilter\IFilter;
use Chopper\Gear\Filtration\Filters\DivStructFilter;

/**
 * OnlyDivFilterFactory
 */
class DivStructFilterFactory implements IFilterFactory
{
    /**
     * Method creates new filter
     *
     * @return IFilter
     */
    public function createFilter(): IFilter
    {
        return new DivStructFilter();
    }
}
