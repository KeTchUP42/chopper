<?php
declare(strict_types = 1);

namespace App\Gear\Filtration\Filters;

use App\Gear\Filtration\Filters\FilterEssence\AbstractFilter;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * StyleCleanerFilter
 */
class StyleCleanerFilter extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    public function handle(string $data): string
    {
        return parent::handle(preg_replace("~<style[^>]*?>.*?</style>~si", '', $data));
    }
}
