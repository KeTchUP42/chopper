<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\BaseFilter\Filter;

/**
 * SpanCleanerFilter
 */
class SpanCleanerFilter extends Filter
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string
    {
        return parent::handle(preg_replace("~<span[^>]*?>.*?</span>~si", '', $data));
    }
}
