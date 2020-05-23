<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\BaseFilter\Filter;

/**
 * DivFilter
 */
class DivFilter extends Filter
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string
    {
        $block = [];
        preg_match("~<div[^>]*?>.*?</div>~si", $data, $block);

        return parent::handle($block[0] ?? '');
    }
}
