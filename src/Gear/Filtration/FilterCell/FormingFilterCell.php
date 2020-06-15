<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\FilterCell;

use Chopper\Gear\Factory\Filter\FilterFactoryInterface;
use Chopper\Gear\Filtration\Filters\FilterEssence\FilterInterface;

/**
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
