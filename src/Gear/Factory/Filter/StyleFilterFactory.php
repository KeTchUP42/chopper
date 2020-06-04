<?php
declare(strict_types = 1);

namespace Chopper\Gear\Factory\Filter;

use Chopper\Gear\Filtration\Filters\BaseFilter\FilterInterface;
use Chopper\Gear\Filtration\Filters\CommentsCleanerFilter;
use Chopper\Gear\Filtration\Filters\StyleSiftFilter;

/**
 * StyleFilterFactory
 */
class StyleFilterFactory implements FilterFactoryInterface
{
    /**
     * @return FilterInterface
     */
    public function createFilter(): FilterInterface
    {
        $filter = new CommentsCleanerFilter();
        $filter->setFilter(new StyleSiftFilter());

        return $filter;
    }
}
