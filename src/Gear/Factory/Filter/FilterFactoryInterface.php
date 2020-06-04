<?php
declare(strict_types = 1);

namespace Chopper\Gear\Factory\Filter;

use Chopper\Gear\Filtration\Filters\BaseFilter\FilterInterface;

/**
 * FilterFactoryInterface
 */
interface FilterFactoryInterface
{
    /**
     * Method creates new filter
     *
     * @return FilterInterface
     */
    public function createFilter(): FilterInterface;
}
