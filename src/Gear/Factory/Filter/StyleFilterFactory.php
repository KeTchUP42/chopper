<?php
declare(strict_types = 1);

namespace Chopper\Gear\Factory\Filter;

use Chopper\Gear\Filtration\Filters\CommentsCleanerFilter;
use Chopper\Gear\Filtration\Filters\FilterEssence\FilterInterface;
use Chopper\Gear\Filtration\Filters\StyleSiftFilter;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * StyleFilterFactory
 */
class StyleFilterFactory implements FilterFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createFilter(): FilterInterface
    {
        $filter = new CommentsCleanerFilter();
        $filter->setFilter(new StyleSiftFilter());

        return $filter;
    }
}
