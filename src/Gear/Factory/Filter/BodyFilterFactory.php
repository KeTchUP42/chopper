<?php
declare(strict_types = 1);

namespace Chopper\Gear\Factory\Filter;

use Chopper\Gear\Filtration\Filters\FilterEssence\FilterInterface;
use Chopper\Gear\Filtration\Filters\BodyIsolatorFilter;

/**
 * BodyFilterFactory
 */
class BodyFilterFactory implements FilterFactoryInterface
{
    /**
     * Method creates new filter
     *
     * @return FilterInterface
     */
    public function createFilter(): FilterInterface
    {
        return new BodyIsolatorFilter();
    }
}
