<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\BaseFilter\Filter;
use Chopper\TagParser\BaseTagParser;

/**
 * DivSearchFilter
 */
class DivStructFilter extends Filter
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

        return parent::handle(serialize($result));
    }
}
