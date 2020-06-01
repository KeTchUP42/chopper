<?php
declare(strict_types = 1);

namespace Chopper\Gear\Factory\Filter;

use Chopper\Gear\Filtration\Filters\BaseFilter\IFilter;
use Chopper\Gear\Filtration\Filters\BodyIsolatorFilter;
use Chopper\Gear\Filtration\Filters\CommentsCleanerFilter;
use Chopper\Gear\Filtration\Filters\ScriptCleanerFilter;
use Chopper\Gear\Filtration\Filters\StyleCleanerFilter;

/**
 * BaseFilterFactory
 */
class BaseFilterFactory implements IFilterFactory
{
    /**
     * Method creates new filter
     *
     * @return IFilter
     */
    public function createFilter(): IFilter
    {
        $filter = new CommentsCleanerFilter();
        $filter->setFilter(new BodyIsolatorFilter())->setFilter(new ScriptCleanerFilter())
            ->setFilter(new StyleCleanerFilter());

        return $filter;
    }
}
