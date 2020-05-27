<?php
declare(strict_types = 1);

namespace Chopper\Gear\Factory\Filter;

use Chopper\Gear\Filtration\Filters\BaseFilter\IFilter;
use Chopper\Gear\Filtration\Filters\BodyIsolatorFilter;
use Chopper\Gear\Filtration\Filters\FormCleanerFilter;
use Chopper\Gear\Filtration\Filters\ScriptCleanerFilter;
use Chopper\Gear\Filtration\Filters\StyleCleanerFilter;
use Chopper\Gear\Filtration\Filters\UlCleanerFilter;

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
        $filter = new BodyIsolatorFilter();
        $filter->setFilter(new ScriptCleanerFilter())->setFilter(new StyleCleanerFilter())
            ->setFilter(new FormCleanerFilter())->setFilter(new UlCleanerFilter());

        return $filter;
    }
}
