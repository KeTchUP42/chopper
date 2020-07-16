<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\FilterEssence\AbstractFilter;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * BodyFilter
 */
class BodyIsolatorFilter extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    public function handle(string $data): string
    {
        $body = [];
        preg_match("~<body[^>]*?>.*?</body>~si", $data, $body);

        return parent::handle($body[0] ?? '');
    }
}
