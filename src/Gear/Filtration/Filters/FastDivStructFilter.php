<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\FilterEssence\AbstractFilter;
use Chopper\TagParser\FastTagParser;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * FastDivStructFilter
 */
class FastDivStructFilter extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    public function handle(string $data): string
    {
        $parser = new FastTagParser('<div', '</div>');
        $result = $parser->parseTagStruct($data);

        return serialize($result);
    }
}
