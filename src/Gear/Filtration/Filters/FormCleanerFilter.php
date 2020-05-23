<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\BaseFilter\Filter;

/**
 * FormCleanerFilter
 */
class FormCleanerFilter extends Filter
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string
    {
        $data = preg_replace("~<form[^>]*?>.*?</form>~si", '', $data);

        return parent::handle($data);
    }
}
