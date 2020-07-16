<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\FilterEssence\AbstractFilter;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * StyleFilter
 */
class StyleSiftFilter extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    public function handle(string $data): string
    {
        $style = [];
        preg_match_all("~<style[^>]*?>.*?</style>~si", $data, $style);

        return serialize($style[0]);
    }
}
