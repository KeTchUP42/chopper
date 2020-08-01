<?php
declare(strict_types = 1);

namespace App\Gear\Filtration\Filtrator;

use App\Gear\Filtration\FilterCell\FilterCellInterface;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
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
