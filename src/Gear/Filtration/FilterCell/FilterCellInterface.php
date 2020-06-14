<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\FilterCell;

/**
 * FilterCellInterface
 */
interface FilterCellInterface
{
    /**
     * Mixer handle method to filtering
     *
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string;
}
