<?php
declare(strict_types = 1);

namespace Chopper\Gear\Factory\Filter;

use Chopper\Gear\Filtration\Filters\BodyIsolatorFilter;
use Chopper\Gear\Filtration\Filters\FilterEssence\FilterInterface;

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
