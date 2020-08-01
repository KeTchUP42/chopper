<?php
declare(strict_types = 1);

namespace App\Gear\Factory\Filter;

use App\Gear\Filtration\Filters\FilterEssence\FilterInterface;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
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
