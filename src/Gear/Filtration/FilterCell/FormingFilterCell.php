<?php
declare(strict_types = 1);

namespace App\Gear\Filtration\FilterCell;

use App\Gear\Factory\Filter\FilterFactoryInterface;
use App\Gear\Filtration\Filters\FilterEssence\FilterInterface;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * FormingFilterCell
 */
class FormingFilterCell implements FilterCellInterface
{
    /**
     * @var FilterInterface
     */
    private $filter;

    /**
     * Конструктор.
     *
     * @param $filterFactory
     */
    public function __construct(FilterFactoryInterface $filterFactory)
    {
        $this->filter = $filterFactory->createFilter();
    }

    /**
     * @inheritDoc
     */
    public function handle(string $data): string
    {
        return $this->filter->handle($data);
    }
}
