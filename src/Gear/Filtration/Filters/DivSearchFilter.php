<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Component\Tag\BaseTagParser;
use Chopper\Gear\Filtration\Filters\BaseFilter\Filter;

/**
 * DivSearchFilter
 */
class DivSearchFilter extends Filter
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

        return parent::handle(json_encode($result));
    }
}
