<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filtrator;

use Chopper\Gear\Filtration\FilterCell\FilterCellInterface;

/**
 * FiltratorInterface
 */
interface FiltratorInterface
{
    /**
     * Установка FilterCell.
     *
     * @param FilterCellInterface $filterCell
     *
     * @return FiltratorInterface
     */
    public function setFilterCell(FilterCellInterface $filterCell): FiltratorInterface;

    /**
     * Method starts handling
     *
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string;
}
