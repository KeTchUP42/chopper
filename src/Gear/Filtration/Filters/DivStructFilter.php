<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\FilterEssence\AbstractFilter;
use Chopper\TagParser\BaseTagParser;

/**
 * DivSearchFilter
 */
class DivStructFilter extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    public function handle(string $data): string
    {
        $parser = new BaseTagParser('<div', '</div>');
        $result = $parser->parseTagStruct($data);

        return serialize($result);
    }
}
