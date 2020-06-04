<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\BaseFilter\AbstractFilter;
use Chopper\TagParser\BaseTagParser;

/**
 * DivSearchFilter
 */
class DivStructFilter extends AbstractFilter
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string
    {
        $parser = new BaseTagParser('<div', '</div>');
        $result = $parser->parseTagStruct($data);

        return serialize($result);
    }
}
