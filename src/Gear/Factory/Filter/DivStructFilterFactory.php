<?php
declare(strict_types = 1);

namespace Chopper\Gear\Factory\Filter;

use Chopper\Gear\Filtration\Filters\FilterEssence\FilterInterface;
use Chopper\Gear\Filtration\Filters\BodyIsolatorFilter;
use Chopper\Gear\Filtration\Filters\CommentsCleanerFilter;
use Chopper\Gear\Filtration\Filters\DivStructFilter;
use Chopper\Gear\Filtration\Filters\ScriptCleanerFilter;
use Chopper\Gear\Filtration\Filters\StyleCleanerFilter;
use Chopper\Gear\Filtration\Filters\SvgCleanerFilter;

/**
 * OnlyDivFilterFactory
 */
class DivStructFilterFactory implements FilterFactoryInterface
{
    /**
     * Method creates new filter
     *
     * @return FilterInterface
     */
    public function createFilter(): FilterInterface
    {
        $filter = new BodyIsolatorFilter();
        $filter->setFilter(new CommentsCleanerFilter())
            ->setFilter(new ScriptCleanerFilter())
            ->setFilter(new StyleCleanerFilter())
            ->setFilter(new SvgCleanerFilter())
            ->setFilter(new DivStructFilter());

        return $filter;
    }
}
