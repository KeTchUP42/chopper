<?php
declare(strict_types = 1);

namespace App\Gear\Filtration\Filters;

use App\Gear\Filtration\Filters\FilterEssence\AbstractFilter;
use App\TagParser\BaseTagParser;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
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
