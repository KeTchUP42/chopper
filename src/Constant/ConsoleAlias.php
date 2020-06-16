<?php
declare(strict_types = 1);

namespace Chopper\Constant;

use Chopper\Gear\Factory\Filter\BaseFilterFactory;
use Chopper\Gear\Factory\Filter\BodyFilterFactory;
use Chopper\Gear\Factory\Filter\DivStructFilterFactory;
use Chopper\Gear\Factory\Filter\FastDivStructFilterFactory;
use Chopper\Gear\Factory\Filter\StyleFilterFactory;
use Chopper\Gear\Handling\MixerCell\TestMixerCell;

/**
 * ConsoleAlias
 */
interface ConsoleAlias
{
    /**
     * Aliases for filter command which uses for choosing correct filter
     */
    public const FILTER_FACTORY_ALIAS = [
        'base'            => BaseFilterFactory::class,
        'body'            => BodyFilterFactory::class,
        'div_struct'      => DivStructFilterFactory::class,
        'fast_div_struct' => FastDivStructFilterFactory::class,
        'style'           => StyleFilterFactory::class,
    ];
    /**
     * Aliases for mixer command which uses for choosing correct mix type
     */
    public const MIX_TYPE_ALIAS = [
        'test' => TestMixerCell::class,
    ];
}
