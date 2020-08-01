<?php
declare(strict_types = 1);

namespace App\Gear\Factory\Filter;

use App\Gear\Filtration\Filters\CommentsCleanerFilter;
use App\Gear\Filtration\Filters\FilterEssence\FilterInterface;
use App\Gear\Filtration\Filters\StyleSiftFilter;

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
