<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\BaseFilter\Filter;

/**
 * BodyFilter
 */
class BodyIsolatorFilter extends Filter
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string
    {
        $body = [];
        preg_match("~<body[^>]*?>.*?</body>~si", $data, $body);

        return parent::handle($body[0] ?? '');
    }
}
