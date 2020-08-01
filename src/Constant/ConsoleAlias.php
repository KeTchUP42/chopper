<?php
declare(strict_types = 1);

namespace App\Constant;

use App\Gear\Factory\Filter\BaseFilterFactory;
use App\Gear\Factory\Filter\BodyFilterFactory;
use App\Gear\Factory\Filter\DivStructFilterFactory;
use App\Gear\Factory\Filter\FastDivStructFilterFactory;
use App\Gear\Factory\Filter\StyleFilterFactory;
use App\Gear\Handling\MixerCell\DirtMixerCell;
use App\Gear\Handling\MixerCell\TestMixerCell;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * Constants which uses in console commands.
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
        'dirt' => DirtMixerCell::class,
    ];
}
