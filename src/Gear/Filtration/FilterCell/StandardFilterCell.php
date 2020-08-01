<?php
declare(strict_types = 1);

namespace App\Gear\Filtration\FilterCell;

use App\Gear\Filtration\Filters\FilterEssence\FilterInterface;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * StandardFilterCell
 */
class StandardFilterCell implements FilterCellInterface
{
    /**
     * @var FilterInterface
     */
    private $filter;

    /**
     * Конструктор.
     *
     * @param $filter
     */
    public function __construct(FilterInterface $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @inheritDoc
     */
    public function handle(string $data): string
    {
        return $this->filter->handle($data);
    }
}
