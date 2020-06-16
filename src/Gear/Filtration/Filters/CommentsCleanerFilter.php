<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\FilterEssence\AbstractFilter;

/**
 * CommentsCleanerFilter
 */
class CommentsCleanerFilter extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    public function handle(string $data): string
    {
        $data = preg_replace("~/\**?.*?\*/~s", '', $data);
        $data = preg_replace("~<!--*?.*?-->~s", '', $data);

        return parent::handle($data);
    }
}
