<?php
declare(strict_types = 1);

namespace Chopper\Gear\Factory\Filter;

use Chopper\Gear\Filtration\Filters\BaseFilter\IFilter;
use Chopper\Gear\Filtration\Filters\BodyFilter;
use Chopper\Gear\Filtration\Filters\FormCleanerFilter;
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
        $filter = new BodyFilter();
        $filter->setFilter(new ScriptCleanerFilter())->setFilter(new StyleCleanerFilter())
            ->setFilter(new FormCleanerFilter());

        return $filter;
    }
}
