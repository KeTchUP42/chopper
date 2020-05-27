<?php
declare(strict_types = 1);

namespace Chopper\Gear\Factory\Filter;

use Chopper\Gear\Filtration\Filters\BaseFilter\IFilter;
use Chopper\Gear\Filtration\Filters\BodyFilter;
use Chopper\Gear\Filtration\Filters\DivSearchFilter;
use Chopper\Gear\Filtration\Filters\FormCleanerFilter;
use Chopper\Gear\Filtration\Filters\ScriptCleanerFilter;
use Chopper\Gear\Filtration\Filters\StyleCleanerFilter;

/**
 * DivFilterFactory
 */
class DivFilterFactory implements IFilterFactory
{
    /**
     * Method creates new filter
     *
     * @return IFilter
     */
    public function createFilter(): IFilter
    {
        $filter = new BodyFilter();
        $filter->setFilter(new ScriptCleanerFilter())->setFilter(new FormCleanerFilter())
            ->setFilter(new StyleCleanerFilter())->setFilter(new DivSearchFilter());

        return $filter;
    }
}
