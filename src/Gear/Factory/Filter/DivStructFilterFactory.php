<?php
declare(strict_types = 1);

namespace App\Gear\Factory\Filter;

use App\Gear\Filtration\Filters\BodyIsolatorFilter;
use App\Gear\Filtration\Filters\CommentsCleanerFilter;
use App\Gear\Filtration\Filters\DivStructFilter;
use App\Gear\Filtration\Filters\FilterEssence\FilterInterface;
use App\Gear\Filtration\Filters\ScriptCleanerFilter;
use App\Gear\Filtration\Filters\StyleCleanerFilter;
use App\Gear\Filtration\Filters\SvgCleanerFilter;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * DivStructFilterFactory
 */
class DivStructFilterFactory implements FilterFactoryInterface
{
    /**
     * @inheritDoc
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
