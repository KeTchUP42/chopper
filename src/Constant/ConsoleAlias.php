<?php
declare(strict_types = 1);

namespace Chopper\Constant;

use Chopper\Gear\Factory\Filter\BaseFilterFactory;
use Chopper\Gear\Factory\Filter\BodyFilterFactory;
use Chopper\Gear\Factory\Filter\DivStructFilterFactory;
use Chopper\Gear\Factory\Filter\FastDivStructFilterFactory;
use Chopper\Gear\Factory\Filter\StyleFilterFactory;

/**
 * ConsoleAlias
 */
interface ConsoleAlias
{
    public const FILTER_FACTORY_ALIAS =
        [
            null              => BaseFilterFactory::class,
            'base'            => BaseFilterFactory::class,
            'body'            => BodyFilterFactory::class,
            'div_struct'      => DivStructFilterFactory::class,
            'fast_div_struct' => FastDivStructFilterFactory::class,
            'style'           => StyleFilterFactory::class,
        ];
}
