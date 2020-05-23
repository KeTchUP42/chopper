<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\BaseFilter\Filter;

/**
 * ScriptCleanerFilter
 */
class ScriptCleanerFilter extends Filter
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string
    {
        $data = preg_replace("~<script[^>]*?>.*?</script>~si", '', $data);

        return parent::handle($data);
    }
}
