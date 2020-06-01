<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\BaseFilter\Filter;

/**
 * StyleFilter
 */
class StyleSiftFilter extends Filter
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string
    {
        $style = [];
        preg_match_all("~<style[^>]*?>.*?</style>~si", $data, $style);

        return serialize($style[0]);
    }
}
