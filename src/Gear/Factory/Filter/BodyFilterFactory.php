<?php
declare(strict_types = 1);

namespace App\Gear\Factory\Filter;

use App\Gear\Filtration\Filters\BodyIsolatorFilter;
use App\Gear\Filtration\Filters\FilterEssence\FilterInterface;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * BodyFilterFactory
 */
class BodyFilterFactory implements FilterFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createFilter(): FilterInterface
    {
        return new BodyIsolatorFilter();
    }
}
