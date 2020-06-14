<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\FilterEssence\AbstractFilter;
use Chopper\TagParser\FastTagParser;

/**
 * FastDivStructFilter
 */
class FastDivStructFilter extends AbstractFilter
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string
    {
        $parser = new FastTagParser('<div', '</div>');
        $result = $parser->parseTagStruct($data);

        return serialize($result);
    }
}
