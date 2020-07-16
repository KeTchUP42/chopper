<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\FilterCell;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * FilterCellInterface
 */
interface FilterCellInterface
{
    /**
     * Handle method to filtering
     *
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string;
}
