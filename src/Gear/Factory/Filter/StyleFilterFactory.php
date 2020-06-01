<?php
declare(strict_types = 1);

namespace Chopper\Gear\Factory\Filter;

use Chopper\Gear\Filtration\Filters\BaseFilter\IFilter;
use Chopper\Gear\Filtration\Filters\CommentsCleanerFilter;
use Chopper\Gear\Filtration\Filters\StyleSiftFilter;

/**
 * StyleFilterFactory
 */
class StyleFilterFactory implements IFilterFactory
{
    /**
     * @return IFilter
     */
    public function createFilter(): IFilter
    {
        $filter = new CommentsCleanerFilter();
        $filter->setFilter(new StyleSiftFilter());

        return $filter;
    }
}
