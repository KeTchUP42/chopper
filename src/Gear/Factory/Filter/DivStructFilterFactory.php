<?php
declare(strict_types = 1);

namespace Chopper\Gear\Factory\Filter;

use Chopper\Gear\Filtration\Filters\BaseFilter\IFilter;
use Chopper\Gear\Filtration\Filters\CommentsCleanerFilter;
use Chopper\Gear\Filtration\Filters\DivStructFilter;
use Chopper\Gear\Filtration\Filters\StyleCleanerFilter;

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
        $filter = new CommentsCleanerFilter();
        $filter->setFilter(new StyleCleanerFilter())->setFilter(new DivStructFilter());

        return $filter;
    }
}
